<?php

namespace Tests\Feature;

use App\Access;
use App\Doc;
use App\Trace;
use App\Tuser_user;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery as m;
use Tests\TestCase;

class NulledDocTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function an_admin_user_nulled_a_doc()
    {

        // Given ...
        $user = Tuser_user::where('tuser_id', 2)->first()->user;

        $access = Access::create([
            'user_id' => $user->id,
            'tuser_id' => 2,
            'facultad_id' => 1,
            'sede_id' => 1
        ]);

        // When
        $this->actingAs($user);

        // Then
        $this->assertAuthenticated();
        // \Session::put('facultad_id', $access['facultad_id']);
        // \Session::put('sede_id', $access['sede_id']);

        $data = [
            'numero' => 'UCSS-FCS-122-2020',
            'descripcion' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.',
            'fecha' => Carbon::now()->format('Y-m-d'),
        ];

        $doc = Doc::create([
            'user_id' => 3,
            'facultad_id' => 2,
            'sede_id' => 4,
            'tdoc_id' => 1,
            'status_id' => 1,
            'numero' => $data['numero'],
            'descripcion' => $data['descripcion'],
            'fecha' => $data['fecha'],
        ]);

        $this->actingAs($user)
            ->get(route('docs.nulled', $doc->id))
            ->assertStatus(200)
            ->assertViewIs('app.docs.index');
            
            // ->assertSee('Documento anulado: ' . $doc->numero);

        $this->assertDatabaseHas('docs', [
            'id' => $doc->id,
            'user_id' => $doc->user_id,
            'facultad_id' => $doc->facultad_id,
            'sede_id' => $doc->sede_id,
            'status_id' => 5,
            'numero' => $doc->numero,
            'descripcion' => $doc->descripcion,
            'fecha' => $doc->fecha
        ]);

        $this->assertDatabaseHas('traces', [
            'user_id' => $user->id,
            'status_id' => 5,
            'doc_id' => $doc->id,
        ]);


    }

}
