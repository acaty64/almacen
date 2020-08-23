<?php

namespace Tests\Feature;

use App\Access;
use App\Tuser_user;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery as m;
use Tests\TestCase;

class AccessCreateTest extends TestCase
{

    use DatabaseTransactions;

    /**    @test     */
    public function an_admin_can_create_access_Test()
    {

        // // Given ...
        $user = Tuser_user::where('tuser_id',2)->first()->user;

        $data = [
            'usuario' => 4,
            't_user' => 3,
            'facultad' => 1,
            'sede' => 2,
        ];

        $this->actingAs($user)
            ->post(route('access.store', $data))
            ->assertStatus(302)
            ->assertRedirect(route('user.index'));

        $this->assertDatabaseHas('accesses', [
            'user_id' => $data['usuario'],
            'tuser_id' => $data['t_user'],
            'facultad_id' => $data['facultad'],
            'sede_id' => $data['sede'],
        ]);

    }

}