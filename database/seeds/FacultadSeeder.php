<?php

use App\Facultad;
use Illuminate\Database\Seeder;

class FacultadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
Facultad::create(['codigo' => 'FCEC', 'name' => 'FACULTAD DE CIENCIAS ECONOMICAS Y COMERCIALES', ]);
Facultad::create(['codigo' => 'FCEH', 'name' => 'FACULTAD DE CIENCIAS DE LA EDUCACION Y HUMANIDADES', ]);
Facultad::create(['codigo' => 'FCS', 'name' => 'FACULTAD DE CIENCIAS DE LA SALUD', ]);
Facultad::create(['codigo' => 'FI', 'name' => 'FACULTAD DE INGENIERIA', ]);
Facultad::create(['codigo' => 'FIA', 'name' => 'FACULTAD DE INGENIERIA AGRARIA', ]);
Facultad::create(['codigo' => 'FDCP', 'name' => 'FACULTAD DE DERECHO Y CIENCIAS POLITICAS', ]);

    }
}
