# DJ Franco — WordPress Block Theme

A premium, high-energy WordPress Full Site Editing (FSE) block theme built for [DJ Franco Live](https://djfrancolive.com). Dark-first palette with electric orange / hot pink / cyan accents, cinematic hero, marquee motion, mix grid, booking packages, press / EPK, and contact sections.

## Features

- Pure **block theme** (WordPress 6.5+) — no page builders required
- **Design tokens** in `theme.json`: colors, typography, spacing, shadows, fluid scales
- **Self-hosted variable fonts**: Anton (display), Space Grotesk (headings), Inter (body)
- **Custom templates** for each key page: Home, About, Mixes, Booking Packages, Gallery, Press/EPK, Contact
- **Block patterns** for every major section so the client can mix-and-match in the editor
- Motion that respects `prefers-reduced-motion`
- Works with existing Contact Form 7, Mailchimp for WP, LiteSpeed Cache, Smush, Yoast

## Install

### Option A — git clone into `wp-content/themes/`

```bash
cd /path/to/wordpress/wp-content/themes/
git clone https://github.com/djfrancolive/djfrancolive-site.git djfranco
```

Then activate **DJ Franco** in `Appearance → Themes`.

### Option B — zip upload

1. Download this repo as a ZIP (`Code → Download ZIP`)
2. Rename the extracted folder to `djfranco`
3. Re-zip it
4. Upload via `Appearance → Themes → Add New → Upload Theme`

## After activating

1. `Appearance → Editor → Styles` — verify palette and typography look right
2. `Appearance → Customize → Site Identity` — upload your site logo (1000×1000 `DJFrancoLogo.png` already in media library)
3. `Appearance → Menus` — assign a menu to the **Primary** location
4. `Settings → Reading` — pick a static **Home** page and **Posts** page
5. Each page in `Pages` can switch its template via the `Template` panel in the sidebar (Page: About, Page: Mixes, etc.)
6. Deactivate **WPBakery Page Builder**, **Colibri Page Builder Pro**, **LT-Ext**, **LT Core** — they were tied to ACIDUM and are no longer needed

## Fonts

The theme references `assets/fonts/*.woff2` files that are **not committed yet** — add these three and you're done:

- `anton-regular.woff2` — https://fonts.google.com/specimen/Anton
- `space-grotesk-variable.woff2` — https://fonts.google.com/specimen/Space+Grotesk
- `inter-variable.woff2` — https://rsms.me/inter/

Until those files exist the theme falls back gracefully to system fonts (Impact / system-ui / -apple-system).

## Deploying

A GitHub Actions workflow at `.github/workflows/deploy.yml` can auto-deploy to the live server over SFTP on every push to `main`. Add these secrets in `Settings → Secrets and variables → Actions`:

- `SFTP_HOST`
- `SFTP_USER`
- `SFTP_PASSWORD` (or `SFTP_KEY`)
- `SFTP_REMOTE_PATH` (e.g. `/home/djfranco/public_html/wp-content/themes/djfranco`)

## File map

```
.
├── style.css                 WP theme header
├── theme.json                Design tokens + Global Styles
├── functions.php             Enqueues, supports, pattern categories
├── templates/                Block templates (front-page, page, single, 404…)
├── parts/                    Reusable template parts (header, footer, cta)
├── patterns/                 Block patterns (hero, mix grid, packages…)
├── assets/
│   ├── css/theme.css         Motion / polish beyond theme.json
│   ├── css/editor.css        Editor-only tweaks
│   ├── js/theme.js           Scroll reveals, marquee, hero
│   └── fonts/                Self-hosted woff2 (add manually)
└── .github/workflows/        CI/CD
```

## License

GPL-2.0-or-later.
