<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
Status::create([ 'status' => 'Por aprobar', ]); 
Status::create([ 'status' => 'Aprobado', ]); 
Status::create([ 'status' => 'Rechazado', ]); 
Status::create([ 'status' => 'Reemplazado', ]); 
Status::create([ 'status' => 'Anulado', ]); 

    }
}
