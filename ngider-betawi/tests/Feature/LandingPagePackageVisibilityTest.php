<?php

namespace Tests\Feature;

use App\Models\PaketWisata;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPagePackageVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_packages_remain_visible_when_optional_funfacts_table_is_missing(): void
    {
        $package = PaketWisata::query()->create([
            'nama_paket' => 'Paket Uji Landing Page',
            'deskripsi' => 'Paket untuk pengujian tampilan landing page.',
            'harga' => 100000,
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee($package->nama_paket)
            ->assertSee('Lihat detail paket '.$package->nama_paket, false)
            ->assertSee('image-padepokan-1.png', false)
            ->assertSee('<dialog', false);
    }
}
