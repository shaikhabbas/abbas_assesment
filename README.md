## Abbas Test Project Setup Guide

This project is a comprehensive API-based system built using Laravel 12. It provides functionalities for user management, project tracking, timesheet logging, and dynamic attribute handling through an Entity-Attribute-Value (EAV) model.

The system is designed to be flexible and scalable, allowing users to manage projects, track work hours, and store dynamic project-related data efficiently. Authentication is handled using Laravel Passport, ensuring secure access to APIs. Additionally, the API documentation is automatically generated using Scramble, providing clear and structured endpoints for easy integration.

### Key Features

- User Management: Create, update, delete users with secure authentication.
- Project Management: Track projects with dynamic attributes.
- Timesheet Logging: Record and monitor work hours efficiently.
- Dynamic Attributes (EAV Model): Support customizable project fields.
- Filtering: Retrieve data based on multiple criteria.
- Secure API Access: Authentication via Bearer Tokens.
- Automated API Documentation: Easily accessible and updated documentation.

## Prerequisites

Make sure you have the following installed on your system:

PHP 8.1 or higher

Composer

MySQL

Laravel 12

MAMP (if using macOS)
XAMPP or Laragon (if using Windows)

Composer

## Installation Steps

To deploy this project run follow below

```bash
  git clone https://github.com/shaikhabbas/abbas_assesment.git
  cd <project-directory>
```
Next,
Install Dependencies

```bash
  composer install
```

Next, Create Database After running MAMP,XAMPP or Laragon which ever server you're using, open phpmyadmin, create a db there. SQL db dump is also added in the repo for more clearity named as abbas_test.sql.

Next, Environment Configuration, Copy the example .env file and configure it:

```bash
  cp .env.example .env
```

Next, Update the .env file with your database credentials:

```bash
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database_name
  DB_USERNAME=your_username
  DB_PASSWORD=your_password
```
Next, Generate Application Key

```bash
  php artisan key:generate
```

Next, Run Migrations and Seeders

```bash
  php artisan migrate:fresh --seed
```

Next, Serve the Application
```bash
  php artisan serve
```

This command will generate the url like http://127.0.0.1:8000


## API Reference

#### To view api documentation Pick the url generated, open in browser like 


```http
   http://YOUR_BASE_URL/docs/api
```


## Screenshots

```http
   http://YOUR_BASE_URL
```
![App Screenshot](/public/home-2.png)

```http
   http://YOUR_BASE_URL/docs/api
```
![App Screenshot](/public/api.png)


## Credentials

For login use below credentials

```bash
  emali: abbas@example.com
  password: password
```


## FAQ

#### I am seeing error of Personal access client not found. 

To fix this issue run the below command.
```bash
  php artisan passport:client --personal
```
It will ask a name, provide any name and hit enter, now good to go. 


## API Documentation

You can view the API documentation without running the Laravel project by opening the following link:  
[View API Docs](https://shaikhabbas.github.io/abbas_assesment/Api_Doc.html#/)





