@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-10">
                      Panel de Administrador
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('view','admin/dashboard.blade.php')