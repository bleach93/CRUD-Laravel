@extends('layouts.app')

@section('content')

<div class="container">

@if(Session::has('mensaje'))
    <div class="alert alert-success" role="alert">{{

        Session::get('mensaje')
        
    }}
    </div>
@endif

<form method="post" action="{{ url('/empleados/'.$empleados->id) }}" enctype="multipart/form-data" style="display: inline">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    @include('empleados.form',['Modo'=>'editar'])
</form>

</div>

@endsection