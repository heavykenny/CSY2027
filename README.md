# eShop - Technical ReadMe

## Introduction

eShop is a web application developed using the Laravel framework, MySQL database, Docker for containerization, Valet for
macOS development environment, and XAMPP for Windows development environment. This readme provides an overview of the
technical aspects of eShop and guides through the setup and usage of the application.

This is a group project for the CSY2027 module at the University of Northampton and developed by the following team members:

- Kehinde Olawuwo
- Prudence-Success Harry
- Isaac Chuwkwudi-Samuel

## Technologies Used

- Laravel: A powerful PHP framework used for developing the eShop web application

- MySQL: MySQL is used as the database engine for eShop.

- Docker: Docker simplifies the deployment process and ensures consistency across different environments.

- Valet (for macOS): Valet provides a lightweight and user-friendly way to set up a local development server for Laravel
  applications.

- XAMPP (for Windows): XAMPP provides an easy-to-install and pre-configured environment for running PHP-based
  applications on Windows.


## Features


## Security tools used

- Burp Suite: a web application security testing tool used to identify vulnerabilities in the eShop
  application.
- Wireshark: a network protocol analyzer used to monitor the network traffic between the eShop application and the
  database.

## Setup Instructions

### Prerequisites

- PHP: Make sure you have PHP installed on your system. You can download it from the official PHP website.

- Composer: Install Composer by following the instructions on the
  official Composer website.

### Installation

1. Clone the eShop repository to your local machine:
   ```bash
   git clone https://github.com/heavykenny/CSY2027.git
   ```

2. Install the project dependencies using Composer:
   ```bash
   cd CSY2027
   composer install
   ```

3. Configure the Database:
    - Create a new MySQL database for eShop.
    - Rename the `.env.example` file to `.env` and update the database configuration details in the `.env` file.

4. Generate the Application Key:
   ```bash
   php artisan key:generate
   ```

5. Run the Database Migrations:
   ```bash
   php artisan migrate
   ```

6. Start the Development Server:
    - For macOS (using Valet):
      ```bash
      valet link
      valet secure
      ```
    - For Windows (using XAMPP):
      Copy the project files to the `htdocs` directory in your XAMPP installation and start the Apache server.

## Docker Setup Instructions

## Tables

The eShop application utilizes several tables to store data, including:

- Clients: Stores information about the clients (users) of the application.
- Roles: Manages different user roles and their permissions.
- Permissions: Defines various permissions that can be assigned to roles.
- Role_Permissions: Establishes the relationship between roles and permissions.
- Vendor: Contains details about the vendors associated with the products.
- Orders: Stores information about the orders placed by clients.
- Products: Manages the product catalog, including details like name, description, price, and image URL.
- Order_Items: Tracks the items included in each order.
- Wishlist: Stores the wishlist items for each user.
- Payments: Manages payment information related to orders.
- Payment_Methods: Contains the available payment methods.
- Order_History - Transaction: Tracks the history of order transactions, including status and timestamps.

## Usage

Once you have completed the installation process, you can access the eShop web application by visiting the assigned domain or localhost in your web browser. The application provides a user-friendly interface for browsing products, adding them to the cart, and completing the checkout process.

As an administrator, you can log in to the admin dashboard to manage products, orders, users, and other aspects of the application.

Enjoy using eShop and happy coding!
