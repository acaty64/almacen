<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Imagenes;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Imagick;

use Jenssegers\Date\Date;

class FileController extends Controller
{
	use Imagenes;


	public function upload($user_id, $file_id)
	{
		# code...
	}

	public function download($user_id, $file_id)
	{
		# code...
	}


}
