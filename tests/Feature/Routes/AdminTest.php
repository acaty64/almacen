<?php

namespace Tests\Feature\Routes;

use App\Access;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function admin_user_without_access_input_is_redirect_to_access_route()
    {
        $access = Access::where('tuser_id', 2)->first();
        $user = User::findOrFail($access->user_id);
        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertStatus(302)
            ->assertRedirect('access');
    }

    /** @test */
    public function admins_can_visit_the_admin_dashboard()
    {
        $access = Access::where('tuser_id', 2)->first();
        \Session::put('facultad_id', $access->facultad_id);
        \Session::put('sede_id', $access->sede_id);        
        $user = User::findOrFail($access->user_id);

        $this->assertTrue($user->isAdmin, true);
        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertStatus(200)
            ->assertSee('Indice de Documentos');
    }


    /** @test */
    public function non_admin_users_cannot_visit_the_admin_dashboard()
    {
        $access = Access::where('tuser_id', 3)->first();
        \Session::put('facultad_id', $access->facultad_id);
        \Session::put('sede_id', $access->sede_id);
        $user = User::findOrFail($access->user_id);

        $this->assertFalse($user->isAdmin, true);
        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));
    }

    /** @test */
    public function guests_cannot_visit_the_admin_dashboard()
    {
        $this->get(route('admin.dashboard'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }





}
