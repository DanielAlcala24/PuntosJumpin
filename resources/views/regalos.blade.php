@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.principal')
@section('titulo','Cupones')
@section('contenido')
<div class=""> <!-- container -->
   

   <!-- Modal curso -->
    <div class="modal fade" id="modal_proy" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largemodal1"> 
                        <i class="fa fa-dropbox text-info" style="font-size: 25px;"></i>
                        Cupones 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- form -->
                <form class="form-horizontal" action="{{ route('guardar.regalo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_proy" id="id_proy">


                    <div class="form-group row">
                        <label class="col-md-3 form-label">Foto cupón:</label>
                        <div class="col-md-6">
                            <input type="file"  name="foto" class="form-control"  id="foto" accept=".png, .jpg, .jpeg">
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="col-md-3 form-label">Nombre cupón:</label>
                        <div class="col-md-6">
                            <input type="text" name="nombre" class="form-control" required="" placeholder="Nombre cupón" id="estacion">
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

   <!-- Modal curso -->
    <div class="modal fade" id="modal_canje" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largemodal1"> 
                        <i class="fa fa-dropbox text-info" style="font-size: 25px;"></i>
                        Canjear cupón 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- form -->
                <form class="form-horizontal" action="{{ route('canjear.regalo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_regalo" id="id_regalo">
                    <input type="hidden" name="id_emple" id="id_emple" value="{{ Auth::user()->id_emple }}">

                    <p style="font-size: 13pt;color: #1264C1;" id="lbl_smj">
                        
                    </p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_closecanje">
                        <i class="fa fa-remove"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check"></i> Canjear
                    </button>
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
                    <form action="{{ route('listar.regalos') }}" method="GET">
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
                                        <th>Foto</th>
                                        <th>Nombre cupón</th>
                                        <th>Puntos</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; ?>
                                        @foreach($listadatos as $dato)
                                        <?php $i++; ?>
                                            <tr>
                                                <td>{{ $i }}</td>  
                                                <td>
                                                    <img src='{{ asset("regalos/$dato->foto") }}' alt="" width="100">
                                                </td>                                              
                                                <td>{{ mb_strtoupper($dato->nombre) }}</td>
                                                <td style="color: #5A6BD4;font-size: 1rem;">
                                                    <b> + {{ $dato->puntos }}</b>
                                                </td>
                                                <td>
                                                    @if(Auth::user()->id_cargo==1)
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_proy" onclick="editar({{ $dato->id }},'{{ $dato->puntos }}','{{ mb_strtoupper($dato->nombre) }}')"> 
                                                        <i class="glyphicon glyphicon-edit"></i> 
                                                    </button>
                                                    <a href="{{ route('borrar.regalo',$dato->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea ELIMINAR?')">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                    @endif

                                                    @if(Auth::user()->id_cargo==2 && $funciones->puntos_disponibles(Auth::user()->id_emple) >= $dato->puntos)
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_canje" onclick="canjear({{ $dato->id }},'{{ $dato->puntos }}','{{ mb_strtoupper($dato->nombre) }}')"> 
                                                        Canjear 
                                                    </button>
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


function canjear(id,puntos,regalo){
    $('#id_regalo').val(id);
    $('#lbl_smj').html('Está canjeando: '+ regalo + ' con '+ puntos + ' puntos.')

}

$(document).ready(function() {




});

</script>
@endsection
