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

class CheckControllerTest extends TestCase
{

    use DatabaseTransactions;

    /**    @test     */
    public function a_user_can_see_index_view()
    {
        $user = User::findOrFail(1);

        $this->actingAs($user)
            ->get(route('check.index',  $user->id))
            ->assertStatus(200);
    }



}