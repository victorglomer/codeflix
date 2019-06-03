<?php

namespace Tests\Feature\Admin;

use CodeFlix\Models\User;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIfUserSeeList()
    {
        Model::unguard();
        $user = factory(User::class)
            ->states('admin')
            ->create([
                'verified' => true,
                'troca_senha' => 1,
            ]);

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertSee('Lista de usuários');
    }
}
