<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{

	protected $table = 'signs';
	protected $fillable = [ 'user_id', 'status_id', 'doc_id', ];

}
