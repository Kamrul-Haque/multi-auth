## Laravel 8 Multi-Authentication System
Role based Authentication System using [Laravel Breeze & Inertia with vue scaffolding](https://laravel.com/docs/8.x/starter-kits#breeze-and-inertia) A middleware 'Permit' has been created for protecting routes of users with different roles.

### Installation
- clone the repository:\
```
git clone https://github.com/Kamrul-Haque/Multi-Auth.git
```
- install PHP dependencies via composer:\
```
composer install
```
- install js dependencies via npm:\
```
npm install
```
- compile js & css assets:\
```
npm run dev
```
- copy .env.example file & create a new .env file using terminal:\
```
copy .env.example .env
```
- generate an application key:\
```
php artisan key:generate
```
- set project configurations in .env file
- create a MySQL database
- create tables in database with default data:\
```
php artisan migrate --seed
```
- use xampp or wampp or php artisan serve command to use run the application in localhost

### Default Data
Roles:
```
1. Super Admin
2. Admin
3. User
```

Users:
```
User
Email: user@email.com
Password: 123456789

Admin
Email: admin@email.com
Password: 123456789

Super Admin
Email: super-admin@email.com
Password: 123456789
```

### Specifications
- Role based Multi Authentication System
- Custom Route Middleware ``Permit.php`` to protect routes for specific roles
- Dedicated *Dashboard* for each role. See ``routes/web.php``
- Redirection upon *Login* managed in ``App/Http/Controllers/Auth/AuthenticatedSessionController.php``
- Auto role allocation in ``App/Http/Controllers/Auth/RegisteredUserController.php``. Any new registered *user* will get the role user.
