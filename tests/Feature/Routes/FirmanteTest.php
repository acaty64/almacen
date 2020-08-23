<?php

namespace Tests\Feature\Routes;

use App\Access;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FirmanteTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function firmante_user_without_access_input_is_redirect_to_access_route()
    {
        $this->markTestIncomplete();
        $access = Access::where('tuser_id', 4)->first();
        $user = User::findOrFail($access->user_id);
        $this->actingAs($user)
            ->get(route('firmante.dashboard'))
            ->assertStatus(302)
            ->assertRedirect('access');
    }

    /** @test */
    public function firmante_can_visit_the_firmante_dashboard()
    {
        $access = Access::where('tuser_id', 4)->first();
        $user = User::findOrFail($access->user_id);
        \Session::put('facultad_id', $access->facultad_id);
        \Session::put('sede_id', $access->sede_id);          
        $this->actingAs($user)
            ->get(route('firmante.dashboard'))
            ->assertStatus(200)
            ->assertSee('Indice de Documentos');

    }


    /** @test */
    public function master_can_visit_the_firmante_dashboard()
    {
        $access = Access::where('tuser_id', 1)->first();
        $user = User::findOrFail($access->user_id);
        \Session::put('facultad_id', $access->facultad_id);
        \Session::put('sede_id', $access->sede_id);  
        $this->actingAs($user)
            ->get(route('firmante.dashboard'))
            ->assertStatus(200)
            ->assertSee('Indice de Documentos');

    }

    /** @test */
    public function admin_can_visit_the_firmante_dashboard()
    {
        $access = Access::where('tuser_id', 2)->first();
        $user = User::findOrFail($access->user_id);
        \Session::put('facultad_id', $access->facultad_id);
        \Session::put('sede_id', $access->sede_id);          
        $this->actingAs($user)
            ->get(route('firmante.dashboard'))
            ->assertStatus(200)
            ->assertSee('Indice de Documentos');

    }


    /** @test */
    public function operator_users_cannot_visit_the_firmante_dashboard()
    {
        $access = Access::where('tuser_id', 3)->first();
        $user = User::findOrFail($access->user_id);
        $this->actingAs($user)
            ->get(route('firmante.dashboard'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

    }

    /** @test */
    public function guests_cannot_visit_the_firmante_dashboard()
    {
        $this->get(route('firmante.dashboard'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

}
