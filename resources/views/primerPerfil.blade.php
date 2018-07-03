@extends('layouts.app')

@section('sidebar')
    <nav id="sidebar">
        <div class="sidebar-header">
            
            <h3 class="h3_sidebar">{{ ucfirst(Auth::user()->name) }}</h3><img class="img_sidebar" src="{{ URL::asset('img/contingut/usuari_perdefecte.png')}}">
                
                    
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
      <h1 id="titol_novetats"><img src="{{ URL::asset('img/contingut/icono_perfil.png') }}" alt="rss_dreta"/> Perfil <?php echo $dades['nom'] ?> <img src="{{ URL::asset('img/contingut/icono_perfil.png') }}" alt="rss_esquerra"/> </h1>
  </div>
</div>


<div id="novetats_cos">
    <div id="novetat_darrera" class="col-md-12">
        <div id="cos_primerPerfil" class="panel panel-primary">
            <div class="panel-body">
                <h2 class="h1_home">Configuración Inicial</h2>
                <hr class="hr_dreta">
                <form action="{{ url('dades_primerPerfil') }}" method="POST" enctype="multipart/form-data" name="form" accept-charset="utf-8">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><h4>Datos Personales</h4></div>
                            
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label for="example-date-input" class="col-form-label">Nombre</label>
                                    <div class="col-2-edit">
                                        <input class="form-control input" type="text" id="cognoms" name="nom" required>
                                    </div>
                                    <label for="example-date-input" class="col-form-label">Apellidos</label>
                                    <div class="col-2-edit">
                                        <input class="form-control input" type="text" id="cognoms" name="cognoms" required>
                                    </div>
                                    <label for="example-date-input" class="col-form-label">DNI</label>
                                    <div class="col-2-edit">
                                        <input class="form-control input" type="text" id="dni" name="dni" required>
                                    </div>
                                    <label for="example-date-input" class="col-form-label">Fecha Nacimiento</label>
                                    <div class="col-2-edit">
                                        <input class="form-control input" type="date" value="1997-07-13" name="fecha" id="fecha" required>
                                    </div>
                                    <label for="example-date-input" class="col-form-label">Genero</label>
                                    <div class="col-2-edit">
                                        <select id="select_genere" class="form-control" name="genero">
                                            <option value="Hombre" class="opcio3">Hombre</option>
                                            <option value="Mujer" class="opcio4">Mujer</option>
                                        </select>
                                    </div>
                                    <label for="example-date-input" class="col-form-label">Población</label>
                                    <div class="col-2-edit">
                                        <input class="form-control input" type="text" id="poblacion" name="poblacion" required>
                                    </div>
                                    <label for="example-date-input" class="col-form-label">Oficio</label>
                                    <div class="col-2-edit">
                                        <input class="form-control input" type="text" id="ofici" name="ofici" required>
                                    </div>
                                    <label for="example-date-input" class="col-form-label">Foto de Perfil</label>
                                    <div class="col-2-edit">
                                        <div class="upload-btn-wrapper">
                                            <button class="btno">Upload a file</button>
                                            <input type="file" name="foto_perfil" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><h4>Configurar Estación</h4></div>
                            <?php if ($dades['error'] != " "){
                                echo "<div class='alert alert-danger' role='alert'>
                                        <strong>Tenemos un problema! </strong>".$dades['error']."</a>
                                      </div>";
                            }?>
                            <div class="panel-body">
                                <div class="form-group">
                                   <div class="col-2-edit">
                                        <label for="exampleSelect1">Tonalidad de la Piel</label>
                                        <select id="select_pell" class="form-control" name="tonal_pell" onchange="if (this.selectedIndex) tonalitat_pell();">
                                            <option>-------</option>
                                            <option value="Fría" class="opcio1">Fría</option>
                                            <option value="Cálida" class="opcio2">Cálida</option>
                                        </select>
                                        <div id="color_1"></div>
                                    </div>
                                    <div id="div_pel" class="col-2-edit">
                                        <label for="exampleSelect1">Tonalidad del Pelo</label>
                                        <select id="select_pel" class="form-control" name="tonal_pel" onchange="if (this.selectedIndex) tonalitat_pel();">
                                            <option value="0">-------</option>
                                            <option value="Claro" class="opcio3">Claro</option>
                                            <option value="Oscuro" class="opcio4">Oscuro</option>
                                        </select>
                                        <div id="color_2"></div>
                                    </div>
                                    {!! csrf_field() !!}
                                    <button type="button" id="boto" class="btn btn-primary" onclick="triar_subestacio()">Saber Subestación</button>
                                    <div id="subestacions"></div>
                                    <div id="div_subestacio" class="col-2-edit">
                                        
                                    </div>
                                    <img class="foto_sidebar" src="{{ URL::asset('img/contingut/gif_pel.gif') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <button type="submit" id="boto_enviar_primer_perfil" class="btn btn-success">Enviar</button>
                </form>
                
            </div>
        </div>     
    </div>
</div>


@endsection
