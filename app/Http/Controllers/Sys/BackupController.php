<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Artisan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function __construct()
    {
        // $this->middleware('master');
        Carbon::setLocale('es');
    }
    /**
     * Display a listing of backups files.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->obtenerListadoDeArchivos();
        // Ordenar datos
        $data = $this->orderMultiDimensionalArray($data, 'nombre', true);

        return view('backup.index')
            ->with('data', $data);
    }

    protected function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {
        $position = array();
        $newRow = array();
        foreach ($toOrderArray as $key => $row) {
                $position[$key]  = $row[$field];
                $newRow[$key] = $row;
        }
        if ($inverse) {
            arsort($position);
        }
        else {
            asort($position);
        }
        $returnArray = array();
        foreach ($position as $key => $pos) {     
            $returnArray[] = $newRow[$key];
        }
        return $returnArray;
    }

    /**
     * Get list of backups files from backup directory.
     *
     * @return string
     */
    protected function obtenerListadoDeArchivos(){
        $directorio = storage_path() . '/app/public/' . env('GOOGLE_DRIVE_BACKUP_FOLDER_ID');
        // Array en el que obtendremos los resultados
        $res = array();

        // Agregamos la barra invertida al final en caso de que no exista
        if(substr($directorio, -1) != "/") $directorio .= "/";

        // Creamos un puntero al directorio y obtenemos el listado de archivos
        $dir = @dir($directorio) or die("getFileList: Error abriendo el directorio $directorio para leerlo");
        while (($archivo = $dir->read()) !== false) {
            // Obviamos los archivos ocultos
            if($archivo[0] == ".") continue;
                if(is_dir($directorio . $archivo)) {
                    $res[] = array(
                    "nombre" => $archivo,
                    "tamaño" => 0,
                    "modificado" => filemtime($directorio . $archivo)
                );
            } else if (is_readable($directorio . $archivo)) {
                $fileTime = Carbon::now()->timestamp(filemtime($directorio . $archivo));
                $res[] = array(
                    "nombre" => $archivo,
                    "tamaño" => $this->formatBytes(filesize($directorio . $archivo)),
                    //"modificado" => date("F d Y H:i:s.",filemtime($directorio . $archivo))
                    //"modificado" => filemtime($directorio . $archivo)->diffForHuman()
                    "modificado" => $fileTime->diffForHumans(),
                );
            }
        }
        $dir->close();
        return $res;
    }

    /**
     * Conversion bytes to Kilobytes, Megabytes, Gigabytes or Terabytes.
     *
     * @return string
     */
    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');   

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }

    /**
     * Download file.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($fileName)
    {
        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );
        // Create Download Response
        $file_in = storage_path() . 
                    DIRECTORY_SEPARATOR . 'app' . 
                    DIRECTORY_SEPARATOR . 'public' . 
                    DIRECTORY_SEPARATOR . env('APP_NAME') . 
                    DIRECTORY_SEPARATOR . $fileName;
        if(file_exists($file_in)){
            return response()->download($file_in, $fileName, $headers);
        }else{
            return 'Error';
        };
    }

    /**
     * Create a backup file.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
// dd('BackupController@create');
        $exitCode = Artisan::call('backup:run', ['--only-db'=>true]);
// dd('BackupController@create', $exitCode);
        return redirect()->route('backup.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($fileName)
    {
        $file_in = storage_path() . 
                    DIRECTORY_SEPARATOR . 'app'. 
                    DIRECTORY_SEPARATOR . 'public' . 
                    DIRECTORY_SEPARATOR . env('APP_NAME') . 
                    DIRECTORY_SEPARATOR . $fileName;

        if(file_exists($file_in)){
            try {
                $nn = unlink($file_in);
                return redirect()->route('backup.index');
            } catch (Exception $e) {
                return false;
            }
        }else{
            return false;
        };        
    }

}
