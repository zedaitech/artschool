<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

/*
| The registered postal address, replacing the placeholder Temple Road one.
| It is a settings row, so correcting the seeder alone would never reach a
| database that has already been seeded. Kept in the same multi-line shape
| as the event venue address, and still editable under Site Settings.
*/

return new class extends Migration
{
    public function up(): void
    {
        Setting::query()->updateOrCreate(
            ['key' => 'contact_address'],
            [
                'value' => implode("\n", [
                    'Shree Narayana Guru School of Art',
                    '1-284/1/4, Shree Mahaguru Krupa,',
                    'Adkabail Road, Adka, Kotekar,',
                    'VTC: Mangaluru, PO: Kotekar,',
                    'District: Dakshina Kannada – 575022',
                    'Karnataka, India',
                ]),
                'group' => 'contact',
            ],
        );
    }

    public function down(): void
    {
        // Data fix — nothing meaningful to roll back to.
    }
};
