## Faq Side
En faq side laget for Fjellserver.no

## Installer
```
composer install --optimize-autoloader --no-dev
php artisan key:generate
npm install
php artisan migrate --force
chgrp -R www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache
chmod -R 775 storage
```
## Tips
Dersom det oppstår problemer prøv:
```
php artisan optimize

kan ikke laste opp bilder:
rm public/storage
php artisan optimize:clear
php artisan storage:link
```
Husk å lag bruker! Filen finnes under:
```
config/fortify.php

Dersom du ikke ønsker at hvemsom helst kan registrere seg
//Features::registration()
```

Generer site map "php artisan app:generate-sitemap"

# Lenker
```
/register
/login
/dashboard
```