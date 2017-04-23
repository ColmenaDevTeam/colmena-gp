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
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="list-group">
					<a href="" class="list-group-item active text-center" onClick="return false;">
						<h3 style="color: white;">{{$activity->title}}
						</h3>
					</a>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<a href="" class="list-group-item" onClick="return false;">
								<p class="text-justify">
									{{$activity->details}}
								</p>
								<hr>
								<p class="text-center">
									<label for="" style="">Dificultad: </label>
									<span class="label label-default">{{$activity->dificulty}}</span>

									<label for="" style="margin-left: 10pt;">Tipo de tarea: </label>
									<span class="label label-default">{{$activity->task_type}}</span>

									<label for="" style="margin-left: 10pt;">Fecha de inicio: </label>
									<span class="label label-default">{{$activity->start_date}}</span>

									<label for="" style="margin-left: 10pt;">Ultimo lanzamiento: </label>
									<span class="label label-default">{{$activity->last_launch}}</span>

									<label for="" style="margin-left: 10pt;">Tiempo de entrega: </label>
									<span class="label label-default">{{$activity->deliverer_days. ' días'}}</span>

									<label for="" style="margin-left: 10pt;">Estado: </label>
									<span class="label label-default">{{$activity->active ? 'Activa' : 'Inactiva'}}</span>
								</p>
								<hr>
							</a><!-- ./list-group-item -->
							<hr>
						</div><!-- ./col-xs-12 col-sm-12 col-md-12 col-lg-12 -->

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="text-center">
								<a href="#"  onclick="$('#{{ $activity->active ? 'desactivate' : 'reactivate' }}-form-modal').modal().show(); return false;" class="btn btn-{{ $activity->active ? 'warning' : 'success' }}">
									<i class="fa fa-check-square-o"></i>{{ $activity->active ? 'Desactivar' : 'Activar' }} Actividad
								</a>
								<a class="btn btn-warning" id="update" href="/actividades-recurrentes/editar/{{$activity->id}}">
									<i class="fa fa-pencil"></i>Modificar
								</a>
								<a class="btn btn-danger" href="#" onclick="$('#delete-form-modal').modal().show();">
									Eliminar <i class="fa fa-times"></i>
								</a>
							</div>
						</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						@if (count($activity->users)>0)
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<hr>
								<a href="" class="list-group-item active text-center" onClick="return false;">
									<h3 style="color: white;">Usuarios responsables</h3>
								</a>
									<div class="table-responsive">
										@foreach ($activity->users as $user)
						 				<a href="" class="list-group-item" onClick="return false;">
											<div class="text-justify">
												<p>{{ $user->fullname }}</p>
											</div>
										</a>
										@endforeach
									</div> <!-- /.table-responsive-->
							</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						@endif
					</div><!-- -/.row-->
				</div><!-- -/.list-group-->
			</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
		</div><!-- -/.row-->
	</div>
	@include('modules.recurring-activities.forms.delete-form-modal')
	@if ($activity->active)
		@include('modules.recurring-activities.forms.desactivate-form-modal')
	@else
		@include('modules.recurring-activities.forms.reactivate-form-modal')
	@endif

@endsection
@section('js')

@endsection
