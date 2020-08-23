<?php

namespace App\Http\Controllers;

use App\Doc;
use App\Drive;
use App\Facultad;
use App\Sede;
use App\Status;
use App\T_doc;
use App\Trace;
use App\Traits\Imagenes;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Imagick;

class DocController extends Controller
{
    use Imagenes;

    public function viewMultiplePdf()
    {
        return view("multiplepdf");
    }
    public function multiplepdf(Request $request)
    {
        $user_id = 1;
        $npages = $request->ControlSelect1;

        $path = $this->pathBack($user_id);
        if(!file_exists($path)){
            mkdir($path);
        }else{
            array_map('unlink', glob($path . "*.jpg"));
        }

        $path = $this->pathBack($user_id);
        if(!file_exists($path)){
            mkdir($path);
        }else{
            array_map('unlink', glob($path . "*.pdf"));
        }

        $originalName = $_FILES['pdf']['name'];
        try {
            $fileBack = $request->pdf->store('images/back/' . $user_id, 'local');
            $fileBack = $this->pathBack($user_id) . basename($fileBack);
        } catch (Exception $e) {
            return ['success'=>false, 'mess'=>'no se grabo archivo ' . $request->file_back->getClientOriginalName,];
        }

        // create Imagick object
        $imagick = new Imagick();
        // Sets the image resolution
        $imagick->setResolution(300, 300);
        // Reads image from PDF
        $imagick->readImage($fileBack);

        // Writes an image
        $pathOut = 'storage/images/back/' . $user_id . '/';
        $nameOut = "page";
        // $fileout = public_path($pathOut . $nameOut . '.png');
        $fileout = public_path($pathOut . $nameOut . '.jpg');
        $imagick->writeImages($fileout, true);

        copy($this->pathBack($user_id) . $nameOut . ".jpg", $this->pathWork($user_id) . $nameOut . ".jpg");


        $files = [];
        for ($i=0; $i < $npages; $i++) { 
            $files[] = $this->pathBack($user_id) . 'page.jpg';
        }

        $response = $this->jpgToPdf($files, $originalName, $user_id);        

        return $response;


    }

    public function pdfoutfile()
    {
            $link = 'http://store.ucssfcec.test/api/checkpdf/123456';
// $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($string));
$qrcode = 'storage/images/qrcode.png';
        // $pdf = App::make('dompdf.wrapper');
        $data = [
            'originalName' => 'Nuevo Archivo',
            'images' => [
                '/storage/images/work/2/page-0.jpg',
                '/storage/images/work/2/page-1.jpg'
            ],
            'link' => $link,
            'qrcode' => $qrcode,
        ];

        \QrCode::size(100)
            ->format('png')
            ->generate($link, public_path($qrcode));

        $pdf = \PDF::loadView('pdf.pdfoutfile', $data);
// return $pdf->stream('archivo.pdf');
return $pdf->download('archivo.pdf');
        // return view('pdf.pdfoutfile')->with([
        //     'originalName' => 'Nuevo Archivo',
        //     'images' => [
        //         '/storage/images/work/2/page-0.jpg',
        //         '/storage/images/work/2/page-1.jpg'
        //     ],
        //     'link' => 'http://store.ucssfcec.test/api/checkpdf/123456',
        // ]);
    }
    public function read($googleFileId)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
            $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->refreshToken(\Auth::user()->refresh_token);
        $service = new Google_Service_Drive($client);
        $response = $service->files->get($googleFileId, array('alt' => 'media'));

        $originalName = Doc::where('file_id', $googleFileId)->first()->filename;

        $file_out = storage_path() . '/app/temp/' . $googleFileId;

        $outHandle = fopen($file_out, "w+");
        while (!$response->getBody()->eof()) {
            fwrite($outHandle, $response->getBody()->read(1024));
        }

        fclose($outHandle);

