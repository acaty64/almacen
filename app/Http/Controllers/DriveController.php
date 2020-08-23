<?php

namespace App\Http\Controllers;

use Google_Client;
use Illuminate\Http\Request;

class DriveController extends Controller
{
    private $drive;
    public function __construct(Google_Client $client)
    {
        $this->middleware(function ($request, $next) use ($client) {
// dd('__construct:', $client);
            $client->refreshToken(\Auth::user()->refresh_token);
            // $this->drive = new \Google_Service_Drive($client);
            $this->drive = new \Google_Service_Drive($client);
// dd('DriveController __construct', $client);
            return $next($request);
        });
    }
 
    public function getDrive(){
        $this->ListFolders(env('GOOGLE_DRIVE_FOLDER_ID'));
    }
 
    public function ListFolders($id){

 dd('ListFolders file', false);
        // $query = "mimeType='application/vnd.google-apps.folder' and '".$id."' in parents and trashed=false";
        $query = "mimeType='application/pdf' and '".$id."' in parents and trashed=false";
 
        $optParams = [
            'fields' => 'files(id, name, mimeType)',
            'q' => $query
        ];
 
        $results = $this->drive->files->listFiles($optParams);
        if (count($results->getFiles()) == 0) {
            print "No files found.\n";
        } else {
            print "Files:\n";
            foreach ($results->getFiles() as $file) {
                dump(
                    $file->getID(),
                    $file->getName(), 
                    $file->getMimeType(),
                    $file->getDescription()
                );
                dd();
            }
        }
    }
 
    function uploadFile(Request $request){
        if($request->isMethod('GET')){
            return view('upload');
        }else{
            $this->createFile($request->file('file'));
        }
    }
 
    function createStorageFile($storage_path){
        $this->createFile($storage_path);
    }
 
    function createFile($file, $parent_id = null){
        $name = gettype($file) === 'object' ? $file->getClientOriginalName() : $file;
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => $name,
            'parent' => $parent_id ? $parent_id : 'root'
        ]);
 
        $content = gettype($file) === 'object' ?  File::get($file) : Storage::get($file);
        $mimeType = gettype($file) === 'object' ? File::mimeType($file) : Storage::mimeType($file);
 
        $file = $this->drive->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $mimeType,
            'uploadType' => 'multipart',
            'fields' => 'id'
        ]);
 
        dd($file->id);
    }
 
    function deleteFileOrFolder($id){
        try {
            $this->drive->files->delete($id);
        } catch (Exception $e) {
            return false;
        }
    }
 
    function createFolder($folder_name){
        $folder_meta = new Google_Service_Drive_DriveFile(array(
            'name' => $folder_name,
            'mimeType' => 'application/vnd.google-apps.folder'));
        $folder = $this->drive->files->create($folder_meta, array(
            'fields' => 'id'));
        return $folder->id;
    }
}