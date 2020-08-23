<?php

namespace App\Http\Controllers;

use App\Doc;
use App\Facultad;
use App\Sede;
use App\Status;
use App\T_doc;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{

    public function index()
    {
        return view('app.reports.index',[
            'facultades' => Facultad::all(),
            'sedes' => Sede::all(),
            't_docs' => T_doc::all(),
            'statuses' => Status::all(),
        ]);
    }

    public function show(Request $request)
    {
    	$filters = "";
        $validatedData = $request->validate([
            'facultad_id' => 'required',
            'sede_id' => 'required',
            'fecha_fin' => 'exclude_if:fecha_ini,""|after_or_equal:fecha_ini',
        ]);
		// $string = Facultad::findOrFail($request->facultad_id)->name;
        $filters = Facultad::findOrFail($request->facultad_id)->name;

        $filters = $filters . " (" . Sede::findOrFail($request->sede_id)->name . ")";

        $where = [
        	['facultad_id', $request->facultad_id],
        	['sede_id', $request->sede_id],
        ];

        if($request->tdoc_id){
        	$where[] = ['tdoc_id', $request->tdoc_id];
        	$filters = $filters . '<br> Tipo: ' . T_doc::findOrFail($request->tdoc_id)->name;
        }

        if($request->status_id){
        	$where[] = ['status_id', $request->status_id];
        	if(!$request->tdoc_id){
        		$filters = $filters . '<br>';
        	}
        	$filters = $filters . ' Status: ' . Status::findOrFail($request->status_id)->status;
        }

        if($request->fecha_ini){
        	$where[] = ['fecha', '>=' , $request->fecha_ini];
        	$where[] = ['fecha', '<=' , $request->fecha_fin];
        	$filters = $filters . '<br> De: ' . $request->fecha_ini;
        	$filters = $filters . ' A: ' . $request->fecha_fin;
        }

        $data = Doc::where($where)
        	->orderBy('fecha')
        	->get();

        $pdf = \PDF::loadView('pdf.report', [
        		'data' => $data,
        		'filters' => $filters
        	]);
        return $pdf->stream('archivo.pdf');
// $pdf = app('dompdf.wrapper');
//     $pdf->loadView('pdf.report', ['data' => $data]);

        // return view('pdf.report', ['data' => $data]);


    }


}
