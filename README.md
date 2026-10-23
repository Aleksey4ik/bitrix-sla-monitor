# Bitrix SLA Monitor

Сервис на Laravel, который следит за SLA в Bitrix24 (коробка и облако): отслеживает сделки и задачи, находит нарушения сроков и отправляет уведомления.

> Проект в разработке. Сейчас готов только каркас: Docker-окружение и пустое приложение Laravel.

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

## Структура

- `src/` — приложение Laravel
- `docker/` — Dockerfile для PHP и конфигурация nginx
- `compose.yml` — запуск всех сервисов

## Лицензия

MIT