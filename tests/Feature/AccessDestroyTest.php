<?php

namespace Tests\Feature;

use App\Access;
use App\Tuser_user;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessDestroyTest extends TestCase
{
    
    use DatabaseTransactions;

    /**    @test     */
    public function an_admin_can_create_access_Test()
    {

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
        // \Session::put('facultad_id', $access['facultad_id']);
        // \Session::put('sede_id', $access['sede_id']);

        $access = Access::findOrFail(3);

        $this->actingAs($user)
            ->get(route('access.destroy', $access->id))
            ->assertStatus(302);
            // ->assertRedirect(route('user.index'));

        $this->assertDatabaseMissing('accesses', [
            'id' => $access->id,
        ]);
        // $this->MarkTestIncomplete();

    }
}