@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-10">
              Indice de Documentos 
            </div>
            <div class="col-md-2">
                <a href="{{ route('home')  }}">Menu</a>
            </div>
          </div>
        </div>
        <div class="body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha</th>
                <th scope="col">Número</th>
                <th scope="col">Descripción</th>
                <th scope="col">Archivo</th>
                <th scope="col">Status</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($docs as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ Carbon\Carbon::parse($item->fecha)->format('d-m-Y') }}</td>
                <td>{{ $item->numero }}</td>
                <td>{{ substr($item->descripcion,0,50) }}</td>
                <td>{{ $item->filename }}</td>
                <td>{{ $item->status->status }}</td>
                <td>
                  <a type="button" class="btn btn-primary" href="{{ route('docs.show',$item->id) }}" target=”_blank” class="">Ver</a>
                  @if($item->status_id == 1)
                    <a type="button" class="btn btn-success" href="{{ route('sign.check',$item->id) }}" class="">Aprobar</a>
                    <a type="button" class="btn btn-danger" href="{{ route('sign.uncheck',$item->id) }}" class="">Rechazar</a>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('view','signs/index.blade.php')