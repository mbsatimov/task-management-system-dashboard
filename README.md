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

### 3. Run the Docker containers

```sh
./vendor/bin/sail up -d
./vendor/bin/sail composer install
```

Install frontend dependencies:

```sh
./vendor/bin/sail npm install
```

### 4. Generate Application Key

```sh
./vendor/bin/sail artisan key:generate
```

### 5. Set Up Database

```sh
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

### 6. Build Frontend Assets

Compile the Vue.js frontend assets:

```sh
./vendor/bin/sail npm run dev
```

### 7. Access the Application

Visit http://localhost in your browser.
