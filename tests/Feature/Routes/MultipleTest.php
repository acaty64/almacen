<?php

namespace Tests\Feature\Routes;

use App\Access;
use App\Tuser_user;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MultipleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_operador_and_signer_can_visit_the_signer_dashboard()
    {
        $user = User::create([
            'name' => 'JOHN DOE',
            'email' => 'jdoe@gmail.com',
            'refresh_token' => 'something'
        ]);

        Tuser_user::create([
            'user_id' => $user->id,
            'tuser_id' => 3
        ]);

        Tuser_user::create([
            'user_id' => $user->id,
            'tuser_id' => 4
        ]);

        Access::create([
            'user_id' => $user->id,
            'tuser_id' => 3,
            'facultad_id' => 1,
            'sede_id' => 1,
        ]);

        Access::create([
            'user_id' => $user->id,
            'tuser_id' => 4,
            'facultad_id' => 1,
            'sede_id' => 1,
        ]);

        $this->get('/autologin/' . $user->id . '/something');
        // $this->actingAs($user);
        $this->assertTrue(\Auth()->user()->isOperador);
        $this->assertTrue(\Auth()->user()->isFirmante);

// dd(\Session::get('facultad_id'));

        $this->actingAs($user)
            ->get(route('operador.dashboard'))
            ->assertStatus(200)
            ->assertSee('Indice de Documentos');

        $this->actingAs($user)
            ->get(route('firmante.dashboard'))
            ->assertStatus(200)
            ->assertSee('Indice de Documentos');
    }

}
