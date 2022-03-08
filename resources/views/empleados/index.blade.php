@extends('layouts.app')

@section('content')

<div class="container">

@if(Session::has('mensaje'))

    <div class="alert alert-success" role="alert">
        {{ 
            Session::get('mensaje')
        }}
    </div>
@endif

@if(Session::has('mesaje'))
    <div class="alert alert-success" role="alert">{{

        Session::get('mesaje')
        
    }}
    </div>
@endif

<a href="{{ url('empleados/create') }}" class="btn btn-primary">Agregar Empleado</a>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($empleados as $empleados) 
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>
            <img src="{{ asset('storage').'/'.$empleados->foto}}" alt="" width="120" class="img-thumbnail img-fluid">
            </td>
            <td>{{$empleados->nombre}} {{$empleados->apePat}} {{$empleados->apeMat}}</td>
            <td>{{$empleados->correo}}</td>
            <td>
            
            <a href="{{ url('/empleados/'.$empleados->id.'/edit') }}" class="btn btn-success">Editar</a>

            <form method="post" action="{{ url ('/empleados/'.$empleados->id) }}" style="display: inline">
                {{ csrf_field() }} 
                {{ method_field('DELETE') }} 
                <button type="submit" onclick="return confirm('¿Seguro que deseas Borrar?');" class="btn btn-danger">Borrar</button>
            </form>
            </td>
        </tr>
     @endforeach
    </tbody>
</table>

</div>

@endsection