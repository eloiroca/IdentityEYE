<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\PerfilModel;
use App\Http\Models\GeneradorModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class GeneradorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    //Funcio que imprimira per pantalla la configuracio establerta del configurador segons la seva subestacio
    public function generadorConfigurador($config = "combinador"){
            
            //Mirem si te creat el perfil per fer-li configurar
            $existencia = PerfilModel::mirar_perfil(Auth::user()->id);
            
            $id_usuari = Auth::user()->id;
            $nom = Auth::user()->name;
            $nom = ucfirst($nom);
            $error = "Tienes que configurar el perfil para ver la ropa";
            $dades = ['nom' => $nom, 'id' => $id_usuari, 'error' => $error];
            
            if ($existencia == NULL){
                //Carreguem una vista per preguntar-li les dades
                return view('primerPerfil')->with('dades', $dades);
            }else{
       
                //Recuperem els colors que li pertoquen a l'usuari
                $id_subestacio = PerfilModel::obtenir_dadesConfiguracio(Auth::user()->id);
                $dades_subestacio = PerfilModel::obtenir_Subestacio($id_subestacio->subestacio);
                $colors = GeneradorModel::obtenir_Colors($id_subestacio->subestacio);

                //Creem la cookie amb els colors per tal que la recuperi quan lusuari miri la roba
                $array_colors = array ();


                for ($i=0; $i<count($colors); $i++){
                    array_push($array_colors, $colors[$i]->color);  
                }
                $this->grabar_cookieColors($array_colors);
                if ($config  == "combinador"){
                    $dades = ['colors' => $colors, 'dades_subestacio' => $dades_subestacio]; 
                    return view('generadorConfigurador')->with('dades', $dades);
                }else{
                    return redirect('generarRoba');
                }
            }
    }
    
    //Funcio que rebra els colors que ha configurat l'usuari i grabara la cookie amb els nous colors
    public function dades_editarColors(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            if (isset($data['array_checkbox'])){
                $this->grabar_cookieColors($data['array_checkbox']);
                return redirect('generarRoba');
            }else{
                return redirect('generadorConfigurador');
            }
            
            
        }
    }
    
    //Funcio que grabara cookie amb els colors del usuari
    public function grabar_cookieColors($colors){
        if (isset($_COOKIE['cookie_colors_'.Auth::user()->name])){
            setcookie('cookie_colors_'.Auth::user()->name,'',time()-100);
            setcookie('cookie_colors_'.Auth::user()->name, serialize($colors), time()+3600);
        }else{
            setcookie('cookie_colors_'.Auth::user()->name, serialize($colors), time()+3600);
        }
    }
    
    //Funcio que pintara la roba segons els colors que ha triat l'usuari
    public function generarRoba(){
        //Mirem si te creat el perfil per fer-li configurar
        $existencia = PerfilModel::mirar_perfil(Auth::user()->id);
        
        if ($existencia == NULL){
            //Carreguem una vista per preguntar-li les dades
            return $this->generadorConfigurador($config = "no");
        }else{
            if (isset($_COOKIE['cookie_colors_'.Auth::user()->name])){
                $data = unserialize($_COOKIE['cookie_colors_'.Auth::user()->name]);
                //Realitzarem la consulta segons la Cookie de l'usuari i el seu genero
                $usuari = PerfilModel::obtenir_dadesConfiguracio(Auth::user()->id);
                $roba = GeneradorModel::obtenirRoba($data, $usuari->genere);

                $dades = ['roba' => $roba, 'colors' => $data]; 
                return view('generadorRoba')->with('dades', $dades);

            }else{
                return $this->generadorConfigurador($configurat="si");
            }
        }
    }
    
    //Funcio que pintara dos peces de roba random
    public function generarCombinacio(){
        $existencia = PerfilModel::mirar_perfil(Auth::user()->id);
        
        if ($existencia == NULL){
            //Carreguem una vista per preguntar-li les dades
            return $this->generadorConfigurador($config = "combinador");
        }else{
            if (isset($_COOKIE['cookie_colors_'.Auth::user()->name])){
                $data = unserialize($_COOKIE['cookie_colors_'.Auth::user()->name]);
                //Realitzarem la consulta segons la Cookie de l'usuari i el seu genero
                $usuari = PerfilModel::obtenir_dadesConfiguracio(Auth::user()->id);
                $roba = GeneradorModel::obtenirCombinacio($data, $usuari->genere);

                $dades = ['roba' => $roba, 'colors' => $data]; 
                return view('generadorCombinacio')->with('dades', $dades);

            }else{
                return $this->generadorConfigurador($configurat="si");
            }
        }
    }
    
    //Funcio que guardara a la base de dades la combinacio actual de l'usuari
    public function dades_afegirCombinacio(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $array_dades = array ();
            
            array_push($array_dades, Auth::user()->id);
            array_push($array_dades, $data['id_roba0']);
            array_push($array_dades, $data['id_roba1']);
            
            $estat = GeneradorModel::guardarCombinacio($array_dades);
            return redirect('combinacions');
        }
    }
    
    //Funcio que imprimira les combinacions del úsuari connectat
    public function combinacions(){
        $roba = GeneradorModel::obtenirCombinacions(Auth::user()->id);
        $dades = ['roba' => $roba]; 
        return view('combinacions')->with('dades', $dades);
    }
    
    //Funcio que eliminara la combinacio del usuari
    public function ajax_eliminarCombinacio(Request $request){
        $data = Input::json()->all();
        $id_usuari = Auth::user()->id;
        $estat = GeneradorModel::eliminarCombinacio($id_usuari, $data['id1'], $data['id2']);
        if ($estat == 1){
            return "S'ha eliminat correctament la combinació";
        }else{
            return "Hi ha hagut un error al intentar eliminar la combinació";
        }
    }
    
}
