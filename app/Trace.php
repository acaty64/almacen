<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
	protected $table = 'traces';

	protected $fillable = ['user_id', 'status_id', 'doc_id', ];

	protected $append = ['user', 'status', 'doc'];

	public function getUserAttribute($value='')
	{
		return User::findOrFail($this->user_id);
	}

	public function getStatusAttribute($value='')
	{
		return Status::findOrFail($this->status_id);
	}

	public function getDocAttribute($value='')
	{
		return Doc::findOrFail($this->doc_id);
	}

}
