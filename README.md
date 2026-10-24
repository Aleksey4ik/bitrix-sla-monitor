# Bitrix SLA Monitor

Сервис на Laravel, который следит за SLA в Bitrix24 (коробка и облако): отслеживает сделки и задачи, находит нарушения сроков и отправляет уведомления.

> Проект в разработке.

## Стек

PHP 8.4, Laravel 13, MySQL 8.4, nginx, Docker Compose.

## Быстрый старт

Нужны Docker и Docker Compose.

```bash
git clone https://github.com/<логин>/bitrix-sla-monitor.git
cd bitrix-sla-monitor

docker compose up -d --build
docker compose exec app composer install
cp src/.env.example src/.env
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

Приложение откроется на http://localhost:8080.

## Проверки качества

Все команды выполняются из корня репозитория, внутри контейнера.

```bash
# тесты
docker compose exec app php artisan test

# статический анализ (PHPStan + Larastan)
docker compose exec app ./vendor/bin/phpstan analyse

# проверка стиля кода (Pint); без --test исправляет файлы
docker compose exec app ./vendor/bin/pint --test
```

Те же три проверки запускаются автоматически в GitHub Actions на каждый pull request.

## Структура

- `src/` — приложение Laravel
- `docker/` — Dockerfile для PHP и конфигурация nginx
- `compose.yml` — сервисы (общая часть для всех окружений)
- `compose.override.yml` — настройки для локальной разработки, подхватываются автоматически

## Окружения

Локально `docker compose up` объединяет `compose.yml` и `compose.override.yml`:
код монтируется из `src/`, а `vendor/` хранится в Docker-volume для скорости (актуально для Windows/WSL2).

## Лицензия

MIT