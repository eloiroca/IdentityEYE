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
      <h1 id="titol_novetats"><img src="{{ URL::asset('img/contingut/anadir.png') }}" alt="rss_dreta"/> Añadir Próxima Moda <img src="{{ URL::asset('img/contingut/anadir.png') }}" alt="rss_esquerra"/> </h1>
  </div>
</div>


<div id="afegirModes_Cos" class="panel panel-primary">
    <div class="panel-body">
        <form action="{{ url('dades_proximaModa') }}" method="POST" enctype="multipart/form-data" name="formulari" accept-charset="utf-8">
            <div id="cos_afegir_moda" class="col-md-8">
                <div class="panel panel-primary">
                    

                    <div class="panel-body">
                        <div class="form-group row">
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <?php if ($dades['error'] != " "){
                                echo "<div class='alert alert-danger' role='alert'>
                                        <strong>Tenemos un problema! </strong>".$dades['error']."</a>
                                      </div>";
                            }?>
                            <label class="label_moda" for="example-date-input" class="col-form-label">Titular</label>
                            <div class="col-2-edit">
                                <input id="input_titular" class="form-control input" type="text" name="titular" required>
                            </div>
                            {!! csrf_field() !!}
                            
                            
                            
                            <label class="label_moda" for="example-date-input" class="col-form-label">Descripción</label>
                            <div id="textarea" class="col-2-edit">
                                <textarea class="textarea" name="descripcio" required></textarea>
                            </div>
                            
                            <div class="col-2-edit">
                                <div class="col-sm-6">
                                    <label class="label_moda div_upload_gran" for="example-date-input" class="col-form-label">Imagen Destacada</label>
                                    <div id="div_upload" class="upload-btn-wrapper">
                                    <button id="bt_upload" class="btno">Subir Archivo</button>
                                    <input type="file" name="foto_destacada" required/>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" id="boto_publicar" class="btn btn-success">Publicar</button>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
