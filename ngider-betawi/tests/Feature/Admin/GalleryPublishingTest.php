<?php

namespace Tests\Feature\Admin;

use App\Models\Galeri;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryPublishingTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_uploaded_photo_is_published_on_the_landing_page(): void
    {
        $this->withoutVite();
        Storage::fake('public');
        $admin = User::query()->create([
            'name' => 'Admin Galeri',
            'email' => 'admin-galeri@example.test',
            'password' => 'password',
            'role' => 'admin',
        ]);
        $title = 'Dokumentasi Kegiatan Betawi';

        $this->actingAs($admin)
            ->post(route('admin.konten.galeri.store'), [
                'judul' => $title,
                'gambar' => UploadedFile::fake()->image('kegiatan.png'),
            ])
            ->assertRedirectToRoute('admin.konten.index');

        $galeri = Galeri::query()->where('judul', $title)->firstOrFail();
        $this->assertModelExists($galeri);
        $this->assertTrue(Storage::disk('public')->exists($galeri->gambar));
        $imageUrl = '/storage/'.$galeri->gambar;
        $encodedImageUrl = str_replace('/', '\\/', $imageUrl);

        $this->get(route('admin.konten.index'))
            ->assertSee($title)
            ->assertSee($imageUrl, false);

        $landingPage = $this->get(route('home'))
            ->assertSee($title)
            ->assertSee($encodedImageUrl, false);

        foreach ([
            'image-padepokan-1.png',
            'image-misi-topeng.png',
            'image-misi-marawis.png',
            'image-misi-kaliciliwung.png',
            'image-misi-sertifikat.png',
        ] as $defaultImage) {
            $landingPage->assertSee($defaultImage, false);
        }
    }

    public function test_guest_cannot_upload_gallery_photos(): void
    {
        $this->post(route('admin.konten.galeri.store'))
            ->assertRedirectToRoute('admin.login');

        $this->assertDatabaseCount('galeri', 0);
    }
}
