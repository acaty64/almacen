<?php

namespace App\Http\Controllers;

use App\Access;
use App\Facultad;
use App\Facultad_sede;
use App\Sede;
use App\T_user;
use App\Tuser_user;
use App\User;
use Illuminate\Http\Request;

class AccessController extends Controller
{

  public function save(Request $request)
  {
    $validatedData = $request->validate([
      'facultad' => 'required',
      'sede' => 'required',
    ]);
    $user = Auth()->user();
    $access = Access::where('user_id', $user->id)
    ->where('facultad_id', $request->facultad)
    ->where('sede_id', $request->sede)
    ->first();

    if($access){
      \Session::put('facultad_id', $request->facultad);
      \Session::put('facultad', $access->facultad->codigo);
      \Session::put('sede_id', $request->sede);
      \Session::put('sede', $access->sede->codigo);
      $request->session()->flash('status', 'Se ha modificado el acceso.');
      return redirect(route('home'));
    }

    $xfacu = Facultad::findOrFail($request->facultad)->codigo;
    $xsede = Sede::findOrFail($request->sede)->codigo;
    $request->session()->flash('status', 'Error, no está autorizado para ' . $xfacu . '/' . $xsede);
    return redirect(route('access'));

  }
  public function panel()
  {
    $user = Auth()->user();
    $facultades = $user->facultades;
    $sedes = $user->sedes;

    $data = [
      'facultades' => $facultades,
      'sedes' => $sedes,
    ];
    return view('app.access.panel')->with(compact('data'));
  }

  public function create()
  {
    $usuarios = User::all()->sortByDesc('id');
    $tusers = T_user::where('id','>',2)->get();
    $facultades = Facultad::all();
    $sedes = Sede::all();

    $data = [
      'usuarios' => $usuarios,
      'tusers' => $tusers,
      'facultades' => $facultades,
      'sedes' => $sedes,
    ];
    return view('app.access.create')->with(compact('data'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'usuario' => 'required',
      't_user' => 'required',
      'facultad' => 'required',
      'sede' => 'required',
    ]);

    $check_tuser = Tuser_user::where('user_id', $request->usuario)
    ->where('tuser_id', $request->t_user)
    ->first();

    if($check_tuser){
      $check = Access::where('user_id', $request->usuario)
      ->where('tuser_id', $request->t_user)
      ->where('facultad_id', $request->facultad)
      ->where('sede_id', $request->sede)->first();

      if($check){
        $request->session()->flash('warning', 'Ya existe el acceso.');
        return back();
      }

      $check_fac = Facultad_sede::where('facultad_id', $request->facultad)
              ->where('sede_id', $request->sede)
              ->first();
              
      if(!$check_fac){
        $request->session()->flash('danger', 'La facultad no está en la sede seleccionada.');
        return back();          
      }

      try {
        Access::create([
          'user_id' => $request->usuario,
          'tuser_id' => $request->t_user,
          'facultad_id' => $request->facultad,
          'sede_id' => $request->sede,
        ]);
        $request->session()->flash('success', 'Acceso agregado.');
        return redirect(route('user.index'));            
      } catch (Exception $e) {
        $request->session()->flash('danger', 'Error, no se grabo el acceso.');
      }

    }
    $tipo = T_user::findOrFail($request->t_user)->type;
    $request->session()->flash('danger', 'El usuario no tiene registrado el tipo ' . $tipo);

    return back();

  }

  public function index($user_id)
  {
      $access = Access::where('user_id', $user_id)->get();

      $user = User::findOrFail($user_id);

      $data = [
        'access' => $access,
        'user' => $user
      ];
      return view('app.access.index', ['data'=>$data]);
  }

  public function edit($access_id)
  {
    $facultades = Facultad::all();
    $sedes = Sede::all();
    $data = [
      'acceso' => Access::findOrFail($access_id),
      'facultades' => $facultades,
      'sedes' => $sedes,
    ];
    return view('app.access.edit', ['data'=>$data]);

  }

  public function update(Request $request)
  {
    $check_fac = Facultad_sede::where('facultad_id', $request->facultad_id)
            ->where('sede_id', $request->sede_id)
            ->first();        
    if(!$check_fac){
      $request->session()->flash('danger', 'La facultad no está en la sede seleccionada.');
      return back();          
    }
    try {
      $access = Access::findOrFail($request->access_id);
      $access->facultad_id = $request->facultad_id;
      $access->sede_id = $request->sede_id;
      $access->save();

      $request->session()->flash('success', 'Acceso modificado.');
      return redirect(route('user.index'));            
    } catch (Exception $e) {
      $request->session()->flash('danger', 'Error, no se grabo la modificacion.');
    }      

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Access  $access
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $access = Access::findOrFail($id);
    $access->delete();

    \Session::flash('status', 'Se ha eliminado el acceso.');
    return redirect(route('access.index', $access->user_id));


  }
}
