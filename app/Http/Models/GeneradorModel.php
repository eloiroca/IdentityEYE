<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class GeneradorModel extends Model
{
    //Funcio que retornara la roba amb les dades de la cookie
    public static function obtenirRoba($colors, $genero){

        $where = "";
        for($i = 1; $i<count($colors); $i++){
            $where .= " or color = '".$colors[$i]."'";
        }
        $sql = "select * from roba where (genero = '".$genero."' AND (color = '".$colors[0]."'".$where."))";

        $roba = DB::select($sql, [1]);
        return $roba;
    }

    //Funcio que retornara una combinacio aleatoria
    public static function obtenirCombinacio($colors, $genero){

        $where = "";
        for($i = 1; $i<count($colors); $i++){
            $where .= " or color = '".$colors[$i]."'";
        }
        $sql = "select * from roba where (genero = '".$genero."' AND (color = '".$colors[0]."'".$where."))ORDER BY RAND() LIMIT 2";

        $roba = DB::select($sql, [1]);
        return $roba;
    }


    //Funcio que retornara la paleta de colors de l'usuari
    public static function obtenir_Colors($id){
        $colors = DB::table('paletes_colors')->where('id_subestacio', $id)->get();
        //where('id_subestacio', $id)->
        return $colors;
    }

    //Funcio que guardara la combinacio de l'usuari
    public static function guardarCombinacio($dades){
        DB::table('combinacions')->insert(
            ['id_usuari' => $dades[0], 'id_pesa1' => $dades[1] ,'id_pesa2' => $dades[2]]
        );
    }

    //Funcio que retornara les combinacions del usuari
    public static function obtenirCombinacions($id){
        $combinacions = DB::table('combinacions')->where('id_usuari', $id)->orderBy('id', 'desc')->get();
        $array_combinacions = array ();

        for ($i=0; $i<count($combinacions); $i++){
            $array_combinacions[$i][0] = DB::table('roba')->where('id', $combinacions[$i]->id_pesa1)->get();
            $array_combinacions[$i][1] = DB::table('roba')->where('id', $combinacions[$i]->id_pesa2)->get();
        }

        return $array_combinacions;
    }

    //Funcio que eliminara una combinacio de l'usuari
    public static function eliminarCombinacio($id0, $id1, $id2){
        return DB::table('combinacions')->where('id_usuari', $id0)->where('id_pesa1', $id1)->where('id_pesa2', $id2)->delete();
    }

    //Funcio que retornara la informacio del producte
    public static function obtenirPesa($id){
        $roba = DB::table('roba')->where('id', $id)->first();
        return $roba;
    }

    //FUncio que guardara el carrito a la base de dades de ASIX
    public static function guardarCarrito($dades_usuari, $dades_compra){
        //$roba = DB::table('roba')->where('id', $id)->first();
        //return $;
        $sql = "insert into comandesvenda (id_usuari, nom, cognoms, nif, genere, poblacio, foto_perfil, estat) values (".$dades_usuari->id_usuari.",'".$dades_usuari->nom."','".$dades_usuari->cognoms."','".$dades_usuari->nif."','".$dades_usuari->genere."', '".$dades_usuari->poblacio."', '".$dades_usuari->foto_perfil."', 'pendent')";
        $dades_comanda = DB::connection('mysql2')->insert($sql);
        //$mysqli = new mysqli('localhost', 'root', 'Informatica:1', 'monitornodeserver');
        echo $sql;
        echo '<pre>';
        print_r($dades_comanda);
        echo '</pre>';
        //echo $sql;
    }
}
