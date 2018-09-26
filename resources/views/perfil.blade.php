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
            <li class="active">
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
      <h1 id="titol_novetats"><img src="{{ URL::asset('img/contingut/icono_perfil.png') }}" alt="rss_dreta"/> Perfil <?php echo ucfirst($dades['dadesUsuari']->name) ?> <img src="{{ URL::asset('img/contingut/icono_perfil.png') }}" alt="rss_esquerra"/> </h1>
  </div>
</div>


<div id="perfil_cos" class="panel panel-primary">
    <div class="panel-body">
        <div id="dadesUsuari" class="col-md-6">
            <div id="div_foto">
                <img class='img_perfil2' src="{{ URL::asset('img/fotos_perfils/'.$dades['dadesConfiguracio']->foto_perfil) }}" alt="foto_perfil"/>
            </div>
            
            <div class="cos_dades">
                
                <div class="centrat"><b>Nick</b><p><?php echo $dades['dadesUsuari']->name ?></p>
                </div>
                <div class="centrat"><b>Rol</b><p><?php echo $dades['dadesEstacions'][2][0]->description ?></p></div>
                <div class="centrat"><b>Nombre</b> 
                <p ><?php echo ucfirst($dades['dadesConfiguracio']->nom) ?></p></div>
                <div class="centrat"><b>Apellidos</b> 
                <p ><?php echo ucfirst($dades['dadesConfiguracio']->cognoms) ?></p></div>
                <div class="centrat"><b>DNI</b> 
                <p><?php echo ucfirst($dades['dadesConfiguracio']->nif) ?></p></div>
                <div class="centrat"><b>Fecha Nacimiento</b> 
                <p><?php echo ucfirst($dades['dadesConfiguracio']->data_naix) ?></p></div>
                <div class="centrat"><b>Genero</b> 
                <p><?php echo ucfirst($dades['dadesConfiguracio']->genere) ?></p></div>
                <div class="centrat"><b>Población</b> 
                <p><?php echo ucfirst($dades['dadesConfiguracio']->poblacio) ?></p></div>
                <div class="centrat"><b>Oficio</b> 
                <p><?php echo ucfirst($dades['dadesConfiguracio']->ofici) ?></p></div>
            </div>
                               
        </div>
        <div id="dadesConfiguracio" class="col-md-6">
            <div id="div_foto"><img class="img_perfil" src="{{ URL::asset('img/contingut/gif_colors.gif') }}" alt="colors"/></div>
            <div class="cos_dades">
                
                
                <div class="centrat"><b>Tonalidad de la Piel</b> 
                <p><?php echo ucfirst($dades['dadesConfiguracio']->tonal_pell) ?></p></div>
                
                <div class="centrat"><b>Tonalidad del Pelo</b> 
                <p><?php echo ucfirst($dades['dadesConfiguracio']->tonal_pel) ?></p></div>
                
                <div class="centrat"><b>Estación</b> 
                <p><?php echo ucfirst($dades['dadesEstacions'][1][0]->estacio)?></p></div>
                
                <div class="centrat"> <b>Subestación</b> 
                <p><?php echo ucfirst($dades['dadesEstacions'][0][0]->subestacio)?></p>
                <?php echo "<img class='img_subestacio' src='data:image/jpeg; base64,".base64_encode($dades['dadesEstacions'][0][0]->foto)."'>";?></div>
                
               
                
            </div>
            <?php 
                if (Auth::user()->id == $dades['dadesUsuari']->id){
                    echo "<div id='div_botons'><button id='btn_editarPerfil' class='btn btn-warning'>Editar Perfil</button> <button id='btn_eliminarPerfil' class='btn btn-warning' data-id='".Auth::user()->id."'>Eliminar Perfil</button></div>";
                }
            ?>
        </div>
    </div>
</div>



@endsection
