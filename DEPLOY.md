# Deploying the Art School demo to Railway

Goal: a live, shareable URL for the client demo. Uses the existing **SQLite**
database (`database/database.sqlite`, already seeded) — no Postgres, no migration.

The container filesystem is writable at runtime, so the Filament panel works and
edits persist within a deployment. Data resets on redeploy (fine for a demo).

---

## What's already done (in this repo)
- `nixpacks.toml` — tells Railway how to build (Composer + Vite) and start the app.
- `database/database.sqlite` — seeded demo data, committed (not git-ignored).
- Session / queue / cache stay on the `database` driver — unchanged.

## What you need to do (account-side — I can't do these from here)

### 1. Get the code into a git repo Railway can read
```powershell
git init
git add .
git commit -m "Art school demo — ready for Railway"
# create an empty GitHub repo, then:
git remote add origin https://github.com/<you>/artschool.git
git push -u origin main
```
(Or use the Railway CLI: `npm i -g @railway/cli`, `railway login`, `railway up`.)

### 2. Create the Railway project
- railway.app -> New Project -> Deploy from GitHub repo -> pick this repo.
- Railway detects `nixpacks.toml` and builds automatically.

### 3. Set environment variables (Railway -> your service -> Variables)
```
APP_NAME="Shree Narayana Guru School of Art"
APP_ENV=production
APP_DEBUG=false
APP_KEY=            # paste output of: php artisan key:generate --show
APP_URL=https://<your-app>.up.railway.app
DB_CONNECTION=sqlite
SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
FILESYSTEM_DISK=public
```
Generate the key locally and paste the value:
```powershell
php artisan key:generate --show
```

### 4. Deploy & get the URL
- Railway builds and gives you a `*.up.railway.app` URL under Settings -> Networking
  (click "Generate Domain" if none is shown). Share that with the client.

---

## Optional: keep client edits across redeploys
Only if the client will edit data and you must not lose it between deploys:
1. Railway -> service -> add a **Volume**, mount path e.g. `/data`.
2. Add env var `DB_DATABASE=/data/database.sqlite`.
3. First deploy only, seed the volume DB:
   `php artisan migrate --force && php artisan db:seed --force`
   (run via Railway's shell, or temporarily append to the start command).

## Verify the demo works
- Open the URL; log into `/admin` (Filament panel).
- Create/edit a record, reload — it persists.
- Check the public site renders in both English and Kannada (en/kn).

## If the build fails on a missing PHP extension
Filament needs `intl`, `gd`, `mbstring`, `pdo_sqlite`. Railway's Nixpacks PHP
provider bundles the common ones; if one is missing, add to `nixpacks.toml`:
```toml
[phases.setup]
nixPkgs = ["...", "php82Extensions.intl", "php82Extensions.gd"]
```

---

# Switching from SQLite to MySQL

Development ran on SQLite (`database/database.sqlite`). MySQL is the right
choice for shared hosting such as Hostinger: no file-locking under concurrent
writes, and the DB can be backed up and inspected from the host's control panel.

Nothing in the app is SQLite-specific, so this is a configuration change plus a
one-off data copy.

## 1. Create the database
In the host's control panel (Hostinger: hPanel -> Databases -> MySQL Databases)
create a database **and** a user, and note the four values you get back.

## 2. Point the app at it
In `.env` (on the server — do not commit it):
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1        # or the host given in the panel
DB_PORT=3306
DB_DATABASE=<database>
DB_USERNAME=<user>
DB_PASSWORD=<password>
```
Sessions, cache and the queue all use the `database` driver, so they follow the
same connection automatically — no other change needed.

## 3. Build the schema
```bash
php artisan migrate --force
```
This creates the tables natively in MySQL. Never import an SQLite dump: the
type affinities, quoting and autoincrement syntax do not translate.

## 4. Move the content — pick one

**a. Re-seed** — quickest, and fine if no content has been edited in the admin
panel since the seeders were written:
```bash
php artisan db:seed --force
```

**b. Copy the real rows** — keeps every edit made in the admin panel. Upload
`database/database.sqlite` alongside the app, then:
```bash
php artisan db:import-sqlite
```
It reads the SQLite file, replaces the matching tables on the current
connection, and reports the row counts. Options: `--file=` for a database
elsewhere on disk, `--force` to skip the confirmation.

Per-environment tables (`migrations`, `sessions`, `cache`, `jobs`,
`failed_jobs`, `password_reset_tokens`) are skipped by design — only content
and the admin user move across. Delete the uploaded `.sqlite` file afterwards.

## 5. Check it
```bash
php artisan config:cache && php artisan view:cache
```

> **Never run `php artisan route:cache` on this project.** Every public URL is
> registered inside `LaravelLocalization::setLocale()` with translated segments
> (`__('routes.centers')`). The standard route cache freezes those at the locale
> that happened to be active on the command line, and every localized URL then
> returns 404 — `/up` keeps working, which makes it look like a routing bug.
> If it has already been run: `php artisan route:clear`.
>
> To cache routes anyway, use the package's own command, `route:trans:cache`,
> which needs the `loadCachedRoutesUsing()` hook described in the
> mcamara/laravel-localization README. Routing is not a bottleneck here — the
> simplest correct choice is to skip it.
Then open the site in both languages, and log into `/admin` — the training
centres, hero slides, events, gallery and Site Settings should all be there.

## Hostinger specifics
- **Document root must point at `/public`**, never the project root — otherwise
  `.env`, `database/` and `vendor/` are downloadable.
- **PHP 8.3** (the installed dependencies require >= 8.3), with `intl`, `gd`,
  `mbstring`, `zip` and `pdo_mysql` enabled.
- **Build assets locally** (`npm run build`) and upload `public/build/` — it is
  git-ignored and there is no Node on shared plans.
- **Run `php artisan storage:link`** over SSH, or images uploaded through the
  admin panel will 404.
- Set `APP_ENV=production`, `APP_DEBUG=false`, a fresh `APP_KEY`
  (`php artisan key:generate`), and `APP_URL` to the live domain.
- Make `storage/` and `bootstrap/cache/` writable.
- Configure real SMTP credentials and set `MAIL_FROM_ADDRESS` to a mailbox on
  your own domain, otherwise enquiry notifications fail silently.

## Document root: point it at `/public`

The domain's document root must be the `public` folder, not the project root.
On Hostinger: hPanel -> Websites -> Dashboard -> Advanced -> "Change website's
root directory" (or set the domain to `.../artschool/public`).

Forwarding from the project root with an `.htaccess` such as
`RewriteRule ^(.*)$ public/$1 [L]` mostly works, but Laravel then sees
`SCRIPT_NAME=/public/index.php` and generates URLs like
`/public/index.php/en`. It also leaves `.env`, `database/` and `storage/`
one mod_rewrite failure away from being downloadable. Once the document root
points at `public/`, delete that root `.htaccess` — `public/.htaccess`
(committed) is the only rewrite file the app needs.
