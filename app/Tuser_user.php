<?php

namespace App;

use App\T_user;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Tuser_user extends Model
{
	protected $table = 'tuser_user';

	protected $fillable = [
		'user_id', 
		'tuser_id', 
		];

	protected $append = ['tuser', 'user'];

	public function getTuserAttribute()
	{
		return T_user::findOrFail($this->tuser_id);
	}
	public function getUserAttribute()
	{
		return User::findOrFail($this->tuser_id);
	}

}
