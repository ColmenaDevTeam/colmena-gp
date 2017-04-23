@extends('layouts.main')
@section('css')

@endsection

@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-12">
					<h2 class="pageTitle">{{isset($activity) ? 'Edición' : 'Registro'}} de tareas</h2>
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
				<div class="activity-data-form">
					<form method="post" data-parsley-validate name="register">
						{{ csrf_field() }}
						@if (isset($activity))
							<input type="hidden" name="id" value="{{ $activity->id }}">
						@endif
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="title">* Titulo</label>
									<input type="text" class="form-control" name="title" placeholder="Título de la actividad" value="{{ isset($activity) ? $activity->title : ''}}" required>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="priority">* Prioridad</label><br>
									<select name="priority" id="priority" class="form-control" required>
										<option value="1" {{ isset($activity) && $activity->priority == 1 ? 'selected' : '' }}>Baja</option>
										<option value="2" {{ isset($activity) && $activity->priority == 2 ? 'selected' : '' }}>Media</option>
										<option value="3" {{ isset($activity) && $activity->priority == 3 ? 'selected' : '' }}>Alta</option>
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">* Complejidad</label><br>
									<select name="complexity" id="complexity" class="form-control" required>
										<option value="1" {{ isset($activity) && $activity->complexity == 1 ? 'selected' : '' }}>Baja</option>
										<option value="2" {{ isset($activity) && $activity->complexity == 2 ? 'selected' : '' }}>Media</option>
										<option value="3" {{ isset($activity) && $activity->complexity == 3 ? 'selected' : '' }}>Alta</option>
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="type">Tipo de actividad</label>
									<select name="task_type" id="task_type" class="form-control">
										@for ($i=0; $i < count($types); $i++)
											<option value="{{ $types[$i] }}" {{ isset($activity) && $activity->task_type == $types[$i] ? 'selected' : '' }}>{{ $types[$i] }}</option>
										@endfor
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="name">* Tipo de frecuencia</label>
									<select name="frequency" id="frequency" class="form-control">
										@for ($i=0; $i < count($frequency); $i++)
											<option value="{{ $frequency[$i] }}" {{ isset($activity) && $activity->frequency == $frequency[$i] ? 'selected' : '' }}>{{ $frequency[$i] }}</option>
										@endfor
									</select>
									<span class="block-info">
										Frecuencia con la que se creará la tarea
									</span>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="deliverer_days">* Tiempo de entrega</label>
									<input type="number" min="1" max="180" class="form-control" id="deliverer_days" name="deliverer_days" placeholder="" value="{{ isset($activity) ? $activity->deliverer_days : '' }}" required>

									<span class="block-info">
										Debe expresarse en días
									</span>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="start_date">Fecha de primer lanzamiento</label>
									<select name="start_date" id="start_date" class="form-control">
										@foreach ($dates as $date)
											<option value="{{ $date }}" {{ isset($activity) && $activity->start == $date ? 'selected' : '' }}>{{ $date }}</option>
										@endforeach
									</select>
									<span class="block-info">
										Fecha del primer lanzamiento de la actividad recurrente
									</span>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						</div><!-- -/.row-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group has-feedback">
									<label for="details">* Detalles</label>
									<textarea class="form-control" rows="4" id="details" name="details" placeholder="" required minlength="10">{{ isset($activity) ? $activity->details : '' }}</textarea>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						</div><!-- -/.row-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="list-group">
									<a href="" class="list-group-item active">* Listado de usuarios</a>
									<div class="row">
										@foreach ($users as $user)
											<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
												<a href="#{{$user->id}}" class="list-group-item">
													<input type="checkbox" style=""id="{{$user->id}}" name="users[]" value="{{$user->id}}" {{ isset($activity) && $activity->users->contains($user) ? 'checked=true' : '' }}>
														{{$user->fullname}}
														<span class="label label-info pull-right" title="Grádo de ocupación de {{$user->fullname}}">
															{{$user->ocupation}}
														</span>
													</input>
												</a>
											</div><!-- /.col-xs-12 col-sm-4 col-md-3 col-lg-3-->
										@endforeach
									</div><!-- /.row-->
								</div><!-- /.list-group-->
							</div>
						</div><!-- -/.row-->
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="submit" value="{{isset($activity) ? 'Editar' : 'Registrar'}} Actividad Recurrente" class="btn btn-info"/>
							</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
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
