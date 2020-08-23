<?php

namespace App;

use App\Facultad;
use App\Sede;
use App\Status;
use App\T_doc;
use App\Trace;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
	protected $table = 'docs';
	protected $fillable = [ 'user_id', 'facultad_id', 'sede_id', 'tdoc_id', 'numero', 'descripcion', 'new_doc_id', 'old_doc_id', 'status_id', 'attach', 'filename', 'fecha', ];

	protected $append = ['user', 'facultad', 'sede', 'status', 'firmante', 'traces', 'tdoc'];

	public function getUserAttribute()
	{
		return User::findOrFail($this->user_id);
	}

	public function getFacultadAttribute()
	{
// 		$xx = Facultad::findOrFail($this->facultad_id);
// dd('model', $xx);
		return Facultad::findOrFail($this->facultad_id);
	}

	public function getSedeAttribute()
	{
		return Sede::findOrFail($this->sede_id);
	}

	public function getStatusAttribute()
	{
		return Status::findOrFail($this->status_id);
	}

	public function getOldDocAttribute()
	{
		return Doc::findOrFail($this->old_doc_id);
	}

	public function getNewDocAttribute()
	{
		return Doc::findOrFail($this->new_doc_id);
	}

	public function getTdocAttribute()
	{
		return T_doc::findOrFail($this->tdoc_id)->name;
	}

	public function getFirmanteAttribute()
	{
		if($this->status->id == 2){
			$trace = Trace::where('doc_id', $this->id)
				->where('status_id', 2)
				->first();
			return $trace->user->name;
		}
		return 'Pendiente de Firma';
	}

	public function getTracesAttribute()
	{
		return Trace::where('doc_id', $this->id);
	}

	public function getGoogleFile()
	{
        $client = new \Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
            $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->refreshToken(\Auth::user()->refresh_token);
        $service = new \Google_Service_Drive($client);
        if($this->file_id)
        {
	        $response = $service->files->get($this->file_id, array('alt' => 'media'));
	        if($response)
	        {
		        $originalName = $this->filename;

		        // $file_out = storage_path('docs') . '/' . $this->file_id . '.pdf';
		        $file_out = storage_path() . '/app/public/docs/' . $this->file_id . '.pdf';
		        $outHandle = fopen($file_out, "w+");
		        while (!$response->getBody()->eof()) {
		            fwrite($outHandle, $response->getBody()->read(1024));
		        }

		        fclose($outHandle);

		        return $this->file_id . '.pdf';
	        }
	        return false;
        }
        return false;

	}


}
