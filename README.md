# IT0049 Point-of-Sale System

A CodeIgniter 4 point-of-sale system built with PHP and MySQL. The application manages products, customers, staff users, and sales transactions through a simple MVC structure.

## Features

- Product management
  - View products
  - Add products
  - Edit products
  - Delete products
  - Upload product images
  - Track prices and stock quantities
- Customer management
  - View customers
  - Add customers
  - Edit customers
  - Delete customers
- Staff user management
  - View users
  - Add users
  - Edit users
  - Delete users
  - Upload user avatars
  - Hash passwords before saving
- Sales management
  - Record sales
  - Select a staff member
  - Select an optional customer
  - Check product availability
  - Deduct stock after a successful sale
  - Save sales in a database transaction
- Sales History
  - View recorded sales
  - Display product, customer, staff, quantity, total, and date
  - Display `Walk-in Customer` when no customer is selected
- Shared navigation across the application views
- Server-side validation for products, customers, and users

## Technology Stack

- PHP 8.2+
- CodeIgniter 4.7.4
- MySQL or MariaDB
- Apache through XAMPP
- Composer
- HTML and basic CSS

## Requirements

Make sure the following are installed:

- XAMPP with Apache and MySQL
- PHP 8.2 or higher
- Composer
- PHP extensions required by CodeIgniter, including `intl`, `mbstring`, and MySQL support

## Installation

### 1. Clone or copy the project

Place the project inside the XAMPP `htdocs` directory:

```text
C:\xampp\htdocs\midtermproject-main
```

### 2. Install dependencies

Open a terminal in the project directory and run:

```bash
composer install
```

This installs the CodeIgniter framework and creates the `vendor` directory.

### 3. Create the environment file

Create a file named `.env` in the project root. It should be beside `app`, `public`, `composer.json`, and `spark`.

Example local configuration:

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost/midtermproject-main/public/'
app.indexPage = ''

database.default.hostname = localhost
database.default.database = it0049_pos
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Update the database username and password if your local MySQL installation uses different credentials.

Do not commit `.env` to GitHub. It is already excluded through `.gitignore`.

### 4. Import the database

1. Start Apache and MySQL in XAMPP.
2. Open phpMyAdmin.
3. Create a database named `it0049_pos`.
4. Import the file:

```text
it0049_pos.sql
```

The database contains the following tables:

- `products`
- `customers`
- `users`
- `sales`

### 5. Open the application

Using XAMPP Apache, open:

```text
http://localhost/midtermproject-main/public/
```

The CodeIgniter development server can also be used from the project directory:

```bash
php spark serve
```

Then open:

```text
http://localhost:8080/
```

## Main Routes

| Route | Purpose |
|---|---|
| `/` | Home page |
| `/products` | Product list |
| `/products/create` | Add a product |
| `/products/edit/{id}` | Edit a product |
| `/products/delete/{id}` | Delete a product |
| `/customers` | Customer list |
| `/customers/create` | Add a customer |
| `/customers/edit/{id}` | Edit a customer |
| `/customers/delete/{id}` | Delete a customer |
| `/users` | Staff user list |
| `/users/create` | Add a staff user |
| `/users/edit/{id}` | Edit a staff user |
| `/users/delete/{id}` | Delete a staff user |
| `/sales/create` | Record a sale |
| `/sales` | View Sales History |

When using XAMPP, prepend the project base URL:

```text
http://localhost/midtermproject-main/public
```

## Project Structure

```text
app/
├── Config/
│   └── Routes.php
├── Controllers/
│   ├── Customers.php
│   ├── Home.php
│   ├── Products.php
│   ├── Sales.php
│   └── Users.php
├── Models/
│   ├── CustomerModel.php
│   ├── ProductModel.php
│   ├── SaleModel.php
│   └── UserModel.php
└── Views/
    ├── customers/
    ├── partials/
    │   └── navigation.php
    ├── products/
    ├── sales/
    ├── users/
    └── welcome_message.php

public/
├── index.php
└── uploads/
    ├── avatars/
    └── products/

it0049_pos.sql
composer.json
spark
```

## MVC Flow

The application follows the CodeIgniter MVC pattern:

```text
Browser request
      ↓
Route in app/Config/Routes.php
      ↓
Controller in app/Controllers/
      ↓
Model in app/Models/
      ↓
MySQL database
      ↓
View in app/Views/
      ↓
HTML response in the browser
```

For example, the Sales History flow is:

```text
/sales
  ↓
Sales::index()
  ↓
SaleModel::getSalesHistory()
  ↓
Joined sales, products, customers, and users query
  ↓
app/Views/sales/index.php
```

## Database Relationships

The `sales` table connects the other main tables:

```text
products ──┐
customers ─┼── sales
users ─────┘
```

- `sales.product_id` references `products.id`
- `sales.customer_id` references `customers.id`
- `sales.sold_by` references `users.id`

The customer relationship is optional to support walk-in sales.

## Validation

Server-side validation is implemented for:

- Products
  - Required name
  - Numeric positive price
  - Whole, non-negative stock quantity
- Customers
  - Required full name
  - Valid email address
  - Required phone number
- Users
  - Required username
  - Required full name
  - Minimum password length when creating a user

Validation errors are displayed on the relevant forms, and submitted values are preserved when validation fails.

## Upload Directories

Uploaded files are stored in the public directory:

```text
public/uploads/products/
public/uploads/avatars/
```

## Development Commands

Display the registered routes:

```bash
php spark routes
```

Start the CodeIgniter development server:

```bash
php spark serve
```

Run the test suite:

```bash
composer test
```

## Project Status

The current implementation includes the main CRUD modules, sales recording, stock deduction, Sales History, file uploads, shared navigation, database relationships, and server-side validation.
