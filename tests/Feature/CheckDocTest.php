<?php

namespace Tests\Feature;

use App\Access;
use App\Doc;
use App\Trace;
use App\Tuser_user;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CheckDocTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_check_a_doc()
    {
        // Given ...
        $user = Tuser_user::where('tuser_id', 1)->first()->user;

        $access = Access::create([
            'user_id' => $user->id,
            'tuser_id' => 1,
            'facultad_id' => 1,
            'sede_id' => 1
        ]);

        $this->actingAs($user);

        // Then
        $this->assertAuthenticated();

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
            ->get(route('sign.check', $doc->id))
            ->assertStatus(200)
            ->assertViewIs('app.signs.check');
        $this->actingAs($user)
            ->get(route('sign.check.ok', $doc->id))
            ->assertStatus(302)
            ->assertRedirect(route('sign.index'));

        $this->assertDatabaseHas('docs', [
            'id' => $doc->id,
            'user_id' => $doc->user_id,
            'facultad_id' => $doc->facultad_id,
            'sede_id' => $doc->sede_id,
            'status_id' => 2,
            'numero' => $doc->numero,
            'descripcion' => $doc->descripcion,
            'fecha' => $doc->fecha
        ]);

        $this->assertDatabaseHas('traces', [
            'user_id' => $user->id,
            'status_id' => 2,
            'doc_id' => $doc->id,
        ]);


    }


}
