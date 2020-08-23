<?php

namespace App\Http\Livewire;

use App\Doc;
use App\Status;
use App\T_doc;
use Livewire\Component;
use Livewire\WithPagination;

class Docs extends Component
{
	use WithPagination;

	public $fields;
	public $tipos;
	public $fechas;
	public $statuses;
	public $field;
	public $status_id;
	public $tipo_id;
	public $fecha;
	public $numero;
	public $perPage;


	public function mount()
	{
		$this->fields = ['ninguno', 'fecha', 'tipo', 'numero', 'status'];
		$this->tipos = T_doc::all();
		$this->statuses = Status::all();
		$this->tipo_id = 1;
		$this->status_id = 1;
		$this->fecha = now()->format('Y-m-d');
		$this->numero = '';
		$this->field = 'ninguno';
		$this->perPage = 5;
	}

	public function render()
	{
		$facultad_id = \Session::get('facultad_id');
		$sede_id = \Session::get('sede_id');
		$searchTerm = "%" . $this->numero . "%";

		switch ($this->field) {
			case 'numero':
				return view('livewire.docs', [
					'docs' => Doc::where('facultad_id', $facultad_id)
					->where('sede_id', $sede_id)
					->orderBy('status_id', 'ASC')
					->orderBy('id', 'DESC')
					->where('numero', 'like', $searchTerm)
					->paginate($this->perPage),
				]);
				break;
			case 'tipo':
				return view('livewire.docs', [
					'docs' => Doc::where('facultad_id', $facultad_id)
					->where('sede_id', $sede_id)
					->where('tdoc_id', $this->tipo_id)
					->orderBy('status_id', 'ASC')
					->orderBy('id', 'DESC')
					->paginate($this->perPage),
				]);
				break;
			case 'status':
				return view('livewire.docs', [
					'docs' => Doc::where('facultad_id', $facultad_id)
					->where('sede_id', $sede_id)
					->where('status_id', $this->status_id)
					->orderBy('id', 'DESC')
					->paginate($this->perPage),
				]);
				break;
			case 'fecha':
				return view('livewire.docs', [
					'docs' => Doc::where('facultad_id', $facultad_id)
					->where('sede_id', $sede_id)
					->where('fecha', $this->fecha)
					->orderBy('status_id', 'ASC')
					->orderBy('id', 'DESC')
					->paginate($this->perPage),
				]);
				break;
			
			default:
				return view('livewire.docs', [
					'docs' => Doc::where('facultad_id', $facultad_id)
					->where('sede_id', $sede_id)
					->orderBy('status_id', 'ASC')
					->orderBy('id', 'DESC')
					->paginate($this->perPage),
				]);
				break;	
		}

	}

}
