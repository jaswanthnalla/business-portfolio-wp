# Business Portfolio — WordPress Theme

A complete, self-contained business portfolio website built with **pure WordPress + PHP**. Zero plugins, zero JavaScript frameworks, zero external dependencies.

## Features

- 4 page templates: **Home**, **About**, **Services**, **Contact**
- Blog support: archive, single post, search, comments, sidebar
- 4 Custom Post Types: **Portfolio**, **Services**, **Testimonials**, **Team**
- Built-in **PHP contact form** — no Contact Form 7 needed
  - WordPress nonce (CSRF protection)
  - Server-side validation + honeypot spam trap
  - Email delivery via `wp_mail()`
  - Submissions logged to a private "Messages" CPT
- Theme Customizer panels for hero, contact info, social links
- CSS-only mobile menu (no JS)
- 3-column footer widget areas + blog sidebar
- Auto-creates required pages and primary menu on theme activation
- WCAG-friendly markup, translation-ready

## Quick install

1. Copy `wp-content/themes/business-portfolio/` into your WordPress install at `wp-content/themes/`
2. WordPress Admin → Appearance → Themes → activate **Business Portfolio**
3. The theme auto-creates Home/About/Services/Contact/Blog pages and assigns templates
4. Customize via Appearance → Customize

See [theme README](wp-content/themes/business-portfolio/README.txt) for full content-management guide.

## Local preview (without WordPress)

A PHP shim that mocks just enough WordPress core to render the templates with sample data:

```bash
php -S 0.0.0.0:8000 -t preview preview/index.php
```

Then open <http://localhost:8000/>. The shim is for visual preview only — the real application runs in a real WordPress installation.

## Project structure

```
wordpress-site/
├── wp-content/themes/business-portfolio/   ← The deliverable WordPress theme
│   ├── style.css                           ← Theme metadata + full stylesheet
│   ├── functions.php                       ← Setup, CPTs, customizer, contact form
│   ├── header.php / footer.php
│   ├── front-page.php
│   ├── page-{about,services,contact}.php
│   ├── archive.php / archive-portfolio.php
│   ├── single.php / single-portfolio.php
│   ├── sidebar.php / search.php / searchform.php
│   ├── comments.php / page.php / 404.php / index.php
│   └── README.txt                          ← Theme docs
└── preview/                                ← Local PHP preview shim (dev only)
    ├── index.php                           ← Router
    └── wp-shim.php                         ← WordPress core mock
```

## Deploying to AwardSpace

See [DEPLOY.md](DEPLOY.md) for step-by-step instructions to host this on AwardSpace's free WordPress hosting (PHP + MySQL + Zacky one-click installer).

## License

GPL v2 or later.
