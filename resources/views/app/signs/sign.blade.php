@extends('layouts.app')

@section('content')
<div class="container-fluid col-md-12">
  {{-- <div class="col-md-12"> --}}
    <div class="row justify-content-center">
        @livewire('signer')
    </div>
  {{-- </div> --}}
</div>
@endsection

@section('view','sign/sign.blade.php')