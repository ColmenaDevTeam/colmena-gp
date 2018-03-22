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
			<h1 class="page-header">Gestion de Actividades Recurrentes</h1>
		</div>
	</div><!--/.row-->
		@include('components.notification.notification')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Listado </div>
				<div class="panel-body">
					<p class="text-left">
						<a href="{{url("/actividades-recurrentes/registrar")}}" class="btn btn-info">Registrar</a>
					</p>
					<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						<thead>
								<tr>
									<th data-sortable="true" data-field="title">Titulo</th>
									<th data-sortable="true" data-field="start_date">Fecha de inicio</th>
									<th data-sortable="true" data-field="last_launch">Ultimo lanzamiento</th>
									<th data-sortable="true" data-field="type">Tiempo de entrega</th>
									<th data-sortable="true" data-field="status">Detalles</th>
									<th data-sortable="true" data-field="details">Dificultad</th>
									<th data-sortable="true" data-field="details">Tipo</th>
									<th data-sortable="true" data-field="active">¿Activa?</th>
									<th>Ver</th>
									<th>Modificar</th>
								</tr>
							</thead>
							<tbody>
								@foreach($activities as $activity)
									<tr>
										<td>{{$activity->title}}</td>
										<td>{{$activity->start_date}}</td>
										<td>{{$activity->last_launch ? $activity->last_launch : "-" }}</td>
										<td>{{$activity->deliverer_days.' días'}}</td>
										<td>{{$activity->details}}</td>
										<td>{{$activity->dificulty}}</td>
										<td>{{$activity->task_type}}</td>
										<td>{{$activity->active ? 'Si' : 'No'}}</td>
										<td>
											<a href="{{url("/actividades-recurrentes/$activity->id/ver")}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
										</td>
										<td>
											<a class="btn btn-warning" id="update" href="{{url("/actividades-recurrentes/modificar/$activity->id")}}">
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
	<script src="{{url("/js/bootstrap-table.js")}}"></script>
@endsection
