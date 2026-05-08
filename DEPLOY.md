# Deploying to Hostinger Premium

Hostinger Premium runs full LAMP-stack WordPress with LiteSpeed caching, free SSL, and a free domain — so this entire theme (contact form, custom post types, admin, everything) works out of the box. Plans start around **$2.99/month** with a yearly+ commitment.

**What you get on Premium (typical):**

- ~100 GB SSD storage
- Unmetered bandwidth
- 100 websites + 100 email accounts
- Free domain (`.com`, `.online`, `.xyz`, etc.) for annual plans
- Free SSL (auto-renewed)
- Daily backups
- WordPress + LiteSpeed Cache one-click install
- 24/7 live chat support
- 30-day money-back guarantee

## 1. Sign up

1. Go to <https://www.hostinger.com/web-hosting>
2. Pick **Premium Web Hosting**
3. Choose billing length (the longer the term, the lower the monthly rate; 12 months is the sweet spot)
4. Create your account (email + password, or Google sign-in)
5. Pay (card, PayPal, Google Pay, crypto)

## 2. Claim your free domain

1. After payment, you'll land in **hPanel** with a setup wizard
2. When asked **"Do you have a domain?"** → choose **Claim my free domain**
3. Search for an available name → pick the TLD → click **Use Domain**
4. Domain registers in ~1 minute and auto-points to your hosting

(Or skip this and use the temporary `*.hstgr.io` preview URL while you decide on a domain.)

## 3. Install WordPress

The setup wizard will offer this automatically; if you skip it you can run it from hPanel later.

1. hPanel → **Websites** → click your site → **Auto Installer**
2. Find **WordPress** → click **Select**
3. Fill in:
   - **Website Title** / **Tagline** — anything (changeable)
   - **Admin Username** / **Password** — strong values
   - **Admin Email** — your real email; the contact form will deliver here
   - **Language** — English (or whatever you want)
4. Click **Install**. ~30 seconds later WordPress is live with LiteSpeed Cache pre-installed.

## 4. Upload the theme

A pre-built ZIP is in this repo at the root: **`business-portfolio.zip`** (or download `wp-content/themes/business-portfolio/` from GitHub and zip it yourself).

**Easiest: hPanel File Manager**

1. hPanel → **Websites** → click your site → **File Manager**
2. Navigate to: `public_html/wp-content/themes/`
3. Click **Upload Files** (top-right toolbar) → upload `business-portfolio.zip`
4. Right-click the zip → **Extract**
5. Verify the path: `public_html/wp-content/themes/business-portfolio/style.css`
6. Delete the zip after extraction

**Alternative: WordPress admin**

1. WordPress admin → **Appearance → Themes → Add New → Upload Theme**
2. Pick `business-portfolio.zip` → **Install Now** → **Activate**

(This bypasses File Manager entirely — usually the fastest path.)

## 5. Activate the theme

1. Open WordPress admin: `https://yourdomain.com/wp-admin/`
2. Log in with the admin credentials from step 3
3. **Appearance → Themes** → hover over **Business Portfolio** → **Activate**

The theme automatically:

- Creates **Home**, **About**, **Services**, **Contact**, **Blog** pages
- Assigns the correct page templates
- Sets Home as the static front page, Blog as the posts page
- Builds a default primary menu
- Flushes rewrite rules

## 6. Add content

In the WordPress admin sidebar:

- **Services** → Add New (set the icon emoji + page order in the sidebar meta box)
- **Portfolio** → Add New (with featured image; assign Project Categories)
- **Testimonials** → Add New (set author + role in the meta box)
- **Team** → Add New (set role + LinkedIn URL in the meta box)
- **Posts** → Add New (regular blog posts)

## 7. Customize

**Appearance → Customize:**

- **Homepage Hero** — change hero title and subtitle
- **Contact Information** — email, phone, address shown on Contact page and footer
- **Social Links** — Twitter, Facebook, LinkedIn, Instagram, GitHub URLs

## 8. Test the contact form

1. Visit `https://yourdomain.com/contact/`
2. Submit a test message
3. Check the inbox of the admin email from step 3
4. Submission also visible in wp-admin under **Contact Messages**

## 9. Optional but recommended

**SSL / HTTPS** — Hostinger auto-installs Let's Encrypt SSL within ~10 min. To force HTTPS:

- hPanel → **Websites → your site → SSL** → make sure status is **Active**
- hPanel → **Websites → your site → Force HTTPS** → toggle **On**

**LiteSpeed Cache** — already pre-installed by Hostinger's WordPress installer. In wp-admin:

- **LiteSpeed Cache → Cache** → enable cache
- **LiteSpeed Cache → Page Optimization** → enable CSS/JS minify and combine
- This makes pages load near-instantly

**Email reliability** — Hostinger's `wp_mail()` works well, but for guaranteed delivery (no spam folder issues) install **WP Mail SMTP** and connect a transactional service:

- Brevo (free tier: 300/day)
- SendGrid (free tier: 100/day)
- Mailgun (free trial)

This is the only plugin you'd ever need; the theme itself is plugin-free.

## 10. Post-launch

- **Backups** — Hostinger does daily auto-backups on Premium; manual backups also available in hPanel → **Files → Backups**
- **Updates** — Auto-update WordPress core, themes, and plugins from wp-admin → **Updates**
- **Custom domain** — already claimed in step 2; if you want to add another, hPanel → **Domains → Add domain**
- **Email accounts** — create `you@yourdomain.com` in hPanel → **Emails → Email Accounts**

## Tips

- **Don't pay for SiteLock or other upsells** — Hostinger is fine without them; the theme has no third-party dependencies that need extra security scanning.
- **Skip the "Boost RAM" or premium DNS upsells** unless your traffic is real and high.
- **The 30-day money-back guarantee is genuine** — if hosting doesn't work out, you get refunded (excluding domain registration).

## When to upgrade

Premium is enough for ~25k visitors/month. If you outgrow it:

- **Hostinger Business** (~$3.99/mo) — daily backups + free CDN + 200k visitors/month
- **Hostinger Cloud** (~$9.99/mo) — dedicated resources, 200 sites
- **Kinsta** / **WP Engine** — enterprise-grade managed WordPress

The theme works identically on all of them — just upload to `wp-content/themes/` and activate.
