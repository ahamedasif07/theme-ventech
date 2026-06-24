# Ventech Grilles — WordPress Theme

A pixel-perfect WordPress conversion of the Ventech Grilles React/Vite website.

---

## 📋 Requirements

- WordPress **6.4 or later**
- PHP **8.1 or later**
- A working email server (for contact form `wp_mail()`)

---

## 🚀 Installation (Step-by-Step)

### Step 1 — Upload the Theme

1. Copy the entire `ventech-theme/` folder into your WordPress installation:
   ```
   wp-content/themes/ventech-theme/
   ```
   You can do this via FTP, cPanel File Manager, or by zipping the folder and using
   **Appearance → Themes → Add New → Upload Theme**.

### Step 2 — Activate the Theme

1. Log in to your WordPress admin panel.
2. Go to **Appearance → Themes**.
3. Find **Ventech Grilles** and click **Activate**.

### Step 3 — Create the Required Pages

Create the following 5 pages in **Pages → Add New**. The **page slug** (Permalink) is critical — it must match exactly.

| Page Title | Page Slug | Page Template |
|---|---|---|
| Home | `home` | *(leave as Default Template)* |
| About | `about` | **About Page** |
| Products | `products` | **Products Page** |
| Projects | `projects` | **Projects Page** |
| Contact | `contact` | **Contact Page** |

> **How to set the Page Template:**
> When editing each page, look in the right sidebar under **Page Attributes → Template** and select the correct template from the dropdown.

> **Page Slug:** The slug is set in the **Permalink** field below the page title. Edit the page, click the page title area, and the permalink will appear with an "Edit" button.

### Step 4 — Set the Front Page

1. Go to **Settings → Reading**.
2. Under "Your homepage displays", select **A static page**.
3. Set **Homepage** to → **Home**
4. Set **Posts page** to → *(leave blank or choose a blog page)*
5. Click **Save Changes**.

### Step 5 — Set Up Navigation Menu (Optional)

1. Go to **Appearance → Menus**.
2. Create a new menu called "Primary Menu".
3. Add your 5 pages (Home, About, Products, Projects, Contact).
4. Under "Menu Settings", check **Primary Navigation**.
5. Click **Save Menu**.

> **Note:** The theme also hard-codes navigation links using `get_page_by_path()`, so the nav will work even without this step, as long as the page slugs are correct.

---

## 📁 Theme File Structure

```
ventech-theme/
├── style.css                   ← Theme header + complete CSS design system
├── functions.php               ← Theme setup, enqueue, AJAX contact handler
├── index.php                   ← WordPress required fallback
├── front-page.php              ← Home page (Hero, Welcome, Products, Regions, CTA)
├── page.php                    ← Generic page fallback
├── page-about.php              ← About page
├── page-products.php           ← Products page (alternating layout)
├── page-projects.php           ← Projects page (with region filter)
├── page-contact.php            ← Contact page (AJAX form)
├── 404.php                     ← 404 error page
├── header.php                  ← Sticky nav with mobile hamburger
├── footer.php                  ← 4-column footer + copyright bar
├── screenshot.png              ← Theme preview image
├── template-parts/
│   └── page-header.php         ← Reusable page banner component
└── assets/
    ├── js/
    │   ├── nav.js              ← Mobile hamburger toggle
    │   ├── projects-filter.js  ← Region filter (ALL/VIC/NSW/QLD)
    │   └── contact-form.js     ← AJAX contact form
    └── images/
        ├── hero-ceiling.jpg
        ├── product-damper.jpg
        ├── product-diffuser.jpg
        ├── product-duct.jpg
        ├── product-grille.jpg
        ├── region-nsw.jpg
        ├── region-qld.jpg
        └── region-vic.jpg
```

---

## ⚙️ Contact Form Setup

The contact form sends emails to **sales@ventechgrilles.com.au** via WordPress's `wp_mail()`.

For email delivery to work reliably, it is **strongly recommended** to install an SMTP plugin:

- **WP Mail SMTP** (free) — [wordpress.org/plugins/wp-mail-smtp](https://wordpress.org/plugins/wp-mail-smtp/)
- Configure it with your hosting provider's SMTP credentials or a service like SendGrid, Mailgun, or Gmail.

---

## 🎨 Design System

The theme uses CSS custom properties (variables) for its design system. You can customise colors by editing the `:root` block in `style.css`:

| Variable | Value | Usage |
|---|---|---|
| `--brand-blue` | `oklch(0.58 0.22 260)` | Primary blue, nav active, links |
| `--brand-red` | `oklch(0.62 0.21 30)` | Section headings, product names |
| `--background` | `oklch(1 0 0)` | Page background (white) |
| `--foreground` | `oklch(0.18 0.04 260)` | Body text (dark navy) |
| `--surface-soft` | `oklch(0.98 0.005 250)` | Card/section backgrounds |

---

## 🔧 Troubleshooting

| Issue | Solution |
|---|---|
| Nav links show wrong pages | Ensure page slugs match exactly: `about`, `products`, `projects`, `contact` |
| Contact form shows "Network error" | Make sure WordPress AJAX is working; check server logs |
| Images not loading | Verify `assets/images/` folder was uploaded with the theme |
| Front page shows blog posts | Go to **Settings → Reading** and set a static front page |
| Page template not selectable | Re-activate the theme — WordPress re-reads template comments on activation |

---

## 📄 Conversion Notes

This theme is a 1:1 conversion of a React/Vite application built with TanStack Router and Tailwind CSS v4.

| React | WordPress |
|---|---|
| TanStack Router routes | WordPress page templates |
| Tailwind utility classes | Hand-written vanilla CSS |
| CSS `oklch()` custom properties | Preserved exactly in `style.css` |
| React `useState` (nav) | `nav.js` class toggle |
| React `useState` (filter) | `projects-filter.js` data-attr filter |
| React `useState` (form sent) | `contact-form.js` DOM mutation |
| `@tanstack/react-router` `<Link>` | `<a href>` with `get_permalink()` |
| Lucide React icons | Inline SVG via `ventech_icon()` helper |
| Dynamic image imports | `get_template_directory_uri() . '/assets/images/'` |

---

*Built with ❤️ for Ventech (Aust) Pty Ltd*
