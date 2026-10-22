## FAQ-side
En FAQ-side laget for Fjellserver.no
hjelp.fjellserver.no

---

## Krav
- PHP 8.3.36 eller nyere (Laravel 13). Composer nekter å installere på eldre PHP.
- Composer 2
- Node.js 20 eller nyere (kun for å bygge frontend-assets)
- MySQL/MariaDB

---

## Installer
Kjør følgende kommandoer for å sette opp prosjektet:

composer install --optimize-autoloader --no-dev
php artisan key:generate
npm ci
npm run build
php artisan migrate --force
php artisan storage:link
chgrp -R www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache
chmod -R 775 storage

Sett `APP_ENV=production` og `APP_DEBUG=false` i `.env` på serveren. Da blir
sesjonskapselen automatisk kun sendt over HTTPS.

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
Alle innloggede brukere har full tilgang til dashbordet, så åpen registrering er
slått av (`Features::registration()` er kommentert ut i `config/fortify.php`).

Opprett den første brukeren fra kommandolinjen:

php artisan tinker
>>> App\Models\User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => Hash::make('et-langt-og-unikt-passord')]);

Skru på tofaktor-autentisering under «Din bruker» etter første innlogging.

---

## Sikkerhet
- Bildeopplasting fra editoren godtar kun jpg, png, gif og webp (maks 5 MB) og
  lagrer filene under tilfeldige navn. `public/.htaccess` nekter kjøring av
  skript under `/storage`.
- Alle POST-ruter, inkludert `/upload`, krever CSRF-token.
- Editoren i dashbordet bruker TinyMCE 7 fra Tiny Cloud. TinyMCE 5 er utgått og
  får ikke lenger sikkerhetsoppdateringer, så ikke rull tilbake til den.
- Passord må være minst 12 tegn med bokstaver og tall i produksjon, og sjekkes
  mot kjente lekkasjer (Have I Been Pwned).
- Svarene får sikkerhetsheadere (`X-Content-Type-Options`, `Referrer-Policy`,
  `Permissions-Policy`, `Content-Security-Policy: frame-ancestors` og HSTS over HTTPS).
- Kjør `composer audit` og `npm audit` jevnlig for å fange sårbare avhengigheter.

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
 0 3 * * 1 cd /path/til/prosjektet && /usr/bin/php artisan app:generate-sitemap >> /dev/null 2>&1

 Forklaring:
- `0 3 * * 1` → kjører hver mandag kl. 03:00
 - cd /path/til/prosjektet → bytter til prosjektmappen
 - /usr/bin/php artisan app:generate-sitemap → kjører Laravel-kommandoen
 - >> /dev/null 2>&1 → skjuler output (valgfritt)

💡 Tips: Du kan sjekke hvor PHP ligger med kommandoen `which php`, og oppdatere banen i cron-jobben dersom nødvendig.

---

## Lenker
/login
/dashboard
/user/profile
