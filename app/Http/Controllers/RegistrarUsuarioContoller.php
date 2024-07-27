<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuarios;

class RegistrarUsuarioContoller extends Controller
{
    function validarUsuario_Existe(Request $request){
        //dd("Hola", $request->Email);
        $CountUser = DB::table('tbl_users')->where('email',$request->Email)->get();
        $CountUser = count($CountUser);
        //$CountUser = 0;
        return $CountUser;
    }

    function GuardarContacto(request $request){
        //dd($request->all());
        $saveUser = new Usuarios\users();
        $saveUser->Nombres = trim($request->NombreUsuario);
        $saveUser->email = trim($request->email);
        $saveUser->password_1 = trim($request->pass1);
        $saveUser->password_2 = trim($request->pass2);
        $saveUser->save();
    }
    
}
