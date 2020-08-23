@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-10">
              Modificación de Acceso
            </div>
            <div class="col-md-2">
              <a href="{{ route('home')  }}">Menu</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
        </div>
        <form action="{{ route('access.update') }}" method="POST">
          @csrf
          <input type="hidden" name="access_id" value="{{ $data['acceso']->id }}">
          <div class="card-header">Usuario</div>
          <div class="card-body">
            {{ $data['acceso']->user->name }}
          </div>
          <div class="card-header">Tipo de Usuario</div>
          <div class="card-body">
            {{ $data['acceso']->t_user->type }}
          </div>
          <div class="card-header">Facultad</div>
          <div class="card-body">
            <select id="facultad_id" name="facultad_id" class="browser-default custom-select">
              @foreach($data['facultades'] as $item_f)
              <option value="{{ $item_f['id'] }}" {{ $data['acceso']->facultad_id == $item_f['id'] ? 'selected' : '' }}>{{ $item_f['name'] }}</option>
              @endforeach
            </select>
          </div>
          <div class="card-header">Sede</div>
          <div class="card-body">
            <select id="sede_id" name="sede_id" class="browser-default custom-select">
              @foreach($data['sedes'] as $item_s)
              <option value="{{ $item_s['id'] }}" {{ $data['acceso']->sede_id == $item_s['id'] ? 'selected' : '' }}>{{ $item_s['name'] }}</option>
              @endforeach
            </select>
          </div>
          <div class="card-body">
            <button  type="submit" value="Submit" class="submit">Aceptar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('view','access/edit.blade.php')