# HOTEL-ADMIN

## Database configuration

## DEV SETUP

```shell
php artisan migrate:fresh --seed
php artisan storage:link
```

## DEPLOYMENT

```shell
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache

```

```
APP_DEBUG=false
```

## ASSETS
/resources/img/fondo.jpg
Pixabay License
Gratis para usar bajo la licencia de Pixabay
No es necesario reconocimiento

/resources/icons/*
Font Awesome Free License
Font Awesome Free is free, open source, and GPL friendly. You can use it for
commercial projects, open source projects, or really almost whatever you want.
Full Font Awesome Free license: https://fontawesome.com/license/free.
