@extends('layouts.app')

@section('content')
<div class="container-fluid col-md-12">
  <div class="col-md-12">
    <div class="row justify-content-center">
      <div class="card ">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              Indice de Documentos
            </div>
            @if(\Auth()->user()->isOperador)
            <div class="col-md-4">
              <a class="btn btn-success" href="{{ route('docs.create') }}">+ Agregar</a>
            </div>
            @endif
          </div>
        </div>
        @livewire('docs')
      </div>
    </div>
  </div>
</div>
@endsection

@section('view','docs/index.blade.php')