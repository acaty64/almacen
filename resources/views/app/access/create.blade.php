@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-10">
                      Creación de Accesos
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
                <form action="{{ route('access.store') }}" method="POST">
                    @csrf

                    <div class="card-header">Usuario</div>
                    <div class="card-body">
                        <select id="usuario" name="usuario" class="browser-default custom-select">
                            <option disabled selected>Seleccione el usuario</option>
                            @foreach($data['usuarios'] as $item_u)
                                <option value="{{ $item_u['id'] }}" {{ old('usuario') == $item_u['id'] ? 'selected' : '' }}>{{ $item_u['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-header">Tipo de Usuario</div>
                    <div class="card-body">
                        <select id="t_user" name="t_user" class="browser-default custom-select">
                            <option disabled selected>Seleccione el usuario</option>
                            @foreach($data['tusers'] as $item_t)
                                <option value="{{ $item_t['id'] }}" {{ old('t_user') == $item_t['id'] ? 'selected' : '' }}>{{ $item_t['type'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-header">Facultad</div>
                    <div class="card-body">
                        <select id="facultad" name="facultad" class="browser-default custom-select">
                            <option disabled selected>Seleccione la facultad</option>
                            @foreach($data['facultades'] as $item_f)
                                <option value="{{ $item_f['id'] }}" {{ old('facultad') == $item_f['id'] ? 'selected' : '' }}>{{ $item_f['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-header">Sede</div>
                    <div class="card-body">
                        <select id="sede" name="sede" class="browser-default custom-select">
                            <option disabled selected>Seleccione la sede</option>
                            @foreach($data['sedes'] as $item_s)
                                <option value="{{ $item_s['id'] }}" {{ old('sede') == $item_s['id'] ? 'selected' : '' }}>{{ $item_s['name'] }}</option>
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

@section('view','access/index.blade.php')