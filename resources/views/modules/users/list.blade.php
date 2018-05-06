<!--
@author: QSoto
-->
@extends('layouts.main')
@section('css')
	{{--<link rel="stylesheet" href="/css/dataTables.bootstrap.min.css">--}}
	<link href="{{url("/css/bootstrap-table.css")}}" rel="stylesheet">
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
				<h1 class="page-header">{{isset($title) ? $title : 'Gestion de Usuarios'}}</h1>
			</div>
		</div><!--/.row-->
		@include('components.notification.notification')
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Listado </div>
					<div class="panel-body">
						<p class="text-left"><a href="/usuarios/registrar" class="btn btn-info">Registrar</a></p>
						<table data-toggle="table" data-show-refres41758498h="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							<thead>
								<tr>
									<th data-sortable="true" data-field="firstname">Nombre</th>
									<th data-sortable="true" data-field="cedula">Cedula</th>
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
										<td ><a href="{{ url($user->url) }}">{{$user->fullname}}</td></a>
										<td >{{$user->cedula}}</td>
										<td >{{$user->birthdate->format('d/m/Y')}}</td>
										<td >{{$user->genderString}}</td>
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
											<a class="btn btn-info" id="update" href="{{url("/usuarios/modificar/$user->id")}}">
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
		<form id="desactivateForm" action="{{url("/usuarios/desactivar")}}" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="user_id" id="user_id" value="">
		</form>
		<form id="reactivateForm" action="{{url("/usuarios/reactivar")}}" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="re_user_id" id="re_user_id" value="">
		</form>
	</div>
	@include('modules.users.forms.desactivate-form-modal')
	@include('modules.users.forms.reactivate-form-modal')
@endsection
@section('js')
	{{--@include('components.datatables.datatable')--}}
	<script src="{{url("/js/bootstrap-table.js")}}"></script>
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
