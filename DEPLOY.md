# Deploying to AwardSpace

AwardSpace offers a free hosting tier with PHP, MySQL, and a one-click WordPress installer (Zacky Installer) — perfect for running this theme exactly as built. The contact form, custom post types, and WordPress admin all work because real PHP + MySQL is available.

**Free tier specs (as of writing):**

- 1 GB disk space
- 5 GB monthly bandwidth
- 1 MySQL database
- Up to 3 free subdomains (e.g. `yoursite.atspace.cc`, `yoursite.atwebpages.com`)
- PHP 7+ / 8+
- Free File Manager + FTP access
- No ads on your site

## 1. Create a free hosting account

1. Go to <https://www.awardspace.com/free-hosting/> → click **Sign Up Free**
2. Fill in name, email, password
3. Verify your email (check spam if it's slow)
4. Log in to the **Hosting Control Panel**

## 2. Create a subdomain

1. Control Panel → **Domain Manager** (or **Hosted Domains**)
2. Click **Add a New Domain or Subdomain**
3. Pick a free subdomain like `yoursite.atspace.cc`
4. Save — wait ~1 minute for DNS to propagate

## 3. Install WordPress

1. Control Panel → **Zacky Installer** (sometimes labeled "Free Installer" or "1-Click Apps")
2. Find **WordPress** → click **Install**
3. Fill in:
   - **Domain**: select the subdomain you just created
   - **Directory**: leave blank (install at root)
   - **Site Name** / **Tagline**: anything (changeable later)
   - **Admin Username** / **Password**: pick something strong
   - **Admin Email**: your real email — the contact form sends here
4. Click **Install**. Zacky will create the database, install WordPress core, and email you a confirmation when done.

## 4. Upload this theme

A pre-built ZIP is in this repo at the root: **`business-portfolio.zip`** (or download just the theme folder from `wp-content/themes/business-portfolio/` on GitHub).

**Option A — File Manager (easiest)**

1. Control Panel → **File Manager**
2. Navigate to your subdomain's folder, then into: `public_html/wp-content/themes/`
3. Click **Upload** → upload `business-portfolio.zip`
4. Right-click the zip → **Extract** (or use the **Extract** toolbar button)
5. Verify the path is: `public_html/wp-content/themes/business-portfolio/style.css`
6. Delete the zip after extraction (saves quota)

**Option B — FTP**

1. Control Panel → **FTP Accounts** → note your FTP host, username, password
2. Connect with FileZilla:
   - **Host**: from FTP Accounts page
   - **Username** / **Password**: same
   - **Port**: 21
3. Upload the entire `business-portfolio` folder to `/public_html/wp-content/themes/`

## 5. Activate the theme

1. Open your WordPress admin: `https://yoursite.atspace.cc/wp-admin/`
2. Log in with the credentials from step 3
3. **Appearance → Themes** → hover over **Business Portfolio** → **Activate**

The theme automatically:

- Creates **Home**, **About**, **Services**, **Contact**, and **Blog** pages
- Assigns the correct page templates
- Sets Home as the static front page, Blog as the posts page
- Builds a default primary menu
- Flushes rewrite rules

## 6. Add content

- **Services** → wp-admin → Services → Add New (set icon emoji + page order)
- **Portfolio** → wp-admin → Portfolio → Add New (with featured image + categories)
- **Testimonials** → wp-admin → Testimonials → Add New (set author + role in meta box)
- **Team** → wp-admin → Team → Add New (set role + LinkedIn URL)
- **Posts** → wp-admin → Posts → Add New (regular blog posts)

## 7. Customize

**Appearance → Customize:**

- **Homepage Hero** — change the hero title and subtitle
- **Contact Information** — email, phone, address shown on the Contact page and footer
- **Social Links** — Twitter, LinkedIn, Facebook, Instagram, GitHub URLs

## 8. Test the contact form

1. Visit `https://yoursite.atspace.cc/contact/`
2. Submit a test message
3. Check the inbox of the admin email you set in step 3
4. Also visible under **Contact Messages** in wp-admin

## Notes & gotchas

- **AwardSpace puts WordPress files under `public_html/`** (not `htdocs/` like some other hosts). Always use `public_html/wp-content/themes/business-portfolio/`.
- The free tier has a **5 GB bandwidth cap per month** — fine for early traffic, you'll need to upgrade for serious volume.
- **`wp_mail()` works on AwardSpace**, but emails sometimes land in spam. If delivery is unreliable, install **WP Mail SMTP** and connect a free SMTP service (Brevo, SendGrid free tier, Mailgun). This would be the only plugin needed; the theme itself is plugin-free.
- **Sleep after inactivity:** free tier sites may take a few seconds to wake on the first request after a long idle period — that's normal.
- **PHP version:** make sure it's set to PHP 7.4 or 8.x in **Control Panel → PHP Configuration**. WordPress and this theme don't run on PHP 5.x.

## When to upgrade

If you outgrow AwardSpace's free tier:

- **AwardSpace Basic** (~$3/mo) — same host, no bandwidth cap
- **Hostinger** (~$2–4/mo, often discounted) — much faster, free domain included
- **SiteGround** / **Kinsta** / **WP Engine** — premium managed WordPress

The theme works identically on any of them — just upload to `wp-content/themes/` and activate.
