#!/bin/sh
set -e

if [ ! -f .env ]; then
  cp .env.example .env
fi

sed -i 's/DB_HOST=.*/DB_HOST=db/' .env
sed -i 's/DB_DATABASE=.*/DB_DATABASE=PPLSI4709B_db/' .env
sed -i 's/DB_USERNAME=.*/DB_USERNAME=PPLSI4709B_db/' .env
sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=KELOMPOK_B/' .env

composer install --ignore-platform-req=ext-zip

php artisan key:generate --force

# Wait for DB to be ready
echo "Waiting for MySQL..."
for i in $(seq 1 30); do
  php artisan migrate --force && break
  echo "DB not ready yet, retrying in 3s..."
  sleep 3
done

echo "Starting Laravel server..."
exec php artisan serve --host=0.0.0.0 --port=8000
