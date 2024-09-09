@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.principal')
@section('titulo','Inicio')
@section('contenido')
<div class="container">
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-body" style="text-align: center;">
					<img src="{{ asset('images/antena.png') }}" width="300">
					<br>
					@if(Auth::user()->id_cargo==2)
					<div style="display: flex;justify-content: center;">
						<span style="color: #55BC11;font-size: 1.5rem;">Puntos:  + {{ $funciones->puntos_disponibles(Auth::user()->id_emple ) }}  
						</span>
					</div>

					@endif


					<div style="display: flex;justify-content: center;align-items: center;">
						<img src="{{ asset('images/logotc.png') }}" width="70">
						<span class="text-info" style="font-size: 15pt;">Convierte tu dedicación en recompensas, <br> ¡porque tus logros merecen ser reconocidos!</span>
					</div>
					<br>
                </div>
            </div>
    </div>



</div>







<script type="text/javascript">

	$(function() {




});
</script>
@endsection
