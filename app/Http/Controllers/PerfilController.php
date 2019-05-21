<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\PerfilModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class PerfilController extends Controller
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
    
        
    //Primera funció que controla si l'usuari es la primera vegada que edita el perfil
    public function comprobarPerfil($error =" "){
        
        //Comprovem la existencia de la configuracio del perfil, si no n'hi ha li fem crear
        $id_usuari = Auth::user()->id;
        $nom = Auth::user()->name;
        $nom = ucfirst($nom);
        
        $dades = ['nom' => $nom, 'id' => $id_usuari, 'error' => $error];
        
        $existencia = PerfilModel::mirar_perfil($id_usuari);
        
        if ($existencia == NULL){
            //Carreguem una vista per preguntar-li les dades
            return view('primerPerfil')->with('dades', $dades);
        }else{return $this->pintarPerfil($id_usuari);}
        
    }
    
    //Funcio que rebra per ajax l'estacio a la que pertany l'usuari
    public function ajax_subestacio(Request $request){
        if($request->isMethod('post')){
            $data = Input::json()->all();
            $estacio = $data['estacio'];
            
            //Retornem les 3 subestacions de l'estacio que ha arribat per a que pugui seleccionar l'usuari     
            $subestacions = PerfilModel::obtenir_subestacions($estacio);
            echo '<div class="check_amagat"><label>Eres la estación '.$estacio.'! Escoge tu Combinación Perfecta</label></div>';
            for ($i=0; $i<count($subestacions);$i++){
                echo '<div class="check_amagat"><input type="radio" name="subestacio" value="'.$subestacions[$i]->subestacio.'" id="'.$subestacions[$i]->id.'" class="input-hidden" />
                        <label for="'.$subestacions[$i]->id.'">
                            <img id="'.$subestacions[$i]->id.'" src="data:image/jpeg; base64,'.base64_encode($subestacions[$i]->foto).'">
                        </label>
                      </div>';
            }
        }
    }
    
    //Funcio que rebra les dades del primer perfil
    public function dades_primerPerfil(Request $request){
        
        if($request->isMethod('post')){
            $data = $request->all();
            
            if (! isset($data['subestacio'])){
                $error = "IdentityEYE necesita saber tu subestación, seleccionala!";
                return $this->comprobarPerfil($error);
            }else{
                $dades = array();
                array_push($dades, $data);          
                //Fiquem les dades rebudes dins de l'array i l'enviem al model
                array_push($dades, Auth::user()->id);
                if ($_FILES['foto_perfil']['type'] == "image/jpeg" || $_FILES['foto_perfil']['type'] == "image/png"){
                    $request->file('foto_perfil')->store('fotos_perfils');
                    array_push($dades, $request->file('foto_perfil')->hashName() );
                    $estat = PerfilModel::inserirDadesPrimerPerfil($dades);
                    return redirect('perfil');
                }else{
                    return $this->comprobarPerfil($error = "El Formato de la Imagen es Incorrecto!");
                }
            }
        }
    }
    
    //Funcio que pintara els perfils
    public function pintarPerfil($id = 1){
        $dadesUsuari = PerfilModel::obtenir_dadesUsuari($id);
        $dadesConfiguracio = PerfilModel::obtenir_dadesConfiguracio($id);
        $dadesEstacions = array();
        $nomSubestacio = PerfilModel::obtenir_Estacio($dadesConfiguracio->estacio);
        $nomEstacio = PerfilModel::obtenir_Subestacio($dadesConfiguracio->subestacio);
        $nomRol = PerfilModel::obtenir_rol($id);
        array_push($dadesEstacions, $nomEstacio);
        array_push($dadesEstacions, $nomSubestacio);
        array_push($dadesEstacions, $nomRol);
        
        $dades = ['dadesUsuari' => $dadesUsuari, 'dadesConfiguracio' => $dadesConfiguracio, 'dadesEstacions' => $dadesEstacions]; 
        
        return view('perfil')->with('dades', $dades);
    }
    
    //Funcio que buscara els perfils a la BD
    public function buscarPerfil(){
        return view('buscarPerfil');
    }
    
    //Funcio que rebra les dades del buscador
    public function ajax_buscador(Request $request){
        $data = Input::json()->all();
        $es_admin = PerfilModel::saber_si_es_admin($data['id']);
        $dades = PerfilModel::obtenir_Usuaris_i_Configuracions_Rols();
        
        //Consultem el Nick Nom Cognoms Poblacio Ofici
        
        
        for ($j=0; $j<count($dades); $j++){
            if ($es_admin){
                if ($dades[$j]->role_id == 1){
                    echo "<tr class='td_usuari'><td><img class='img_cercador' src=".URL::asset('img/fotos_perfils/'.$dades[$j]->foto_perfil)."/></td><td>".$dades[$j]->name."</td><td>".$dades[$j]->nom."</td><td>".$dades[$j]->cognoms."</td><td>".$dades[$j]->poblacio."</td><td>".$dades[$j]->ofici."</td><td>Administrador</td><td><div><a href='".url("/perfil/{$dades[$j]->id}")."'><button class='btn btn-primary botons-usuaris'><span class='glyphicon glyphicon-eye-open'></button></a></div></td><td><div><a href='".url("/editarPerfilAjax/{$dades[$j]->id}")."'><button class='btn btn-warning botons-usuaris'><span class='glyphicon glyphicon-edit'></button></a></div></td><td><div><button id='btn_eliminarPerfil' class='btn btn-danger botons-usuaris' data-id='".$dades[$j]->id."'><span class='glyphicon glyphicon-remove'></button></div></td></tr>";
                }else{
                    echo "<tr class='td_usuari'><td><img class='img_cercador' src=".URL::asset('img/fotos_perfils/'.$dades[$j]->foto_perfil)."/></td><td>".$dades[$j]->name."</td><td>".$dades[$j]->nom."</td><td>".$dades[$j]->cognoms."</td><td>".$dades[$j]->poblacio."</td><td>".$dades[$j]->ofici."</td><td>Usuario</td><td><div><a href='".url("/perfil/{$dades[$j]->id}")."'><button class='btn btn-primary botons-usuaris'><span class='glyphicon glyphicon-eye-open'></button></a></div></td><td><div><a href='".url("/editarPerfilAjax/{$dades[$j]->id}")."'><button class='btn btn-warning botons-usuaris'><span class='glyphicon glyphicon-edit'></button></a></div></td><td><div><button id='btn_eliminarPerfil' class='btn btn-danger botons-usuaris' data-id='".$dades[$j]->id."'><span class='glyphicon glyphicon-remove'></button></div></td></tr>";
                    
                }
            }else{
                if ($dades[$j]->role_id == 1){
                    echo "<tr class='td_usuari'><td><img class='img_cercador' src=".URL::asset('img/fotos_perfils/'.$dades[$j]->foto_perfil)."/></td><td>".$dades[$j]->name."</td><td>".$dades[$j]->nom."</td><td>".$dades[$j]->cognoms."</td><td>".$dades[$j]->poblacio."</td><td>".$dades[$j]->ofici."</td><td>Administrador</td><td><div><a href='".url("/perfil/{$dades[$j]->id}")."'><button class='btn btn-primary botons-usuaris'><span class='glyphicon glyphicon-eye-open'></button></a></div></td><td></td><td></td></tr>";
                }else{
                    echo "<tr class='td_usuari'><td><img class='img_cercador' src=".URL::asset('img/fotos_perfils/'.$dades[$j]->foto_perfil)."/></td><td>".$dades[$j]->name."</td><td>".$dades[$j]->nom."</td><td>".$dades[$j]->cognoms."</td><td>".$dades[$j]->poblacio."</td><td>".$dades[$j]->ofici."</td><td>Usuario</td><td><div><a href='".url("/perfil/{$dades[$j]->id}")."'><button class='btn btn-primary botons-usuaris'><span class='glyphicon glyphicon-eye-open'></button></a></div></td><td></td><td></td></tr>";
                }
            }
            /**/
            
            
        }
    }
    
    //Funcio que pintara els perfils dels usuaris de la taula buscar perfils
    public function buscarPerfilConcret($id){
        $existencia = PerfilModel::mirar_perfil($id);
        if ($existencia == NULL){
            return redirect('perfil');
        }else{return $this->pintarPerfil($id); }
    }
    
    //Funcio que editara l'usuari actual
    public function editarPerfil($error =" "){
        $id = Auth::user()->id;
        $dadesUsuari = PerfilModel::obtenir_dadesUsuari($id);
        $dadesConfiguracio = PerfilModel::obtenir_dadesConfiguracio($id);
        $dadesEstacions = array();
        $nomSubestacio = PerfilModel::obtenir_Estacio($dadesConfiguracio->estacio);
        $nomEstacio = PerfilModel::obtenir_Subestacio($dadesConfiguracio->subestacio);
        array_push($dadesEstacions, $nomEstacio);
        array_push($dadesEstacions, $nomSubestacio);
        
        $dades = ['error' => $error, 'dadesUsuari' => $dadesUsuari, 'dadesConfiguracio' => $dadesConfiguracio, 'dadesEstacions' => $dadesEstacions]; 
        
        return view('editarPerfil')->with('dades', $dades);
    }
    
    //Funcio que rebra les dades d'editar el perfil
    public function dades_editarPerfil(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            if (! isset($data['subestacio'])){
                $error = "IdentityEYE necesita saber tu subestación, seleccionala!";
                
                if ($data['id'] == Auth::user()->id){
                   return $this->editarPerfil($error); 
                }else{
                   return $this->editarPerfilAjax($data['id'], $error);
                }
                
            }else{
                $dades = array();
                array_push($dades, $data);
                            
                //Fiquem les dades rebudes dins de l'array i l'enviem al model
                array_push($dades, $data['id']);
                if (isset($data['foto_perfil'])){
                    if ($_FILES['foto_perfil']['type'] == "image/jpeg" || $_FILES['foto_perfil']['type'] == "image/png"){
                        $request->file('foto_perfil')->store('fotos_perfils');
                        array_push($dades, $request->file('foto_perfil')->hashName() );
                    }else{
                        return $this->editarPerfil($error = "El Formato de la Imagen es Incorrecto!");
                    }                   
                    
                }
                $estat = PerfilModel::actualitzarDadesPerfil($dades);
                return redirect('perfil');
            }
        }
    }
    
    //Funcio que rebra les dades per editar el usuari del buscador d'usuaris
    function editarPerfilAjax($id, $error = " "){
        $es_admin = PerfilModel::saber_si_es_admin(Auth::user()->id);
        if ($es_admin){
            $dadesUsuari = PerfilModel::obtenir_dadesUsuari($id);
            $dadesConfiguracio = PerfilModel::obtenir_dadesConfiguracio($id);
            $dadesEstacions = array();
            $nomSubestacio = PerfilModel::obtenir_Estacio($dadesConfiguracio->estacio);
            $nomEstacio = PerfilModel::obtenir_Subestacio($dadesConfiguracio->subestacio);
            array_push($dadesEstacions, $nomEstacio);
            array_push($dadesEstacions, $nomSubestacio);

            $dades = ['error' => $error, 'dadesUsuari' => $dadesUsuari, 'dadesConfiguracio' => $dadesConfiguracio, 'dadesEstacions' => $dadesEstacions]; 

            return view('editarPerfil')->with('dades', $dades);
        }else{
            return redirect('perfil');
        }
        
    }
    
    //Funcio que rebra les dades d'eliminar usuaris
    public function ajax_eliminar(Request $request){
        $data = Input::json()->all();
        $estat = PerfilModel::eliminarUsuari($data['id']);
        echo $estat;
    }
}
