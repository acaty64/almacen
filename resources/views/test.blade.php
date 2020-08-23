@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de Prueba</div>
                <form action="{{ route('doc.saveBack') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" >
                    @csrf                
                    <div class="card-body">
                        <input type="file" id="upload" accept="application/pdf" name="pdf">
                    </div>
                    <button class="btn btn-primary">Aceptar</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@section('view','test.blade.php')