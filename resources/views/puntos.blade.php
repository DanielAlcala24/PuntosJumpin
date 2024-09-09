@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.principal')
@section('titulo','Registro de puntos')
@section('contenido')
<div class=""> <!-- container -->
   



   <!-- Modal curso -->
    <div class="modal fade" id="modal_proy" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largemodal1"> 
                        <i class="fa fa-laptop text-info" style="font-size: 40px;"></i>
                        Registrar puntos
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- form -->
                <form class="form-horizontal" action="{{ route('guardar.proyecto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_proy" id="id_proy">
                    <div class="form-group row">
                        <label class="col-md-3 form-label">Empleado:</label>
                        <div class="col-md-9">
                            <select class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione un empleado" tabindex="-1" aria-hidden="true" id="empleado" name="empleado">
                                <option value="">Seleccione...</option>
                                {!! $funciones->cmb_empleados() !!}
                            </select>
                        </div>
                    </div> 
 

                    <div class="form-group row">
                        <label class="col-md-3 form-label">Actividad:</label>
                        <div class="col-md-9">
                            <select class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione una actividad" tabindex="-1" aria-hidden="true" id="actividad" name="actividad">
                                <option value="">Seleccione...</option>
                                {!! $funciones->cmb_actividades() !!}
                            </select>
                        </div>
                    </div> 

                    <div class="flex" id="lblequipo"> </div>
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
                    <form action="{{ route('listar.puntos') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Buscar:</label>
                            <input class="form-control mb-4" placeholder="Buscar por empleado" type="text" name="nombre_usuario" value="{{ $databusqueda->nombre_usuario }}">
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
                                        <th>Empleado</th>
                                        <th>Actividad</th>
                                        <th>Puntos</th>
                                        <th>fecha</th>
                                        <th>persona califica</th>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; ?>
                                        @foreach($listadatos as $dato)
                                        <?php 
                                        $i++; 
                                        $ff=date_create($dato->created_at);
                                        $fecha=date_format($ff,'d/m/Y H:i:s');
                                        ?>

                                        @if(Auth::user()->id_cargo==1)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td> {{ $dato->num_docu }} - {{ $dato->nombre }}</td>
                                                <td>
                                                    {!! $funciones->nom_actividad($dato->id_actividad) !!}
                                                </td>
                                                <td style="color: #55BC11;font-size: 1rem;">
                                                    <b> + {{ $dato->puntos }}</b>
                                                </td>
                                                <td>{{ $fecha }}</td>
                                                <td>
                                                    @if(Auth::user()->id_cargo==1)
                                                    <!--<a href="{{ route('borrar.proyecto',$dato->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea ELIMINAR?')">
                                                        <i class="fa fa-remove"></i>
                                                    </a>-->
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif

                                        <!-- solo empleado -->
                                        @if(Auth::user()->id_cargo==2 && $dato->id_empleado==Auth::user()->id_emple)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td> {{ $dato->num_docu }} - {{ $dato->nombre }}</td>
                                                <td>
                                                	{!! $funciones->nom_actividad($dato->id_actividad) !!}
                                                </td>
                                                <td style="color: #55BC11;font-size: 1rem;">
                                                	<b> + {{ $dato->puntos }}</b>
                                                </td>
                                                <td>{{ $fecha }}</td>
                                                <td>
                                                </td>
                                            </tr>
                                            @endif
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
    $('#proyecto').val('');

    $("#estacion").val('').trigger('change');	

    $('#tipo').val('');
    $('#fecha').val('');
    
    $('#doc_correc').val('');
    $('#row_corecc').hide();
}




function editar(id,proy,estacion,tipo,fecha,persona,correc) {
    $('#id_proy').val(id);
   	$("#estacion").val(estacion).trigger('change');
    $('#proyecto').val(proy);
    $('#tipo').val(tipo);
    $('#fecha').val(fecha);
    $("#id_persona").val(persona).trigger('change');
    $('#doc_correc').val('');
    if (correc==1) { $('#row_corecc').show(); } else{ $('#row_corecc').hide(); }
}

$(document).ready(function() {


	$('#doc_correc').change(function() {
        var formato=($(this)[0].files[0].name.split('.').pop()).toLowerCase();
        if (formato=='doc' || formato=='docx') {
            $('#val_medio').html($(this)[0].files[0].name);
            $('#formato_medio').val(formato);
        }else{
            alert('Seleccione sólo documento de WORD');
            $(this).val('');
        }
	});

});

</script>
@endsection