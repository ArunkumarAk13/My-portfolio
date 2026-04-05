# Arun Kumar S — Portfolio v2.0

A modular PHP portfolio site with a JSON data layer, glass-morphism dark/light UI, and vanilla JavaScript interactions. Zero database, zero framework — just PHP templating, CSS custom properties, and clean JS.

---

## Table of Contents

1. [Project Structure](#project-structure)
2. [How the Page Is Assembled](#how-the-page-is-assembled)
3. [Config Layer](#config-layer)
4. [Data Layer — JSON Files](#data-layer--json-files)
5. [Template Partials](#template-partials)
6. [JavaScript — main.js](#javascript--mainjs)
7. [CSS — main.css](#css--maincss)
8. [Assets](#assets)
9. [External Dependencies](#external-dependencies)
10. [Data Flow Diagram](#data-flow-diagram)
11. [Adding or Editing Content](#adding-or-editing-content)

---

## Project Structure

```
My-portfolio/
│
├── index.php                   ← Entry point; builds the full HTML page
│
├── _config/
│   ├── config.php              ← Global constants (site name, paths, CDN URLs, feature flags)
│   └── _load.php               ← Helper functions (template loader, JSON loader, sanitizer)
│
├── _data/                      ← All site content as JSON (edit here to update the site)
│   ├── personal.json           ← Name, bio, roles, contact info, social links, stats
│   ├── skills.json             ← Skill categories and individual skills with icons
│   ├── experience.json         ← Work history / internships
│   ├── projects.json           ← Project cards with links, tags, images
│   ├── education.json          ← Academic degrees and online courses
│   └── services.json           ← Service offerings (web dev, IoT, cyber)
│
├── _template/                  ← PHP partials; one file per section
│   ├── head.php                ← <head>: meta, SEO, Open Graph, CDN links, inline CSS
│   ├── navbar.php              ← Fixed nav bar, theme toggle, hamburger, mobile menu
│   ├── hero.php                ← Full-viewport hero, particle canvas, typed text, CTA
│   ├── about.php               ← About section with image, bio, tech chips
│   ├── skills.php              ← Tabbed skill grid with Devicons
│   ├── experience.php          ← Timeline of work experience
│   ├── projects.php            ← Filterable project card grid
│   ├── education.php           ← Academic + courses split layout
│   ├── services.php            ← Service offering cards
│   ├── contact.php             ← Contact info + PHPMailer-powered form
│   └── footer.php              ← Brand, quick links, contact info, copyright
│
├── public/
│   ├── css/
│   │   └── main.css            ← All styles (2043 lines); design tokens, components, layouts
│   └── js/
│       └── main.js             ← All interactions (525 lines); pure vanilla JS
│
├── images/                     ← Static image assets
│   ├── profile.JPG
│   ├── about.jpg
│   ├── localhub.jpg
│   ├── workgen.jpg
│   ├── notice board.jpg
│   ├── gas.jpg
│   └── waater.jpg
│
└── pdfs/                       ← Downloadable PDFs
    ├── ARUN KUMAR resume.pdf
    ├── WorkGen paper.pdf
    ├── WorkGen report.pdf
    ├── IoT BASED WIRELESS NOTICE BOARD PAPER.pdf
    └── IOT based Water Conservation System.pdf
```

---

## How the Page Is Assembled

`index.php` is the only file the server executes. Everything else is pulled in by it.

**Execution order inside `index.php`:**

```
1. define('PORTFOLIO_ROOT', ...)      ← absolute path anchor for all includes

2. require _config/config.php         ← load all constants
3. require _config/_load.php          ← load all helper functions

4. $data = load_all_data()            ← read every JSON file into one array

5. echo DOCTYPE + <html data-theme>
6. echo load_template('head', $data)
7. echo <body>
      ├── #loadingScreen overlay
      ├── #cursorGlow div
      ├── #backToTop button
      ├── load_template('navbar', $data)
      ├── <main>
      │     ├── load_template('hero',       $data)
      │     ├── load_template('about',      $data)
      │     ├── load_template('skills',     $data)
      │     ├── load_template('experience', $data)
      │     ├── load_template('projects',   $data)
      │     ├── load_template('education',  $data)
      │     └── load_template('contact',    $data)
      ├── load_template('footer', $data)
      └── <script src="public/js/main.js" defer>
```

Each `load_template()` call buffers the PHP template output and returns it as a string. Templates receive the full `$data` array via `extract()`, so they can access any JSON value directly as a PHP variable.

---

## Config Layer

### `_config/config.php`

Defines every constant used across the project. Nothing is hard-coded in templates.

| Constant | Value / Purpose |
|---|---|
| `SITE_NAME` | "Arun Kumar S" |
| `SITE_TAGLINE` | Site subtitle |
| `SITE_DESCRIPTION` | SEO meta description |
| `SITE_VERSION` | "2.0.0" |
| `SITE_AUTHOR` | "Arun Kumar S" |
| `SITE_EMAIL` | Contact email |
| `PORTFOLIO_ROOT` | Absolute server path (set in index.php) |
| `DATA_PATH` | `/_data/` |
| `TEMPLATE_PATH` | `/_template/` |
| `PUBLIC_PATH` | `/public/` |
| `CSS_PATH` | `/public/css/` |
| `JS_PATH` | `/public/js/` |
| `IMAGES_PATH` | `/images/` |
| `ENABLE_PARTICLES` | `true` — controls particle canvas rendering |
| `ENABLE_CURSOR_GLOW` | `true` — controls trailing cursor effect |
| `ENABLE_LOADING_SCREEN` | `true` — controls loading overlay |
| `DEFAULT_THEME` | `"dark"` |
| `MAIL_ENDPOINT` | PHP mail handler (`send-mail.php`) for contact form |
| `FONT_AWESOME_CDN` | Font Awesome 6.5.1 CDN URL |
| `GOOGLE_FONTS_URL` | Inter + Space Grotesk CDN URL |

### `_config/_load.php`

All helper functions live here. Templates and `index.php` rely on these.

#### `load_template(string $name, array $data = []): string`
Loads `_template/{$name}.php`, extracts `$data` into scope, buffers output with `ob_start()`, and returns the HTML string. Returns an HTML comment error if the file is missing.

#### `load_json(string $file): array`
Reads `_data/{$file}.json`, decodes it as an associative array. Returns `[]` on failure.

#### `load_all_data(): array`
Calls `load_json()` for every data file and merges them into one array:
```php
[
  'personal'   => [...],
  'skills'     => [...],
  'projects'   => [...],
  'experience' => [...],
  'education'  => [...],
  'services'   => [...],
]
```
This single array is passed to every template.

#### `data_get(array $arr, string $key, $default = ''): mixed`
Dot-notation accessor for nested arrays. `data_get($data, 'personal.name')` safely walks the keys and returns `$default` if any key is missing.

#### `e(string $str): string`
XSS sanitizer. Wraps `htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8')`. Use this whenever outputting user-controlled or JSON-sourced strings into HTML.

---

## Data Layer — JSON Files

All content lives in `_data/`. To update the site content, edit these files only — no PHP changes needed.

### `personal.json`
```
name           — Full name
shortName      — Initials shown in navbar logo ("AK")
roles[]        — Cycled by the typed-text animation in hero
tagline        — One-liner under the name
bio            — Paragraph for About section
email          — Contact email
phone          — Contact phone
location       — City/country
availability   — Status badge text
stats[]        — { label, value, suffix } — animated counters in hero
resume         — Path to resume PDF
socials[]      — { platform, url, icon } — used in navbar, hero, footer
```

### `skills.json`
```
categories     — Object with 5 keys: programming, appdev, database, tools, cybersecurity
  Each key:
    skills[]   — { name, icon }  (icon = Devicon class or Font Awesome class)
```

### `experience.json`
```
experience[]
  role         — Job title
  company      — Employer name
  type         — "Full-time" | "Internship"
  period       — "Month YYYY – Month YYYY"
  location     — City / Remote
  description  — Summary paragraph
  skills[]     — Tech tags shown on the card
  icon         — Font Awesome class for the timeline icon
```

### `projects.json`
```
projects[]
  id           — Slug identifier
  title        — Project name
  description  — Short summary
  category     — "Software" | "IoT"  (used by filter buttons)
  tags[]       — Tech/tool tags (first 4 shown)
  image        — Path to project image
  github       — GitHub URL (optional)
  demo         — Live demo URL (optional)
  website      — Website URL (optional)
  playstore    — Play Store URL (optional)
  pdf          — Paper PDF path (optional)
  report       — Report PDF path (optional)
  featured     — true/false — animated border highlight
  highlight    — true/false — "Main Project" badge
  year         — Year string
```

### `education.json`
```
education[]
  degree       — Degree name or course title
  field        — Major / subject
  institution  — School or platform name
  location     — City or "Online"
  period       — Year range
  gpa          — GPA or percentage (optional)
  status       — "Completed" | "In Progress"
  type         — "academic" | "course"  (used to split the two columns)
  description  — Summary
  courses[]    — Rendered as skill tags (for courses type)
  icon         — Font Awesome class
```

### `services.json`
```
services[]
  id           — Slug
  title        — Service name
  description  — Summary paragraph
  icon         — Font Awesome class
  features[]   — Bullet points shown on the card
```

---

## Template Partials

Each file in `_template/` receives the full `$data` array via PHP's `extract()`.

### `head.php`
- Outputs the full `<head>` tag
- Sets charset, viewport, X-UA-Compatible
- SEO: `<title>`, `<meta description>`, `<meta keywords>`, robots
- Open Graph + Twitter Card meta tags
- SVG favicon as inline data URI
- Preconnects to Google Fonts and cdnjs
- Loads Google Fonts (Inter 300–900, Space Grotesk 300–700)
- Loads Font Awesome 6 and Devicons from CDN
- Links `main.css`
- Inline critical CSS for initial theme (`color-scheme`) and the loading screen bar animation

### `navbar.php`
- Fixed `<header>` with glass-morphism background
- Logo: "AK" badge + full name
- Desktop `<nav>`: Home, About, Skills, Experience, Education, Projects, Contact
- Theme toggle button — swaps moon/sun icon; JS updates `html[data-theme]`
- Hamburger button for mobile
- Mobile menu overlay — same nav links + social icons pulled from `personal.json`

### `hero.php`
- Full-viewport `<section id="hero">`
- `<canvas id="particleCanvas">` for the floating-dot background
- Left column:
  - Greeting + name with first name in `.gradient-text`
  - `#typedText` span — JS cycles through `personal.roles`
  - Bio excerpt from `personal.json`
  - CTA: "View Projects" → `#projects`, "Download CV" → resume PDF
  - Social pills (GitHub, LinkedIn, Email, Instagram, WhatsApp)
- Right column:
  - Profile image in hexagonal clip-path frame with animated glow ring
  - Floating badges: Web Dev, IoT, Security
- Scroll indicator with animated mouse-wheel SVG

### `about.php`
- Two-column grid
- Left: `about.jpg` with glow effect
- Right: subtitle, bio text from `personal.json`, static education info (SNS Institutions, GPA), tech chip list
- Buttons: Download CV, Get In Touch → `#contact`

### `skills.php`
- Section header "My Expertise"
- Tab buttons generated from `skills.json` categories with colour metadata:
  - programming → `#6c63ff`
  - appdev → `#a855f7`
  - database → `#06b6d4`
  - tools → `#10b981`
  - cybersecurity → `#f59e0b`
- Each tab panel shows a grid of skill tiles with Devicon icons
- JS switches panels on tab click

### `experience.php`
- Vertical timeline layout
- Iterates `experience.json`
- Each item: period pill, type badge (Full-time / Internship), role, company, description, skill tags
- Timeline connector line between items

### `projects.php`
- Filter bar: "All" + one button per unique `category` in `projects.json`
- Card grid; each card shows:
  - Project image with hover overlay
  - Title overlay + action icon buttons on hover
  - "Featured" badge (if `featured: true`)
  - "Main Project" badge (if `highlight: true`)
  - Category, year, description, first 4 tags
  - Action buttons rendered only if the URL field is non-empty: GitHub, Website, Play Store, Demo, PDF, Report, Private
- All URLs passed through `e()` for XSS safety

### `education.php`
- Two-column split: Academic (left) | Courses & Certifications (right)
- Filters `education.json` by `type === 'academic'` vs `type === 'course'`
- Each item: period, institution, degree, field, description, GPA or course tags
- CSS `animation-delay` staggered per item for reveal effect

### `services.php`
- Three-column card grid
- Each card: icon, title, description, feature list with checkmarks
- Data from `services.json`

### `contact.php`
- Two-column layout
- Left:
  - Intro text
  - Contact cards: email, phone, location with icons and links
  - Social connect links from `personal.json`
- Right:
  - `<form id="contactForm">` with `action` set to `MAIL_ENDPOINT` (`send-mail.php`)
  - Fields: name, email, subject, message (all required)
  - Success/error alert `<div>`s (hidden by default; shown by JS)
  - Submit button with loading spinner (toggled by JS)

### `footer.php`
- Brand: logo, tagline, social icons from `personal.json`
- Quick links: all 7 section anchors
- Contact column: email, phone, location
- Copyright line with heart, `SITE_VERSION` constant

---

## JavaScript — main.js

Pure vanilla JS — no libraries. All functions are called at the bottom of the file after DOMContentLoaded. Feature flags in `config.php` control which HTML elements exist; JS operates on the DOM after PHP renders them.

| Function | Lines | What it does |
|---|---|---|
| *(top-level)* | 9 | Adds `js-ready` class to `<html>` to enable CSS reveal states |
| `initTheme()` | 14–29 | Reads `localStorage('portfolio-theme')`, sets `html[data-theme]`, wires the toggle button |
| `initLoader()` | 34–45 | Adds `hidden` class to `#loadingScreen` on `window.load` |
| `initMobileMenu()` | 50–88 | Toggles `.active` on hamburger + `#mobileMenu`; closes on link click, outside click, Escape |
| `initNavbarScroll()` | 93–107 | Adds `.scrolled` to `<header>` when `scrollY > 60`; CSS shrinks the navbar |
| `initActiveNavLink()` | 112–133 | IntersectionObserver on sections; updates `.active` on matching nav `<a>` links |
| `initParticles()` | 138–216 | Canvas 2D particles — random positions/velocities, lines drawn between particles < 140px apart; redraws on resize |
| `initTyped()` | 221–262 | Types/deletes roles from `data-roles` attribute at 95ms/55ms per character; loops forever |
| `initSkillTabs()` | 268–282 | Tab click → hide all `.skills-panel` → show the matching one |
| `initProjectFilter()` | 287–305 | Filter button click → toggle `.hidden` on cards whose `data-category` doesn't match |
| `initTimeline()` | 310–327 | IntersectionObserver adds `.animated` to `#timelineLine` once (one-shot) |
| `initCounters()` | 332–371 | Animates `.stat-value` elements from 0 to `data-count` over 1600ms; handles floats and `+` suffix |
| `initScrollReveal()` | 376–403 | IntersectionObserver adds `.visible` to `.reveal` elements; fallback forces `.visible` after 1.5s |
| `initContactForm()` | 408–456 | `fetch` POST to `send-mail.php` (PHPMailer); spinner state on button; success/error alerts; form reset on success |
| `initBackToTop()` | 461–472 | Shows `#backToTop` when `scrollY > 400`; scrolls to top on click |
| `initSmoothScroll()` | 477–486 | All `<a href="#...">` links use `scrollIntoView({ behavior: 'smooth' })` |
| `initCursorGlow()` | 491–525 | Desktop only: `#cursorGlow` follows mouse with lerp factor 0.1 for trail effect; hidden on touch |

---

## CSS — main.css

2043 lines of CSS. No preprocessor — uses native CSS custom properties.

### Design Tokens (CSS Variables)

Defined on `:root` for dark theme; overridden under `[data-theme="light"]`.

```css
--bg-primary        #060614
--bg-secondary      #0d0d1a
--bg-tertiary       #12122a
--glass-bg          rgba(255,255,255,0.05)
--glass-border      rgba(255,255,255,0.10)
--text-primary      #ffffff
--text-secondary    rgba(255,255,255,0.70)
--text-muted        rgba(255,255,255,0.40)
--accent-primary    #6C63FF   (purple)
--accent-2          #00D4FF   (cyan)
--accent-3          #FF6B6B   (red/coral)
--gradient-primary  135deg, #6C63FF → #2196F3
--gradient-accent   #00D4FF → #6C63FF
--gradient-warm     #FF6B6B → #FF8E53
--gradient-green    #43e97b → #38f9d7
--nav-height        72px
--container-max     1200px
--radius-sm/md/lg/xl
```

### Key Component Classes

| Class | Purpose |
|---|---|
| `.glass-card` | Glass-morphism card — backdrop blur, semi-transparent background |
| `.btn` / `.btn-primary` / `.btn-outline` | Button variants with gradient fill or outline |
| `.social-pill` | Circular icon button |
| `.skill-tag` | Inline badge / chip |
| `.gradient-text` | Gradient fill on text via `background-clip: text` |
| `.section-header` | Centered section title + subtitle block |
| `.reveal` | Hidden until scrolled into view (JS adds `.visible`) |
| `.visible` | Triggers the reveal transition |
| `#loadingScreen` | Full-screen loading overlay |
| `#cursorGlow` | Radial glow div that follows the cursor |

### Keyframe Animations

| Name | Effect |
|---|---|
| `spin` | 360° rotation, 6s linear infinite |
| `floatA` / `floatB` | Gentle up-down floating motion |
| `loadBar` | Loading bar fill animation |
| `pulse` | Opacity fade in/out |
| `blink` | Typed-text cursor blink |

### Responsive Breakpoints

- Hamburger menu activates below ~768px
- CSS Grid columns collapse to single column on mobile
- `clamp()` used for h1–h3 to scale fluidly

---

## Assets

### `images/`

| File | Used in |
|---|---|
| `profile.JPG` | Hero section — hexagon profile frame |
| `about.jpg` | About section — left column image |
| `localhub.jpg` | Projects card — LocalHub |
| `workgen.jpg` | Projects card — WorkGen |
| `notice board.jpg` | Projects card — Smart Notice Board |
| `gas.jpg` | Projects card — Gas Leakage Detection |
| `waater.jpg` | Projects card — Water Conservation |

### `pdfs/`

| File | Linked from |
|---|---|
| `ARUN KUMAR resume.pdf` | Hero CTA, About CTA |
| `WorkGen paper.pdf` | Projects card action button |
| `WorkGen report.pdf` | Projects card action button |
| `IoT BASED WIRELESS NOTICE BOARD PAPER.pdf` | Projects card action button |
| `IOT based Water Conservation System.pdf` | Projects card action button |

---

## External Dependencies

All loaded via CDN — no npm, no build step.

| Dependency | Version | Used for |
|---|---|---|
| Google Fonts — Inter | — | Body text |
| Google Fonts — Space Grotesk | — | Headings |
| Font Awesome | 6.5.1 | All icons throughout the site |
| Devicons | latest | Skill icons in the Skills section |
| PHPMailer | ~6.x | Contact form backend via Gmail SMTP (`send-mail.php`) |

---

## Data Flow Diagram

```
                        ┌──────────────────────┐
                        │      index.php        │
                        │  (entry point)        │
                        └──────────┬───────────┘
                                   │
               ┌───────────────────┼───────────────────┐
               ▼                   ▼                   ▼
     _config/config.php    _config/_load.php      load_all_data()
     (constants)           (helper functions)     │
                                                  ▼
                              ┌───────────────────────────────┐
                              │         _data/*.json           │
                              │  personal, skills, projects,   │
                              │  experience, education,        │
                              │  services                      │
                              └──────────────┬────────────────┘
                                             │  unified $data array
                                             ▼
                              ┌──────────────────────────────┐
                              │      _template/*.php          │
                              │  head, navbar, hero, about,  │
                              │  skills, experience,          │
                              │  projects, education,         │
                              │  contact, footer              │
                              └──────────────┬───────────────┘
                                             │  rendered HTML strings
                                             ▼
                              ┌──────────────────────────────┐
                              │     Browser receives HTML     │
                              │                              │
                              │   public/css/main.css        │
                              │   (styles + design tokens)   │
                              │                              │
                              │   public/js/main.js          │
                              │   (interactions + animations) │
                              └──────────────────────────────┘
```

---

## Adding or Editing Content

| Task | What to edit |
|---|---|
| Update bio, name, contact info, socials | `_data/personal.json` |
| Add or remove a skill | `_data/skills.json` |
| Add a new job or internship | `_data/experience.json` |
| Add a new project | `_data/projects.json` + drop image in `images/` |
| Add education or a course | `_data/education.json` |
| Change service offerings | `_data/services.json` |
| Change site name, email, CDN URLs | `_config/config.php` |
| Turn off particles / cursor glow / loading screen | `_config/config.php` feature flags |
| Change colour scheme or typography | `public/css/main.css` CSS variables |
| Add a new section | Create `_template/newsection.php` + call `load_template('newsection', $data)` in `index.php` |
| Add a new interaction | Add a function in `public/js/main.js` and call it at the bottom |
