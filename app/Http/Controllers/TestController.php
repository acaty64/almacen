<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function master()
    {
        return view('tests')->with('data', 'Master');
    }
    public function admin()
    {
        return view('tests')->with('data', 'Administrador');
    }
    public function autor()
    {
        return view('tests')->with('data', 'Autor');
    }
    public function asesor()
    {
        return view('tests')->with('data', 'Asesor');
    }
}