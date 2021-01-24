@extends('layouts.app')

@section('content')

    <div class="container"> 
        <div class="content">
            <h2>Agregar información al Cliente</h2>
            <br>
            <form action="{{url('/clientes/'.$cliente->id_cliente)}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{method_field('PATCH')}}
                    <div class="form-group">
                        <label class="control-label" for="nombres">Nombres</label>
                        <input class="form-control" type="text" name="nombres" id="nombres" required pattern="[Aa-Zz]" value="{{$cliente->nombres}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="apellidos">Apellidos</label>
                        <input class="form-control" type="text" name="apellidos" id="apellidos" required pattern="[Aa-Zz]" value="{{$cliente->apellidos}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="cedula">Cedula</label>
                        <input class="form-control" type="text" name="cedula" id="cedula" required pattern="[0-9]{10}" value="{{$cliente->cedula}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="telefono">Telefono</label>
                        <input class="form-control" type="text" name="telefono" id="telefono" required pattern="[0-9]{10}" value="{{$cliente->telefono}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="id_user">Usuario Vinculado</label>
                            <select name="id_user" class="form-control" disabled>
                                @foreach ($users as $user) 
                                    @if($cliente->id_user == $user->id)
                                        <option value="{{$user->id}}"> {{$user->name}} </option>
                                    @endif
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="id_postalcode">Direccion</label>
                            <select name="id_postalcode" class="form-control" required>
                                <option value=""> -- Seleccionar Direccion --</option>
                                @foreach($pcodes as $pcode)
                                    <option value="{{ $pcode->id_codigopostal }}">
                                        {{ $pcode->lugar }}
                                    </option>
                                @endforeach
                            </select>
                    </div>

                    <a href="{{route('clientes.index')}}" class="btn btn-danger" role="button">Cancel</a>
                    <input class="btn btn-success" type="submit" value="Agregar Informacion">

             </form>
        </div>
    </div>
@endsection