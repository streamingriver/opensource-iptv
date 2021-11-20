# OpenSource IPTV


copy .env.example to .env and edit to your environment

```
composer install --no-dev
php artisan sriptv:init
```

## Docker 

build:

```
docker build . -t sr-admin-gui
```

run:

```
docker run -p 8080:80 -v "$(pwd)"/.env:/app/sr-admin-gui/.env:z sr-admin-gui
```
