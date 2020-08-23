<?php

namespace Tests\Unit;

use App\Access;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class A00_AccessTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_does_not_allow_guests_to_discover_auths_urls()
    {
        $this->get('invalid-url')
            ->assertStatus(404);
             // ->assertRedirect('login');
    }

    /**
     * @test
     */
    public function it_displays_404s_when_auths_visit_invalid_url()
    {
     // $this->markTestIncomplete();
        $user = User::findOrFail(1);
        $this->actingAs($user);

        $response = $this->get('invalid-url');
        $response->assertStatus(404);
    }

    /** @test */
    public function check_masterTest()
    {
        $user = User::findOrFail(1);
        $user->refresh_token = 'something';
        $user->save();
        $response = $this->get('autologin/1/something');
        $response->assertStatus(302);
        $response->assertRedirect('home');

        $this->get(route('master.dashboard'))
            ->assertStatus(200);
    }

    /** @test  */
    public function administradorTest()
    {
        $access = Access::where('tuser_id',2)->first();
        $user = User::findOrFail($access->user_id);
        $user->refresh_token = 'something';
        $user->save();
        $response = $this->get('autologin/1/something');
        $response->assertStatus(302);
        $response->assertRedirect('home');

        $this->get(route('admin.dashboard'))
            ->assertStatus(200);
    }

    /**  @test */
    public function operadorTest()
    {
        $access = Access::where('tuser_id',3)->first();
        $user = User::findOrFail($access->user_id);

        $user->refresh_token = 'something';
        $user->save();
        $response = $this->get('autologin/1/something');
        $response->assertStatus(302);
        $response->assertRedirect('home');

        $this->get(route('operador.dashboard'))
            ->assertStatus(200);
    }

    /** @test */
    public function firmanteTest()
    {
        $access = Access::where('tuser_id',4)->first();
        $user = User::findOrFail($access->user_id);
        $user->refresh_token = 'something';
        $user->save();
        $response = $this->get('autologin/1/something');
        $response->assertStatus(302);
        $response->assertRedirect('home');

        $this->get(route('firmante.dashboard'))
            ->assertStatus(200);
    }
     


}
