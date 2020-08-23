<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Doc;
use Faker\Generator as Faker;
use Illuminate\Support\Str;



$factory->define(Doc::class, function (Faker $faker) {
	//Start point of our date range.
	$start = strtotime("1 January 2020");
	 
	//End point of our date range.
	$end = strtotime("22 April 2020");
	 
	//Custom range.
	$timestamp = mt_rand($start, $end);
    return [
		'user_id' => rand(1, 6),
		'numero' => Str::random(15),
		'descripcion' => $faker->words(20, true),
		'facultad_id' => 1,
		'sede_id' => 1,
		'tdoc_id' => rand(1, 5),
		'status_id' => rand(1,5),
		'filename' => Str::random(15) . 'pdf',
		'fecha' => date("Y-m-d", $timestamp),
    ];
});
		// 'facultad_id' => rand(1, 6),
		// 'sede_id' => rand(1, 7),