        return response()->file($file_out, [
            'Content-type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename =' . "'" . $originalName . "'",
        ]);
            
    }

    public function nulled($doc_id)
    {
        $doc = Doc::findOrFail($doc_id);
        $doc->status_id = 5;
        $doc->save();
        Trace::create([
            'user_id' => \Auth()->user()->id,
            'doc_id' => $doc->id,
            'status_id' => 5
        ]);
        return view('app.docs.index');
        // return view('app.docs.index');
    }

    public function show($doc_id)
    {
        $xdoc = Doc::findOrFail($doc_id);
        $doc = $xdoc->toArray();

        $googleFileDown = $xdoc->getGoogleFile();

        if($googleFileDown)
        {
            $archivo = "storage/docs/" . $googleFileDown;
            $doc['fecha'] = Carbon::parse($xdoc->fecha)->format('d-m-Y');
            $doc['archivo'] = $archivo;
            $doc['facultad'] = $xdoc->facultad->name;
            $doc['sede'] = $xdoc->sede->name;
            $doc['sign'] = $xdoc->firmante;
            $doc['tdoc'] = $xdoc->tdoc;
            $doc['status'] = $xdoc->status->status;

            $doc['new_doc'] = null;
            $doc['old_doc'] = null;
            if($xdoc->new_doc_id){
                $doc['new_doc'] = Doc::findOrFail($xdoc->new_doc_id)->numero;
            }

            if($xdoc->old_doc_id){
                $doc['old_doc'] = Doc::findOrFail($xdoc->old_doc_id)->numero;
            }

            return view('app.docs.show')
                    ->with('doc', $doc);
        }
return "Error, no se encuentra el archivo " . $xdoc->filename;
        return back();

    }

    public function create()
    {
        $old_docs = Doc::all();
        $t_docs = T_doc::all();
        return view('app.docs.create')
                ->with([
                    'old_docs' => $old_docs,
                    't_docs' => $t_docs,
            ]);
    }

    public function store(Request $request)
    {
        \Session::forget('status');

        $validatedData = $request->validate([
            'tdoc_id' => 'required',
            'fecha' => 'required',
            'numero' => 'required|max:120',
            'descripcion' => 'required|max:250',
            'file' => 'required',
        ]);

        $user = Auth::user();

        $new_doc = Doc::create([
            'tdoc_id' => $request->tdoc_id,
            'fecha' => $request->fecha,
            'user_id'   => $user->id, 
            'facultad_id'   => session('facultad_id'), 
            'sede_id'   => session('sede_id'), 
            'numero'    => $request->numero, 
            'descripcion'   => $request->descripcion, 
            'status_id' => 1, 
        ]);

        if($request->old_doc_id){
            $new_doc->old_doc_id = $request->old_doc_id;
            $new_doc->save();

            $old_doc = Doc::findOrFail($request->old_doc_id);
            $old_doc->new_doc_id = $new_doc->id;
            $old_doc->status_id = 4;
            $old_doc->save();
        }

        //obtenemos el campo file definido en el formulario
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        // $originalRequest = $request;
        $googleFilename = $file->store('', 'google');
        // dd($googleFilename);

        // Verifica si el archivo se grabo, si no eliminar el registro       
        // if(\Storage::disk('local')->exists($pathname)){

        if($googleFilename){

            // Recupera el Id del archivo en GoogleDrive
            $file_id = Drive::fileId($googleFilename);
            $new_doc->file_id = $file_id;

            if($request->old_doc){
                $new_doc->old_doc_id = $request->old_doc;
            }
            $new_doc->attach = $googleFilename;
            $new_doc->filename = $originalName;
            $new_doc->save();

            $trace = Trace::create([
                'user_id' => $user->id, 
                'status_id' => 1, 
                'doc_id' => $new_doc->id,
            ]);
            return redirect(route('docs.index'));
        }else{
            $new_doc->delete();
            \Session::put('status', 'Error, no se ha grabado el archivo.');
            return redirect(route('docs.new'));
        }

    }

    public function index()
    {
        $docs = Doc::where('facultad_id', session('facultad_id'))
                    ->where('sede_id', session('sede_id'))
                    ->orderBy('status_id')
                    ->orderBy('fecha', 'DESC')->get();
        return view('app.docs.index')->with('docs', $docs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function edit(Doc $doc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doc $doc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doc $doc)
    {
        //
    }
}
