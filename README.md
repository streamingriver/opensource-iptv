# OpenSource IPTV

copy `.env.example` to `.env` and edit to your environment and edit by your needs.
Set permissions of `.env` via `chmod 777 .env` .

```shell
composer install --no-dev
php artisan sriptv:init
php artisan serve
```

## Docker

build the sr-admin-gui image

```shell
docker build . -t sr-admin-gui
```

run:

```shell
docker run -it -p 8080:80 -v data:/data -v "$(pwd)"/.env:/var/www/html/.env sr-admin-gui
```

or, if you want to get pre-built package, please use:

```shell
docker pull ghcr.io/streamingriver/sr-admin-gui:latest
```

## Access

[Gui](http://localhost:8080/)
