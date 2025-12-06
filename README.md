# MyMembers

This is a Laravel Inertia project for membership management.

## Prerequisites

Before you begin, ensure you have met the following requirements:
* You have installed PHP (8.2 or higher)
* You have installed Composer
* You have installed Node.js and npm
* You have a basic understanding of Laravel and Inertia.js

## Cloning and Installing

To install MyMembers, follow these steps:

1. Clone the repository
   ```
   git clone https://github.com/CyberElysium/MyMembers.git
   ```

2. Navigate to the project directory
   ```
   cd MyMembers
   ```

3. Install PHP dependencies
   ```
   composer install
   ```

4. Install JavaScript dependencies
   ```
   npm install
   ```

5. Copy the .env.example file to .env
   ```
   cp .env.example .env
   ```
   
6. Create a symbolic link for storage
   ```
   php artisan storage:link
   ```

7. Migrate the database
   ```
   php artisan migrate
   ```
   
8. Seed the database
   ```
   php artisan db:seed
   ```

9. Migrate and seed the database
   ```
   php artisan migrate --seed
   ```

10. Key generate
   ```
   php artisan key:generate
   ```

## Running the application

To run MyMembers, follow these steps:

1. Compile and hot-reload for development
   ```
   npm run dev
   ```

2. In a separate terminal, start the Laravel development server
   ```
   php artisan serve
   ```

3. Open your browser and navigate to `http://localhost:8000`

4. You should see "MyMembers" in the browser

## Server Links

* QA - `https://mymembers.cyberelysium.xyz`
* Live - `https://app.mymembers.lk`
