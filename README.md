
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

Next, Create Database After running MAMP,XAMPP or Laragon which ever server you're using, open phpmyadmin, create a db there.

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
  php artisan migrate --seed
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

![App Screenshot](/public/home-2.png)
![App Screenshot](/public/api.png)

