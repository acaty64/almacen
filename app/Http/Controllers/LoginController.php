<?php

namespace App\Http\Controllers;

use App\Access;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

	public function autologin($id, $api_token)
	{
		try {
		    $appUser = User::findOrFail($id);

		    if($appUser != null && $api_token == $appUser->refresh_token){

		    	$access = Access::where('user_id', $appUser->id)->first();
		    	if($access){
					\Session::put('tuser_id', $access->tuser_id);
					\Session::put('tuser', $access->t_user->type);

					\Session::put('facultad_id', $access->facultad_id);
					\Session::put('facultad', $access->facultad->codigo);

					\Session::put('sede_id', $access->sede_id);
					\Session::put('sede', $access->sede->codigo);

	        		Auth::login($appUser);
		    		return redirect(route('home'));

		    	}else{
		    		return view('app.unauthorizated');
		    		return 'logueado no autorizado';
		    	}
		    }else{
		    	return view('app.unauthorizated');
		    }

		} catch (Exception $e) {
			Auth::logout();
	    	return view('app.unauthorizated');
		}
	}

	public function handle($token)
	{
		$appUser = \Auth::user();
	    if($appUser != null && $token == $appUser->refresh_token){

	    	$access = Access::where('user_id', $appUser->id)->first();
	    	if($access){
				\Session::put('tuser_id', $access->tuser_id);
				\Session::put('tuser', $access->t_user->type);

				\Session::put('facultad_id', $access->facultad_id);
				\Session::put('facultad', $access->facultad->codigo);

				\Session::put('sede_id', $access->sede_id);
				\Session::put('sede', $access->sede->codigo);
	    		
	    		return redirect(route('home'));

	    	}else{
	    		return view('app.unauthorizated');
	    		return 'logueado no autorizado';
	    	}
	    }else{
	    	return view('app.unauthorizated');
	    	return redirect('/login');
	    	return 'no logueado';
	    }

	}	

}
