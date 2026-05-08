# Deploying to InfinityFree

InfinityFree provides free PHP + MySQL hosting that runs real WordPress, so the entire theme — including the contact form, custom post types, and admin — works exactly as built.

## 1. Create a free hosting account

1. Go to <https://www.infinityfree.com/> and sign up (no credit card)
2. From the **Client Area**, click **Create Account**
3. Pick a free subdomain (e.g. `your-site.infinityfreeapp.com`) or attach a custom domain
4. Wait ~5 minutes for the account to provision

## 2. Install WordPress

1. From the Client Area → click **Manage** on your account → **Control Panel**
2. In the control panel, find **Softaculous Apps Installer**
3. Click **WordPress** → **Install Now**
4. Fill in:
   - **Choose Domain**: your InfinityFree subdomain
   - **In Directory**: leave blank to install at root
   - **Site Name** / **Site Description**: anything (you can change later)
   - **Admin Username** / **Password**: pick something strong
   - **Admin Email**: your real email (the contact form sends here)
5. Click **Install**. Softaculous will set up the database and WordPress core for you.

## 3. Upload this theme

**Option A — Upload via cPanel File Manager (easiest)**

1. Download a ZIP of just the theme folder from this repo:
   - In GitHub: navigate to `wp-content/themes/business-portfolio/`
   - Or clone the repo and zip the folder yourself
2. In the InfinityFree control panel → **File Manager** (or **Online File Manager**)
3. Navigate to: `htdocs/wp-content/themes/`
4. Click **Upload** and upload the `business-portfolio` folder (or the ZIP, then **Extract**)
5. Make sure the final path is: `htdocs/wp-content/themes/business-portfolio/style.css`

**Option B — Upload via FTP**

1. In the control panel, find your **FTP Details** (host, username, password)
2. Connect with FileZilla or any FTP client
3. Upload the entire `business-portfolio` folder to `htdocs/wp-content/themes/`

## 4. Activate the theme

1. Open your WordPress admin: `https://your-site.infinityfreeapp.com/wp-admin/`
2. Log in with the admin credentials from step 2
3. Go to **Appearance → Themes**
4. Hover over **Business Portfolio** → click **Activate**

The theme will automatically:

- Create the **Home**, **About**, **Services**, **Contact**, and **Blog** pages
- Assign the correct page templates to each
- Set Home as the static front page and Blog as the posts page
- Build a default primary menu with all five pages
- Flush rewrite rules so pretty URLs work

## 5. Add content

In the WordPress admin sidebar:

- **Services** → Add the actual services you offer (set the icon emoji in the right sidebar meta box, set Page Order to control display order)
- **Portfolio** → Add real projects with featured images (assign Project Categories)
- **Testimonials** → Add client quotes (set author name + role in the meta box)
- **Team** → Add team members (set role + LinkedIn URL in the meta box)
- **Posts** → Write blog posts as usual

## 6. Customize

- **Appearance → Customize → Homepage Hero** — change the hero title and subtitle
- **Appearance → Customize → Contact Information** — set the email/phone/address that show on the Contact page and in the footer
- **Appearance → Customize → Social Links** — add your Twitter, LinkedIn, etc. URLs

## 7. Verify the contact form

1. Visit `https://your-site.infinityfreeapp.com/contact/`
2. Fill out and submit the form
3. Check the inbox of the admin email you set during install
4. Also visible in WordPress admin under **Contact Messages** (saved as private posts)

## Notes & gotchas

- **InfinityFree has no SSH**, so you can't `git clone` directly into the server — use File Manager or FTP to upload
- The first request after a long idle period takes a few seconds — that's normal on free hosting
- Outbound `wp_mail()` works on InfinityFree but can land in spam initially. If delivery is unreliable, install **WP Mail SMTP** plugin and connect a free SMTP service (Brevo, Mailgun, etc.). Note: this would be the only plugin needed; the theme itself is plugin-free.
- Free accounts have a daily hits limit (~50,000). For real traffic, upgrade or move to a paid host.

## Alternative: paid WordPress hosts

If you outgrow InfinityFree:

- **Hostinger** — ~$2–4/mo, beginner-friendly, includes free domain
- **SiteGround** — solid performance, great support
- **Kinsta** / **WP Engine** — premium managed WordPress

The theme works identically on any of them. Just upload to `wp-content/themes/` and activate.
