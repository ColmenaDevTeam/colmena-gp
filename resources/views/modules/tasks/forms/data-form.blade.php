@extends('layouts.main')
@section('css')

@endsection

@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-12">
					<h2 class="pageTitle">{{isset($task) ? 'Edición' : 'Registro'}} de tareas</h2>
				</div>
			</div>
		</div>
			<div class="row">
				@include('components.notification.notification')
				@if ($errors->has('title'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('title') }}</strong>
					</div>
				@endif
				@if ($errors->has('type'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('type') }}</strong>
					</div>
				@endif
				@if ($errors->has('priority'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('priority') }}</strong>
					</div>
				@endif
				@if ($errors->has('complexity'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('complexity') }}</strong>
					</div>
				@endif
				@if ($errors->has('estimated_date'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('estimated_date') }}</strong>
					</div>
				@endif
				@if ($errors->has('details'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('details') }}</strong>
					</div>
				@endif
				@if ($errors->has('users'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('users') }}</strong>
					</div>
				@endif
			</div><!-- /..row-->
			<div class="row">
				<div class="task-data-form">
					<form id="task-data-form" role="form" method="post" data-parsley-validate>
						{{ csrf_field() }}
						@if(isset($task))
							<input type="hidden" name="id" value="{{ $task->id }}">
						@endif
						<div class="row">
							<div class="col-xs-1 col-sm-4 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="title">Titulo</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="Departamento de Informática" value="{{ isset($task) ? $task->title : ''}}">
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-1 col-sm-4 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="type">Tipo de tarea</label>
									<select name="type" id="type" class="form-control">
										@for ($i=0; $i < count($types); $i++)
											<option value="{{ $types[$i] }}" {{ isset($task) && $task->type == $types[$i] ? 'selected' : '' }}>{{ $types[$i] }}</option>
										@endfor
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-1 col-sm-4 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="priority">Prioridad</label>
									<select name="priority" id="priority" class="form-control">
										<option value="1">Baja</option>
						   				<option value="2">Media</option>
						   				<option value="3">Alta</option>
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-1 col-sm-4 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="complexity">Complejidad</label>
									<select name="complexity" id="complexity" class="form-control">
										<option value="1">Baja</option>
						   				<option value="2">Media</option>
						   				<option value="3">Alta</option>
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="estimated_date">Fecha entrega</label>
									<select name="estimated_date" id="estimated_date" class="form-control">
										@foreach ($dates as $date)
											<option value="{{ $date }}">{{ $date }}</option>
										@endforeach
									</select>{{--
									<label for="estimated_date">Fecha entrega</label>
									<input type="text" class="form-control" id="estimated_date" name="estimated_date" placeholder="20/01/2017" value="{{ isset($task) ? $task->estimated_date->format('d/m/Y') : ''}}" data-inputmask="'mask' : '99/99/9999'">
								--}}</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group has-feedback">
									<label for="details">Descripción</label>
									<textarea rows="8" cols="80" class="form-control" id="details" name="details" >{{ isset($task) ? $task->details : ''}}</textarea>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								@if (isset($task))
									<div class="col-xs-1 col-sm-4 col-md-4 col-lg-3">
										<div class="form-group has-feedback">
											<label for="user_id">Responsable: {{ $task->responsible->fullname }}</label>
										</div>
									</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
								@else
									<div class="list-group">
										<label for="details">Listado de usuarios</label>
										<div class="row">
											@foreach ($users as $user)
												<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
													<p class="list-group-item">
														<input type="checkbox" style=""id="{{$user->id}}" name="users[]" value="{{$user->id}}" class="pull-left">
															{{$user->fullname}}
														</input>
														<span class="label label-info pull-right" title="Grádo de ocupación de {{$user->fullname}}">
															{{ $user->ocupation }}
														</span>
													</p>
												</div><!-- /.col-xs-12 col-sm-6 col-md-4 col-lg-4-->
											@endforeach
										</div><!-- /.row-->
									</div><!-- /.list-group-->
								@endif
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="submit" value="{{isset($task) ? 'Editar' : 'Registrar'}} tarea" class="btn btn-info">
							</div> <!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
						</div><!-- -/.row-->
					</form>
				</div><!-- /.contact-form -->
			</div><!-- /.row -->
		</div>
@endsection

@section('js')
	<script type="text/javascript" src="/js/jquery.inputmask.bundle.min.js"></script>
	<script type="text/javascript">
		$(":input").inputmask();
		or
		Inputmask().mask(document.querySelectorAll("input"));
	</script>
@endsection
