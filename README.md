<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="public/logo.png" width="80" alt="Laravel Logo">
    </a>
</p>

## Task Management Dashboard

This is a simple dashboard for managing tasks.


## Installation

Follow these steps to set up the application locally:

### 1. Clone the Repository

```sh
git clone https://github.com/mbsatimov/task-management-system-dashboard
cd task-management-system-dashboard
```

### 2. Copy the .env file

Copy the .env.example file to .env:

```sh
cp .env.example .env
```

### 3. Install Dependaecies

```sh
composer install
```

### 4. Bring Sail Up

Start the Docker containers with Sail:

```sh
./vendor/bin/sail up -d
```

### 5. Generate Application Key

```sh
./vendor/bin/sail artisan key:generate
```

### 6. Set Up Database

```sh
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

### 7. Install Frontend Dependencies

```sh
./vendor/bin/sail npm install
```

### 8. Build Frontend Assets

Development Build

```sh
./vendor/bin/sail npm run dev
```

Production Build

```sh
./vendor/bin/sail npm run build
```

### 9. Access the Application

Visit http://localhost in your browser.
