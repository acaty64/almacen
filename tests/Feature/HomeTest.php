<?php

namespace Tests\Feature;

use App\Tuser_user;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_authorized_are_authenticated_is_redirect_to_home()
    {
        // Given ...
        $user = Tuser_user::where('tuser_id', 1)->first()->user;

        // When
        $this->actingAs($user);
 
        // Then
        $this->assertAuthenticated();

        $this->get('home')
            ->assertStatus(302);

    }


}
