# Block 69 Café Website

A full-stack café website built as a final term project during our Senior High School year. The project was developed as the official web presence for **Block 69 Café**, a real café located in Taguig, Metro Manila, Philippines.

**Live Demo:** https://block69cafe.site.je

---

## About the Project

This website was led and developed by a team of 5 Senior High School students. It serves as a complete café management and customer-facing web application — covering everything from menu browsing and online ordering to blog management, gallery, and event/catering services.

---

## Features

### Customer-Facing
- **Home** — Hero carousel with featured items and promotions
- **Menu** — Full menu browsing with categories (Espresso, Brew, Matcha, Non-Coffee, Foods, etc.) and online ordering with cart
- **Blog** — Café news, events, and workshop announcements
- **Gallery** — Photo and video gallery of café events and products
- **Services** — Bar services and event coverage
- **Packages** — Café packages and catering services with pricing
- **About** — Company story, mission, vision, and competitive advantages
- **Contact** — Location, email, and phone information
- **Sign In / Sign Up** — Customer account registration and login
- **Shopping Cart & Checkout** — Online order placement with GCash and cash payment support

### Admin / Staff Panel
- **Dashboard** — Overview of orders and activity
- **CMS** — Edit content for Home, About, Services, Gallery, Packages, and Blog pages
- **Menu Management** — Add, edit, and delete menu items and categories
- **Blog Management** — Create, edit, and delete blog posts and slider images
- **Orders Management** — View and manage customer orders
- **User Accounts** — Manage customer and staff accounts

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2 |
| Database | MySQL (MariaDB 10.4) |
| Frontend | HTML, CSS, JavaScript |
| Database Abstraction | MySQLi |
| Email | PHPMailer |
| Environment Config | vlucas/phpdotenv |
| Server | Apache (via XAMPP locally) |

---

## Project Structure

```
admin/
├── config/
│   ├── connect.php          # Database connection (reads from .env)
│   ├── functions.php        # Auth and session helpers
│   ├── content-manage.php   # Home CMS logic
│   ├── functions-about.php  # About CMS logic
│   ├── functions-services.php
│   ├── services-content-manage.php
│   ├── menu-cms.php
│   └── blog-manage.php
├── partials/
│   ├── header.php           # Global navigation
│   └── footer.php           # Global footer
├── database/
│   ├── block69cafe.sql      # Full database schema + seed data
│   └── blog_posts.sql       # Blog post seed data
├── vendor/                  # Composer dependencies
├── .env.example             # Environment variable template
├── home.php
├── menu.php
├── blog.php
├── gallery.php
├── services.php
├── packages.php
├── about.php
├── contact.php
├── sign-in.php
├── sign-up.php
├── shopping-cart.php
├── checkout.php
├── payment.php
├── dashboard.php
└── ...
```

---

## Database

The database is named `block69cafe` and contains the following tables:

| Table | Description |
|---|---|
| `useraccounts` | Customer, staff, and admin accounts |
| `menucategory` | Menu category groups |
| `menuitems` | Individual menu items with prices |
| `homecontent` | Homepage carousel content |
| `aboutcontent` | About page content |
| `blogcontents` | Blog posts |
| `blogslider` | Blog page slider images |
| `galleryimage` | Gallery images |
| `gallerysection` | Gallery section headers |
| `galleryvideo` | Gallery videos |
| `servicescontent` | Bar/event services content |
| `barservicescontent` | Coffee bar service packages |
| `cateringservicescontent` | Catering services description |
| `cateringservicestable` | Catering pricing by pax |
| `cafepackagescontents` | Café package descriptions |
| `cafebarkadapackage` | Barkada package pricing |
| `cafepackageshomecontent` | Packages page header content |
| `cafepackagespaxandprices` | Package pricing by pax |
| `packagesection` | Packages page sections |
| `packagecontactcontent` | Contact details on packages page |
| `cartcontent` | Active shopping cart items |
| `checkoutcontent` | Items pending checkout |
| `orderitems` | Placed order items |
| `orderdetails` | Placed order details and payment info |

---

## Local Setup

### Requirements
- XAMPP / WAMP (PHP 8.2 + MySQL)
- Composer

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/MeinardEdrei/Block-69-Cafe-Website.git
   cd Block-69-Cafe-Website
   ```

2. **Install dependencies**
   ```bash
   cd admin
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   ```
   Edit `.env` with your local database credentials.

4. **Import the database**
   - Open phpMyAdmin
   - Create a database named `block69cafe`
   - Import `admin/database/block69cafe.sql`

5. **Start the server**
   - Place the project in your XAMPP `htdocs/` folder
   - Start Apache and MySQL in XAMPP
   - Visit `http://localhost/Block-69-Cafe-Website/admin/home.php`

### Default Accounts

| Role | Username | Password |
|---|---|---|
| Admin | admin | admin123 |
| Staff | eric | lor123 |
| Customer | louie | louie123 |

> **Note:** Change these credentials before deploying to production.

---

## Deployment

The site is deployed on **InfinityFree** free hosting.

For deployment, upload all files via FTP and import the SQL dump into the hosting provider's phpMyAdmin. Update `.env` with the production database credentials.

---

## Team

Developed by a team of 5 Senior High School students as a final term project.

---

## License

This project is for academic and archival purposes.
