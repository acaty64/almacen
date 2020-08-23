art <?php

use App\File;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::create([
        	'user_id' => 1,
        	'filename' => 'prueba.pdf'
        ]);
    }
}
