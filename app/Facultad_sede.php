<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facultad_sede extends Model
{
	protected $table = 'facultad_sede';
	protected $fillable = [ 'facultad_id', 'sede_id',  ];


}
