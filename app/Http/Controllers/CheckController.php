<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function index($user_id)
    {
    	return view('app.check.index')
    			->with([
    				'user_id' => $user_id
    			]);
    }

    
}
