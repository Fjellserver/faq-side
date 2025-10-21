## FAQ-side
En FAQ-side laget for Fjellserver.no
hjelp.fjellserver.no

---

## Installer
Kjør følgende kommandoer for å sette opp prosjektet:

composer install --optimize-autoloader --no-dev
php artisan key:generate
npm install
php artisan migrate --force
chgrp -R www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache
chmod -R 775 storage

---

## Tips
Dersom det oppstår problemer, prøv følgende:

php artisan optimize

### Kan ikke laste opp bilder:
rm public/storage
php artisan optimize:clear
php artisan storage:link

---

## Brukeropprettelse
Husk å opprette en bruker!
Konfigurasjonen finnes i:

config/fortify.php

Dersom du ikke ønsker at hvem som helst skal kunne registrere seg, kommenter ut følgende linje:

// Features::registration()

---

## Generer sitemap
For å generere et sitemap manuelt, kjør:

php artisan app:generate-sitemap

---

## Automatisk sitemap-generering via cron
For å automatisere genereringen av sitemap, kan du legge til en cron-jobb som kjører kommandoen daglig.

1. Åpne crontab-redigering:
 crontab -e

2. Legg til følgende linje nederst i filen:
 0 3 * * * cd /path/til/prosjektet && /usr/bin/php artisan app:generate-sitemap >> /dev/null 2>&1

 Forklaring:
 - 0 3 * * * → kjører hver dag kl. 03:00
 - cd /path/til/prosjektet → bytter til prosjektmappen
 - /usr/bin/php artisan app:generate-sitemap → kjører Laravel-kommandoen
 - >> /dev/null 2>&1 → skjuler output (valgfritt)

💡 Tips: Du kan sjekke hvor PHP ligger med kommandoen `which php`, og oppdatere banen i cron-jobben dersom nødvendig.

---

## Lenker
/register
/login
/dashboard
