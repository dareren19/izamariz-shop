# 🛒 Laravel E-Commerce Store

## 📋 Overview
A modern, Demo e-commerce website built with **Laravel 12**, featuring product browsing, shopping cart management, and seamless checkout integration with **HitPay[DEMO]** payment processing.

## ✨ Features

### 🏪 Product Management
- **Product Catalog** – Browse products with images, descriptions, and pricing
- **Categories & Filtering** – Organize products by category (Christening, Wedding, Birthday)
- **Product Details** – View comprehensive product information with images
- **Featured Products** – Highlight special products on the homepage

### 🛍️ Shopping Cart
- **Add / Remove Items** – Easy cart management with real-time updates
- **Quantity Adjustment** – Increase or decrease item quantities in cart
- **Cart Summary** – View total costs, taxes, and shipping estimates
- **Persistent Cart** – Shopping cart saved across sessions

### 💳 Checkout & Payments
- **Secure Checkout Process** – Multi-step checkout flow
- **HitPay Integration** – Secure payment processing with multiple payment methods
- **Order Summary** – Review order details before payment
- **Order Confirmation** – Instant confirmation with order tracking

### 👤 User Experience
- **Responsive Design** – Mobile-friendly interface
- **Fast Loading** – Optimized performance
- **Intuitive Navigation** – Easy-to-use interface
- **Secure Transactions** – HTTPS enforced, secure form handling

## 🛠️ Tech Stack

### Backend
- **Laravel 12** – PHP framework
- **MySQL / TiDB** – Database management
- **Eloquent ORM** – Database interactions
- **Blade Templating** – Server-side rendering

### Frontend
- **Tailwind CSS** – Responsive 
- **Vite** – Modern build tool
- **JavaScript Vanilla** – Interactive features
- **Font Awesome** – Icon library

### Deployment & Services
- **Railway.app** – Cloud hosting platform
- **TiDB Cloud** – MySQL-compatible cloud database
- **HitPay[DEMO ONLY]** – Payment gateway integration
- **GitHub** – Version control

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- MySQL / TiDB database

## 📁 Project Structure
```
laravel-e-commerce/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   │   ├── CartController.php
│   │   └── CheckoutController.php
│   ├── Models/              # Eloquent models
│   └── Services/            # Business logic
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Test data seeders
├── resources/
│   ├── views/              # Blade templates
│   └── css/js/             # Frontend assets
├── routes/                  # Application routes
└── public/                  # Public assets
```
