<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class PerfilModel extends Model
{
    //Funcio que mirara si hi ha una configuracio per l'usuari actual, si no hi és li farem crear
    public static function mirar_perfil($perfil){       
        $user = DB::table('configuracions')->where('id_usuari', $perfil)->first();
        return $user;
    }
    
    //Funcio que obtindra les subestacions d'una estacio
    public static function obtenir_subestacions($estacio){
        $id_estacio = DB::table('estacions')->where('estacio', $estacio)->first()->id;
        
        $subestacions = DB::table('subestacions')->where('id_estacio', $id_estacio)->get();
        return $subestacions;
    }
    
    //Funcio que inserira la primera configuracio de l'usuari
    public static function inserirDadesPrimerPerfil($dades){
        $id_estacio = DB::table('subestacions')->where('subestacio', $dades[0]['subestacio'])->first()->id_estacio;
        $id_subestacio = DB::table('subestacions')->where('subestacio', $dades[0]['subestacio'])->first()->id;
        DB::table('configuracions')->insert(
            ['id_usuari' => $dades[1], 'nom' => ''.$dades[0]['nom'].'','cognoms' => ''.$dades[0]['cognoms'].'','genere' => ''.$dades[0]['genero'].'', 'nif' => ''.$dades[0]['dni'].'', 'data_naix' => ''.$dades[0]['fecha'].'', 'ofici' => ''.$dades[0]['ofici'].'', 'poblacio' => ''.$dades[0]['poblacion'].'', 'foto_perfil' => ''.$dades[2].'', 'estacio' => $id_estacio, 'subestacio' => $id_subestacio, 'tonal_pell' => ''.$dades[0]['tonal_pell'].'', 'tonal_pel' => ''.$dades[0]['tonal_pel'].'']
        );
    }
    
    //Funcio que retornara la informacio de la taula configuració
    public static function obtenir_dadesUsuari($id){
        $user = DB::table('users')->where('id', $id)->first();
        return $user;
    }
    
    //Funcio que retornara la informacio de la taula usuari
    public static function obtenir_dadesConfiguracio($id){
        $user = DB::table('configuracions')->where('id_usuari', $id)->first();
        return $user;
    }
    
    //Funcio que retornara el nom de l'estacio a partir d'un id
    public static function obtenir_Estacio($id){
        $estacio = DB::table('estacions')->where('id', $id)->get();
        return $estacio;
    }
            
    //Funcio que retornara el nom de la sunestacio a partir d'un id
    public static function obtenir_Subestacio($id){
        $subestacio = DB::table('subestacions')->where('id', $id)->get();
        return $subestacio;
    }
    
    //Funcio que retornara la descripcio del rol mitjançant un id d'usuari
    public static function obtenir_rol($id){
        $rol = DB::table('role_user')->where('user_id', $id)->get();
        $nom_rol = DB::table('roles')->where('id', $rol[0]->role_id)->get(); 
        return $nom_rol;
    }
    
    //Funcio que retornara tots els usuaris de la BD
    public static function obtenir_Usuaris_i_Configuracions_Rols(){
        $users = DB::table('users')
            ->select('users.id' ,'configuracions.foto_perfil', 'users.name', 'configuracions.nom', 'configuracions.cognoms', 'configuracions.poblacio', 'configuracions.ofici', 'role_user.role_id' )
            ->join('configuracions', 'configuracions.id_usuari', '=', 'users.id')
            ->join('role_user', 'role_user.user_id', '=', 'configuracions.id_usuari')
            ->get();
        return $users;
    }
    
    //Funcio que actualitzara les dades del perfil
    public static function actualitzarDadesPerfil($dades){
        
        //Obtenim id de l'estacio i de la subestacio per actualitzar-lo
        $id_estacio = DB::table('subestacions')->where('subestacio', $dades[0]['subestacio'])->first()->id_estacio;
        $id_subestacio = DB::table('subestacions')->where('subestacio', $dades[0]['subestacio'])->first()->id;
        
        if(isset($dades[0]['foto_perfil']) && isset($dades[0]['contrasenya'])){
            $password = bcrypt($dades[0]['contrasenya']);
            DB::table('users')
              ->where('id', $dades[1])
              ->update(['password' => $password]);
            DB::table('configuracions')
              ->where('id_usuari', $dades[1])
              ->update(['nom' => $dades[0]['nom'], 'cognoms' => $dades[0]['cognoms'], 'nif' => $dades[0]['dni'], 'data_naix' => $dades[0]['fecha'], 'poblacio' => $dades[0]['poblacion'], 'foto_perfil' => $dades[2], 'ofici' => $dades[0]['ofici'], 'genere' => $dades[0]['genero'], 'tonal_pell' => $dades[0]['tonal_pell'], 'tonal_pel' => $dades[0]['tonal_pel'], 'estacio' => $id_estacio, 'subestacio' => $id_subestacio]);
        }else if(isset($dades[0]['foto_perfil']) && !isset($dades[0]['contrasenya'])){
            DB::table('configuracions')
              ->where('id_usuari', $dades[1])
              ->update(['nom' => $dades[0]['nom'], 'cognoms' => $dades[0]['cognoms'], 'nif' => $dades[0]['dni'], 'data_naix' => $dades[0]['fecha'], 'poblacio' => $dades[0]['poblacion'], 'foto_perfil' => $dades[2], 'ofici' => $dades[0]['ofici'], 'genere' => $dades[0]['genero'], 'tonal_pell' => $dades[0]['tonal_pell'], 'tonal_pel' => $dades[0]['tonal_pel'], 'estacio' => $id_estacio, 'subestacio' => $id_subestacio]);        
        }else if(!isset($dades[0]['foto_perfil']) && isset($dades[0]['contrasenya'])){
            DB::table('users')
              ->where('id', $dades[1])
              ->update(['password' => $password]);
            DB::table('configuracions')
              ->where('id_usuari', $dades[1])
              ->update(['nom' => $dades[0]['nom'], 'cognoms' => $dades[0]['cognoms'], 'nif' => $dades[0]['dni'], 'data_naix' => $dades[0]['fecha'], 'poblacio' => $dades[0]['poblacion'], 'ofici' => $dades[0]['ofici'], 'genere' => $dades[0]['genero'], 'tonal_pell' => $dades[0]['tonal_pell'], 'tonal_pel' => $dades[0]['tonal_pel'], 'estacio' => $id_estacio, 'subestacio' => $id_subestacio]);
        }else{
            DB::table('configuracions')
              ->where('id_usuari', $dades[1])
              ->update(['nom' => $dades[0]['nom'], 'cognoms' => $dades[0]['cognoms'], 'nif' => $dades[0]['dni'], 'data_naix' => $dades[0]['fecha'], 'poblacio' => $dades[0]['poblacion'], 'ofici' => $dades[0]['ofici'], 'genere' => $dades[0]['genero'], 'tonal_pell' => $dades[0]['tonal_pell'], 'tonal_pel' => $dades[0]['tonal_pel'], 'estacio' => $id_estacio, 'subestacio' => $id_subestacio]);
        }       
        
    }
    
    //Funcio que retornara si es admin o no segon el id
    public static function saber_si_es_admin($id){
        $user = DB::table('role_user')->where('user_id', $id)->first();
        if ($user->role_id == 1){return True;}
        else if($user->role_id == 2){return False;}
    }
    
    //Funcio que eliminara l'usuari de la BD
    public static function eliminarUsuari($id){
        DB::table('users')->where('id', $id)->delete();
        DB::table('configuracions')->where('id_usuari', $id)->delete();
    }
}
