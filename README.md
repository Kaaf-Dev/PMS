# BeProTeam - Properties Management System (PMS)

This is a Laravel project that provides a powerful properties and tenants management tools

## Getting Started

These instructions will help you get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

- PHP
- Composer
- MySQL

### Installing

1. Clone the repository:

```
git clone https://github.com/BeProTeam/PMS
```

2. Navigate to the project directory:

```
cd PMS
```

3. Install project dependencies:

```
composer install
```

4. Create a copy of the `.env.example` file and rename it to `.env`. Update the necessary configurations such as database credentials.

5. Generate an application key:

```
php artisan key:generate
```

6. Run the database migrations:

```
php artisan migrate
```

7. Seed the database with sample data:

```
php artisan db:seed --class AdminsTableSeeder

php artisan db:seed --class NationalitiesTableSeeder
php artisan db:seed --class UsersTableSeeder

php artisan db:seed --class CategoriesTableSeeder
php artisan db:seed --class PropertyTableSeeder
php artisan db:seed --class ContractApartmentSeeder

```

8. Start the development server:

```
php artisan serve
```

9. Open the application in your browser:

```
http://localhost:8000
```
