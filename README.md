# News API

Backend для сайта с новостями.

- [Требования](#требования)
- [Установка и запуск](#установка-и-запуск)
- [Возможности и особенности](#возможности-и-особенности)

## Требования

- PHP >=8.3
- Composer
- PostgreSQL >=16.2
- Веб-сервер Nginx

### Или

- Docker + Docker Compose

## Установка и запуск

### Настройка окружения

Клонировать репозиторий на локальную машину:

```bash
git clone https://github.com/bcchicr/ad-board.git
```

Получить подмодуль с докер-средой:

```bash
git submodule init
git submodule update
```

Зайти в папку `docker-php-env` и копировать файл `.env.example` в `.env`:

```bash
cp .env.example .env
```

Настроить переменные окружения при необходимости.

### Настройка приложения

В корневой папке проекта копировать файл `.env.example` в `.env`:

```bash
cp .env.example .env
```

Заполнить поля `DB_*`.

Открыть контейнер с приложением в интерактивном режиме:

```bash
docker exec -it <app_container_name> bash
```

PHP-fpm работает из-под пользователя www-data. Для корректной работы может понадобиться изменить владельца папки `storage`:

```bash
chown -R www-data:www-data ./storage/
```

Установить зависимости:

```bash
composer install
```

Сгенерировать новый ключ шифрования:

```bash
php artisan key:generate
```

Запустить миграции:

```bash
php artisan migrate:fresh --seed
```
