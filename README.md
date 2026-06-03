# Finance Tracker - Laravel

A simple financial tracking system built for the PaninBank Technical Test. This project allows users to manage multiple wallets and record income/expense transactions with automatic balance updates.

## Features

-   **Authentication**: Login & Register (Laravel Breeze).
-   **Wallets**: Create and manage multiple financial accounts/wallets.
-   **Transactions**: Record Income (+) and Expense (-) transactions.
-   **Automatic Balance**: Wallet balances update automatically based on transactions.
-   **Dashboard**: Summary of total balance, total expenses, and recent activities.

## Tech Stack

-   **Framework**: Laravel 11
-   **Database**: MySQL
-   **Frontend**: Tailwind CSS & Blade Templates
-   **Auth Starter Kit**: Laravel Breeze

## Prerequisites

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL

## Installation Steps

1. **Clone the repository** (or extract the zip).
2. **Install PHP dependencies**:
    ```bash
    composer install
    ```
3. **Install JS dependencies**:
    ```bash
    npm install
    ```
4. **Configure Environment**:
    - Copy `.env.example` to `.env`.
    - Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env` to match your local MySQL setup.
5. **Generate App Key**:
    ```bash
    php artisan key:generate
    ```
6. **Run Migrations**:
    ```bash
    php artisan migrate
    ```
7. **Build Assets**:
    ```bash
    npm run build
    ```
8. **Run the Application**:
    ```bash
    php artisan serve
    ```

Access the app at: `http://127.0.0.1:8000`
