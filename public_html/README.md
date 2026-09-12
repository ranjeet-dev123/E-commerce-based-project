# 🧶 Mirzapur Qaleen — Premium Handmade Carpets E-Commerce Platform

### 🏆 India's Traditional Carpet Craft — Now Digitally Yours

> **"Mirzapur ki Qaleen ab ghar baithe order karein." 🇮🇳**

**Mirzapur Qaleen** is a PHP-based full-stack e-commerce platform designed to bring Mirzapur's traditional handmade carpets, durries, handicrafts, and home-furnishing products to a modern digital shopping experience.

The platform provides a complete customer shopping journey along with a dedicated **Admin Management System** for products, categories, users, orders, and basic sales information.

**Customer Shopping Flow:**

`Product Discovery → Customization → Cart → Checkout → Address → Order → Invoice`

---

## 📖 Table of Contents

* [About the Project](#-about-the-project)
* [Project Goals](#-project-goals)
* [Key Features](#-key-features)
* [Admin Panel](#-admin-panel)
* [Technical Features](#-technical-features)
* [Tech Stack](#-tech-stack)
* [Architecture](#️-project-architecture)
* [Data Flow](#-core-shopping-flow)
* [Project Structure](#-project-structure)
* [Installation Guide](#-installation-guide)
* [Database Setup](#️-database-setup)
* [How to Use](#-how-to-use)
* [Security](#-security--technical-notes)
* [Roadmap](#️-roadmap)
* [Project Highlights](#-project-highlights)
* [License](#-license)
* [Author](#-author)
* [Acknowledgements](#-acknowledgements)
* [Contact](#-contact)

---

# 🎯 About the Project

**Mirzapur Qaleen** is a full-stack e-commerce web application built using **PHP, MySQL/MariaDB, HTML5, CSS3, and JavaScript**.

The project focuses on digitizing traditional Mirzapur carpet and handicraft products by providing customers with an online platform where they can:

* Browse products and categories
* Explore carpet designs
* Select size and style
* Customize carpet requirements
* Add products to cart
* Register/login
* Enter delivery address
* Place orders
* View order information
* Access account information

The system also provides a dedicated **Admin Panel** for centralized management of the e-commerce platform.

---

# 🎯 Project Goals

### 🧶 Digitalize Traditional Craft

Give traditional Mirzapur carpets and handicraft products a digital platform.

### 🛍️ Complete Online Shopping

Provide customers with a complete e-commerce experience from product discovery to order placement.

### 🎨 Product Customization

Allow customers to explore different carpet sizes, designs, and styles.

### 🧑‍💼 Centralized Administration

Provide administrators with a centralized dashboard for managing products, users, categories, and orders.

### 📱 Responsive Experience

Provide a responsive interface for:

* Desktop
* Tablet
* Mobile

### 🇮🇳 Promote Local Craftsmanship

Help connect traditional Indian craftsmanship with modern digital commerce.

---

# ✨ Key Features

## 🛍️ Customer Features

| Feature                   | Description                                                                                    |
| ------------------------- | ---------------------------------------------------------------------------------------------- |
| 🏠 Dynamic Homepage       | Hero slider, featured products, and category showcase                                          |
| 🧵 20+ Product Categories | Carpets, durries, brass vessels, bamboo bottles, cushion covers, doormats, paintings, and more |
| 🎨 Custom Design Studio   | Submit/customize carpet preferences such as color, size, and style                             |
| 📏 Size Selector          | Select sizes such as 2×3, 5×7, and 8×10 ft                                                     |
| 🖌️ Style Selector        | Traditional, Modern, Persian, and Geometric styles                                             |
| 🛒 Smart Cart             | Add, update, remove products and calculate totals                                              |
| 👤 User Account           | Registration, login, profile, and order history                                                |
| 📦 Order Management       | Complete cart-to-order workflow                                                                |
| 🧾 Order Confirmation     | Order confirmation/invoice information                                                         |
| 🔄 Return & Refund        | Return policy and related information                                                          |
| 🧼 Dry Cleaning Exchange  | "Purani Carpet Do, Nayi Lo" exchange offer                                                     |
| 🧽 Carpet Maintenance     | Carpet-care and maintenance information                                                        |
| 📞 Contact Form           | Validated customer enquiry form                                                                |
| 📜 Legal Pages            | Privacy Policy, Shipping Policy, Terms, etc.                                                   |
| 🤝 Social Weavers Welfare | Artisan-support initiative                                                                     |
| 🏨 Big Hotel Section      | B2B and bulk-order information                                                                 |
| 📱 Responsive UI          | Mobile, tablet, and desktop support                                                            |

---

# 🔧 Admin Panel Features

The platform includes a dedicated administration area for managing the e-commerce system.

### 🔑 Admin Authentication

Separate administrator login and session management.

### 📊 Dashboard

Provides an overview of:

* Total users
* Total orders
* Total products
* Order status
* Recent orders
* Basic revenue information

### 📦 Product Management

Administrators can:

* Add products
* Edit products
* Delete products
* Set product prices
* Assign categories
* Configure size and style
* Manage stock
* Upload product images

### 🗂️ Category Management

Administrators can manage product categories and related information.

### 📋 Order Management

Administrators can:

* View orders
* View order details
* View customer information
* View delivery address
* Update order status

### 👥 User Management

View and manage registered customer information.

### 🖼️ Image Management

Upload and manage product images through the admin panel.

---

# ⚙️ Technical Features

* 🗄️ MySQL/MariaDB database
* 🔐 Session-based authentication
* 👤 Separate customer/admin sessions
* 🔑 Password hashing support
* 🛡️ Input sanitization
* 📝 Error and debug logging
* 📱 Responsive CSS layouts
* ⚡ JavaScript-based interactivity
* 🔄 AJAX/client-side interaction where applicable
* 🖥️ XAMPP local development environment
* 🌐 Apache web server
* 📊 phpMyAdmin database management
* 🔧 Git/GitHub version control

---

# 🛠️ Tech Stack

| Layer             | Technology      | Purpose                                     |
| ----------------- | --------------- | ------------------------------------------- |
| Frontend          | HTML5           | Semantic page structure                     |
| Styling           | CSS3            | Responsive design, animations, layouts      |
| Client-side       | JavaScript      | DOM manipulation, validation, interactivity |
| Backend           | PHP 8.x         | Server-side application logic               |
| Authentication    | PHP Sessions    | User/admin authentication                   |
| Database          | MySQL / MariaDB | Application data storage                    |
| Web Server        | Apache          | PHP application hosting                     |
| Local Environment | XAMPP           | Apache + PHP + MySQL                        |
| Database Tool     | phpMyAdmin      | Database administration                     |
| Version Control   | Git             | Source-code management                      |
| Repository        | GitHub          | Project hosting                             |

---

# 🏗️ Project Architecture

```text
┌──────────────────────────────────────────────────────────┐
│                  MIRZAPUR QALEEN                         │
└──────────────────────────────────────────────────────────┘

                         CLIENT
              ┌─────────────────────────┐
              │ HTML5 + CSS3            │
              │ JavaScript              │
              │ Responsive UI           │
              └────────────┬────────────┘
                           │
                    HTTP Request
                           │
                           ▼
              ┌─────────────────────────┐
              │     APACHE SERVER       │
              │         XAMPP           │
              └────────────┬────────────┘
                           │
                           ▼
              ┌─────────────────────────┐
              │      PHP APPLICATION    │
              │                         │
              │ • Customer Side         │
              │ • Authentication        │
              │ • Shopping Cart         │
              │ • Checkout              │
              │ • Order Management      │
              │ • Admin Panel           │
              └────────────┬────────────┘
                           │
                       SQL Queries
                           │
                           ▼
              ┌─────────────────────────┐
              │     MySQL / MariaDB     │
              │                         │
              │ • users                 │
              │ • admin                 │
              │ • products              │
              │ • categories            │
              │ • cart                  │
              │ • orders                │
              │ • order_items           │
              │ • contact               │
              │ • custom_design          │
              └─────────────────────────┘
```

---

# 🔄 Core Shopping Flow

```text
        Browse Homepage
              │
              ▼
       Explore Categories
              │
              ▼
        Select Product
              │
              ▼
      Choose Size / Style
              │
              ▼
      Customization (Optional)
              │
              ▼
          Add to Cart
              │
              ▼
           My Cart
              │
              ▼
      Proceed to Checkout
              │
              ▼
        Login / Register
              │
              ▼
       Enter Address
              │
              ▼
        Place Order
              │
              ▼
     Order Confirmation
              │
              ▼
       Invoice / Order
```

---

# 📂 Project Structure

```text
E-commerce-based-project/
│
├── 📄 index.php
├── 📄 home.php
├── 📄 config.php
├── 🎨 style.css
│
├── 🔐 AUTHENTICATION/
│   ├── Users_login.php
│   ├── Resister.php
│   ├── Admin_login.php
│   └── logout.php
│
├── 🛒 SHOPPING FLOW/
│   ├── My_Cart.php
│   ├── order_address.php
│   ├── create_order.php
│   ├── My_Account.php
│   └── profile.php
│
├── 🧵 PRODUCT CATEGORIES/
│   ├── Brass_vessels.php
│   ├── bamboo_bottels.php
│   ├── cushion_covers.php
│   ├── doormats.php
│   ├── hand_tufted.php
│   ├── hand_tufted_saggy.php
│   ├── knotted_carpets.php
│   ├── fine_indian_durrys.php
│   ├── fine_indian_jute.php
│   ├── fine_indian_knotted.php
│   ├── organic_carpets.php
│   ├── organic_yarns.php
│   ├── organic_treasury.php
│   ├── pooja_durry_aasan.php
│   ├── kitchen_natural_wood.php
│   ├── fashion_flooring.php
│   ├── home_fashion.php
│   ├── luxury_fashion.php
│   ├── luxury_home_fashion.php
│   └── hand_made_painting.php
│
├── 🎨 CUSTOMIZATION/
│   ├── Custom_Design.php
│   ├── customize_your_own.php
│   ├── Product_Size.php
│   └── Product_Style.php
│
├── 📄 INFORMATION PAGES/
│   ├── Contact_Us.php
│   ├── Privacy_Policy.php
│   ├── Shipping_Policy.php
│   ├── Return.php
│   ├── Carpet_Maintenance.php
│   ├── Drycleaning_Exchange_Offer.php
│   ├── Social_Weavers_Welfare.php
│   ├── for_big_hotel.php
│   └── materials.php
│
├── 🔧 ADMIN PANEL/
│   ├── Admin_login.php
│   ├── admin.php
│   └── welcometoDASHBOARD.php
│
└── 📁 ASSETS & LOGS/
    ├── clean_hd_logo-removebg-preview.png
    ├── ChatGPT Image ...png
    ├── debug_log.txt
    └── error_log.txt
```

> **Development Note:** The original project contains a few files with similar/duplicate naming conventions, such as `Brass_vessels.php` and `Brassvessels.php`. These were retained during development/testing.

---

# 🚀 Installation Guide

## 📋 Prerequisites

Before running the project, install:

| Tool          | Version                 | Purpose               |
| ------------- | ----------------------- | --------------------- |
| XAMPP         | 8.0+                    | Apache + PHP + MySQL  |
| PHP           | 8.x                     | Backend               |
| MySQL/MariaDB | XAMPP bundled           | Database              |
| Browser       | Chrome / Firefox / Edge | Application           |
| Git           | Latest                  | Repository management |
| VS Code       | Latest                  | Development           |

---

## 1️⃣ Clone the Repository

```bash
git clone https://github.com/ranjeet-dev123/E-commerce-based-project.git
```

Or download the repository as a ZIP file and extract it.

---

## 2️⃣ Move Project to XAMPP

### Windows

```text
C:\xampp\htdocs\E-commerce-based-project\
```

### macOS

```text
/Applications/XAMPP/htdocs/E-commerce-based-project/
```

### Linux

```text
/opt/lampp/htdocs/E-commerce-based-project/
```

---

## 3️⃣ Start XAMPP

Open **XAMPP Control Panel** and start:

```text
Apache  → Running
MySQL   → Running
```

Default ports:

```text
Apache → 80
MySQL  → 3306
```

If port `80` is already occupied, Apache can be configured to use another available port such as `8080`.

---

# 🗄️ Database Setup

## 4️⃣ Create Database

Open:

```text
http://localhost/phpmyadmin
```

Create a new database:

```text
mirzapur_qaleen
```

Recommended character set:

```text
utf8mb4
```

---

## 5️⃣ Import SQL Database

If an SQL export file is available:

1. Open phpMyAdmin
2. Select `mirzapur_qaleen`
3. Open **Import**
4. Select the SQL file
5. Click **Go**

If an SQL export is not included, create the required tables according to the database schema.

---

# 🧩 Database Schema

## Main Tables

| Table           | Purpose                   | Important Columns                 |
| --------------- | ------------------------- | --------------------------------- |
| `users`         | Registered customers      | id, name, email, password         |
| `admin`         | Administrator accounts    | id, username, password            |
| `products`      | Product catalog           | id, name, price, category         |
| `categories`    | Product categories        | id, name, image                   |
| `cart`          | Shopping-cart items       | user_id, product_id, quantity     |
| `orders`        | Customer orders           | id, user_id, total_amount, status |
| `order_items`   | Individual order products | order_id, product_id, quantity    |
| `contact`       | Contact submissions       | name, email, message              |
| `custom_design` | Custom design requests    | user_id, design_data              |

---

## Core SQL Schema

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    phone VARCHAR(15),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200),
    category VARCHAR(100),
    price DECIMAL(10,2),
    size VARCHAR(50),
    style VARCHAR(50),
    image VARCHAR(255),
    description TEXT,
    stock INT DEFAULT 0
);

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10,2),
    status VARCHAR(50) DEFAULT 'Pending',
    address TEXT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

---

# 🔗 Database Relationship

```text
                 ┌──────────────┐
                 │    USERS     │
                 └──────┬───────┘
                        │
             ┌──────────┴──────────┐
             ▼                     ▼
       ┌──────────┐          ┌──────────┐
       │   CART   │          │  ORDERS  │
       └────┬─────┘          └────┬─────┘
            │                     │
            ▼                     ▼
       ┌──────────┐          ┌─────────────┐
       │ PRODUCTS │          │ ORDER_ITEMS │
       └──────────┘          └──────┬──────┘
                                    │
                                    ▼
                                PRODUCTS
```

---

# ⚙️ Database Configuration

Open:

```text
config.php
```

Configure the connection according to your XAMPP installation.

Example local configuration:

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "mirzapur_qaleen";
```

> ⚠️ **Security:** Never commit real production database credentials to GitHub. For production deployment, use environment variables or a secure secrets-management solution.

---

# ▶️ Launch the Application

After configuring Apache, PHP, and MySQL, open:

```text
http://localhost/E-commerce-based-project/
```

### Admin Panel

```text
http://localhost/E-commerce-based-project/Admin_login.php
```

---

# 🎮 How to Use

## 👤 Customer Workflow

|   Step | Action                          |
| -----: | ------------------------------- |
|    1️⃣ | Open the homepage               |
|    2️⃣ | Browse product categories       |
|    3️⃣ | Select a product                |
|    4️⃣ | Choose size and style           |
|    5️⃣ | Add product to cart             |
|    6️⃣ | Open My Cart                    |
|    7️⃣ | Update quantity if required     |
|    8️⃣ | Proceed to checkout             |
|    9️⃣ | Login/Register                  |
|     🔟 | Enter shipping address          |
| 1️⃣1️⃣ | Place order                     |
| 1️⃣2️⃣ | View order confirmation/invoice |

---

# 👨‍💼 Admin Workflow

```text
Admin Login
     │
     ▼
Dashboard
     │
     ├── Products
     │     ├── Add
     │     ├── Edit
     │     └── Delete
     │
     ├── Categories
     │
     ├── Users
     │
     ├── Orders
     │     └── Update Status
     │
     └── Sales Overview
```

---

# 🔧 Admin Panel

## 1. Admin Authentication

Admin authentication is separated from customer authentication.

After successful login, an administrator session is created.

Protected pages verify the admin session before granting access.

Example:

```php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: Admin_login.php");
    exit();
}
```

---

## 2. Dashboard

The dashboard provides information such as:

* Total registered users
* Total orders
* Total products
* Order status overview
* Recent orders
* Basic sales/revenue information
* Quick management actions

---

## 3. Product Management

Administrators can:

* Add products
* Edit products
* Delete products
* Set product prices
* Assign categories
* Configure sizes
* Configure styles
* Manage stock
* Upload product images

---

## 4. Order Management

Supported order statuses include:

```text
Pending
   ↓
Processing
   ↓
Shipped
   ↓
Delivered
```

Administrators can view order details and update order status.

---

## 5. User Management

The administrator can view registered users and available account information.

---

# 🔐 Admin Access

Local development URL:

```text
http://localhost/E-commerce-based-project/Admin_login.php
```

> ⚠️ If default development credentials are configured in the local version, change them before deploying the application publicly.

For production:

```php
password_hash()
password_verify()
```

should be used for secure password storage and verification.

---

# 🔐 Security & Technical Notes

The project currently includes:

* Session-based authentication
* Separate user/admin sessions
* Password hashing support
* Input sanitization
* Protected admin pages
* Error/debug logging
* Basic access control

## 🛡️ Recommended Production Hardening

Before public deployment, the following improvements are recommended:

* Move database credentials from `config.php` to environment variables
* Convert remaining SQL queries to prepared statements
* Add stronger server-side validation
* Review authentication and authorization rules
* Add CSRF protection
* Disable debug/error output in production
* Store logs outside publicly accessible directories
* Enable HTTPS
* Implement stronger password policies
* Add secure session configuration
* Validate uploaded file types and sizes
* Add rate limiting for authentication endpoints

---

# 🗺️ Roadmap

## ✅ Completed

* ☑ User Authentication — Login/Register
* ☑ Admin Panel with Dashboard
* ☑ Product Management — Add/Edit/Delete
* ☑ Order Management with Status Update
* ☑ User Management
* ☑ 20+ Product Categories
* ☑ Shopping Cart System
* ☑ Order Placement Flow
* ☑ Custom Design Feature
* ☑ Return & Exchange Information
* ☑ Carpet Maintenance Guide
* ☑ B2B Hotel Section
* ☑ Responsive Design
* ☑ Session-based Security

---

## 🚧 Upcoming Features

* ☐ 💳 Payment Gateway — Razorpay / Paytm / Stripe
* ☐ 📧 Email Notifications
* ☐ 📱 SMS Order Alerts
* ☐ ⭐ Product Reviews & Ratings
* ☐ ❤️ Wishlist
* ☐ 🔍 Advanced Search & AJAX Filters
* ☐ 📊 Advanced Analytics Dashboard
* ☐ 🌐 Hindi + English Multi-language Support
* ☐ 🚚 Live Order Tracking
* ☐ 🔐 OTP-based Login

---

# 🧹 Code Quality & Architecture Roadmap

Future technical improvements:

* ☐ Remove duplicate/legacy file versions
* ☐ Move database credentials to environment variables
* ☐ Convert remaining SQL queries to prepared statements
* ☐ Reorganize application using MVC architecture
* ☐ Add Composer integration
* ☐ Introduce reusable components
* ☐ Add unit/integration tests
* ☐ Improve API/service separation
* ☐ Add centralized error handling

---

# 📸 Project Highlights

The application is designed around a complete digital shopping journey:

```text
┌───────────────────────┐
│     🏠 HOMEPAGE       │
│ Categories + Products │
└───────────┬───────────┘
            │
            ▼
┌───────────────────────┐
│    🧵 PRODUCT PAGE    │
│ Size + Style +        │
│ Customization         │
└───────────┬───────────┘
            │
            ▼
┌───────────────────────┐
│      🛒 CART          │
│ Quantity + Total      │
└───────────┬───────────┘
            │
            ▼
┌───────────────────────┐
│     📦 CHECKOUT       │
│ Address + Order       │
└───────────┬───────────┘
            │
            ▼
┌───────────────────────┐
│   ✅ CONFIRMATION     │
│ Order / Invoice       │
└───────────────────────┘
```

---

# 📄 License

**© 2025 Ranjeet — All Rights Reserved**

This project is intended to remain a **private e-commerce project**.

Unauthorized commercial use, redistribution, or deployment is prohibited without permission from the project owner.

---

# 👨‍💻 Author

## Ranjeet 🇮🇳

**Full-Stack Web Developer**

* **GitHub:** `ranjeet-dev123`
* **Project:** Mirzapur Qaleen
* **Project Type:** Private E-Commerce Platform
* **Technology:** PHP + MySQL + HTML + CSS + JavaScript
* **Role:** Solo Developer

### 🎯 Mission

> **Traditional Indian handicrafts ko modern digital platform dena.**

The project was developed independently across:

* Frontend
* Backend
* Database
* Authentication
* Shopping Cart
* Order Management
* Admin Panel
* Responsive UI

---

# 🙏 Acknowledgements

Special thanks to:

### 🧶 Mirzapur's Qaleen Weavers

For preserving generations of traditional carpet craftsmanship.

### 🎨 Local Artisans

For carrying traditional Indian craftsmanship forward.

### 💻 Open Source Community

For technologies such as PHP, MySQL, JavaScript, and XAMPP.

### 🏫 Mentors & Teachers

For their technical guidance and support.

### 👨‍👩‍👧 Family & Friends

For their continuous encouragement and support.

---

# 📞 Contact

For project-related queries, collaboration, suggestions, or technical discussions:

### 💬 GitHub

`ranjeet-dev123`

### 🐛 Issues

Use the GitHub Issues section of the repository.

---

# ⭐ Support the Project

If you find this project useful or interesting, consider giving the repository a ⭐ on GitHub.

Your support helps encourage further development and improvement.

---

## 🧶 Project Mission

> **"Mirzapur ki Qaleen ab ghar baithe order karein." 🇮🇳**

**Made with ❤️ in Mirzapur, India 🇮🇳**

---

⬆️ **Back to Top**
