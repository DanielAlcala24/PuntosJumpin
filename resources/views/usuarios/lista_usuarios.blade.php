@inject('lstcargos','App\Models\Cargos')
@extends('layouts.principal')
@section('titulo','Usuarios')
@section('contenido')
<div class=""> <!-- container -->
   
   <!-- Modal Nuevo y editar -->
	<div class="modal fade" id="modal_nuevousuario" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
		<div class="modal-dialog modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="largemodal1"> <i class="fa fa-user-plus"></i> Nuevo usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="form-horizontal" action="{{ route('guardar.usuario') }}" method="POST">
					@csrf
					<input type="hidden" name="id_usuario" id="id_usuario">
				<div class="modal-body">
					<div class="form-group row">
						<!-- 
						<label class="col-md-3 form-label">Cargo</label>
						<div class="col-md-3">
							<select name="id_cargo" required="" class="form-control" id="cmbcargo">
								<option value="">Seleccionar...</option>
								@foreach($lstcargos::orderby('cargo','ASC')->get() as $cargo)
								<option value="{{ $cargo->id }}">{{ $cargo->cargo }}</option>
								@endforeach
							</select>
						</div>
						 -->
						<input type="hidden" name="id_cargo" id="cmbcargo" value="1">
					</div>					
					<div class="form-group row">
						<label class="col-md-3 form-label">Nombres</label>
						<div class="col-md-9">
							<input type="text" name="nombre_usuario" class="form-control"  placeholder="Nombres" required="" id="txtnombres">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Correo</label>
						<div class="col-md-9">
							<input type="email" name="email" class="form-control"  placeholder="Correo electrónico" required="" id="txtcorreo">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 form-label">Contraseña</label>
						<div class="col-md-9">
							<input type="password" name="clave" class="form-control" placeholder="Contraseña" id="txtclave">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Fin Modal nuevo y editar -->

	<!-- Modal eliminar -->
	<div class="modal" id="modal_eliminar">
		<div class="modal-dialog modal-dialog-centered text-center" role="document">
			<div class="modal-content tx-size-sm">
				<div class="modal-body text-center p-4">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<i class="fe fe-x-circle fs-100 text-danger lh-1 mb-5 d-inline-block"></i>
					<h4 class="text-danger"> Estás seguro eliminar? </h4>
					<p class="mg-b-20 mg-x-20" id="lblmensaje" style="font-size: 1.2rem;">  </p>
					<form action="{{ route('borrar.usuario') }}" method="POST">
						@csrf
						<input type="hidden" name="id_usuario" id="id_borrar">
						
						<textarea class="form-control mb-2" placeholder="Escribe el motivo" rows="2" required="" name="motivo"></textarea>

					<button aria-label="Close" class="btn btn-secondary pd-x-25" data-dismiss="modal" type="button">Cancelar</button>
					<button type="submit" class="btn btn-primary">Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal eliminar -->




    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                	<form action="{{ route('listar.usuarios') }}" method="GET">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> Usuario</label>
                            <input class="form-control mb-4" placeholder="Buscar" type="text" name="nombre_usuario" value="{{ $databusqueda->nombre_usuario }}">
                        </div>

                        <div class="col-lg "><br>
                           <button type="submit" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </button>
                           
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_nuevousuario" onclick="nuevo()"> 
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
								<tr>
									<th>#</th>
									<th>Cargo</th>
									<th>Nombres</th>
									<!--<th>Correo</th>-->
									<th></th>
								</tr>
							</thead>
							<tbody>

								<?php 
								$i = 0;
								if(isset($_GET['page'])){
									$i = ($_GET['page']*10)-10;
								}
								 ?>
								@foreach($listausers  as $usuario)
								<?php $i++;  ?>
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $usuario->cargo }}</td>
										<td>{{ $usuario->nombre_usuario }}</td>
										<!--<td>{{ $usuario->email }}</td>-->
										
										<td>
					        				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_nuevousuario" onclick="editar({{ $usuario->id }},'{{ $usuario->nombre_usuario }}','{{ $usuario->email }}')" > 
					                            <i class="glyphicon glyphicon-edit"></i> 
					                        </button>

					                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_eliminar" onclick="eliminar({{ $usuario->id}},'{{ $usuario->nombre_usuario }}')"> 
					                            <i class="glyphicon glyphicon-trash"></i> 
					                        </button>
										</td> 
									</tr>									
								@endforeach
							</tbody>
						</table>
					</div>
					<hr class="m-1">
				    <div class="text-center">
				        {!! $listausers->render()!!}
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	function nuevo(){
		$('#id_usuario').val('');
		$('#txtcorreo').prop('disabled',false);
		//$('#txtclave').prop('disabled',false);

		$('#txtclave').val('');
		$('#txtcorreo').val('');
	}

	function editar(idusuario,nombre,correo) {
		// id usuerio
		$('#id_usuario').val(idusuario);
		$('#txtnombres').val(nombre);
	
		$('#txtcorreo').prop('disabled',true);
		$('#txtcorreo').val(correo);
		//$('#txtclave').prop('disabled',true);
		$('#txtclave').val('');
		$('#row_estados').show();
	}

	function eliminar(idusuario,nombre){
		$('#lblmensaje').text( nombre);
		$('#id_borrar').val(idusuario);
	}




$(document).ready(function() {
	

});

</script>
@endsection
