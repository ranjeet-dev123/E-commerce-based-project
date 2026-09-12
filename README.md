# 🧶 Mirzapur Qaleen — Premium Handmade Carpets E-Commerce Platform

**Traditional Craft • Modern E-Commerce • PHP • MySQL/MariaDB • Responsive Web**

Mirzapur Qaleen is a full-stack **PHP-based E-Commerce Platform** designed for showcasing and selling handmade carpets, rugs, durries, flooring products, home-furnishing items, and customized designs.

It provides a complete shopping experience with **product categories, user authentication, product management, orders, customer details, contact enquiries, and database-driven content.**

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat-square\&logo=php\&logoColor=white)](https://www.php.net/) [![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=flat-square\&logo=mysql\&logoColor=white)](https://www.mysql.com/) [![MariaDB](https://img.shields.io/badge/MariaDB-Database-003545?style=flat-square\&logo=mariadb\&logoColor=white)](https://mariadb.org/) [![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square\&logo=html5\&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML) [![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square\&logo=css3\&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS) [![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square\&logo=javascript\&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript) [![XAMPP](https://img.shields.io/badge/XAMPP-FF6C2C?style=flat-square\&logo=apachefriends\&logoColor=white)](https://www.apachefriends.org/)

**Features • E-Commerce • Authentication • Products • Orders • Database • Admin • Customization • Setup • Tech Stack • Project Structure**


## 🌟 Project Overview

**Mirzapur Qaleen** is a web-based e-commerce platform focused on traditional Indian handmade carpet and home-furnishing products.

The project combines a responsive frontend with a PHP backend and relational database to provide an end-to-end online shopping experience.

### 🎯 Main Objectives

* Digitize traditional Mirzapur carpet businesses
* Showcase handmade carpet and home-furnishing products online
* Provide category-based product discovery
* Allow customers to register and manage their accounts
* Provide an online ordering workflow
* Store customer and order information securely
* Provide contact and enquiry functionality
* Support product customization concepts
* Provide a foundation for future payment and logistics integration

---

# ✨ Key Features

## 🛍️ E-Commerce Features

* Product listing
* Product categories
* Product images
* Product pricing
* Product discovery
* Shopping workflow
* Order placement
* Quantity management
* Customer address collection
* Order status management
* Order date tracking
* Product/category information stored with orders

---

## 👤 User Management

The system contains user/customer management functionality.

### Features

* User registration
* User login
* Password hashing
* Customer profile information
* Email-based user identification
* Mobile number
* Address
* City
* Pincode
* Account creation timestamp
* Account update timestamp

---

## 🔐 Authentication

The project uses PHP-based authentication with password hashes stored in the database.

Passwords are **not stored as plain text**.

The database uses password hashes generated using PHP password hashing mechanisms.

> **Security Note:** Never upload real passwords, credentials, API keys or production database credentials to a public repository.

---

# 🛒 Product Categories

The database contains separate product tables for different product categories.

| Category / Table      | Purpose                       |
| --------------------- | ----------------------------- |
| `fashionflooring`     | Fashion flooring products     |
| `fineindiandurrys`    | Fine Indian durrys            |
| `fineindianjute`      | Fine Indian jute products     |
| `fineindianknotted`   | Fine Indian knotted products  |
| `fineindiarugs`       | Fine Indian rugs              |
| `knottedcarpets`      | Knotted carpets               |
| `handtufted`          | Hand-tufted products          |
| `handtuftedsaggy`     | Hand-tufted shaggy products   |
| `organiccarpets`      | Organic carpets               |
| `organicyarns`        | Organic yarn products         |
| `poojadurryaasan`     | Puja durries and aasans       |
| `homefashion`         | Home-furnishing products      |
| `cushioncovers`       | Cushion covers                |
| `door`                | Door/home products            |
| `handmadepainting`    | Handmade paintings            |
| `customizeyourown`    | Customizable products         |
| `forbighotel`         | Hotel/B2B products            |
| `bamboobottels`       | Bamboo bottle products        |
| `brassvessels`        | Brass vessel products         |
| `kitchennatural_wood` | Kitchen/natural wood products |

Each product category generally contains:

```text
id
name
price
image
created_at
```

This structure makes it easy to maintain product-specific catalogues.

---

# 🗄️ Database

## Database Name

```text
u174340608_carpet
```

The project uses **MariaDB/MySQL-compatible relational database architecture**.

The provided SQL dump was generated using:

```text
phpMyAdmin: 5.2.2
MariaDB: 11.8.x
PHP: 7.2.x in the original dump environment
Character Set: utf8mb4
Storage Engine: InnoDB
```

> For local development, use a currently supported PHP version compatible with your project code and dependencies.

---

# 📊 Database Schema

The database contains the following major functional areas:

### 🔐 Administration

```text
admin1
```

Stores administrator account information.

Main fields:

```text
id
email
password
created_at
```

---

### 👤 Customer Registration

```text
register
```

Stores registered customer accounts.

Main fields:

```text
id
full_name
email
password
created_at
updated_at
```

The email field is uniquely indexed.

---

### 👥 Customer/User Profile

```text
users
```

Stores extended customer information.

Main fields:

```text
id
full_name
email
password
mobile
address
city
pincode
created_at
updated_at
```

The email field is uniquely indexed.

---

### 📦 Orders

```text
orders
```

This is one of the primary transactional tables.

It stores information about customer orders.

Important fields include:

```text
id
user_email
product_id
product_name
name
total_amount
qty
status
order_date
mobile
address
city
pincode
product_image
category
created_at
updated_at
```

### Order Information

The `orders` table supports:

* Customer identification
* Product identification
* Product name
* Quantity
* Total amount
* Order status
* Order date
* Customer mobile number
* Delivery address
* City
* Pincode
* Product image
* Product category
* Creation timestamp
* Last update timestamp

Example order status:

```text
ordered
```

The status field can be extended in future versions for:

```text
ordered
confirmed
processing
shipped
delivered
cancelled
returned
```

---

### 📩 Contact / Enquiry

```text
contactme
```

Stores messages submitted through the contact form.

Fields:

```text
id
Name
Mobile
Email
Message
created_at
```

This allows the business to maintain customer enquiries and communication records.

---

# 🧩 Database Architecture

The project follows a simple relational structure:

```text
                    ┌──────────────────┐
                    │      Admin       │
                    │     admin1       │
                    └──────────────────┘
                             │
                             ▼
                    ┌──────────────────┐
                    │ Product Catalog  │
                    └──────────────────┘
                             │
       ┌─────────────────────┼─────────────────────┐
       ▼                     ▼                     ▼
 fashionflooring       knottedcarpets       fineindianjute
 handtufted             organiccarpets       homefashion
 fineindiandurrys       cushioncovers        handmadepainting
 ...                    ...                  ...
                             │
                             ▼
                    ┌──────────────────┐
                    │      Orders      │
                    │     orders       │
                    └──────────────────┘
                             │
                             ▼
                    ┌──────────────────┐
                    │     Customer     │
                    │ register/users   │
                    └──────────────────┘
```

---

# 🔑 Database Keys & Constraints

The database uses:

### Primary Keys

Each major table uses an `id` field as its primary key.

Example:

```sql
PRIMARY KEY (id)
```

### Unique Email Constraints

The following tables enforce unique email addresses:

```text
register.email
users.email
```

This helps prevent duplicate accounts.

### Auto Increment

Most `id` fields use:

```sql
AUTO_INCREMENT
```

This automatically generates unique identifiers for new records.

---

# 💾 SQL Database Setup

The repository contains the database SQL dump.

Example file:

```text
u174340608_carpet.sql
```

## Step 1 — Install XAMPP

Install XAMPP with:

* Apache
* MySQL/MariaDB-compatible database
* PHP
* phpMyAdmin

---

## Step 2 — Start Services

Open XAMPP Control Panel and start:

```text
Apache
MySQL
```

---

## Step 3 — Create Database

Open phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Create a database:

```text
u174340608_carpet
```

---

## Step 4 — Import SQL

Open the newly created database and select:

```text
Import
```

Then choose:

```text
u174340608_carpet.sql
```

and execute the import.

---

# ⚙️ Project Installation

## 1. Clone Repository

```bash
git clone https://github.com/ranjeet-dev123/E-commerce-based-project.git
```

Enter the project:

```bash
cd E-commerce-based-project
```

---

## 2. Copy Project to XAMPP

Copy the project into:

```text
C:\xampp\htdocs\
```

For example:

```text
C:\xampp\htdocs\CARPET
```

The project can then be accessed through:

```text
http://localhost/CARPET/
```

Depending on the actual project folder structure, use the appropriate entry path.

---

# 🔧 Database Configuration

The project contains a PHP database configuration file:

```text
public_html/config.php
```

Configure the database connection according to your local environment.

Typical local XAMPP configuration:

```text
Host: localhost
Database: u174340608_carpet
Username: root
Password: 
```

> ⚠️ Do not publish real production database credentials in `config.php`.

For production deployment, use environment variables or a secure server-side configuration system.

---

# 📁 Project Structure

A simplified project structure is:

```text
E-commerce-based-project/
│
├── public_html/
│   │
│   ├── AUTHENTICATION/
│   │
│   ├── SHOPPING FLOW/
│   │
│   ├── PRODUCT CATEGORIES/
│   │
│   ├── CUSTOMIZATION/
│   │
│   ├── INFO PAGES/
│   │
│   ├── ADMIN PANEL/
│   │
│   ├── assets/
│   │
│   ├── images/
│   │
│   ├── config.php
│   └── ...
│
├── u174340608_carpet.sql
├── .gitignore
└── README.md
```

> Folder names may vary depending on the current repository version.

---

# 🧑‍💻 Technology Stack

### Frontend

* HTML5
* CSS3
* JavaScript
* Responsive Web Design
* Bootstrap / UI components where applicable
* Font Awesome where applicable

### Backend

* PHP
* PHP Sessions
* Server-side form processing
* Authentication
* Order processing
* Database operations

### Database

* MySQL / MariaDB
* phpMyAdmin
* SQL
* InnoDB
* UTF-8 / `utf8mb4`

### Development Environment

* XAMPP
* Apache
* VS Code
* Git
* GitHub

---

# 🔒 Security Considerations

The project implements or is designed around several basic security practices:

* Password hashing
* Session-based authentication
* Server-side validation
* Input sanitization
* Database-backed authentication
* Unique email constraints
* Controlled database access

## Recommended Production Improvements

Before production deployment, the following should be added or reviewed:

* Prepared statements throughout the complete codebase
* CSRF protection
* Strong server-side validation
* Secure session cookie configuration
* HTTPS
* Rate limiting
* Secure password reset workflow
* Role-based access control
* Secure file-upload validation
* Environment-based database credentials
* Database backups
* Error logging without exposing sensitive information
* Removal of test/personal customer data from public SQL dumps

---

# 🛒 Order Workflow

The basic order workflow is:

```text
Customer
   │
   ▼
Browse Products
   │
   ▼
Select Product
   │
   ▼
Add / Continue Shopping
   │
   ▼
Provide Customer Details
   │
   ▼
Enter Delivery Address
   │
   ▼
Place Order
   │
   ▼
Store Order in `orders`
   │
   ▼
Order Status = ordered
```

---

# 🎨 Customization

The platform includes a customization-oriented product section through:

```text
customizeyourown
```

The concept allows the platform to be extended toward custom carpet requirements such as:

* Custom dimensions
* Design selection
* Material selection
* Color preferences
* Handmade/custom production requests

Future versions can connect these requirements directly to a dedicated customization-order table.

---

# 🏨 B2B / Hotel Products

The database includes:

```text
forbighotel
```

This provides a foundation for serving hotel and institutional customers.

Potential future B2B features:

* Bulk orders
* Hotel quotations
* Custom carpet dimensions
* Business enquiries
* Wholesale pricing
* Dedicated B2B accounts

---

# 📞 Customer Communication

The `contactme` table stores customer enquiries.

Workflow:

```text
Customer
    ↓
Contact Form
    ↓
PHP Backend
    ↓
Database
    ↓
contactme
```

This can later be extended with:

* Admin enquiry management
* Email notifications
* Reply system
* Contact status
* Follow-up tracking

---

# 🚀 Future Improvements

Planned or recommended enhancements include:

### Payment

* Razorpay integration
* UPI
* Card payments
* Payment verification
* Payment transaction records

### Order Management

* Order tracking
* Delivery status
* Cancellation
* Return management
* Refund management

### Customer Features

* Wishlist
* Product reviews
* Ratings
* Saved addresses
* Order history
* Profile management

### Product Management

* Product search
* Filters
* Sorting
* Stock management
* Multiple product images
* Product variants
* Size-based pricing

### Admin Dashboard

* Product CRUD
* Category management
* User management
* Order management
* Customer enquiries
* Sales reports
* Inventory management

### Security

* CSRF protection
* Prepared statements
* Role-based authorization
* Secure file uploads
* HTTPS
* Environment variables

---

# 📈 Scalability Roadmap

The current project is built using PHP and MySQL/MariaDB and can be gradually improved.

### Phase 1 — Current Foundation

```text
PHP + MySQL/MariaDB
HTML + CSS + JavaScript
Authentication
Products
Orders
Contact
```

### Phase 2 — E-Commerce Enhancement

```text
Payment Gateway
Wishlist
Reviews
Search
Filters
Inventory
Order Tracking
```

### Phase 3 — Business Platform

```text
Advanced Admin Dashboard
B2B Management
Analytics
Reports
Notifications
Customer Support
```

### Phase 4 — Modern Architecture

```text
REST API
React Frontend
PHP/Laravel or Java/Spring Boot Backend
MySQL
Cloud Deployment
```

---

# 🧪 Local Testing Checklist

Before considering the project ready for demonstration, test:

* [ ] Homepage loads correctly
* [ ] Product categories open
* [ ] Product images load
* [ ] Product prices display correctly
* [ ] User registration works
* [ ] Login works
* [ ] Password hashing works
* [ ] Product selection works
* [ ] Order placement works
* [ ] Customer address is saved
* [ ] Order appears in database
* [ ] Order status is stored
* [ ] Contact form works
* [ ] Admin authentication works
* [ ] Admin functionality works
* [ ] Database import works
* [ ] Responsive layout works
* [ ] Invalid form inputs are handled
* [ ] No database credentials are exposed

---

# 🛠️ Troubleshooting

## Apache Not Starting

Check whether another application is using port:

```text
80
443
```

Change Apache ports from XAMPP if required.

---

## MySQL Not Starting

Check whether another MySQL/MariaDB service is already running.

---

## Database Connection Error

Verify:

```text
Database name
Username
Password
Host
Port
```

and check:

```text
public_html/config.php
```

---

## Images Not Loading

Check:

* Image file paths
* Folder names
* File extensions
* Case sensitivity
* Apache document root

---

# 🌐 Repository

**GitHub Repository:**

[E-commerce-based-project](https://github.com/ranjeet-dev123/E-commerce-based-project?utm_source=chatgpt.com)

---

# 👨‍💻 Developer

**Ranjeet Kumar**

B.Tech CSE Student & Developer

### Areas of Interest

* Web Development
* Backend Development
* Database Systems
* Java
* Data Structures & Algorithms
* Spring Boot
* Cloud Computing

---

# 📜 License

This project is intended for **educational, development and demonstration purposes** unless otherwise specified by the project owner.

Before commercial deployment, review all third-party assets, images, libraries and licensing requirements.

---

# ⭐ Project Highlights

```text
🧶 Mirzapur Handmade Carpet Focus
🛍️ E-Commerce Product Catalog
👤 User Authentication
🔐 Password Hashing
📦 Order Management
🗄️ MySQL/MariaDB Database
📩 Contact Management
🎨 Product Customization Foundation
🏨 B2B/Hotel Product Foundation
📱 Responsive Web Interface
⚙️ PHP Backend
🚀 Future Payment & Cloud Integration
```

---

## 📌 Important Database Note

The SQL dump contains development/test records. **For a public GitHub repository, remove personal customer information and do not publish real credentials or sensitive production data.**

Use anonymized/demo records when sharing the database publicly.
