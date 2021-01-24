{{-- @include('layouts.partials.head') --}}

@extends('layouts.app')

@section('content')
    
    @if (session()->has('Msg')) 

    <div id="alert" class="col-3 col-sm-3 alert alert-style" role="alert">
        {{   session()->get('Msg')  }}    
        </div>

        <script>
            $('#alert').fadeIn();     
          setTimeout(function() {
               $("#alert").fadeOut();           
          },4000);
        </script>
    @endif

<div class="container">        
        <div class="client-container col-12 col-sm-12">
            <h2>Clientes Registrados</h2>
            <br>
            <div class="table-responsive">
                <table id="table-client" class="table tableClientes table-striped" border="1">
                        <thead class="thead-dark">
                            <tr>
                                {{-- <th>#</th> --}}
                                <th>Numero de Cliente</th>
                                <th>Usuario Vinculado</th>
                                <th>Nombres Cliente</th>
                                <th>Apellidos Cliente</th>
                                <th>Cedula</th>
                                <th>Telefono</th>
                                <th>Direccion (Postal Code)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    {{-- <td>{{$loop->iteration}}</td> --}}
                                    <td>{{$cliente->id_cliente}}</td>
                                    <td>
                                        @foreach ($users as $user) 
                                            @if($cliente->id_user == $user->id)
                                            {{$user->name}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$cliente->nombres}}</td>
                                    <td>{{$cliente->apellidos}}</td>
                                    <td>{{$cliente->cedula}}</td>
                                    <td>{{$cliente->telefono}}</td>
                                    <td>
                                        @foreach ($pcodes as $pcode) 
                                            @if($cliente->id_postalcode == $pcode->id_codigopostal)
                                            {{$pcode->lugar}} ({{$pcode->sector}})
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                            <button class="btn btn-primary btnActions btnCliAdd" onclick="location.href='{{url('/clientes/'.$cliente->id_cliente.'/edit')}}';">Agregar Informacion</button>
                                            <form action="{{url('/clientes/'.$cliente->id_cliente)}}" method="post">
                                                {{ csrf_field() }}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-danger btnActions" type="submit" onclick="return confirm('Esta seguro de Borrar?');">Delete</button>
                                            </form>
                                    </td>
                                </tr> 
                            @endforeach
                        </tbody>
                </table>
                {{$clientes->links()}}
            </div>
        </div>
</div>
@endsection