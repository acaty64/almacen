<?php

use App\Tuser_user;
use Illuminate\Database\Seeder;

class TuserUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
Tuser_user::create([ 'user_id' => 1, 'tuser_id' => 1, ]); 
Tuser_user::create([ 'user_id' => 2, 'tuser_id' => 2, ]); 
Tuser_user::create([ 'user_id' => 3, 'tuser_id' => 3, ]); 
Tuser_user::create([ 'user_id' => 5, 'tuser_id' => 4, ]); 
Tuser_user::create([ 'user_id' => 4, 'tuser_id' => 3, ]); 
Tuser_user::create([ 'user_id' => 6, 'tuser_id' => 4, ]); 

    }
}
