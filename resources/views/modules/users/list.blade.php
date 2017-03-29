<!--
@author: QSoto
-->
@extends('layouts.main_layout')
@section('customcss')
	<link rel="stylesheet" href="/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Gestion de Usuarios</h2>
				</div>
			</div>
		</div>
	</section>
	<section id="content">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p> </p>
					@if(session()->has('success') && session('success') == true)
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>¡Muy bien!</strong> La accion se ha realizado con exito.
						</div>
					@else
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>¡Error!</strong> Ocurrió un error al registrar. Por favor intentelo de nuevo
						</div>
					@endif
				</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
			</div><!-- /.row-->
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="pull-left">
						<a class="btn" href="/usuarios/registrar">Registrar Usuario</a><br><br>
					</div>
				</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<table id="datatable" class="table table-striped bulk_action">
							<thead>
								<tr>
									<td align="center"><strong>Cedula</strong></td>
									<td align="center"><strong>Nombres</strong></td>
									<td align="center"><strong>Apellidos</strong></td>
									<td align="center"><strong>Fecha de Nacimiento</strong></td>
									<td align="center"><strong>Sexo</strong></td>
									<td align="center"><strong>Tipo de Usuario</strong></td>
									<td align="center"><strong>Correo Electronico</strong></td>
									<td align="center"><strong>Telefono</strong></td>
									<td align="center"><strong>¿Activo?</strong></td>
									<td align="center"><strong>Modificar</strong></td>
									<td align="center"><strong>Inhabilitar</strong></td>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
									<tr>
										<td align="center">{{$user->cedula}}</td>
										<td align="center">{{$user->firstname}}</td>
										<td align="center">{{$user->lastname}}</td>
										<td align="center">{{$user->birthdate->format('d/m/Y')}}</td>
										<td align="center">{{$user->gender ? 'Masculino' : 'Femenino'}}</td>
										<td align="center">{{$user->user_type}}</td>
										<td align="center">{{$user->email}}</td>
										<td align="center">{{$user->phone}}</td>
										<td align="center">
											@if ($user->active)
												SI
											@else
												<a href="#" onclick="showReactivateForm('{{$user->id}}','{{$user->getFullName()}}');return false;">NO</a>
											@endif
										</td>
										<td align="center">
											<a class="btn" id="update" href="/usuarios/editar/{{$user->id}}">
												<i class="fa fa-pencil" value="Actualizar"></i>
											</a>
										</td>
										<td align="center">
											@if ($user->active)
												<a class="btn" href="#" id="desactivate_btn_{{$user->id}}" onclick="showDesactivateForm('{{$user->id}}','{{$user->getFullName()}}');return false;">
													<i class="fa fa-times" value="Desactivar"></i>
												</a>
											@else
												<i class="fa fa-times" value="Desactivar"></i>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
				</div>
			</div>
		</div>
		<form id="desactivateForm" action="/usuarios/desactivar" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="user_id" id="user_id" value="">
		</form>
		<form id="reactivateForm" action="/usuarios/reactivar" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="re_user_id" id="re_user_id" value="">
		</form>
	</section>
	@include('modules.users.forms.desactivate-form-modal')
	@include('modules.users.forms.reactivate-form-modal')
@endsection
@section('customjs')
	@include('components.datatables.datatable')

	<script type="text/javascript">
		function showDesactivateForm(id,name){
			$('#user_id').val(id);
			$('#userInfo').text(name);
			$('#desactivate-form-modal').modal().show();
		}
		function showReactivateForm(id,name){
			$('#re_user_id').val(id);
			$('#re_userInfo').text(name);
			$('#reactivate-form-modal').modal().show();
		}
	</script>
@endsection
