<?php

use App\Sede;
use Illuminate\Database\Seeder;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
Sede::create(['codigo' => 'LIM', 'name' => 'LIMA', ]);
Sede::create(['codigo' => 'HUA', 'name' => 'HUACHO', ]);
Sede::create(['codigo' => 'ATA', 'name' => 'ATALAYA', ]);
Sede::create(['codigo' => 'NCA', 'name' => 'NUEVA CAJAMARCA', ]);
Sede::create(['codigo' => 'CHU', 'name' => 'CHULUCANAS', ]);
Sede::create(['codigo' => 'TMA', 'name' => 'TARMA', ]);
Sede::create(['codigo' => 'TZZ', 'name' => 'TEZZA', ]);

    }
}
