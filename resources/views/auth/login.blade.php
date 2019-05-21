@extends('layouts.app')

@section('sidebar')
    <nav id="sidebar">
        <div class="sidebar-header">
             
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="{{ url('') }}">
                    <i class="glyphicon glyphicon-home activat"></i>
                    Inicio
                </a>
            </li>
            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-user desactivat"></i>
                    Perfil
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li class="no_loguejat"><a href="#">Tu Perfil</a></li>
                    <li class="no_loguejat"><a href="#">Perfiles Identity</a></li>
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
                    <i class="glyphicon glyphicon-link desactivat"></i>
                    Generador Identity
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li class="no_loguejat"><a href="#">Configurador Identity</a></li>
                    <li class="no_loguejat"><a href="#">Generador de Ropa</a></li>
                    <li class="no_loguejat"><a href="#">Combinaciones Aleatorias</a></li>
                </ul>
            </li>
            <li class="no_loguejat">
                <a href="#">
                    <i class="glyphicon glyphicon-duplicate desactivat"></i>
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

<div id="panell_login" class="panel panel-info">
        <div class="panel-heading">Entrar IdentityEYE</div>
        <div class="panel-body">
            <img id="imatge_login" src="{{ URL::asset('img/icono.png') }}" alt="login">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12 offset-md-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recordar-me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-4">                      
                        <button id="btn_tornar" type="button" class="btn btn-primary">
                            {{ __('Volver') }}
                        </button>
                        <button id="btn_login" type="submit" class="btn btn-primary">
                            {{ __('Entrar') }}
                        </button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
