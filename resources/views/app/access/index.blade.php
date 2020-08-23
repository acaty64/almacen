@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-4">
              Acceso del usuario: {{ $data['user']->name }}
            </div>
            <div class="col-md-4">
              <a type="button" class="btn btn-success" href="{{ route('access.create') }}" class="">Agregar</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('home')  }}">Menu</a>
            </div>
          </div>
        </div>
        
        <div class="body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo</th>
                <th scope="col">Facultad</th>
                <th scope="col">Sede</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data['access'] as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->t_user->type }}</td>
                <td>{{ $item->facultad->name }}</td>
                <td>{{ $item->sede->name }}</td>
                <td>
                  <a type="button" class="btn btn-primary" href="{{ route('access.edit',$item->id) }}" class="">Modificar</a>
                  <a type="button" class="btn btn-danger" href="{{ route('access.destroy',$item->id) }}" class="">Eliminar</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        {{-- {{ $users->links() }} --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('view','access/index.blade.php')