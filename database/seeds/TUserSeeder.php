<?php

use App\T_user;
use Illuminate\Database\Seeder;

class TUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
T_user::create([ 'type' => 'Master', ]);
T_user::create([ 'type' => 'Administrador', ]);
T_user::create([ 'type' => 'Operador', ]);
T_user::create([ 'type' => 'Firmante', ]);

    }
}
