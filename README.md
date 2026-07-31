# Shree Narayana Guru School of Art — Website & CMS

A professional, **bilingual (English + Kannada)** website for an art school, built on
**Laravel 11** with a **Filament v3** admin panel for managing every piece of content.
Design language: *heritage-elegant* — warm golds, deep maroon and green drawn from the
school crest, refined display serifs, gallery-first layouts.

---

## ✨ Features

- **Fully content-managed** — training centres, faculty, gallery, events, homepage hero slides,
  testimonials, free-form pages (About / Admissions) and site settings are all edited from
  the admin panel. No code changes to update content.
- **Two languages, one click** — every content field is translatable (English + Kannada)
  via a per-locale editor in the admin, and the public site has a language switcher with
  localized URLs (`/en/...`, `/kn/...`) and `hreflang` SEO tags.
- **World-class UI/UX** — animated hero slider, scroll-reveal sections, animated stat
  counters, filterable masonry gallery with lightbox, weekly centre timetable, responsive
  mobile menu, reduced-motion support, accessible focus states.
- **Lead capture** — contact & admission enquiry forms save to the database (visible in the
  admin with an unread badge) and email a notification to the school.
- **SEO-ready** — per-page titles/descriptions, Open Graph tags, sitemap-friendly routes.

---

## 🧱 Tech stack

| Concern            | Choice |
|--------------------|--------|
| Framework          | Laravel 11 (PHP 8.2+) |
| Admin / CMS        | Filament v3 |
| Translations       | spatie/laravel-translatable + Filament translatable plugin |
| Localized routing  | mcamara/laravel-localization |
| Styling            | Tailwind CSS 3 + Vite |
| Interactivity      | Alpine.js |

---

## 🚀 Local setup

> Prerequisites: **PHP 8.2+**, **Composer**, **Node 18+ / npm**, and a database
> (MySQL/MariaDB, or SQLite for zero-config). On Windows the easiest all-in-one is
> [Laragon](https://laragon.org/) or [Herd](https://herd.laravel.com/).

```bash
# 1. Install dependencies
composer install
npm install

# 2. Environment
cp .env.example .env
php artisan key:generate

# 3. Configure the database in .env
#    Either point DB_* at a MySQL database named "artschool",
#    OR use SQLite for a zero-setup start:
#       - set  DB_CONNECTION=sqlite
#       - create an empty file:  database/database.sqlite

# 4. Create tables + demo content (English & Kannada)
php artisan migrate --seed

# 5. Make uploaded images publicly accessible
php artisan storage:link

# 6. Build front-end assets
npm run dev        # during development (hot reload)
# or:  npm run build   # for production

# 7. Serve
php artisan serve
```

Then open **http://localhost:8000** — you'll be redirected to `/en`.

### PowerShell note (Windows)
`&&` isn't supported in Windows PowerShell 5.1. Run the commands one per line, or use
`;` to chain.

### ⚡ This machine — it's already installed & running
The toolchain was installed per-user via **Scoop** (no admin needed): PHP 8.5, Node 24 LTS,
Composer, Git. Dependencies, the SQLite database + demo content, and the compiled assets are
all in place.

On this machine `php artisan serve` / port 8000 fail to bind (port 8000 sits in a
Windows-reserved exclusion range and Symfony's serve pre-check misfires). So the app is
served with PHP's built-in server + a router script on a free port:

```powershell
# add scoop shims to PATH for the session
$env:Path = "$env:USERPROFILE\scoop\shims;$env:Path"
cd d:\projects\artschool
php -S 127.0.0.1:8091 -t public server.php   # -t public is REQUIRED (else CSS/JS 404)
```

> If you ever re-run `composer install`, also run `php artisan filament:assets`
> once to (re)publish the admin panel's CSS/JS into `public/`.

- **Public site:** http://127.0.0.1:8091  (redirects to `/en`; Kannada at `/kn`)
- **Admin panel:** http://127.0.0.1:8091/admin

`server.php` is a tiny router (equivalent to `artisan serve`) committed at the project root.
In production, ignore it and point Nginx/Apache at `public/` as usual.

---

## 🔐 Admin panel (CMS)

- URL: **http://localhost:8000/admin**
- Email: `admin@snsart.example`
- Password: `password`

> Change this password immediately after first login (top-right profile menu).

### What you can manage
| Section | Manages |
|---------|---------|
| **Homepage → Hero Slides** | Big rotating banners on the home page |
| **Homepage → Testimonials** | Student / parent quotes |
| **Content → Training Centres** | Class venues, weekday and timings shown on the centres page and weekly timetable |
| **Content → Faculty** | Teacher profiles |
| **Content → Gallery** | Filterable image gallery |
| **Content → Events** | Upcoming & past events |
| **Content → Pages** | About & Admissions body content |
| **Enquiries** | Contact + admission form submissions (unread badge) |
| **Settings → Site Settings** | Contact info, socials, map, stats, SEO defaults |

### Editing in both languages
Open any content record and use the **language switcher** in the top-right of the edit
screen to flip between **English** and **Kannada**. Each language is saved independently.

---

## 🎨 Using the official logo
The `public/images/logo.png` and `favicon.png` shipped here are **placeholders**. Replace
them with the official school crest you provided (see `public/images/README.txt`). No code
changes are required.

---

## 🌐 Adding another language later
1. Add a block to `config/laravellocalization.php` under `supportedLocales` (e.g. `hi`).
2. Add a `defaultLocales([...])` entry in `app/Providers/Filament/AdminPanelProvider.php`.
3. Create `lang/<code>/messages.php` and `lang/<code>/routes.php` (copy an existing one).
That's it — the switcher and translatable editor pick it up automatically.

---

## 📦 Deploying to production
- Set `APP_ENV=production`, `APP_DEBUG=false`, a real `APP_URL`, and mail credentials.
- `composer install --optimize-autoloader --no-dev`
- `npm run build`
- `php artisan migrate --seed --force`
- `php artisan storage:link`
- `php artisan config:cache route:cache view:cache filament:cache-components`
- Point the web server's document root at **`public/`**.

---

## 📁 Project structure (highlights)
```
app/
  Filament/Resources/     ← CMS screens (one folder per content type)
  Filament/Pages/         ← Site Settings page
  Http/Controllers/       ← Public site controllers
  Models/                 ← TrainingCenter, Faculty, GalleryImage, Event, ...
database/
  migrations/  seeders/   ← Schema + bilingual demo content
lang/en, lang/kn          ← UI strings + route slugs
resources/views/
  components/layouts/app  ← Master layout
  components/             ← Reusable UI (center-card, page-hero, enquiry-form, ...)
  pages/                  ← One Blade file per public page
  partials/               ← Header, footer, language switcher
routes/web.php            ← Localized public routes
```
