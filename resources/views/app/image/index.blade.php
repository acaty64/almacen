@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de Control</div>

                <div class="card-body">

<div>
    
    <img src="{{ asset('storage/tmp/BARNETT GUILLEN, LIDA ESTHER.jpeg') }}" width="248"
     height="350">
</div>
    {{-- <img src="{{asset('images/logo-ucss.png')}}"> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('view','home.blade.php')