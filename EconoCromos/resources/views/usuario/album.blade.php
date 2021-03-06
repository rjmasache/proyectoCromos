@extends('layouts.layout')
@section('titulo', 'Economía a tu alcance')
@section('contentalbum')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ asset('css/actividades.css') }}" rel="stylesheet">

<section class="contenidoActividades" id="estructura">
    <section class="tablaAlbumes table-responsive">
        @php
        $n = 1;
        $n2 = 1;
        @endphp
        <nav>
            @foreach( $albumContenido as $album)
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="{{$n2}}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#nombre{{$n2}}" aria-expanded="true" aria-controls="nombre{{$n2}}">
                            {{$album->nombre}}
                        </button>
                    </h2>
                    <div id="nombre{{$n2}}" class="accordion-collapse collapse show" aria-labelledby="{{$n2}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach( $album->tematicas as $tematicas)
                            <a class="nboton link-primary" target="{{$n}}"> {{$tematicas['nombreTematica']}}</a> <br>
                            @php
                            $n = $n+1;
                            @endphp
                            @endforeach
                        </div>
                    </div>
                    @php
                    $n2 = $n2+1;
                    @endphp
                </div>
            </div>
            @endforeach
            <script>
                jQuery(function() {
                    jQuery('.nboton').click(function() {
                        jQuery('.classTem1').hide();
                        jQuery('#tematica' + $(this).attr('target')).toggle('slide');
                    });
                });
            </script>
        </nav>
    </section>
    <section class="cromos">
        <div id="tematica0" class="classTem1 table-responsive table-bordered">
            <ul class="list-group">
                <li class="list-group-item">Mis cromos</li>
            </ul>
            @php
                $n = 1;
            @endphp
            @foreach( $albumContenido[0]->tematicas[0]->cromos as $cromo)
                @php
                    $encontrado = False;
                @endphp
                @if(count($albumContenido[0]->desbloqueados) == 0)
                    <article class="desactivarCromo">
                        <img src="{{ asset('storage').'/'.$cromo->imgURL }}">
                        <img src="{{ asset('img/bloqueado.svg') }}" style="width:20px; margin:0; padding:0; height:auto; opacity:50%">
                    </article>
                @else
                    @foreach( $albumContenido[0]->desbloqueados as $desbloqueado)
                        @if($desbloqueado->idCromo === $cromo->idCromo && auth()->user()->idUsuario == $desbloqueado->idUsuario)
                            @php
                                $encontrado = True;
                            @endphp
                        @endif
                    @endforeach
                    @if($encontrado)
                        <article target="{{$n}}" class="activarCromo">
                            <img src="{{ asset('storage').'/'.$cromo->imgURL }}">
                            <div class="cromo animation-target2" id="cromo{{$n}}" style="display: none; height:475px">
                                <img src="{{ asset('storage').'/'.$cromo->imgURL }}" class="xxdf" style="width: 450px;height:440px">    
                                <section class="textualCromo">
                                    <h6>#{{$cromo->idCromo}}</h6>
                                    <h3>{{$cromo->nombre}}</h3>
                                    <h5>{{$cromo->descripcion}}</h5>
                                </section>
                            </div>
                            <h4 class="taitu" > <b>{{$cromo->nombre}}</b> </h4>
                        </article>
                        @php
                            $n = $n+1;
                        @endphp
                    @else
                        <article class="desactivarCromo">
                            <img src="{{ asset('storage').'/'.$cromo->imgURL }}">
                            <img src="{{ asset('img/bloqueado.svg') }}" style="width:20px; margin:0; padding:0; height:auto; opacity:50%">
                        </article>
                    @endif
                @endif
            @endforeach

        </div>
        @php
            $n2 = 1;
        @endphp
        @foreach( $albumContenido as $album)
            @php
                $cantDes = 0;
                $cantCromos = 0;
            @endphp
            @foreach( $album->tematicas as $tematica)
            <div id="tematica{{$n2}}" class="classTem1 table-responsive table-bordered" style="display: none;">
                <ul class="list-group">
                    <li class="list-group-item">{{ $tematica->nombreTematica }}</li>
                </ul>
                @foreach( $tematica->cromos as $cromo)
                    @php
                        $encontrado = False;
                        $cantCromos = $cantCromos +1;
                    @endphp
                    @if(count($album->desbloqueados) == 0)
                    <article class="desactivarCromo">
                        <img src="{{ asset('storage').'/'.$cromo->imgURL }}">
                        <img src="{{ asset('img/bloqueado.svg') }}" style="width:20px; margin:0; padding:0; height:auto; opacity:50%">
                    </article>
                    @else
                        @foreach( $album->desbloqueados as $desbloqueado)
                            @if($desbloqueado->idCromo === $cromo->idCromo && auth()->user()->idUsuario == $desbloqueado->idUsuario)
                                @php
                                    $encontrado = True;
                                    $cantDes = $cantDes +1;
                                @endphp
                            @endif
                        @endforeach
                        @if($encontrado)
                            <article target="{{$n}}" class="activarCromo">
                                <img src="{{ asset('storage').'/'.$cromo->imgURL }}">
                                <div class="cromo animation-target2" id="cromo{{$n}}" style="display: none; height:475px">
                                    <img src="{{ asset('storage').'/'.$cromo->imgURL }}" class="xxdf" style="width: 450px;height:440px">    
                                    <section class="textualCromo">
                                        <h6>#{{$cromo->idCromo}}</h6>
                                        <h3>{{$cromo->nombre}}</h3>
                                        <h5>{{$cromo->descripcion}}</h5>
                                    </section>
                                </div>
                                <h4 class="taitu" > <b>{{$cromo->nombre}}</b> </h4>
                            </article>
                            @php
                                $n = $n+1;
                            @endphp
                        @else
                            <article class="desactivarCromo">
                                <img src="{{ asset('storage').'/'.$cromo->imgURL }}">
                                <img src="{{ asset('img/bloqueado.svg') }}" style="width:20px; margin:0; padding:0; height:auto; opacity:50%">
                            </article>
                        @endif
                    @endif
                @endforeach
            </div>
            @php
                $n2 = $n2 +1;
            @endphp
        @endforeach
        {{-- <p class="pCantidad">{{$cantDes}}/{{$cantCromos}}</p> --}}
    @endforeach
    </section>
</section>
{{-- Funcion Jquery para mostrar el contenido de los cromos  --}}
<script>
    jQuery(function() {
        jQuery('.activarCromo').click(function() {
            //jQuery('.cromo').hide();
            jQuery('.obscurecer').fadeIn(300);
            jQuery('#cromo' + $(this).attr('target')).fadeIn();
        });
        jQuery('.obscurecer').click(function() {
            jQuery('.obscurecer').fadeOut(300);
            jQuery('.cromo').fadeOut(300);
            //jQuery('#cromo' + $(this).attr('target')).fadeOut();
        });
    });
</script>
@endsection