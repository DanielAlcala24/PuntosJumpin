@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.principal')
@section('titulo','Canjes')
@section('contenido')
<div class=""> <!-- container -->
   

   <!-- Modal curso -->
    <div class="modal fade" id="modal_proy" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largemodal1"> 
                        <i class="fa fa-dropbox text-info" style="font-size: 25px;"></i>
                        Canjear 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- form -->
                <form class="form-horizontal" action="{{ route('guardar.canje') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_proy" id="id_proy">


                    <div class="form-group row">
                        <label class="col-md-3 form-label">Empleado:</label>
                        <div class="col-md-9">
                            <select class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione un empleado" tabindex="-1" aria-hidden="true" id="empleado" name="empleado">
                                <option value="">Seleccione...</option>
                                {!! $funciones->cmb_empleados_canje() !!}
                            </select>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="col-md-3 form-label">Cupones:</label>
                        <div class="col-md-9">
                           

<select class="form-control select2-show-search select2-hidden-accessible" data-placeholder="Seleccione un cupón" tabindex="-1" aria-hidden="true" id="regalo" name="regalo">

                                <option value="">Seleccione...</option>
                                
                            </select>
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
                    <form action="{{ route('listar.canjes') }}" method="GET">
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
                                        <th>Empleado</th>
                                        <th>cupón canjeado</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>Fecha</th>
                                        <th></th>
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
                                                <td>
                                                    {{ $dato->num_docu }} - {{ $dato->nom_empleado }}
                                                </td>
                                                <td>
                                                    <img src='{{ asset("regalos/$dato->foto") }}' alt="" width="100" style="margin-right: 5px;">
                                                    {{ mb_strtoupper($dato->nombre) }}

                                                    <span style="color: #5A6BD4;font-size: 1rem;margin-left: 5px;"><b> ( {{ $dato->puntos }} puntos)</b></span>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </td> 
                                                <td>{{ $fecha }}</td>
                                                <td>
             
                                                    @if(Auth::user()->id_cargo==1)
                                                    <!--<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_proy" onclick="editar({{ $dato->id }},'{{ $dato->id_empleado }}',{{ $dato->id_regalo }})"> 
                                                        <i class="glyphicon glyphicon-edit"></i> 
                                                    </button>--> 

                                                    
                                                    <!--<a href="{{ route('borrar.regalo',$dato->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea ELIMINAR?')">
                                                        <i class="fa fa-remove"></i>
                                                    </a>-->                                                        
                                                    @endif

                                                </td>
                                            </tr>
                                            @endif

<!-- solo del empleado -->


                                            @if(Auth::user()->id_cargo==2 && $dato->id_empleado==Auth::user()->id_emple)
                                            <tr>
                                                <td>{{ $i }}</td>  
                                                <td>
                                                    {{ $dato->num_docu }} - {{ $dato->nom_empleado }}
                                                </td>
                                                <td>
                                                    <img src='{{ asset("regalos/$dato->foto") }}' alt="" width="100" style="margin-right: 5px;">
                                                    {{ mb_strtoupper($dato->nombre) }}

                                                    <span style="color: #5A6BD4;font-size: 1rem;margin-left: 5px;"><b> ( {{ $dato->puntos }} puntos)</b></span>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    
                                                </td> 
                                                <td>{{ $fecha }}</td>
                                                <td>
             
                                                    @if(Auth::user()->id_cargo==1)
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_proy" onclick="editar({{ $dato->id }},'{{ $dato->id_empleado }}',{{ $dato->id_regalo }})"> 
                                                        <i class="glyphicon glyphicon-edit"></i> 
                                                    </button>

                                                    
                                                    <a href="{{ route('borrar.regalo',$dato->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea ELIMINAR?')">
                                                        <i class="fa fa-remove"></i>
                                                    </a>                                                        
                                                    @endif

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
    $('#puntos').val('');
    $('#estacion').val('');
}



function editar(id,empleado,regalo) {

    $('#id_proy').val(id);
    $("#empleado").val(empleado).trigger('change');
    setTimeout(function(){
    $("#regalo").val(regalo).trigger('change');
}, 500);
    
}

$(document).ready(function() {




$("#empleado").on('change', function(e) {
    // Access to full data
    var id_em=$(this).select2('data')[0].id;
    if (id_em!='') { 
        $.ajax({
            url:"{{ route('ajaxregs') }}",  
            method:'GET',
            data:{id_empleado:id_em},
            dataType:'json',
            success:function(data){ 
               $('#regalo').html(data.regalos); 
            }  
        });

     }

});


    


});

</script>
@endsection
