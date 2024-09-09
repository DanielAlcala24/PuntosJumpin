@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.principal')
@section('titulo','Sucursales')
@section('contenido')
<div class=""> <!-- container -->
   

   <!-- Modal curso -->
    <div class="modal fade" id="modal_proy" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largemodal1"> 
                        <i class="fa fa-map-marker text-info" style="font-size: 30px;"></i>
                        Sucursal 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- form -->
                <form class="form-horizontal" action="{{ route('guardar.estacion') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_proy" id="id_proy">
                    <div class="form-group row">
                        <label class="col-md-3 form-label">Responsable:</label>
                        <div class="col-md-9">
                            <select class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione un responsable" tabindex="-1" aria-hidden="true" id="ubigeo" name="id_responsable">
                                <option value="">Seleccione...</option>
                                @foreach($funciones->usuarios()->where('id_cargo',1) as $usu)
                                    <option value="{{ $usu->id }}">{{ $usu->nombre_usuario }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 


                    <div class="form-group row">
                        <label class="col-md-3 form-label">Sucursal:</label>
                        <div class="col-md-6">
                            <input type="text" name="nombre" class="form-control" required="" placeholder="Nombre sucursal" id="estacion">
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
                    <form action="{{ route('listar.estaciones') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Buscar:</label>
                            <input class="form-control mb-4" placeholder="Buscar por sucursal" type="text" name="nombre_usuario" value="{{ $databusqueda->nombre_usuario }}">
                        </div>

                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_proy" onclick="nuevo()"> 
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
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
                                        <th>Responsable</th>
                                        <th> Sucursal</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; ?>
                                        @foreach($listadatos as $dato)
                                        <?php $i++; ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    @foreach($funciones->usuarios()->where('id',$dato->id_responsable) as $respon)
                                                        {{ $respon->nombre_usuario }}
                                                    @endforeach
                                                </td>                                                
                                                <td>{{ mb_strtoupper($dato->nombre) }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_proy" onclick="editar({{ $dato->id }},'{{ $dato->id_responsable }}','{{ mb_strtoupper($dato->nombre) }}')"> 
                                                        <i class="glyphicon glyphicon-edit"></i> 
                                                    </button>
                                                    <a href="{{ route('borrar.estacion',$dato->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea ELIMINAR?')">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
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
    $("#ubigeo").val('').trigger('change');
    $('#proyecto').val('');
    $('#estacion').val('');
    $('#tipo').val('');
    $('#fecha').val('');
    $("#id_persona").val('').trigger('change');	
    $('#doc_correc').val('');
    $('#row_corecc').hide();
}




function editar(id,ubigeo,estacion) {
    $('#id_proy').val(id);
    $("#ubigeo").val(ubigeo).trigger('change');
    $('#estacion').val(estacion);
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
