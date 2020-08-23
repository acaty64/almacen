@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-4">
                      Panel Maestro
                    </div>
                    <div class="col-md-4">
                      
                    </div>
                    <div class="col-md-4">
                        <a href="{{ url()->previous()  }}">Regresar</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                        <a href="{{ route('docs.index') }}" type="button" class="btn btn-primary">Ver documentos</a>
                        <a href="{{ route('docs.create') }}" type="button" class="btn btn-success">Agregar documento</a>
                        <a href="{{ route('sign.index') }}" type="button" class="btn btn-warning">Firmar documento</a>
                        <a href="{{ route('user.index') }}" type="button" class="btn btn-primary">Usuarios</a>
                        <a href="{{ route('backup.index') }}" type="button" class="btn btn-danger">Backups</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('view','master/dashboard.blade.php')