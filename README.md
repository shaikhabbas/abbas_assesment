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

1. Clone the Repository

git clone <repository-url>
cd <project-directory>

2. Install Dependencies
composer install

3. Create Database
After running MAMP,XAMPP or Laragon which ever server you're using, open phpmyadmin, create a db there.

4. Environment Configuration
Copy the example .env file and configure it:
cp .env.example .env
Update the .env file with your database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

5. Generate Application Key
php artisan key:generate

6. Run Migrations and Seeders
php artisan migrate --seed

7.Serve the Application 
php artisan serve
This command will generate the url like http://127.0.0.1:8000

8. To view api documentation 
Pick the url generated on step 7, open in browser like http://127.0.0.1:8000/docs/api.
YOUR_BASE_URL/docs/api.