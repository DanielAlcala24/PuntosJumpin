@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.principal')
@section('titulo','Actividades')
@section('contenido')
<div class=""> <!-- container -->
   

   <!-- Modal curso -->
    <div class="modal fade" id="modal_proy" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largemodal1"> 
                        <i class="fa fa-list text-info" style="font-size: 25px;"></i>
                        Actividad 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- form -->
                <form class="form-horizontal" action="{{ route('guardar.acti') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_proy" id="id_proy">


                    <div class="form-group row">
                        <label class="col-md-3 form-label">Actividad:</label>
                        <div class="col-md-6">
                            <input type="text" name="nombre" class="form-control" required="" placeholder="Nombre actividad" id="estacion">
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="col-md-3 form-label">Puntos:</label>
                        <div class="col-md-3">
                            <input type="text" name="puntos" class="form-control" required="" placeholder="Puntos" id="puntos" onkeypress="return solo_nums(event);">
                        </div>
                    </div> 


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_closecurso">Cancelar</button>
                    <button type="submit" class="btn btn-primary" >Guardar</button>
                </div>
                </form>
                <!-- fin form -->
            </div>
        </div>
    </div>
    <!-- Fin Modal curso -->





    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('listar.actividades') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Buscar:</label>
                            <input class="form-control mb-4" placeholder="Buscar" type="text" name="nombre_usuario" value="{{ $databusqueda->nombre_usuario }}">
                        </div>

                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           @if(Auth::user()->id_cargo==1)
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_proy" onclick="nuevo()"> 
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                            @endif
                        </div>
                    </div>
                    </form>

                </div>
            </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                                    <thead>
                                        <th>#</th>
                                        <th>Actividad</th>
                                        <th> Puntos</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; ?>
                                        @foreach($listadatos as $dato)
                                        <?php $i++; ?>
                                            <tr>
                                                <td>{{ $i }}</td>                                                
                                                <td>{{ mb_strtoupper($dato->actividad) }}</td>
                                                <td style="color: #5A6BD4;font-size: 1rem;">
                                                    <b> + {{ $dato->puntos }}</b>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->id_cargo==1)
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_proy" onclick="editar({{ $dato->id }},'{{ $dato->puntos }}','{{ mb_strtoupper($dato->actividad) }}')"> 
                                                        <i class="glyphicon glyphicon-edit"></i> 
                                                    </button>
                                                    <a href="{{ route('borrar.actividad',$dato->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea ELIMINAR?')">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr class="m-1">
                            <div class="text-center">
                                {!! $listadatos->render()!!}
                            </div>
                        </div>
                    </div>



        </div>
    </div>
</div>



<script>


function nuevo() {
    $('#id_proy').val('');
    $('#puntos').val('');
    $('#estacion').val('');
}




function editar(id,puntos,estacion) {
    $('#id_proy').val(id);
    $("#puntos").val(puntos);
    $('#estacion').val(estacion);
}

$(document).ready(function() {




});

</script>
@endsection
