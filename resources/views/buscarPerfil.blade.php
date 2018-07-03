@extends('layouts.app')

@section('sidebar')
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3 class="h3_sidebar">{{ ucfirst(Auth::user()->name) }}</h3> 
                
                    
            <strong>{{ Auth::user()->name }}</strong>
              
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="{{ url('') }}">
                    <i class="glyphicon glyphicon-home activat"></i>
                    Inicio
                </a>
            </li>
            <li  class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-user activat"></i>
                    Perfil
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li><a href="{{ route('perfil') }}">Tu Perfil</a></li>
                    <li><a href="{{ route('buscarPerfil') }}">Perfiles Identity</a></li>
                    <li><a href="{{ route('afegirProximaModa') }}">+ Próximas Modas</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('novetats') }}">
                    <i class="glyphicon glyphicon-send activat"></i>
                    Novedades
                </a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-link activat"></i>
                    Generador Identity
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li><a href="{{ route('generadorConfigurador') }}">Configurador Identity</a></li>
                    <li><a href="{{ route('generarRoba') }}">Generador de Ropa</a></li>
                    <li><a href="{{ route('generarCombinacio') }}">Combinación Aleatoria</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('combinacions') }}">
                    <i class="glyphicon glyphicon-duplicate activat"></i>
                    Combinación Guardada
                </a>
            </li>
            <li>
                <a href="{{ route('proximaModa') }}">
                    <i class="glyphicon glyphicon-briefcase activat"></i>
                    Próxima Moda
                </a>
            </li>
            
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
            © Copyright 2018 IdentityEYE
            </li>
        </ul>
    </nav>
@endsection

@section('content')

<div id="novetats" class="panel panel-primary">
  <div class="panel-body">
      <h1 id="titol_novetats"><img src="{{ URL::asset('img/contingut/lupa2_girat.png') }}" alt="rss_dreta"/> Buscador IdentityEYE <img src="{{ URL::asset('img/contingut/lupa2.png') }}" alt="rss_esquerra"/> </h1>
  </div>
</div>


<div id="perfil_cos" class="panel panel-primary">
    <div class="panel-body">
        <div class="input-group">
            <span class="input-group-addon">Buscar</span>
            <input id="filtrar" type="text" class="form-control" placeholder="Ingresa cualquier dato de la persona que quieres buscar ..."/>           
            
        </div> 
        
    </div>
</div>
<div id="perfil_cos" class="panel panel-primary">
    <div class="panel-body">
        
        <table id="taula_users" class="table table-striped">
            
             <tr class='td_usuari'>
              <th></th>  
              <th>Nick</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Población</th> 
              <th>Oficio</th>
              <th>Rol</th>
              <th></th>
              <th></th>
              <th></th>
             </tr>

            <tbody class="buscar">
               <!-- Usuaris de la BD amb ajax -->
                {!! csrf_field() !!}
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('scripts_baix')
    <script>
       
    </script>
@endsection