# QaiserLab
# Code Igniter 4 & VueJS CMS

Just a simple blog with a simple CMS, mainly made with Code Igniter 4 & VueJS.

# Live
https://qaiserlab.herokuapp.com/

# Features

- Blog/Website
- Admin/Dashboard (Using AdminLTE as The Template)

# Development Setup

1. Install composer packages

```
composer install
```

2. Install yarn/npm packages

```
cd public
yarn install ~ or ~ npm install
```

3. Make sure to run MySQL/MariaDB Server on your PC

4. Run QaiserLab service

```
php spark serve
```

5. Run Adminer using web browser and create your database using Adminer

```
http://localhost:8080/adminer
```

6. Create .env file on root directory by copying env file

7. Configure your environment & database connection on .env file, ex.

```
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080'

database.default.DSN = 
database.default.hostname = localhost
database.default.username = root
database.default.password = m30ng
database.default.database = db_qaiserlab
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

8. Run database migrations

```
php spark migrate
```

9. Run database seeders

```
php spark db:seed DatabaseSeeder
```

10. Run the QaiserLab using web browser, by browsing

```
http://localhost:8080
```

11. Admin/Dashboard Info

```
URL: http://localhost:8080/dashboard
Username: admin
Password: admin123
```
