-----------------------------------------------

# Laravel 10 backend API
cd .\backend\ 
  # Instalar dependencias
composer install
pnpm install
  # Crear el archivo .env
copy .env.example .env
  # Creando un nuevo API key
php artisan key:generate
  # ejecutar migracion y seeder
php artisan migrate:fresh --seed
  # correr Laravel API
php artisan serve

-----------------------------------------------

# Quasar Framework 2 Frontend
cd .\frontend\
  # Instalar dependencias
pnpm add -g @quasar/cli
pnpm install
  # correr quasar framework
quasar dev

-----------------------------------------------

