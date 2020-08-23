<?php

namespace App\Http\Controllers;

use App\T_user;
use App\Tuser_user;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);
        return view('app.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth_id = \Auth()->user()->id;
        $tuser = T_user::where('id','>', $auth_id)->get();
        return view('app.users.create', [
            'tuser' => $tuser ]);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'tuser_id' => 'required',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            if($user){
                $tuser = Tuser_user::create([
                    'tuser_id' => $request->tuser_id,
                    'user_id' => $user->id,
                ]);
                if($tuser){
                    $request->session()->flash('status', 'Se ha agregado el usuario ' . $user->name);
                    return redirect(route('user.index'));
                }else{
                    $user->delete();
                }
            }
        } catch (Exception $e) {
            $request->session()->flash('status', 'Error de creación de usuario.');
            return redirect(route('user.create'));          
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $old_user = User::findOrFail($id);

        $auth_id = \Auth()->user()->id;
        $tuser = T_user::where('id','>', $auth_id)->get();

        $data = [
            'user_id' => $id,
            'name' => $old_user->name,
            'email' => $old_user->email,
            'tuser_id' => $old_user->tuser_id,
        ];

        return view('app.users.edit', [
                'data' => $data,
                'tuser' => $tuser
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $tuser_user = Tuser_user::where('user_id', $request->user_id)->first();
        $tuser_user->tuser_id = $request->tuser_id;
        $tuser_user->save();

        $request->session()->flash('status', 'Se ha modificado el usuario ' . $user->name);
        return redirect(route('user.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $tuser_user = Tuser_user::where('user_id', $id)->first();
        $tuser_user->delete();

        \Session::flash('status', 'Se ha eliminado el usuario ' . $user->name);
        return redirect(route('user.index'));


    }
}
