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
				<div class="text-right">
					<a class="btn btn-warning" id="update" href="{{url("/tareas/modificar/$task->id")}}">
						<i class="fa fa-pencil"></i>Modificar
					</a>
					<a class="btn btn-danger" href="#" onclick="$('#delete-form-modal').modal().show();">
						Eliminar <i class="fa fa-times" value="Eliminar"></i>
					</a>
				</div>
				<hr>
			</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="list-group">
					<a href="" class="list-group-item active text-center" onClick="return false;">
						<h3 style="color: white;">{{$task->title}}
						</h3>
					</a>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<p class="text-justify">
									{{$task->details}}
								</p>
								<hr>
								@php
									$P_BMA = ['Baja', 'Media', 'Alta'];
								@endphp
								<p class="text-center">
									<label for="" style="">Prioridad: </label>
									<span class="label label-default">{{$P_BMA[$task->priority-1]}}</span>

									<label for="" style="margin-left: 10pt;">Complejidad: </label>
									<span class="label label-default">{{$P_BMA[$task->complexity-1]}}</span>

									<label for="" style="margin-left: 10pt;">Tipo de tarea: </label>
									<span class="label label-default">{{$task->type}}</span>

									<label for="" style="margin-left: 10pt;">Fecha de tope: </label>
									<span class="label label-default">{{$task->estimated_date->format('d/m/Y')}}</span>
								</p>

								<hr>
								<h4>Responsables: </h4>
								@foreach ($task->responsibles as $responsible)
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="list-group">
											<a href="#l_{{strtolower(str_replace(' ', '_', $responsible->cedula ))}}" class="list-group-item active" data-toggle="collapse">
												{{$responsible->fullname}}
											</a>
											<div class="collapse" id="l_{{strtolower(str_replace(' ', '_', $responsible->cedula ))}}">
												<p>Fecha de tope:Fecha de tope:Fecha de tope:Fecha de tope:Fecha de tope:</p>
												<div class="text-center" style="padding: 20px">
													<a href="#"  onclick="$('#transact-form-modal').modal().show(); return false;" class="btn btn-success">Tramitar Tarea</a>
												</div>
												{{--@foreach ($perms as $permission)
													<p class="list-group-item">
														<input type="checkbox" {{isset($role) && $role->permissions->contains($permission) ? 'checked' : ''  }} id="{{$permission->id}}" name="permissions[]" value="{{$permission->id}}">
															{{$permission->action}}
														</input>
													</p>
												@endforeach--}}
											</div>
										</div>
									</div>
								@endforeach
							<hr>
						</div><!-- ./col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
					</div><!-- -/.row-->
				</div><!-- -/.list-group-->
			</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
		</div><!-- -/.row-->
	</div>
	@include('modules.tasks.forms.transact-form-modal')
	@include('modules.tasks.forms.delete-form-modal')
@endsection
@section('js')

@endsection
