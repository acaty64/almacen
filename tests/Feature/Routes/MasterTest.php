<?php

namespace Tests\Feature\Routes;

use App\Access;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MasterTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function master_user_without_access_input_is_redirect_to_access_route()
    {
        $access = Access::where('tuser_id', 1)->first();
        $user = User::findOrFail($access->user_id);
        $this->actingAs($user)
            ->get(route('master.dashboard'))
            ->assertStatus(302)
            ->assertRedirect('access');
    }


    public function master_can_visit_the_master_dashboard()
    {
        $access = Access::where('tuser_id', 1)->first();
        \Session::put('facultad_id', $access->facultad_id);
        \Session::put('sede_id', $access->sede_id);
        $user = User::findOrFail($access->user_id);
        $this->actingAs($user)
            ->get(route('master.dashboard'))
            ->assertStatus(200)
            ->assertSee('Panel de Master');
    }


    /** @test */
    public function master_can_visit_the_admin_dashboard()
    {
        $access = Access::where('tuser_id', 1)->first();
        $user = User::findOrFail($access->user_id);
        \Session::put('facultad_id', $access->facultad_id);
        \Session::put('sede_id', $access->sede_id);
        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertStatus(200)
            ->assertSee('Indice de Documentos');
    }


    /** @test */
    public function non_master_users_cannot_visit_the_master_dashboard()
    {
        $access = Access::where('tuser_id', 2)->first();
        \Session::put('facultad_id', $access->facultad_id);
        \Session::put('sede_id', $access->sede_id);
        $user = User::findOrFail($access->user_id);
        $this->actingAs($user)
            ->get(route('master.dashboard'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

    }

    /** @test */
    public function guests_cannot_visit_the_master_dashboard()
    {
        $this->get(route('master.dashboard'))
            ->assertRedirect(route('login'));

    }





}
