=== Business Portfolio Theme ===
Version:    2.0.0
Author:     Senior WordPress Developer
Requires:   WordPress 5.6+, PHP 7.4+
License:    GPL v2 or later

A complete, self-contained business portfolio theme built with pure
WordPress + PHP. Zero external plugins or JavaScript dependencies.


## What's Included

* 4 page templates: Home, About, Services, Contact
* Blog support: archive, single, search, sidebar
* 4 Custom Post Types:
   - Portfolio (with categories taxonomy + archive page)
   - Services
   - Testimonials
   - Team
* Built-in PHP contact form with:
   - WordPress nonces (CSRF protection)
   - Server-side validation
   - Honeypot spam trap
   - Email delivery via wp_mail()
   - Submissions logged to a private "Messages" CPT
* Theme Customizer panels for:
   - Hero title & subtitle
   - Contact info (email, phone, address)
   - Social links (Twitter, Facebook, LinkedIn, Instagram, GitHub)
* CSS-only mobile menu (no JavaScript)
* 3-column footer widget areas + blog sidebar
* Responsive grid layouts for services, portfolio, testimonials, team
* WCAG-friendly markup (skip link, ARIA labels, focus styles)
* Auto-creates required pages and menu on theme activation
* Translation-ready (text domain: business-portfolio)


## Installation

1. Copy the entire `business-portfolio` folder to:
      wp-content/themes/business-portfolio
2. WordPress Admin → Appearance → Themes → activate "Business Portfolio"
3. The theme will automatically:
      - Create Home, About, Services, Contact, and Blog pages
      - Assign correct page templates
      - Set Home as the static front page and Blog as the posts page
      - Build a default primary menu
      - Flush rewrite rules
4. (Optional) Customize via Appearance → Customize:
      - Homepage Hero
      - Contact Information
      - Social Links


## Adding Content

* Services      → wp-admin → Services       → Add New (set menu order to control display order)
* Portfolio     → wp-admin → Portfolio      → Add New (assign categories under Project Categories)
* Testimonials  → wp-admin → Testimonials   → Add New (set author + role in the meta box)
* Team Members  → wp-admin → Team           → Add New (set role + LinkedIn URL in the meta box)
* Blog Posts    → wp-admin → Posts          → Add New (regular WordPress posts)


## Contact Form

The contact form is fully functional out of the box — no Contact Form 7 or
other plugin required. All submissions are emailed to the site admin (Settings
→ General → Administration Email Address) and saved as private posts under
"Contact Messages" in wp-admin.

Server-side protections:
* WordPress nonce verification (rejects forged submissions)
* Honeypot field (silently drops bots that auto-fill all inputs)
* Validation: name required, valid email required, message ≥ 10 chars
* All fields sanitized via core WP functions (sanitize_text_field, sanitize_email, etc.)


## File Structure

  business-portfolio/
    style.css              ← Theme metadata + complete stylesheet
    functions.php          ← Setup, CPTs, customizer, contact form handler
    header.php             ← Site header with mobile menu (CSS-only)
    footer.php             ← Footer with 3-col widgets + social links
    front-page.php         ← Homepage (hero, services, portfolio, etc.)
    page.php               ← Generic page fallback
    page-about.php         ← About page (loads Team CPT)
    page-services.php      ← Services page (loads Service CPT)
    page-contact.php       ← Contact page with built-in form
    archive.php            ← Blog archive
    archive-portfolio.php  ← Portfolio archive (with category filter)
    single.php             ← Single blog post
    single-portfolio.php   ← Single portfolio item
    sidebar.php            ← Blog sidebar
    search.php             ← Search results
    searchform.php         ← Reusable search form
    comments.php           ← Comment template
    404.php                ← Not-found template
    index.php              ← WordPress fallback


## Local Preview (Without WordPress)

A development preview shim is included at the project root:
  preview/index.php
  preview/wp-shim.php

It mocks just enough WordPress core to render the templates with sample data,
so you can preview visual changes without installing WordPress. To use it:

  cd C:\path\to\wordpress-site
  C:\xampp\php\php.exe -S 0.0.0.0:8000 -t preview preview/index.php

Then open http://localhost:8000/

The shim is for preview only. The real application runs inside a real
WordPress installation as described in the Installation section above.
