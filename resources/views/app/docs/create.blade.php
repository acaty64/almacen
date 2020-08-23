@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-10">
              Agregar Documentos
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
          <form method="POST" action="{{ route('docs.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Tipo</label>
              </div>
              <select class="custom-select" id="tdoc_id" name="tdoc_id">
                <option value="">Seleccione el tipo</option>
                @foreach($t_docs as $item_t)
                  <option  
                    value="{{ $item_t->id }}">
                    {{ $item_t->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1" >Fecha de emisión:  </span>
                </div>
                <input name="fecha" value="{{ old('fecha') }}" type="date" class="form-control" placeholder="UCSS/CAU-2010" aria-label="fecha" aria-describedby="basic-addon1">
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1" >Número:  </span>
                </div>
                <input name="numero" type="text" value="{{ old('numero') }}" class="form-control" placeholder="UCSS/CAU-2010" aria-label="Número" aria-describedby="basic-addon1" maxlength="120">
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1" >Descripción:  </span>
                </div>
                <input name="descripcion" value="{{ old('descripcion') }}" type="text" class="form-control" placeholder="Ingrese una breve descripción" aria-label="Número" aria-describedby="basic-addon1" maxlength="255">
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">
                    Documento a reemplazar
                  </label>
                </div>
                <select class="custom-select" id="old_doc_id" name="old_doc_id">
                  <option value="">Seleccione el documento a reemplazar</option>
                  @foreach($old_docs as $item)
                    <option  
                      value="{{ $item->id }}">
                      {{ $item->numero}}
                    </option>
                  @endforeach
                </select>
              </div>
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1" maxlength="255">Agregue Archivo:  </span>
                </div>
                <div class="col-md-6">
                  <input type="file" class="form-control" name="file" accept="application/pdf" >
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('view','docs/create.blade.php')