@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="align-self: center">RECHAZO DE DOCUMENTO
                </div>
                <div class="card-header" style="align-self: center">
                    ¿ Está seguro de rechazar este documento ?.
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-8"><b>Documento: </b>{{ $doc['numero'] }}</div>
                        <div class="col col-md-4"><b>Fecha:</b> {{ $doc['fecha'] }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12"><b>Descripción: </b>{{ $doc['descripcion'] }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-6"><b>Facultad: </b>{{ $doc['facultad'] }}</div>
                        <div class="col col-md-4"><b>Sede: </b>{{ $doc['sede'] }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-4">
                            <a href="{{ route('sign.uncheck.ko' , $doc['id']) }}" type="button" class="btn btn-danger">CANCELAR</a>
                        </div>
                        <div class="col col-md-4">
                            <a href="{{ route('sign.uncheck.ok' , $doc['id']) }}" type="button" class="btn btn-success">ACEPTAR</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('view','signs/uncheck.blade.php')