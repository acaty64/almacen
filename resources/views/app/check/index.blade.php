@extends('layouts.app')

@section('content')
<index-component :user_id={{ $user_id }}></index-component>
@endsection

@section('view','check/index.blade.php')