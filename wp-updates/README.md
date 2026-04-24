# DJ Franco Theme — EPK Content Update

Drop-in replacement files that swap the placeholder copy (Chicago, Fortune Co., Rooftop 33, gmail address, etc.) for the real EPK content (Tampa, Florida Gators, Coca-Cola, JW Marriott, Oxford Exchange, Armature Works, bookings@djfrancolive.com, etc.).

## What changed

| File | Change |
|---|---|
| `patterns/hero-home.php` | Removed fake "May 17 Grand Ballroom" next-date card. Lede swapped to EPK copy ("There are people that play music…"). Meta shows Tampa / Open-Format · World Sounds / Since 2014 / Worldwide travel. |
| `patterns/testimonials.php` | Three quotes re-attributed: Oxford Exchange private client, JW Marriott events team, Florida Gators Basketball production. |
| `patterns/press-logos.php` | Real client roster: Florida Gators, Coca-Cola, JW Marriott, Keller Williams, 98.9 Jamz, Armature Works, Oxford Exchange, Hotel Flor, CADE Museum, Dillard's. |
| `patterns/stats-strip.php` | 10+ years pro / 200+ events / 3 UF Basketball seasons / 4 states & int'l. |
| `patterns/epk-bio.php` | Short + long bio sourced from the official EPK. Adds UF → Gators → luxury-brand arc. |
| `patterns/about-split.php` | New heading ("A polished, global sound."), Tampa-based copy, genre list (Afrobeats / Amapiano / Dancehall / Hip-Hop). |
| `patterns/marquee.php` | Ticker items: Luxury Weddings · Brand Activations · Private Affairs · Open-Format · Afrobeats · Amapiano · Tampa · Worldwide. |
| `patterns/booking-packages.php` | "Signature Wedding" → "Luxury Wedding" w/ real venue list. "Club & Corporate" → "Brand & Arena". |
| `patterns/gallery-grid.php` | Tile labels now reference real venues: Gators Gainesville, Armature Works, Oxford Exchange, Coca-Cola, JW Marriott, Mexico, Hotel Flor. |
| `patterns/contact-form.php` | Email → `bookings@djfrancolive.com`. Location → "Tampa, FL · Worldwide travel". Event-type options updated. |
| `parts/footer.html` | Footer email → `bookings@djfrancolive.com`. Tagline gains Tampa / Worldwide. |
| `assets/js/theme.js` | Mix card data: Gators Game-Day replaces Rooftop 33; Brand Activation · Coca-Cola replaces Fortune Co.; Armature Works — Live replaces House Parties; etc. |

## How to apply

1. Extract this zip over your theme root so the files land at the same paths (e.g. `wp-content/themes/djfranco/patterns/hero-home.php`).
2. From the theme folder:

   ```bash
   cd /path/to/wp-content/themes/djfranco
   git add -A
   git status   # sanity-check the diff
   git commit -m "Replace placeholder copy with EPK content (Tampa, Gators, Coca-Cola, JW Marriott, Oxford Exchange, bookings@djfrancolive.com)"
   git push origin main
   ```

3. If the GH Actions SFTP workflow is wired up, the push will auto-deploy. Otherwise upload the theme folder the usual way.

4. After deploy, clear any page cache (LiteSpeed / Smush) so the patterns re-render.

## Notes

- No template, CSS, or `theme.json` changes — layout/visuals stay identical to the redesign you already approved. This is a **content-only** pass so everything matches the EPK.
- If you want a different featured-wedding venue list or want to add the Instagram @handle anywhere, say the word and I'll patch those too.
