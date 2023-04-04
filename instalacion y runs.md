# Instalar Proyecto laravel
{
composer create-project laravel/laravel example-app
}

# instalar Breeze ( a minimal, simple implementation of all of Laravel's authentication features, including login, registration, password reset, email verification, and password confirmation. )
{
composer require laravel/breeze --dev
# configurar breeze modo api
php artisan breeze:install api
php artisan migrate
}

# {{ o }}

# instalar Fortify nos permite componer todos los comportamientos del sistema de login de usuarios de Laravel, pero sin introducir ningún código de la parte de del frontend
{
composer require laravel/fortify
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
php artisan migrate
}

# correr server
{
php artisan serve
}

# hacer modelos migraciones controladores
{
php artisan make:model nombre -a
}

# Laravel Migration Generator
{
composer require --dev bennett-treptow/laravel-migration-generator
php artisan vendor:publish --provider="LaravelMigrationGenerator\LaravelMigrationGeneratorProvider"

## Usage tests/database/migrations
php artisan generate:migrations

## Different path with the --path option:
php artisan generate:migrations --path=database/migrations
}

# Correr todas las migraciones y rellenar seeders
{
php artisan migrate:fresh --seed
}
