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
```
## Tips
Dersom det oppstår problemer prøv:
```
php artisan optimize
```
Husk å lag bruker! Filen finnes under:
```
config/fortify.php

Dersom du ikke ønsker at hvemsom helst kan registrere seg
//Features::registration()
```

# Lenker
```
/register
/login
/dashboard
```