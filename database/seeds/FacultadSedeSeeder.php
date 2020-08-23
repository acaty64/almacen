<?php

use App\Facultad_sede;
use Illuminate\Database\Seeder;

class FacultadSedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Facultad_sede::create(['facultad_id' => 1, 'sede_id' => 1]);
		Facultad_sede::create(['facultad_id' => 1, 'sede_id' => 2]);
		Facultad_sede::create(['facultad_id' => 1, 'sede_id' => 3]);
		Facultad_sede::create(['facultad_id' => 1, 'sede_id' => 4]);
		Facultad_sede::create(['facultad_id' => 1, 'sede_id' => 5]);
		Facultad_sede::create(['facultad_id' => 2, 'sede_id' => 1]);
		Facultad_sede::create(['facultad_id' => 2, 'sede_id' => 3]);
		Facultad_sede::create(['facultad_id' => 2, 'sede_id' => 5]);
		Facultad_sede::create(['facultad_id' => 3, 'sede_id' => 1]);
		Facultad_sede::create(['facultad_id' => 3, 'sede_id' => 4]);
		Facultad_sede::create(['facultad_id' => 3, 'sede_id' => 5]);
		Facultad_sede::create(['facultad_id' => 3, 'sede_id' => 6]);
		Facultad_sede::create(['facultad_id' => 3, 'sede_id' => 7]);
		Facultad_sede::create(['facultad_id' => 4, 'sede_id' => 1]);
		Facultad_sede::create(['facultad_id' => 4, 'sede_id' => 4]);
		Facultad_sede::create(['facultad_id' => 4, 'sede_id' => 6]);
		Facultad_sede::create(['facultad_id' => 5, 'sede_id' => 1]);
		Facultad_sede::create(['facultad_id' => 5, 'sede_id' => 2]);
		Facultad_sede::create(['facultad_id' => 5, 'sede_id' => 3]);
		Facultad_sede::create(['facultad_id' => 5, 'sede_id' => 4]);
		Facultad_sede::create(['facultad_id' => 5, 'sede_id' => 5]);
		Facultad_sede::create(['facultad_id' => 5, 'sede_id' => 6]);
		Facultad_sede::create(['facultad_id' => 6, 'sede_id' => 1]);
		Facultad_sede::create(['facultad_id' => 6, 'sede_id' => 4]);


    }
}
