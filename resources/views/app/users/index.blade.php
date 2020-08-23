@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-4">
              Usuarios
            </div>
            <div class="col-md-4">
              <a type="button" class="btn btn-success" href="{{ route('user.create') }}" class="">Agregar</a>
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
                <th scope="col">Nombre</th>
                <th scope="col">E-mail</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>
                  <a type="button" class="btn btn-success" href="{{ route('access.index', $item->id) }}" class="">Accesos</a>
                  <a type="button" class="btn btn-primary" href="{{ route('user.edit',$item->id) }}" class="">Modificar</a>
                  <a type="button" class="btn btn-danger" href="{{ route('user.destroy',$item->id) }}" class="">Eliminar</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('view','users/index.blade.php')