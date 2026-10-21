<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FaqSecurityTest extends TestCase
{
    use RefreshDatabase;

    /** A valid 1x1 transparent PNG, so the tests do not depend on the GD extension. */
    private const PNG_1X1 = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==';

    private function createKategori(string $navn = 'Generelt'): int
    {
        return DB::table('kategori')->insertGetId([
            'navn' => $navn,
            'undertekst' => 'Undertekst',
        ]);
    }

    private function createArtikkel(array $overrides = []): int
    {
        return DB::table('artikler')->insertGetId(array_merge([
            'tittel' => 'Tittel',
            'url' => 'Tittel',
            'intro' => 'Intro',
            'innhold' => '<p>Innhold</p>',
            'kategori' => 'Generelt',
            'short' => 'kort',
            'hide' => 0,
            'sticky' => 0,
        ], $overrides));
    }

    public function test_responses_carry_security_headers(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('Content-Security-Policy');
        $this->assertStringContainsString('frame-ancestors', $response->headers->get('Content-Security-Policy'));
    }

    public function test_upload_requires_authentication(): void
    {
        $response = $this->post('/upload', [
            'file' => UploadedFile::fake()->createWithContent('a.png', base64_decode(self::PNG_1X1)),
        ]);

        $response->assertRedirect('/login');
    }

    public function test_upload_rejects_non_image_files(): void
    {
        Storage::fake('public');

        $response = $this->actingAs(User::factory()->create())
            ->postJson('/upload', [
                'file' => UploadedFile::fake()->createWithContent('shell.php', '<?php echo 1;'),
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('file');
        $this->assertSame([], Storage::disk('public')->allFiles());
    }

    public function test_upload_rejects_images_with_script_extension(): void
    {
        Storage::fake('public');

        $response = $this->actingAs(User::factory()->create())
            ->postJson('/upload', [
                'file' => UploadedFile::fake()->createWithContent('image.php', base64_decode(self::PNG_1X1)),
            ]);

        $response->assertStatus(422);
        $this->assertSame([], Storage::disk('public')->allFiles());
    }

    public function test_upload_stores_images_under_a_random_name(): void
    {
        Storage::fake('public');

        $response = $this->actingAs(User::factory()->create())
            ->postJson('/upload', [
                'file' => UploadedFile::fake()->createWithContent('../../evil name.png', base64_decode(self::PNG_1X1)),
            ]);

        $response->assertOk();

        $location = $response->json('location');
        $this->assertMatchesRegularExpression('#^/storage/uploads/[A-Za-z0-9]{40}\.png$#', $location);

        $stored = Storage::disk('public')->allFiles();
        $this->assertCount(1, $stored);
        $this->assertSame('/storage/'.$stored[0], $location);
    }

    public function test_article_titles_are_escaped_in_listings(): void
    {
        $this->createKategori();
        $this->createArtikkel([
            'tittel' => '<script>alert(1)</script>',
            'url' => 'xss',
            'intro' => '<img src=x onerror=alert(1)>',
        ]);

        $response = $this->get('/kategori?kategori=Generelt');

        $response->assertOk();
        $response->assertDontSee('<script>alert(1)</script>', false);
        $response->assertDontSee('<img src=x onerror=alert(1)>', false);
        $response->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false);
    }

    public function test_hidden_articles_are_not_served_by_direct_url(): void
    {
        $this->createKategori();
        $this->createArtikkel(['url' => 'skjult', 'tittel' => 'Skjult artikkel', 'hide' => 1]);

        $response = $this->get('/artikkel?artikkel=skjult');

        $response->assertOk();
        $response->assertDontSee('Skjult artikkel');
    }

    public function test_array_query_parameters_do_not_break_public_pages(): void
    {
        $this->get('/artikkel?artikkel[]=x')->assertOk();
        $this->get('/kategori?kategori[]=x')->assertOk();
    }

    public function test_article_creation_validates_flags_and_category(): void
    {
        $this->createKategori();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->from('/dashboard')->post('/dashboard/artikkel', [
            'tittel' => 'Ny artikkel',
            'intro' => 'Intro',
            'innhold' => '<p>Innhold</p>',
            'KategoriDataList' => 'Finnes ikke',
            'short' => 'kort',
            'sticky' => 'DROP TABLE',
            'hide' => '7',
        ]);

        $response->assertRedirect('/dashboard');
        $response->assertSessionHasErrors(['KategoriDataList', 'sticky', 'hide']);
        $this->assertSame(0, DB::table('artikler')->count());
    }

    public function test_article_update_only_deletes_the_confirmed_row(): void
    {
        $this->createKategori();
        $first = $this->createArtikkel(['tittel' => 'Samme tittel', 'url' => 'a']);
        $second = $this->createArtikkel(['tittel' => 'Samme tittel', 'url' => 'b']);

        $response = $this->actingAs(User::factory()->create())->post('/dashboard/rediger/side', [
            'id' => $first,
            'tittel' => 'Samme tittel',
            'intro' => 'Intro',
            'innhold' => '<p>Innhold</p>',
            'KategoriDataList' => 'Generelt',
            'short' => 'kort',
            'delid' => 'Samme tittel',
        ]);

        $response->assertRedirect(route('admin-faq'));
        $this->assertNull(DB::table('artikler')->find($first));
        $this->assertNotNull(DB::table('artikler')->find($second));
    }

    public function test_article_update_rejects_unknown_ids(): void
    {
        $this->createKategori();

        $response = $this->actingAs(User::factory()->create())->from('/dashboard/faq')->post('/dashboard/rediger/side', [
            'id' => 999,
            'tittel' => 'Tittel',
            'intro' => 'Intro',
            'innhold' => '<p>Innhold</p>',
            'KategoriDataList' => 'Generelt',
            'short' => 'kort',
        ]);

        $response->assertRedirect('/dashboard/faq');
        $response->assertSessionHasErrors('id');
    }

    public function test_dashboard_requires_authentication(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/dashboard/rediger/side?artikkel=1')->assertRedirect('/login');
        $this->post('/dashboard/kategori', ['navn' => 'x', 'undertekst' => 'y'])->assertRedirect('/login');
    }
}
