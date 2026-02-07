#!/bin/sh
set -e

echo "⏳ Waiting for MySQL..."

until php -r "
try {
    new PDO(
        'mysql:host=mysql;port=3306;dbname=mini-crm',
        'user',
        'password',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception \$e) {
    exit(1);
}
"; do
    sleep 2
done

echo "✅ MySQL is ready"

php artisan migrate --force
php artisan db:seed --force

exec "$@"
