<?php

namespace App\Http\Controllers;

use App\Doc;
use App\Sign;
use App\Trace;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SignController extends Controller
{

    public function check($doc_id)
    {
        $xdoc = Doc::findOrFail($doc_id);
        $doc = $xdoc->toArray();
        $doc['fecha'] = Carbon::parse($xdoc->fecha)->format('d-m-Y');
        $doc['facultad'] = $xdoc->facultad->name;
        $doc['sede'] = $xdoc->sede->name;

        return view('app.signs.check')
            ->with('doc', $doc);
    }

    public function checkOk($doc_id)
    {
        $doc = Doc::findOrFail($doc_id);
        $doc->status_id = 2;

        $trace = Trace::create([
            'user_id' => \Auth::user()->id,
            'status_id' => $doc->status_id,
            'doc_id' => $doc->id
        ]);

        if($trace){
            $doc->save();
        }
// dd('Controller',$trace);

        return redirect(route('sign.index'));
    }

    public function checkKo()
    {
        return redirect(route('sign.index'));
    }

    public function uncheck($doc_id)
    {
        $xdoc = Doc::findOrFail($doc_id);
        $doc = $xdoc->toArray();
        $doc['fecha'] = Carbon::parse($xdoc->fecha)->format('d-m-Y');
        $doc['facultad'] = $xdoc->facultad->name;
        $doc['sede'] = $xdoc->sede->name;

        return view('app.signs.uncheck')
            ->with('doc', $doc);
    }

    public function uncheckOk($doc_id)
    {
        $doc = Doc::findOrFail($doc_id);
        $doc->status_id = 3;

        $trace = Trace::create([
            'user_id' => \Auth::user()->id,
            'status_id' => $doc->status_id,
            'doc_id' => $doc->id
        ]);

        if($trace){
            $doc->save();
        }

        return redirect(route('sign.index'));
    }

    public function uncheckKo()
    {
        return redirect(route('sign.index'));
    }

    public function index()
    {
        $docs = Doc::where('facultad_id', session('facultad_id'))
                    ->where('sede_id', session('sede_id'))
                    ->orderBy('status_id', 'ASC')
                    ->orderBy('fecha', 'DESC')
                    ->get();

        return view('app.signs.index')
            ->with('docs', $docs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sign  $sign
     * @return \Illuminate\Http\Response
     */
    public function show(Sign $sign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sign  $sign
     * @return \Illuminate\Http\Response
     */
    public function edit(Sign $sign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sign  $sign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sign $sign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sign  $sign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sign $sign)
    {
        //
    }
}
