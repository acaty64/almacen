@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Papel Membretado</div>
        <form action="{{ route('doc.multiplepdf') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" >
          @csrf             
          <div class="card-body">
            <div class="row">
              <input type="file" id="upload" accept="application/pdf" name="pdf">
            </div>
            <div class="row">
              <div class="form-group">
                <label for="ControlSelect1">Cantidad de paginas</label>
                <select class="form-control" id="ControlSelect1" name="ControlSelect1">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>
          </div>
          <button class="btn btn-primary">Aceptar</button>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection

@section('view','multiplepdf.blade.php')