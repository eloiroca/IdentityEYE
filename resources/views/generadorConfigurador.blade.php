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
            <li>
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
            <li class="active">
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
      <h1 id="titol_novetats"><img src="{{ URL::asset('img/contingut/config_girat.png') }}" alt="rss_dreta"/> Configuración del Generador <img src="{{ URL::asset('img/contingut/config.png') }}" alt="rss_esquerra"/> </h1>
  </div>
</div>


<div id="afegirModes_Cos" class="panel panel-primary">
    <div class="panel-body">
        <div class="col-sm-6">
            <h3 class="h3_normal">Paleta de Colores Personal</h3>
            <hr class="hr_dreta">
                <form action="{{ url('dades_editarColors') }}" method="POST" name="form" accept-charset="utf-8">
                <?php
                    for ($i=0; $i<count($dades['colors']); $i++){
                        echo "<div class='col-sm-2 colors' style='background-color:".$dades['colors'][$i]->color.";'><input type='checkbox' name='array_checkbox[]' value='".$dades['colors'][$i]->color."'></div>";
                    }

                ?>{!! csrf_field() !!}
                    <button type="submit" id="boto_enviar_colors" class="btn btn-success">Enviar</button>

                </form>
        </div>

        <div class="col-sm-6">
            <h3 class="h3_normal">Subestación que perteneces</h3>
            <hr class="hr_dreta">
            <div class="centrat">
                <h4>{{ $dades['dades_subestacio'][0]->subestacio }}</h4>
                <?php echo "<img class='img_subestacio_configuracio' src='data:image/jpeg; base64,".base64_encode($dades['dades_subestacio'][0]->foto)."'>";?>
            </div>



        </div>

    </div>
</div>


@endsection
