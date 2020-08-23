<?php

namespace Tests\Unit;

use App\Access;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class A01_UsersTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_index_view()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);
        $response = $this->get(route('user.index'));
        $response->assertStatus(200);
        $response->assertViewIs('app.users.index');
    }

    /** @test */
    public function user_create_view()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);
        $response = $this->get(route('user.create'));
        $response->assertStatus(200);
        $response->assertViewIs('app.users.create');
    }

    /** @test */
    public function save_new_user()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $request = [
            'name' => 'JOHN DOE',
            'email' => 'jdoe@gmail.com',
            'tuser_id' => 3            
        ];

        $response = $this->post(route('user.store'), $request);
     
        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));

        $response = $this->assertDatabaseHas('users', [
                'name' => $request['name'],
                'email' => $request['email'],
            ]);

        $user = User::where('name', $request['name'])->first();
        $this->assertDatabaseHas('tuser_user', [
            'tuser_id' => $request['tuser_id'],
            'user_id' => $user->id
        ]);

    }

    /** @test */
    public function user_edit_view()
    {
        $user = User::findOrFail(2);
        $this->actingAs($user);
        $response = $this->get(route('user.edit',2));
        $response->assertStatus(200);
        $response->assertViewIs('app.users.edit');
    }

    /**
     * @test
     */
    public function modify_a_user()
    {
        $user = User::findOrFail(2);
        $this->actingAs($user);

        $request = [
            'user_id' => 3,
            'name' => 'New Name',
            'email' => 'newEmail@gmail.com',
            'tuser_id' => 4
        ];

        $response = $this->post(route('user.update', $request));
        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));

        $response = $this->assertDatabaseHas('users', [
                'id' => $request['user_id'],
                'name' => $request['name'],
                'email' => $request['email'],
            ]);

        $this->assertDatabaseHas('tuser_user', [
            'tuser_id' => $request['tuser_id'],
            'user_id' => $request['user_id']
        ]);

    }

    /** @test */
    public function delete_a_user()
    {

        $user = User::findOrFail(2);
        $this->actingAs($user);

        $delete_user = User::findOrFail(3);
        $tuser_id = $delete_user->tuser_id;

        $response = $this->delete(route('user.destroy',3));
        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));

        $this->assertDatabaseMissing('users', [
                'id' => $delete_user->id,
                'name' => $delete_user->name,
                'email' => $delete_user->email,
            ]);

        $this->assertDatabaseMissing('tuser_user', [
            'tuser_id' => $tuser_id,
            'user_id' => $delete_user->id
        ]);

    }

}

