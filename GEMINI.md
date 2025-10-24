## Project Overview

This is a Laravel 12 project, likely a stock management application based on the project name "shangtelhome-stock". It uses MariaDB for the database and includes basic user authentication with roles.

## Building and Running

### Prerequisites

*   PHP 8.2+
*   Composer
*   Node.js
*   npm
*   Docker (for database and phpMyAdmin)

### Setup

1.  Ensure Docker is running.
2.  Navigate to the `laravel` directory: `cd laravel`
3.  Install PHP dependencies: `composer install`
4.  Install Node.js dependencies: `npm install`
5.  Copy `.env.example` to `.env`: `cp .env.example .env`
6.  Generate application key: `php artisan key:generate`
7.  Run migrations: `php artisan migrate`
8.  Build frontend assets: `npm run build`

### Running the application

1.  Start Docker services (database, phpMyAdmin) from the project root (`/home/fuureya/Documents/projects/shangtelhome-stock/`):
    ```bash
    docker-compose up -d
    ```
2.  Start the Laravel development server, queue listener, pail, and Vite dev server from the `laravel` directory:
    ```bash
    npm run dev
    ```
3.  Access the application in your browser, typically at `http://localhost:8000` (or the port configured by `php artisan serve`).
4.  phpMyAdmin will be available at `http://localhost:8081`.

### Testing

*   Run PHPUnit tests from the `laravel` directory:
    ```bash
    php artisan test
    ```

## Development Conventions

*   **Framework:** Laravel 12
*   **Database:** MariaDB
*   **Frontend:** Uses Vite for asset compilation, Bootstrap 5 for styling.
*   **Authentication:** Custom authentication implemented with `AuthController`, using `username` and `password`. Users have a `role` (default 'user').
