<?php

namespace App\Http\Controllers\Api;

use App\File;
use App\Http\Controllers\Controller;
use App\Traits\Imagenes;
use Illuminate\Http\Request;

class CheckController extends Controller
{
	use Imagenes;

	public function getdata($user_id)
	{
		$file = File::where('user_id', $user_id)->first();
		return [
				'path' => '/storage/docs/',
				'filename' => $file->filename
			];
	}

	public function setcheck($user_id)
	{
		$file = File::where('user_id', $user_id)->first();

		$jpgs = $this->pdf2jpg($file->filename, $user_id);

		$request = $this->annotation($user_id, $jpgs['pages']);

		if($request){
			$request_2 = $this->jpgToPdf($request['workfiles'], $file->filename, $user_id);
			$oldfilepath = $this->pathOut($user_id) . $request_2['filename']; 
			$newfilepath = storage_path( 'app/public/check/') . $request_2['filename']; 
			copy($oldfilepath, $newfilepath);

			return [
					'path' => '/storage/check/',
					'filename' => $request_2['filename']
				];

		}



		// if($request['success']){		
		// 	return [
		// 			'path' => $request['path'],
		// 			'files' => $request['filename']
		// 		];
		// }

	}

	public function saveComment($user_id)
	{



		return true;
	}


    public function pdf($id)
    {
    	if($id == '123456'){
    		return 'true';
    	}else{
    		return 'false';
    	}
    }
}
