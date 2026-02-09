# Mini CRM

Тестовый проект на Laravel для приёма и обработки заявок с сайта.

Проект включает:
- публичный API для создания заявок
- iframe-виджет для встраивания на сайт
- административную панель для менеджеров
- загрузку и хранение файлов
- Docker-окружение для быстрого запуска

---

## Стек технологий

- PHP 8.4
- Laravel 12
- MySQL
- Nginx
- Docker / Docker Compose
- Bootstrap 5
- spatie/laravel-permission
- spatie/laravel-medialibrary

---

## Запуск проекта

### 1. Клонирование репозитория

```bash
git clone https://github.com/51mpLeDev/mini-crm
cd mini-crm
```

### 2. Запуск Docker

```bash
docker compose up -d --build
```

### Инициализация приложения

В контейнере app выполнить:

```bash
docker compose exec app bash
```

```bash
composer install
npm install
npm run build

php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

---

## Доступы

### Административная панель

```makefile
URL: http://localhost:8080/admin/tickets
Email: manager@test.com
Password: password
```

Доступ ограничен ролью manager.
