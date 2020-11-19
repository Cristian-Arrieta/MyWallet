#Run Database Migrations
#php artisan migrate:fresh --forge
php artisan migrate --force

#Run seeders
php artisan db:seed