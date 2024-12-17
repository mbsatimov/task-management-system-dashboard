<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="public/logo.png" width="80" alt="Laravel Logo">
    </a>
</p>

## Task Management Dashboard

This is a simple dashboard for managing tasks.

## Running the Application with Docker

You can easily run this application using Docker. Start the container with the following command:

### 1. Clone this repository

```sh
git clone https://github.com/mbsatimov/task-management-system-dashboard
cd task-management-system-dashboard
```

### 2. Copy the .env file

Copy the `.env.example` file to `.env` and update the necessary environment variables if needed.

### 3. Run the migrations

```sh
sail artisan migrate
sail php artisan db:seed
```

### 4. Run the Docker containers

```sh
sail up -d
sail npm run dev
```
