@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de Control</div>

                <div class="card-body">
                    @livewire('search')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('view','home.blade.php')