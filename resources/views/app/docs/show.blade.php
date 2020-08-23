@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" >
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Vista de Documento
              </div>
              <div class="col-md-2">
                <a href="{{ url()->previous()  }}">Regresar</a>
              </div>
            </div>
          </div>                    
          <div class="row">
            <div class="col col-md-8"><b>Archivo: </b>{{ $doc['archivo'] }}</div>
          </div>
          <div class="row">
            <div class="col col-md-8"><b>Documento: </b>{{ $doc['numero'] }}</div>
            <div class="col col-md-4"><b>Fecha: </b>{{ $doc['fecha'] }}</div>
          </div>
          <div class="row">
            <div class="col col-md-12"><b>Descripción: </b>{{ $doc['descripcion'] }}</div>
          </div>
          <div class="row">
            <div class="col col-md-5">
              <b>Facultad: </b>{{ $doc['facultad'] }}
            </div>
            <div class="col col-md-2">
              <b>Sede: </b>{{ $doc['sede'] }}
            </div>
            <div class="col col-md-2">
              <b>Status: </b>{{ $doc['status'] }}
            </div>
            <div class="col col-md-3">
            @if($doc['status_id'] == 1)
              @if( \Auth()->user()->isFirmante || \Auth()->user()->isAdmin || \Auth()->user()->isMaster )
                <a type="button" class="btn btn-success" href="{{ route('sign.check.ok',$doc['id']) }}">
                  Aprobar
                </a>
                <a type="button" class="btn btn-danger" href="{{ route('sign.check.ko',$doc['id']) }}">
                  Rechazar
                </a>
              @endif
            @endif
            @if($doc['status_id'] != 5 )
              @if( \Auth()->user()->isMaster || \Auth()->user()->isAdmin )
                <a type="button" class="btn btn-danger" href="{{ route('docs.nulled',$doc['id']) }}">
                  Anular
                </a>
              @endif
            @endif
            </div>
          </div>
          <div class="row">
            <div class="col col-md-6">Firmado por: {{ $doc['sign'] }}</div>
            @if($doc['new_doc'])
              <div class="col col-md-6">Reemplazado por: {{ $doc['new_doc'] }}</div>
            @endif
            @if($doc['old_doc'])
              <div class="col col-md-6">Reemplaza a: {{ $doc['old_doc'] }}</div>
            @endif
          </div>
        </div>
        <div class="card-body">
          <div class="container" align="center">
            <iframe src="{{ asset($doc['archivo']) }}" width="800" height="610" ></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('view','docs/show.blade.php')