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
			<h1 class="page-header">Gestion de Tareas</h1>
		</div>
	</div><!--/.row-->
		@include('components.notification.notification')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Listado </div>
				<div class="panel-body">
					<p class="text-right">
						@if (\Auth::user()->canDo('tasks.create'))
							<a href="{{url("/tareas/registrar")}}" class="btn btn-info">Registrar</a>
						@endif
						@if (\Auth::user()->canDo('tasks.list_all'))
							<a href="{{url("/tareas/todas")}}" class="btn btn-info">Ver todas</a>
						@endif
					</p>
					@if (!isset($all))
						@if (\Auth::user()->tasks->count())
							@include('modules.tasks.table-view', ['data' => ['title' => 'Mis Tareas', 'tasks' => \Auth::user()->tasks]])
						@endif
						@if (\Auth::user()->canDo('tasks.create') && count(\Auth::user()->createdTasks))
							@include('modules.tasks.table-view', ['data' => ['title' => 'Tareas Creadas', 'tasks' => \Auth::user()->createdTasks]])
						@endif

						@if (\Auth::user()->canDo('tasks.department_list') && count(\Auth::user()->department->tasks))
							@include('modules.tasks.table-view', ['data' => ['title' => 'Tareas del Departamento', 'tasks' => \Auth::user()->department->tasks]])
						@endif
					@else
						@include('modules.tasks.table-view', ['data' => ['title' => 'Todas las Tareas', 'tasks' => $tasks]])
					@endif
				</div>
			</div>
		</div>
@endsection
@section('js')
	<script src="{{url("/js/bootstrap-table.js")}}"></script>
@endsection
