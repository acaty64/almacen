@extends('layouts.app')

@section('content')
<div class="container-fluid col-md-12">
  <div class="col-md-12">
    <div class="row justify-content-center">
      <div class="card ">
        <div class="card-header">
          <div class="row">
            <div class="col-md-12">
              Reporte de Documentos
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('reports.show') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Facultad</label>
              </div>
              <select name="facultad_id">
                @foreach($facultades as $facultad)
                  <option value="{{ $facultad->id }}">
                    {{ $facultad->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Sede</label>
              </div>
              <select name="sede_id">
                @foreach($sedes as $sede)
                  <option value="{{ $sede->id }}">
                    {{ $sede->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Tipo</label>
              </div>
              <select name="tdoc_id" value="{{ old('tdoc_id') }}">
                <option value="">
                  Todos
                </option>
                @foreach($t_docs as $t_doc)
                  <option value="{{ $t_doc->id }}">
                    {{ $t_doc->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Status</label>
              </div>
              <select name="status_id" value="{{ old('status_id') }}">
                  <option value="">
                    Todos
                  </option>
                @foreach($statuses as $status)
                  <option value="{{ $status->id }}">
                    {{ $status->status }}
                  </option>
                @endforeach
              </select>
            </div>
   
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Fecha Inicio</label>
              </div>
              <input type="date" name="fecha_ini" value="{{ old('fecha_ini') }}">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Fecha Fin</label>
              </div>
              <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}">
            </div>
            <button class="btn btn-primary" type="submit">
              Enviar
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('view','reports/index.blade.php')