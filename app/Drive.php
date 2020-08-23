<?php

namespace App;

use Google_Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Drive extends Model
{

    private $drive;
    // public function __construct(Google_Client $client)
    // {
    //     $this->middleware(function ($request, $next) use ($client) {
    //         $client->refreshToken(\Auth::user()->refresh_token);
    //         $this->drive = new \Google_Service_Drive($client);

    //         return $next($request);
    //     });
    // }


    public static function fileId($filename)
    {
    	$client = new Google_Client;
		// $client->setAuthConfig(Storage::path('client_secret.json'));
        Storage::disk('local')->put('client_secret.json', \Auth::user()->google_id);
        $client->setAuthConfig(Storage::path('client_secret.json'));
        $client->refreshToken(\Auth::user()->refresh_token);
        $drive = new \Google_Service_Drive($client);
        
    	$folder_id = env('GOOGLE_DRIVE_FOLDER_ID');
        $query = "mimeType='application/pdf' and '".$folder_id."' in parents and trashed=false";
 
        $optParams = [
            'fields' => 'files(id, name, mimeType)',
            'q' => $query
        ];
 
        $results = $drive->files->listFiles($optParams);

        if (count($results->getFiles()) == 0) {
            return false;
            print "No files found.\n";
        } else {
            foreach ($results->getFiles() as $file) {
            	if($file->getName() == $filename){
            		return $file->getId();
            	}
            }
            return false;
        }
    }

}
