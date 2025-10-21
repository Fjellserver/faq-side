<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator; // Used for crawling
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Spatie\Sitemap\Tags\Url; // Used to create custom URL tags

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 1. Start the crawler using the configured URL (APP_URL from .env) and add a hook
        // to modify every discovered URL before it's saved.
        $sitemap = SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) {
                $path = $url->path();

                // DEDUPING FIX: If the path is the root (or equivalent), skip it.
                // We add it manually in step 2 with the correct high priority.
                if ($path === '/' || $path === '') {
                    return; // Ekskluder denne URL-en fra sitemapen
                }

                // Sett siste modifikasjonsdato for *hver* URL funnet av crawleren
                $url->setLastModificationDate(Carbon::now());

                if (str_starts_with($path, '/kategori')) {
                    // Category Pages: Disse er viktige navigasjonssider.
                    $url->setPriority(0.8);
                    $url->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY);

                } elseif (str_starts_with($path, '/artikkel')) {
                    // Article/Blog Pages: Standardinnhold, oppdateres ukentlig.
                    $url->setPriority(0.7);
                    $url->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY);

                } else {
                    // Alle andre generelle sider (f.eks. /about, /contact)
                    $url->setPriority(0.5);
                    $url->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);
                }

                return $url;
            })
            ->getSitemap();

        // 2. Add the root URL manually, setting the highest priority (1.0).
        // This is now the ONLY place the root URL is added.
        $sitemap->add(
            Url::create('/')
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(1.0) // Sett hjemmesiden til absolutt høyeste prioritet
        );

        // 3. Write the final sitemap file (containing crawled URLs + custom URLs)
        $sitemap->writeToFile(public_path('sitemap.xml'));

        // Optional: Log a success message
        $this->info('Sitemap successfully generated!');
        Log::info('Sitemap successfully generated!');
    }
}
