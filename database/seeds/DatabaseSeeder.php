<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // if(env('APP_ENV')=='testing'){
        //     $this->call(UsersSeeder::class);
        // }
        $this->call(TUserSeeder::class);
        $this->call(TuserUserSeeder::class);
        $this->call(FacultadSeeder::class);
        $this->call(SedeSeeder::class);
        $this->call(FacultadSedeSeeder::class);
        $this->call(AccessSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(TDocSeeder::class);
        $this->call(DocSeeder::class);
        $this->call(FileSeeder::class);
    }
}
