<?php

namespace App;

use App\Facultad;
use App\Sede;
use App\T_user;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
	protected $table = 'accesses';
	protected $fillable = ['user_id', 'tuser_id', 'facultad_id', 'sede_id', ];

	protected $append = ['user', 'tuser', 'facultad', 'sede'];

	public function getUserAttribute()
	{
		return User::findOrFail($this->user_id);
	}
	public function getTUserAttribute()
	{
		return T_user::findOrFail($this->tuser_id);
	}
	public function getFacultadAttribute()
	{
		return Facultad::findOrFail($this->facultad_id);
	}
	public function getSedeAttribute()
	{
		return Sede::findOrFail($this->sede_id);
	}
}
