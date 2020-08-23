<?php

use App\T_doc;
use Illuminate\Database\Seeder;

class TDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
T_doc::create([ 'name' => 'Memorandum', ]); 
T_doc::create([ 'name' => 'Oficio', ]); 
T_doc::create([ 'name' => 'Carta', ]); 
T_doc::create([ 'name' => 'Resolución Decanal', ]); 
T_doc::create([ 'name' => 'Resolución de Consejo de Facultad', ]); 

    }
}
