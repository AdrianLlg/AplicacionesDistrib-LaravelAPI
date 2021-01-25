<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Mascotas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ClientesController extends Controller
{

    public function fillInfo(Request $request)
    {
        $nomb_ape = $request->NombresApellidos;
        $CI = $request->Cedula;
        $lat = $request->Latitud;
        $long = $request->Longitud;
        $n_mascota = $request->NombreMascota;
        $especie = $request->Especie;
        $generoMasc = $request->GeneroMascota;
        $flag = 0;
        $dataCli = ['nombres_apellidos' => $nomb_ape, 'cedula' => $CI, 'latitud' => $lat, 'longitud' => $long];
        
    if($nomb_ape && $lat && $long && $n_mascota && $especie && $generoMasc && $CI != null){
        
        $msg = 'Informacion recibida correctamente';
        $existsClient = DB::table('clientes')->where('cedula','LIKE', $CI)->first();

        if (empty($existsClient))
        {
            Clientes::insert($dataCli);
            $logClientCI = $CI;
            $flag = 1;
        }else {

           $queryClient= DB::table('clientes')->select('id_Cliente')->where('cedula','LIKE', $CI)->pluck('id_Cliente');
           $id_Cliente = $queryClient->first();
           $existsMasc = DB::table('mascotas')->where('nombre_mascota','LIKE', $n_mascota)->where('especie','LIKE', $especie)->where('genero','LIKE', $generoMasc)->where('id_cliente','=', $id_Cliente)->first();

           if(empty($existsMasc)){
               $dataMasc = ['nombre_mascota' => $n_mascota, 'especie' => $especie, 'genero' => $generoMasc, 'id_cliente' => $id_Cliente];
               Mascotas::insert($dataMasc);
               $queryExtractID = DB::table('mascotas')->where('nombre_mascota','LIKE', $n_mascota)->where('especie','LIKE', $especie)->where('genero','LIKE', $generoMasc)->where('id_cliente','=', $id_Cliente)->pluck('id_mascota');
               $ID_Masc = $queryExtractID->first();

               DB::table('clientes')->where('id_Cliente','=', $id_Cliente)->update(['longitud' => $long, 'latitud' => $lat]);
           }else{
                $queryExtractID = DB::table('mascotas')->where('nombre_mascota','LIKE', $n_mascota)->where('especie','LIKE', $especie)->where('genero','LIKE', $generoMasc)->where('id_cliente','=', $id_Cliente)->pluck('id_mascota');
                $ID_Masc = $queryExtractID->first();
                DB::table('clientes')->where('id_Cliente','=', $id_Cliente)->update(['longitud' => $long, 'latitud' => $lat]);
           }
           $flag = 0;
        }
        $comprob = 'Informacion procesada correctamente';
    }else{
        $comprob = 'Verificar la informacion ingresada';
        $msg = 'Algun campo se encuentra vacio';
    }

    if($flag == 1){
      
        $clientID2= DB::table('clientes')->select('id_Cliente')->where('cedula','LIKE', $logClientCI)->pluck('id_Cliente');
        $id_Cliente2 = $clientID2->first();

        $verifyMasc = DB::table('mascotas')->where('nombre_mascota','LIKE', $n_mascota)->where('especie','LIKE', $especie)->where('genero','LIKE', $generoMasc)->where('id_cliente','=', $id_Cliente2)->first();

        if(empty($verifyMasc)){

            $dataMasc2 = ['nombre_mascota' => $n_mascota, 'especie' => $especie, 'genero' => $generoMasc, 'id_cliente' => $id_Cliente2];
            Mascotas::insert($dataMasc2);

            $queryExtractID = DB::table('mascotas')->where('nombre_mascota','LIKE', $n_mascota)->where('especie','LIKE', $especie)->where('genero','LIKE', $generoMasc)->where('id_cliente','=', $id_Cliente2)->pluck('id_mascota');
            $ID_Masc = $queryExtractID->first();
            DB::table('clientes')->where('id_Cliente','=', $id_Cliente2)->update(['longitud' => $long, 'latitud' => $lat]);
        }else{
            $queryExtractID = DB::table('mascotas')->where('nombre_mascota','LIKE', $n_mascota)->where('especie','LIKE', $especie)->where('genero','LIKE', $generoMasc)->where('id_cliente','=', $id_Cliente2)->pluck('id_mascota');
            $ID_Masc = $queryExtractID->first();
            DB::table('clientes')->where('id_Cliente','=', $id_Cliente2)->update(['longitud' => $long, 'latitud' => $lat]);
        }
    }

        return json_encode(array(
            'status' => 200,
            'response'  => $msg,
            'Info' => $comprob,
            'ID Mascota' => $ID_Masc
        ));
        // return json_encode(array(
        //     'Response' => $existsClient));
    }

    public function sendData($id){

        try{
            $info_Mascota = Mascotas::findOrFail($id);
            $ident_Cli = $info_Mascota->id_cliente;
    
            $info_Cliente = Clientes::findOrFail($ident_Cli);
    
            $Info = "{$info_Mascota} {$info_Cliente}";

            return $Info;

        }catch(Throwable $e){
            $e = 'verifica que la informacion sea la correcta';
            $Info = 'Vacio';
        }
        
        return json_encode(array(
            'status' => 200,
            'response'  => $e,
            'Info' => $Info
        ));
    }
}
