<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Copies content out of the SQLite file the site was developed on and into the
 * current default connection (MySQL on the server).
 *
 * Run `php artisan migrate` first: this command only moves rows, it never
 * creates tables. Infrastructure tables (sessions, cache, queues, migrations)
 * are deliberately skipped — they are per-environment, not content.
 */
class ImportSqliteData extends Command
{
    protected $signature = 'db:import-sqlite
        {--file= : Path to the .sqlite file (defaults to database/database.sqlite)}
        {--force : Skip the confirmation prompt}';

    protected $description = 'Copy content from a SQLite file into the current database connection';

    /** Per-environment tables that must not be carried across. */
    protected array $skip = [
        'migrations',
        'sessions',
        'cache',
        'cache_locks',
        'jobs',
        'job_batches',
        'failed_jobs',
        'password_reset_tokens',
    ];

    public function handle(): int
    {
        $file = $this->option('file') ?: database_path('database.sqlite');

        if (! is_file($file)) {
            $this->error("SQLite file not found: {$file}");

            return self::FAILURE;
        }

        $target = config('database.default');

        if ($target === 'sqlite' && realpath(config('database.connections.sqlite.database')) === realpath($file)) {
            $this->error('Source and target are the same database. Point DB_CONNECTION at the new database first.');

            return self::FAILURE;
        }

        Config::set('database.connections.sqlite_import', [
            'driver' => 'sqlite',
            'database' => $file,
            'prefix' => '',
            'foreign_key_constraints' => false,
        ]);

        $source = DB::connection('sqlite_import');

        $tables = collect($source->select("select name from sqlite_master where type = 'table' and name not like 'sqlite_%' order by name"))
            ->pluck('name')
            ->reject(fn (string $table) => in_array($table, $this->skip, true))
            ->filter(fn (string $table) => Schema::hasTable($table))
            ->values();

        if ($tables->isEmpty()) {
            $this->error('No matching tables found. Run `php artisan migrate` against the new database first.');

            return self::FAILURE;
        }

        $this->newLine();
        $this->line("  Source: <comment>{$file}</comment>");
        $this->line("  Target: <comment>{$target}</comment> (".config("database.connections.{$target}.database").')');
        $this->line('  Tables: '.$tables->implode(', '));
        $this->newLine();

        if (! $this->option('force') && ! $this->confirm('Existing rows in those tables will be replaced. Continue?')) {
            return self::SUCCESS;
        }

        $this->withoutForeignKeyChecks(function () use ($source, $tables) {
            foreach ($tables as $table) {
                DB::table($table)->delete();

                $copied = 0;

                foreach ($source->table($table)->cursor()->chunk(200) as $chunk) {
                    $rows = $chunk->map(fn ($row) => (array) $row)->all();
                    DB::table($table)->insert($rows);
                    $copied += count($rows);
                }

                $this->line(sprintf('  <info>%-24s</info> %d row(s)', $table, $copied));
            }
        });

        $this->newLine();
        $this->info('Done. Log into /admin to confirm the content is present.');

        return self::SUCCESS;
    }

    /** MySQL rejects inserts that break FK order; SQLite here has them off already. */
    protected function withoutForeignKeyChecks(callable $callback): void
    {
        $driver = DB::connection()->getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        }

        try {
            $callback();
        } finally {
            if (in_array($driver, ['mysql', 'mariadb'], true)) {
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            }
        }
    }
}
