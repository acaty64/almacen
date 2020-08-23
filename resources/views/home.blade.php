@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de Control</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('tuser_id')==1)
                        <a href="{{ route('docs.index') }}" type="button" class="btn btn-primary">Ver documentos</a>
                        <a href="{{ route('docs.new') }}" type="button" class="btn btn-success">Agregar documento</a>
                        <a href="{{ route('sign.index') }}" type="button" class="btn btn-warning">Firmar documento</a>
                    @endif 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('view','home.blade.php')