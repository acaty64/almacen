@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-10">
                      Accesos
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
                <form action="{{ route('access.save') }}" method="POST">
                    @csrf
                    <div class="card-header">Facultad</div>
                    <div class="card-body">
                        <select id="facultad" name="facultad" class="browser-default custom-select">
                            <option selected>Seleccione la facultad</option>
                            @foreach($data['facultades'] as $item_f)
                                <option value="{{ $item_f['id'] }}">{{ $item_f['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-header">Sede</div>
                    <div class="card-body">
                        <select id="sede" name="sede" class="browser-default custom-select">
                            <option selected>Seleccione la sede</option>
                            @foreach($data['sedes'] as $item_s)
                                <option value="{{ $item_s['id'] }}">{{ $item_s['name'] }}</option>
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

@section('view','access/panel.blade.php')