@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <div class="col-md-2">
                    {{-- <a href="{{ route('login')  }}">Login</a> --}}
                </div>
                <div class="card-body">
                    <p>
                        Usted no está registrado para acceder a este módulo.
                    </p>
                    <p>
                        Solicítelo al correo electrónico ucss.horarios@gmail.com
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
