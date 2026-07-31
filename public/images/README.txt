BRAND ASSETS
============

logo.png and favicon.png are auto-generated PLACEHOLDERS so the site renders
out of the box.

>>> Replace them with the official school crest that you provided:
    1. Save the attached "Shree Narayana Guru School of Art" crest as:
         public/images/logo.png      (square, ideally 512x512 or larger, transparent PNG)
    2. Save a small square version (or the same file) as:
         public/images/favicon.png   (96x96 is plenty)

No code changes are needed — the templates already point at these two files.


HERO SLIDER
===========

hero/ holds the home page slider images, wired up in
database/seeders/HeroSlideSeeder.php.

    1  banner-varna-vaibhava-2026.jpg      banner slide, links to the event page
    2  students-drawing-class.jpg          photo slide (overlay copy)
    3  banner-creativity-blossoms.jpg      banner slide (is_banner = true)
    4  students-artwork-hall.jpg           photo slide (overlay copy)
    5  banner-registered-institution.jpg   banner slide (is_banner = true)
    6  students-drawing-lineup.jpg         photo slide (overlay copy)

Photo slides are cropped to fill the screen and get the maroon scrim plus the
heading/CTA overlay. Banner slides already carry their own artwork and
typography, so `is_banner` shows them whole (letterboxed over a blurred copy of
themselves) with no overlay text.

A banner slide with a `cta_url` turns the whole banner into a link — that is how
the Varna Vaibhava banner opens /events/shree-guru-varna-vaibhava-2026.

After changing an image path, re-run:

    php artisan db:seed --class=HeroSlideSeeder


EVENTS
======

events/ holds event artwork, wired up in database/seeders/EventSeeder.php.

    varna-vaibhava-2026-poster.jpg   Shree Guru Varna Vaibhava-2026 poster,
                                     shown on the event page (click to zoom)

After changing an event, re-run:

    php artisan db:seed --class=EventSeeder


NOT YET USED
============

founder-portrait.jpg   candidate for the About / faculty section
