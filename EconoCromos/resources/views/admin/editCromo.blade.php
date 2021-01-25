@extends('adminlte::page')
@section('tittle', 'Admin Panel | Economía a tu alcance')
@section('content_header')
<h3>Modificar cromos</h3>
@endsection
@section('content')
<!-- Importación -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link href="{{ asset('css/administracion.css') }}" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<!-- Formulario para modificar los datos del cromo -->
<div class="formularioCromos container">
    <form class="row g-3" method="POST" action="{{ url('/agregarCromo/'. $cromos->idCromo)}}" enctype="multipart/form-data">
        @csrf
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <!-- Campo para modificar el nombre del cromo -->
        <div class="col-md-4">
            <label for="nombre" class="form-label">{{ __('Nombre del cromo') }}</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{$cromos->nombre}}" required autocomplete="nombre">
            @error('nombre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <!-- Campo para modificar la descripción del cromo -->
        <div class="col-md-10">
            <label for="descripcion" class="form-label">{{ __('Descripción del cromo') }}</label>
            <textarea type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" value="{{$cromos->descripcion}}" required autocomplete="descripcion"></textarea>
            @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <!-- Campo que muestra la imagen de la temática -->
        <div class="col-md-4">
            <label for="imgURL" class="form-label">{{ __('Imagen de la temática') }}</label><br>
            <img style="width: 200px" src="{{ asset('storage').'/'.$cromos->imgURL }}">
        </div>

        <!-- Campo para agregar la imagen del cromo -->
        <div class="col-md-6">
          <label for="imgURL" class="form-label">{{ __('Cargar nueva imagen') }}</label>
          <input type="file" class="form-control" id="imgURL" name="imgURL" accept="image/*" required autocomplete="imgURL">
        </div>

        {{-- <!-- Campo para editar el álbum al que pertenece el cromo -->
        <div class="col-md-4">
            <label for="idTematica" class="form-label">{{ __('Álbum') }}</label>
            <select class="form-control @error('idAlbum') is-invalid @enderror" id="idAlbum" name="idAlbum">
                @foreach ($albumContenido as $album)
                <option value="{{ $album->idAlbum }}">{{ $album->nombre }}</option>
                @endforeach
            </select>
        </div> --}}

        <!-- Campo para seleccionar el álbum del cromo -->
        <div class="col-md-4">
          <label for="albun" class="form-label">{{ __('Álbum') }}</label>
          <select class="form-control @error('idAlbum') is-invalid @enderror" id="albun" name="albun">
            <option selected="selected">Seleccione un álbum</option>
            @foreach ($albumContenido as $album)
              <option value="{{ $album->idAlbum }}">{{ $album->nombre }}</option>
            @endforeach
          </select>
        </div>

        <!-- Campo para seleccionar la temática del cromo -->
        <div class="col-md-4">
          <label for="tematica" class="form-label">{{ __('Temática') }}</label>
          <select class="form-control @error('idAlbum') is-invalid @enderror" id="tematica" name="idTematica" required autocomplete="albun">
            <option selected="selected">Seleccione una temática</option>
          </select>
        </div>

        <!-- Botón interno para modificar los datos de la temática-->
        <div class="botonModificarCromos col-20">
            <button type="submit" class="btn btn-primary">{{ __('Modificar datos') }}</button>
        </div>
    </form>
</div>
<script src="../../js/preguntas.js"></script>
@endsection