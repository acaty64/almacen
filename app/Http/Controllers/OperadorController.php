<?php

namespace App\Http\Controllers;

use App\Access;
use Illuminate\Http\Request;

class OperadorController extends Controller
{
	public function dashboard()
	{
    	if(\Session::get('facultad_id') != null){
			return view('app.docs.index');
    	}else{
    		$access = Access::where('user_id', \Auth()->user()->id)->get();
    		$count = $access->count();
    		if($count == 1){
    			\Session::put('facultad_id', $access->first()->facultad_id);
    			\Session::put('sede_id', $access->first()->sede_id);
                return view('app.docs.index');
    		}else{
    		    return redirect('access');
    		}
    	}
	}
}
