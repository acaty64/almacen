@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Livewire example</div>
                <div class="card-body">
                    @livewire('example')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
