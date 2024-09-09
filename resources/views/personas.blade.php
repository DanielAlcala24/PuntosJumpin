@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.principal')
@section('titulo','Empleados')
@section('contenido')
<div class=""> <!-- container -->
   

   <!-- Modal persona -->
    <div class="modal fade" id="modal_persona" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largemodal1"> 
                        <i class="fa fa-user-plus text-info" style="font-size: 40px;"></i>
                        Empleados
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{ route('guardarpersona') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_persona" id="id_persona">
                <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-md-3 form-label">Sucursal:</label>
                        <div class="col-md-9">
                            <select class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione una sucursal" tabindex="-1" aria-hidden="true" id="id_departamento" name="id_departamento" required="">
                                <option value="">Seleccione...</option>
                                {!! $funciones->cmb_departamentos() !!}
                            </select>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="col-md-3 form-label">Contraseña:</label>
                        <div class="col-md-3">
                            <select required="" class="form-control" id="cmbtipo" name="tipo_docu">
                                <option value="">Seleccionar...</option>
                                <option value="01">8 digitos</option>
                            </select>
                        </div>
                    </div>  

                    <div class="form-group row">
                        <label class="col-md-3 form-label">Contraseña:</label>
                        <div class="col-md-6">
                            <input type="text" id="numdocu" class="form-control" placeholder="Primeras 3 letras sucursal + 5 números (CHU12345)" maxlength="8" required="" name="num_docu">
                        </div>
                    </div>  

                    <div class="form-group row">
                        <label class="col-md-3 form-label">Nombres:</label>
                        <div class="col-md-9">
                            <input type="text" id="nompersona" class="form-control" placeholder="Nombres" required="" name="nom_persona">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 form-label">Correo electrónico:</label>
                        <div class="col-md-9">
                            <input type="text" id="correopersona" class="form-control" placeholder="Correo electrónico" name="correo_persona" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-label"> Telefono:</label>
                        <div class="col-md-3">
                            <input type="text" id="numtelefono" class="form-control" placeholder="Telefono" name="telefono_persona">
                        </div>
                    </div>
                    <div class="flex" id="lblpersona"> </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_closepersona">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="btn_guardarpersona">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Fin Modal persona -->


    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('listapersonas') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Usuario</label>
                            <input class="form-control mb-4" placeholder="Buscar" type="text" name="nombre_usuario" value="{{ $databusqueda->nombre_usuario }}">
                        </div>
                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_persona" onclick="nuevo()"> 
                                <i class="fa fa-plus"></i> Nuevo
                            </button>
                           <a href="{{ route('listapersonas') }}" class="mt-2">
                                <span class="btn"> 
                                    <i class="fa fa-refresh text-info" style="font-size: 1.4rem;"></i> 
                                </span>                         
                           </a>

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
                                        <tr>
                                            <th>#</th>
                                            <th>Sucursal</th>
                                            <th>Contraseña</th>
                                            <th>Nombres</th>
                                            <!--<th>correo</th>-->
                                            <th>telefono</th>
                                            <th>Puntos</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; ?>
                                        @foreach($listadatos as $dato)
                                        <?php $i++; ?>
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    {{ $funciones->nom_depart($dato->id_departamento) }}
                                                </td>
                                                <td>
                                                    {{ $dato->num_docu }}
                                                </td>
                                                <td>{{ $dato->nombre }}</td>
                                                <!--<td>{{ $dato->correo }}</td>-->
                                                <td>{{ $dato->telefono }}</td>

                                                <td style="color: #55BC11;font-size: 1rem;">
                                                    <b> + {{ $funciones->puntos_disponibles($dato->id ) }}</b>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_persona" onclick="editar({{ $dato->id }},'{{ $dato->tipo_docu }}','{{ $dato->num_docu }}','{{ $dato->nombre }}','{{ $dato->correo }}','{{ $dato->telefono }}',{{ $dato->id_departamento }})"> 
                                                        <i class="glyphicon glyphicon-edit"></i> 
                                                    </button>

                                                    <a href="{{ route('borrar.empleado',$dato->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea ELIMINAR?')">
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



<script type="text/javascript">

function editar(id,tipo,num,nom,correo,telefono,depar) {
    $('#id_persona').val(id);
    $('#cmbtipo').val(tipo);
    $('#numdocu').val(num);
    $('#nompersona').val(nom);
    $('#correopersona').val(correo);
    $('#numtelefono').val(telefono);
    $("#id_departamento").val(depar).trigger('change');
}


$(document).ready(function() {


});

</script>
@endsection