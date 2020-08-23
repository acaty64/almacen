<?php

namespace Tests\Feature;

use App\Access;
use App\Tuser_user;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessEditTest extends TestCase
{

    use DatabaseTransactions;

    /**    @test     */
    public function an_admin_can_edit_access_Test()
    {
        // $this->MarkTestIncomplete();

        // Given ...
        $user = Tuser_user::where('tuser_id',2)->first()->user;

        $access = Access::create([
            'user_id' => $user->id,
            'tuser_id' => 2,
            'facultad_id' => 1,
            'sede_id' => 1
        ]);

        $this->actingAs($user);

        // Then
        $this->assertAuthenticated();

        $access = Access::findOrFail(3);

        $data = [
            'access_id' => $access->id,
            'facultad_id' => 2,
            'sede_id' => 3,
        ];

        $this->actingAs($user)
            ->post(route('access.update', $data))
            ->assertStatus(302)
            ->assertRedirect(route('user.index'));

        $this->assertDatabaseHas('accesses', [
            'id' => $access->id,
            'user_id' => $access->user_id,
            'tuser_id' => $access->tuser_id,
            'facultad_id' => $data['facultad_id'],
            'sede_id' => $data['sede_id'],
        ]);

    }

}