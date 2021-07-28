# laravel7-gull
## Skeleton laravel 7 menggunakan gull
##### install:

```
git clone [nama repo]
npm install
composer install --optimize-autoloader --no-dev
composer dump-autoload
copy .env.production .env

ganti nama database di .env dengan yang sesuai

Bikin dulu database nya misalkan nama database nya gull
contoh:
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_DATABASE=gull
DB_USERNAME=postgres
DB_PASSWORD=root123
DB_PORT=5432

php artisan key:generate
php artisan config:cache
php artisan config:clear
php artisan route:cache
php artisan view:cache
php artisan migrate
php artisan db:seed
user: admin
password: admin

```

##### sudah dilengkapi dengan:
- Auth menggunakan spatie
- Activity log