<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(\Auth::user()->isMaster){
            return redirect(route('master.dashboard'));
        }

        if(\Auth::user()->isAdmin){
            return redirect(route('admin.dashboard'));
        }

        if(\Auth::user()->isOperador){
            return redirect(route('operador.dashboard'));
        }

        if(\Auth::user()->isFirmante){
            return redirect(route('firmante.dashboard'));
        }

        return redirect(route('access'));

        // switch (\Auth::user()->tuser) {
        //     case 'Master':
        //         break;
        //     case 'Administrador':
        //         return redirect(route('admin.dashboard'));
        //         break;
        //     case 'Operador':
        //         return redirect(route('operador.dashboard'));
        //         break;
        //     case 'Firmante':
        //         return redirect(route('firmante.dashboard'));
        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }
    }
}
