<?php

// Failed because nao-pon/flysystem-google-drive don't have unit test

namespace Tests\Feature;

use App\Access;
use App\Doc;
use App\Trace;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery as m;
use Tests\TestCase;

class NewDocTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_uploaded_a_file()
    {
        $this->MarkTestIncomplete();
        // Given ...
        $user = User::findOrFail(1);

        $access = Access::create([
            'user_id' => $user->id,
            'tuser_id' => 1,
            'facultad_id' => 1,
            'sede_id' => 1
        ]);

         $googleUser = m::mock(SocialiteUser::class, [
            'getName' => $user->name,
            'getEmail' => $user->email,
        ]);

        $googleUser->token = 'something';
        
        $this->mockGoogleProvider()
            ->shouldReceive('user')
            ->andReturn($googleUser);
        // When
        $response = $this->get('/login/callback');

        // Then
        $this->assertAuthenticated();

        // Storage::fake('public');
        Storage::fake('google');

        $data = [
            'tdoc_id' => 1,
            'numero' => 'UCSS-FCS-122-2020',
            'descripcion' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.',
            'fecha' => Carbon::now()->format('Y-m-d'),
            'file' => $file = UploadedFile::fake()->create('testing.pdf',1, "application/pdf"),
        ];

        $user = User::findOrFail(1);
// dd('tdd', User::findOrFail(1));
        $this->actingAs($user)
            ->postJson(route('docs.store'), $data)
            ->assertStatus(302);


        $this->assertDatabaseHas('docs', [
            'user_id' => $user->id,
            'facultad_id' => 1,
            'sede_id' => 1,
            'tdoc_id' => $data['tdoc_id'],
            'filename' => 'testing.pdf',
            'status_id' => 1,
            'numero' => $data['numero'],
            'descripcion' => $data['descripcion'],
            'fecha' => $data['fecha']
        ]);

        $doc = Doc::first();

        $this->assertDatabaseHas('traces', [
            'user_id' => $user->id,
            'status_id' => 1,
            'doc_id' => $doc->id,
        ]);

        $path = storage_path().'/app/public/'.($doc->attach);
        $check = file_exists($path);
        unlink($path);

        // ???????????????????????????????????????????????
        // $response->assertRedirect(route('docs.index'));


    }


    public function mockGoogleProvider()
    {
        $provider = m::mock(GoogleProvider::class);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        return $provider;
    }

}
