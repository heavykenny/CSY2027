set -e

echo "Deploying Application to Server....."

#Enter Maintenance Mode

(php artisan down || true)
    composer install

    php artisan optimize

    php artisan config:clear

php artisan up

echo "Successfully Deployed....."
