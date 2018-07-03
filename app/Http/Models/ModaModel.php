<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class ModaModel extends Model
{
    //Funcio que insertara la nova moda a la BD
    public static function inserirProximaModa($dades){
        DB::table('proximes_modes')->insert(
            ['id_usuari' => $dades[0]['id'], 'titol' => ''.$dades[0]['titular'].'','cos' => ''.$dades[0]['descripcio'].'','nom_imatge' => ''.$dades[1].'']
        );
    }
}
