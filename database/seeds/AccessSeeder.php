<?php

use App\Access;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
Access::create([ 'user_id' => 1, 'tuser_id' => 1, 'facultad_id' => 1, 'sede_id' => 1, ]); 
Access::create(['user_id' => 1, 'tuser_id' => 1, 'facultad_id' => 1, 'sede_id' => 2, ]); 
Access::create(['user_id' => 1, 'tuser_id' => 1, 'facultad_id' => 2, 'sede_id' => 1, ]); 
Access::create(['user_id' => 1, 'tuser_id' => 1, 'facultad_id' => 2, 'sede_id' => 2, ]); 
Access::create(['user_id' => 1, 'tuser_id' => 1, 'facultad_id' => 2, 'sede_id' => 3, ]); 
Access::create([ 'user_id' => 2, 'tuser_id' => 2, 'facultad_id' => 1, 'sede_id' => 1, ]); 
Access::create([ 'user_id' => 2, 'tuser_id' => 2, 'facultad_id' => 1, 'sede_id' => 2, ]); 
Access::create([ 'user_id' => 2, 'tuser_id' => 2, 'facultad_id' => 2, 'sede_id' => 1, ]); 
Access::create([ 'user_id' => 2, 'tuser_id' => 2, 'facultad_id' => 2, 'sede_id' => 3, ]); 
Access::create([ 'user_id' => 3, 'tuser_id' => 3, 'facultad_id' => 1, 'sede_id' => 1, ]); 
Access::create([ 'user_id' => 5, 'tuser_id' => 4, 'facultad_id' => 1, 'sede_id' => 1, ]); 
Access::create([ 'user_id' => 4, 'tuser_id' => 3, 'facultad_id' => 2, 'sede_id' => 1, ]); 
Access::create([ 'user_id' => 6, 'tuser_id' => 4, 'facultad_id' => 2, 'sede_id' => 1, ]); 
Access::create([ 'user_id' => 5, 'tuser_id' => 4, 'facultad_id' => 1, 'sede_id' => 2, ]); 
Access::create([ 'user_id' => 3, 'tuser_id' => 3, 'facultad_id' => 1, 'sede_id' => 2, ]); 

    }
}
