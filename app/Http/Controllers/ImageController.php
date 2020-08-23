<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Imagick;

class ImageController extends Controller
{
    public function convert(Request $request)
    {
        $originalName = $request->file('pdf')->getClientOriginalName();
        
        $localFile = $request->pdf->store('/tmp', 'local');
        // $imagick = new Imagick();

        $srcimg = storage_path() . '/app/public/' . $localFile;
        if(file_exists($srcimg)){
            $fileNameJpeg = substr($originalName, 0, strlen($originalName)-4) . '.jpeg';
            $targetimg = storage_path() . '/app/public/tmp/' . $fileNameJpeg;

            $im = new imagick();
            $im->setResolution(300, 300);
            $im->readImage($srcimg);
            $im->setImageFormat('jpeg');
            $im->setImageCompression(imagick::COMPRESSION_JPEG); 
            $im->setImageCompressionQuality(100);
            $im->writeImages($targetimg, false);
            unlink($srcimg);
            // $this->addStamp($targetimg . "-0");
            $response = $this->addStamp($fileNameJpeg);
        
			return view('app.image.index');
        }
    
    	return false;
    }

    public function addStamp($filename)
    {
        $fondo = storage_path().'/app/public/tmp/'.$filename;
        // session_start();
        // $posiX =    $_POST['x'];
        // $posiY = $_POST['y'];
        // $logo = $datoImg['logo']; //'logo.png'
        // $datoImg = $_SESSION['genImg'];
        $posiX = 10;
        $posiY = 10;

        $logo = public_path() . '/images/' . 'logo-ucss.png'; //'logo.png'

        $output_jpg = $filename;

        $response = $this->merge($fondo, $logo, $posiX, $posiY, $output_jpg);

        return $response;

    }

    public function merge($img_original, $stamp, $posX, $posY, $output_jpg){

        $trozosimagenorig=explode(".",$img_original);

        $extensionimagenorig=$trozosimagenorig[count($trozosimagenorig)-1];

        if (preg_match("/jpg|jpeg|JPG|JPEG/", $extensionimagenorig)) {
            $imgm=imagecreatefromjpeg($img_original);
        }
        if (preg_match("/png|PNG/", $extensionimagenorig)) {
            $imgm=imagecreatefrompng($img_original);
        }
        if (preg_match("/gif|GIF/", $extensionimagenorig)) {
            $imgm=imagecreatefromgif($img_original);
        }

        $stamp = imagecreatefrompng($stamp);

        $xstamp = $posX;
        $ystamp = $posY;
        $wstamp = imagesx($stamp);
        $hstamp = imagesy($stamp);

        imagecopy($imgm, $stamp, $xstamp, $ystamp,
         0, 0, $wstamp, $hstamp);

        //se copia la imagen
        $output_jpg = public_path() . '/storage/tmp/' . $output_jpg;
        imagejpeg($imgm, $output_jpg);

        return $output_jpg;
    }        

}
