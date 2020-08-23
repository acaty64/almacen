<?php

namespace App;

use App\Access;
use App\Tuser_user;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    /**  DATABASE **/

    // protected $connection = config('app.env') === 'testing' ? 'mysql_tests' : 'mysql_user';

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
        // $this->connection = 'mysql_user';
        $this->connection = config('app.env') === 'testing' ? 'mysql_tests' : 'mysql_user';
// dd($this->connection);
    }
    // protected $connection = 'mysql_user'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'refresh_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $append = ['facultades', 'sedes', 'tuser_id', 'tuser'];

    public function getFacultadesAttribute()
    {
        $facultades = [];
        $data = Access::where('user_id', $this->id)->get();
        foreach ($data->unique('facultad_id') as $item) {
            array_push($facultades, [
                'id' => $item->facultad->id,
                'name' => $item->facultad->name
            ]);
        }
        return $facultades;
    }

    public function getSedesAttribute()
    {
        $sedes = [];
        $data = Access::where('user_id', $this->id)->get();
        foreach ($data->unique('sede_id') as $item) {
            array_push($sedes, [
                'id' => $item->sede->id,
                'name' => $item->sede->name
            ]);
        }
        return $sedes;
    }

    public function getTuserIdAttribute()
    {
        $tuser = Tuser_user::where('user_id', $this->id)->first();
        return $tuser->tuser_id;
    }

    public function getTuserAttribute()
    {
        $tuser_user = Tuser_user::where('user_id', $this->id)->first();
        return $tuser_user->tuser->type;
    }

    public function getIsMasterAttribute()
    {
        if($this->tuser == 'Master'){
            return true;
        }
        return false;
    }

    public function getIsAdminAttribute()
    {
        if($this->tuser == 'Administrador'){
            return true;
        }
        return false;
    }

    public function getIsOperadorAttribute()
    {
        $tuser = T_user::where('type', 'Operador')->first();
        if(Access::where('user_id', $this->id)
            ->where('tuser_id', $tuser->id)
            ->where('facultad_id', \Session::get('facultad_id'))
            ->where('sede_id', \Session::get('sede_id'))
            ->first())
        {
            return true;
        }
        return false;
    }

    public function getIsFirmanteAttribute()
    {
        $tuser = T_user::where('type', 'Firmante')->first();
        if(Access::where('user_id', $this->id)
            ->where('tuser_id', $tuser->id)
            ->where('facultad_id', \Session::get('facultad_id'))
            ->where('sede_id', \Session::get('sede_id'))
            ->first())
        {
            return true;
        }
        return false;
    }

}
