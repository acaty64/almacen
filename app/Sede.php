<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
	protected $table = 'sedes';
	protected $fillable = ['codigo', 'name',];


}
