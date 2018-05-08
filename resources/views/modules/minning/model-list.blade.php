@extends('layouts.main')
@section('css')
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
		<h1 class="page-header">Modelos Generados: </h1>
	</div>
</div><!--/.row-->
	@include('components.notification.notification')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Listado</div>
			<div class="panel-body">
				<p class="text-left">
					<a href="{{url("/segmentacion-de-datos/explorar")}}" class="btn btn-info">Generar</a>
				</p>
				<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
					<thead>
						<tr>
							<th data-sortable="true" data-field="name">Modelo</th>
							<th data-sortable="true" data-field="description">Descripción</th>
							<th data-sortable="true" data-field="clusters">Conglomerados</th>
							<th data-sortable="true" data-field="range">Rango de datos</th>
							<th data-sortable="true" data-field="total">Registros</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($models as $model)
							<tr>
								<td>{{$model->name}}</td>
								<td>{{$model->description}}</td>
								<td>{{$model->clusters}}</td>
								<td>[{{$model->min_selected}} - {{$model->max_selected}}]</td>
								<td>{{$model->total_avaliable}}</td>
								<td>
										<div class="btn-group">
											<a href="#" {{--href="/segmentacion-de-datos/evaluar/{{$model->id}}"--}} class="btn btn-success" data-toggle="tooltip" title="Aplicar Modelo">
												<i class="fa fa-pencil"></i>
											</a>

											<a href="{{url("/segmentacion-de-datos/borrar/".$model->id)}}" class="btn btn-danger" data-toggle="tooltip" title="Borrar Modelo">
												<i class="fa fa-times"></i>
											</a>
											<a href="#" {{--href="/segmentacion-de-datos/datos/{{ $model->id }}"--}} class="btn btn-info" data-toggle="tooltip" title="Ver Datos del Modelo">
												<i class="fa fa-eye"></i>
											</a>
										</div>
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
