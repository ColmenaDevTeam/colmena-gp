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
			<h1 class="page-header">Gestion de Departamentos</h1>
		</div>
	</div><!--/.row-->
		@include('components.notification.notification')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Listado </div>
				<div class="panel-body">
					<p class="text-left"><a href="/departamentos/registrar" class="btn btn-info">Registrar</a></p>
					<table data-toggle="table" data-show-refres41758498h="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						<thead>
								<tr>
									<th data-sortable="true" data-field="name">Nombre</th>
									<th data-sortable="true" data-field="description">Descripción</th>
									<th data-sortable="true" data-field="users">Usuarios Asignados</th>
									<th>Modificar</th>
								</tr>
							</thead>
							<tbody>
								@foreach($departments as $department)
									<tr>
										<td>{{$department->name}}</td>
										<td>{{$department->description}}</td>
										<td>
											<a href="/departamento/{{$department->id}}/listado">{{ count($department->users) }}</a>
										</td>
										<td>
											<a class="btn" id="update" href="/departamentos/editar/{{$department->id}}">
												<i class="fa fa-pencil" value="Actualizar"></i>
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
				</div>
			</div>
		</div>
@endsection
@section('js')
	<script src="/js/bootstrap-table.js"></script>
@endsection
