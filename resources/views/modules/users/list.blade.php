<!--
@author: QSoto
-->
@extends('layouts.main')
@section('css')
	{{--<link rel="stylesheet" href="/css/dataTables.bootstrap.min.css">--}}
	<link href="/css/bootstrap-table.css" rel="stylesheet">
	<style media="screen">
		td, th {
			text-align: center;
		}
	</style>
@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Gestion de Usuarios</h1>
			</div>
		</div><!--/.row-->
		@include('components.notification.notification')
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Listado </div>
					<div class="panel-body">
						<table data-toggle="table" data-show-refres41758498h="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							<thead>
								<tr>
									<th data-sortable="true" data-field="cedula">Cedula</th>
									<th data-sortable="true" data-field="firstname">Nombre</th>
									<th data-sortable="true" data-field="birthdate">Fecha de Nacimiento</th>
									<th data-sortable="true" data-field="gender">Sexo</th>
									<th data-sortable="true" data-field="user_type">Tipo de Usuario</th>
									<th data-sortable="true" data-field="email">Correo Electronico</th>
									<th data-sortable="true" data-field="phone">Telefono</th>
									<th data-sortable="true" data-field="active">¿Activo?</th>
									<th data-sortable="false">Modificar</th>
									<th data-sortable="false">Inhabilitar</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
									<tr>
										<td >{{$user->cedula}}</td>
										<td >{{$user->fullname}}</td>
										<td >{{$user->birthdate->format('d/m/Y')}}</td>
										<td >{{$user->gender ? 'Masculino' : 'Femenino'}}</td>
										<td >{{$user->user_type}}</td>
										<td >{{$user->email}}</td>
										<td >{{$user->phone}}</td>
										<td >
											@if ($user->active)
												SI
											@else
												<a href="#" onclick="showReactivateForm('{{$user->id}}','{{$user->fullname}}');return false;">NO</a>
											@endif
										</td>
										<td >
											<a class="btn btn-info" id="update" href="/usuarios/editar/{{$user->id}}">
												<i class="fa fa-pencil" value="Actualizar"></i>
											</a>
										</td>
										<td >
											@if ($user->active)
												<a class="btn btn-warning" href="#" id="desactivate_btn_{{$user->id}}" onclick="showDesactivateForm('{{$user->id}}','{{$user->fullname}}');return false;">
													<i class="fa fa-times" value="Desactivar"></i>
												</a>
											@else
												<span class="label label-danger">Inhabilitado</i></span>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<form id="desactivateForm" action="/usuarios/desactivar" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="user_id" id="user_id" value="">
		</form>
		<form id="reactivateForm" action="/usuarios/reactivar" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="re_user_id" id="re_user_id" value="">
		</form>
	</div>

		{{--
	<section id="content">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p> </p>
					@if(session()->has('success'))
						@if (session('success') == true)
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
	</section>--}}
	@include('modules.users.forms.desactivate-form-modal')
	@include('modules.users.forms.reactivate-form-modal')
@endsection
@section('js')
	{{--@include('components.datatables.datatable')--}}
	<script src="/js/bootstrap-table.js"></script>
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
