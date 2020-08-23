<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::on('mysql_tests')->create(['name' => 'master','email' => 'aarashiro@ucss.edu.pe', 'password' => bcrypt('secret'), 'refresh_token'=> 'something']);
		User::on('mysql_tests')->create(['name' => 'administrador','email' => 'ucss.fcec.lim@gmail.com', 'password' => bcrypt('secret'), 'refresh_token'=> 'something']);
		User::on('mysql_tests')->create(['name' => 'facultad1','email' => 'facultad1@gmail.com', 'password' => bcrypt('secret'), 'refresh_token'=> 'something']);
		User::on('mysql_tests')->create(['name' => 'facultad2','email' => 'facultad2@gmail.com', 'password' => bcrypt('secret'), 'refresh_token'=> 'something']);
		User::on('mysql_tests')->create(['name' => 'decano1','email' => 'decano1@gmail.com', 'password' => bcrypt('secret'), 'refresh_token'=> 'something']);
		User::on('mysql_tests')->create(['name' => 'decano2', 'email' => 'decano2@gmail.com', 'password' => bcrypt('secret'),  'refresh_token'=> 'something']);


    }
}
