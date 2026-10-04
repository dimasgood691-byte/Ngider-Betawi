<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentManagementPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_open_content_management_page(): void
    {
        $admin = User::query()->create([
            'name' => 'Admin Test',
            'email' => 'admin-content@example.test',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.konten.index'))
            ->assertOk()
            ->assertSee('Manajemen Konten Website');
    }
}
