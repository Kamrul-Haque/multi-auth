## Laravel 8 Multi-Authentication System
Authentican system for multiple types of usersuser & admin. 'Laravel Breeze' package has been used for creating the role based multi-authentication system. A middleware 'Permit' has been created for protecting routes of users with different roles.

### How to use
- clone the repository using:\
git clone https://github.com/Kamrul-Haque/Multi-Auth.git
- install PHP packages via composer:\
composer install
- install js packages via npm:\
npm install
- compile js & css assets:\
npm run dev
- copy .env.example file & create a new .env file using terminal:\
copy .env.example .env
- generate an application key:\
php artisan key:generate
- modify profect configurations in .env file
- create a MySQL database
- create tables in database:\
php artisan migrate
- use xampp or wampp or php artisan serve command to use run the application in localhost
