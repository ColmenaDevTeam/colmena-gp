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
			<h1 class="page-header">Gestion de Tareas</h1>
		</div>
	</div><!--/.row-->
		@include('components.notification.notification')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Listado </div>
				<div class="panel-body">
					<p class="text-left">
						<a href="/tareas/registrar" class="btn btn-info">Registrar</a>
						<a href="/tareas/todas" class="btn btn-info">Ver todas</a>
					</p>
					<table data-toggle="table" data-show-refres41758498h="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						<thead>
								<tr>
									<th data-sortable="true" data-field="title">Titulo</th>
									<th data-sortable="true" data-field="responsible">Responsable</th>
									<th data-sortable="true" data-field="type">Tipo de tarea</th>
									<th data-sortable="true" data-field="status">Estado</th>
									<th data-sortable="true" data-field="details">Detalles</th>
									<th data-sortable="true" data-field="dificulty">Dificultad</th>
									<th data-sortable="true" data-field="estimated_date">Fecha tope</th>
									<th data-sortable="true" data-field="deliver_date">Fecha de entrega</th>
									<th>Ver</th>
									<th>Modificar</th>
								</tr>
							</thead>
							<tbody>
								@foreach($tasks as $task)
									<tr>
										<td>{{$task->title}}</td>
										<td>{{$task->responsible->fullname}}</td>
										<td>{{$task->type}}</td>
										<td>{{$task->status}}</td>
										<td>{{$task->details}}</td>
										<td>{{ $task->dificulty }}</td>
										<td>{{$task->estimated_date->format('d/m/Y')}}</td>
										<td>{{$task->deliver_date}}</td>
										<td>
											<a href="/tareas/{{$task->id}}/ver" class="btn btn-info"><i class="fa fa-eye"></i></a>
										</td>
										<td>
											<a class="btn btn-warning" id="update" href="/tareas/modificar/{{$task->id}}">
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
