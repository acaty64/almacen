<?php

namespace App\Providers;

use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // // https://quantizd.com/google-drive-client-api-with-laravel/
        // $this->app->singleton(Google_Client::class, function ($app) {
        //     $client = new Google_Client();
        //     Storage::disk('local')->put('client_secret.json', json_encode([
        //         'web' => config('services.google')
        //     ]));
        //     $client->setAuthConfig(Storage::path('client_secret.json'));
        //     return $client;
        // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
// dd('Google_Drive_Service');
        \Storage::extend("google", function($app, $config){
            $client = new \Google_Client;
            // $client->setAccessType('offline');
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);
            $client->fetchAccessTokenWithRefreshToken($config['refreshToken']); 
            $service = new \Google_Service_Drive($client);
            $adapter = new GoogleDriveAdapter($service, $config['folderId']);
// dd($adapter);
            return new Filesystem($adapter);
        });
    }
}
