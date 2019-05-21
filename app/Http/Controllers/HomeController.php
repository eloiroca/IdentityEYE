<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\PerfilModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        //Si esta loggejat retornarem una altra vista
        if (Auth::check()){
            $id = Auth::user()->id;
            //Mirem si te la foto de perfil configurada, sino li fiquem una per defecte
            $existencia = PerfilModel::mirar_perfil($id);
        
            if ($existencia == NULL){
                //Carreguem una vista per preguntar-li les dades
                
                $foto = "NULL";
                $dades = ['dadesUsuari' => $foto];
                return view('identity')->with('dades', $dades);
            }else{
                $data = PerfilModel::obtenir_dadesConfiguracio($id);
                
                $dades = ['dadesUsuari' => $data];
                return view('identity')->with('dades', $dades);
            }
            
        }else{
            return view('home');
        }
        
    }
}
