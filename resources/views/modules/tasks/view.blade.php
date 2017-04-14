@extends('layouts.main')
@section('css')

@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tramitar Tarea</h1>
			</div>
		</div><!--/.row-->
		@include('components.notification.notification')
		@if ($errors->has('status'))
			<div class="alert alert-warning help-block">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>{{ $errors->first('status') }}</strong>
			</div>
		@endif
		@if ($errors->has('details'))
			<div class="alert alert-warning help-block">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>{{ $errors->first('details') }}</strong>
			</div>
		@endif
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="list-group">
					<a href="" class="list-group-item active text-center" onClick="return false;">
						<h3 style="color: white;">{{$task->title}}
						</h3>
					</a>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<a href="" class="list-group-item" onClick="return false;">
								<p class="text-justify">
									{{$task->details}}
								</p>
								<hr>
								<?php $P_BMA = ['Baja', 'Media', 'Alta']?>
								<p class="text-center">
									<label for="" style="">Prioridad: </label>
									<span class="label label-default">{{$P_BMA[$task->priority-1]}}</span>

									<label for="" style="margin-left: 10pt;">Complejidad: </label>
									<span class="label label-default">{{$P_BMA[$task->complexity-1]}}</span>

									<label for="" style="margin-left: 10pt;">Tipo de tarea: </label>
									<span class="label label-default">{{$task->type}}</span>

									<label for="" style="margin-left: 10pt;">Fecha de entrega: </label>
									<span class="label label-default">{{$task->estimated_date}}</span>
								</p>
								<hr>
							</a><!-- ./list-group-item -->
							<a href="#{{--$task->responsible->getURL()--}}" class="list-group-item active text-center">
								<span class="label label-default">Responsable:</span><h4 style="color: white;">{{$task->responsible->fullname}}</h4>
							</a>
							<hr>
						</div><!-- ./col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<button type="button" class="btn btn-warning pull-left" style="margin-left: 3pt;" onclick="window.location='/tareas/modificar/{{$task->idTar}}'">
								Modificar <i class="fa fa-pencil"></i>
							</button>
							<form id="borrarTarea" class="form" name="borrarTarea" method="post" action="/tareas/eliminar">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{$task->id}}" name="id">
								<button id="borrarTar" class="btn btn-danger pull-left" style="margin-left: 3pt;" onClick="confirmarEliminar('borrarTar');">
									Eliminar <i class="fa fa-times" value="Eliminar"></i>
								</button>
							</form>
						</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<hr>
							<a href="" class="list-group-item active text-center" onClick="return false;">
								<h3 style="color: white;">Tramites
								</h3>
							</a>
								<div class="table-responsive">
					 				<a href="" class="list-group-item" onClick="return false;">
					 					<p class="text-center">
						 					<hr>
											@foreach ($task->taskLogs as $log)
												<span class="label label-default">{{$log->created_at}}</span> Por: <span class="label label-default">{{$log->user}}</span> Estado: <span class="label label-default">{{$log->status}}</span> <br>{{$log->details}}
												<hr>
											@endforeach
										</p>
									</a>
								</div> <!-- /.table-responsive-->
								{{--<div class="pagination"> {{ $task->taskLogs->links() }} </div>--}}
								<div class="text-center" style="padding-top: 20px">
									<a href="#"  onclick="$('#transact-form-modal').modal().show(); return false;" class="btn btn-success">Tramitar Tarea</a>
								</div>

							</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						</div><!-- -/.row-->
					</div><!-- -/.row-->
				</div><!-- -/.list-group-->
			</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
		</div><!-- -/.row-->

	</div>
	@include('modules.tasks.forms.transact-form-modal')
@endsection
@section('js')

@endsection
