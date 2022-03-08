<div class="form-group">
    <label for="nombre" class="control-label">{{'Nombre'}}</label>
    <input type="text" class="form-control {{$errors->has('Nombre')?'is-invalid':''}}" name="nombre" id="nombre" value=" {{ isset($empleados->nombre)?$empleados->nombre:'' }}">
    {!! $errors->first('Nombre','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="apePat" class="control-label">{{'Apellido Paterno'}}</label>
    <input type="text" class="form-control {{$errors->has('Apellido Paterno')?'is-invalid':''}}"  name="apePat" id="apePat" value="{{ isset($empleados->apePat)?$empleados->apePat:'' }}">
    {!! $errors->first('Apellido Paterno','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="apeMat" class="control-label">{{'Apellido Materno'}}</label>
    <input type="text" class="form-control {{$errors->has('Apellido Materno')?'is-invalid':''}}" name="apeMat" id="apeMat" value="{{ isset($empleados->apeMat)?$empleados->apeMat:'' }}">
    {!! $errors->first('Apellido Materno','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <label for="correo" class="control-label">{{'Correo'}}</label>
    <input type="email" class="form-control {{$errors->has('Correo')?'is-invalid':''}}" name="correo" id="correo" value="{{ isset($empleados->correo)?$empleados->correo:'' }}">
    {!! $errors->first('Correo','<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group">
    <div>
        <label for="foto" class="control-label" >{{'Foto'}}</label>
        @if(isset($empleados->foto))
    </div>
    <div>
        <img src="{{ asset('storage').'/'.$empleados->foto}}" alt="" width="200" class="img-thumbnail img-fluid"> 
    </div>
    @endif
    <input type="file" class="form-control {{$errors->has('Foto')?'is-invalid':''}}" name="foto" id="foto" value="">
    {!! $errors->first('Foto','<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
    <input type="submit" class = "btn btn-success" style="margin-top: 1em" value="{{$Modo == 'crear' ? 'Agregar':'Editar'}}">
    <a href="{{ url('empleados') }}" style="margin-top: 1em" class = "btn btn-primary">Regresar</a>
</div>