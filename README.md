# Bandtech

## Table of Contents

### Project Overview
    * Installation
    * Usage (Optional)
    * Testing
    * notes
This project is developed for Bandtech. It utilizes the Laravel framework version 10 to provide a robust and flexible foundation for building Api.

## Installation

**1. Clone the Repository:**

```bash
git clone https://github.com/your-username/bandtech-project.git
```

**2. change dir:**

```bash
cd bandTech
```

**3. Create Database and Update .env File:**

Create a database for the project on your local development machine and update the .env file with your database credentials:
```bash
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
```
    
## Install Dependencies:

### Install project dependencies using Composer:

```bash
composer install
```

## Database Migrations:

Run database migrations to create or update database tables:

```bash
php artisan migrate
```

Seeding Data (Optional):

If applicable, seed sample data into the database for testing purposes:

```bash
php artisan db:seed
```

Storage Link :

Create a symbolic link from the storage directory to the public/storage directory if you plan to store user-uploaded files:

```bash
php artisan storage:link
```

Unit Tests:

Run unit tests to verify code functionality:

```bash
php artisan test
```

Development Server:

Start a development server for easy access to the application:

```bash
php artisan serve
```

This will typically start the server on http://localhost:8000.
## find collection in 

- you can use postman Ruuner to run all collection requests but make sure unchecked logout request

```bash 
https://api.postman.com/collections/26624499-533d97de-4c36-4188-9740-c375229bccf7?access_key=PMAT-01HT9WBHRV5BNPBJF0EPM06PKZ
```

## notes
- I implemented simple test case senario using phpUnit
- I implemented simple tests using postman test
