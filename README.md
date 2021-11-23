# OpenSource IPTV


copy .env.example to .env and edit to your environment and edit by your needs

```
composer install --no-dev
php artisan sriptv:init
php artisan serve
```

## Docker 

build:

```
docker build . -t sr-admin-gui
```

run:

```
docker run -it -p 8080:80 -v data:/data -v "$(pwd)"/.env:/var/www/html/.env:z sr-admin-gui
```

or, if you want to get pre-built package, please use:

```
docker pull ghcr.io/streamingriver/sr-admin-gui:latest
```
