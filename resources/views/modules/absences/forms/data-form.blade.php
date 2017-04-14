@extends('layouts.main')
@section('css')

@endsection

@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-12">
					<h2 class="pageTitle">{{isset($absence) ? 'Edición' : 'Registro'}} de ausencias</h2>
				</div>
			</div>
		</div>
			<div class="row">
				@include('components.notification.notification')
				@if ($errors->has('start_date'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('start_date') }}</strong>
					</div>
				@endif
				@if ($errors->has('end_date'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('end_date') }}</strong>
					</div>
				@endif
				@if ($errors->has('details'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('details') }}</strong>
					</div>
				@endif
				@if ($errors->has('user_id'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('user_id') }}</strong>
					</div>
				@endif
				@if ($errors->has('type'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('type') }}</strong>
					</div>
				@endif
			</div><!-- /..row-->
			<div class="row">
				<div class="user-data-form">
					<form id="user-data-form" role="form" method="post" data-parsley-validate>
						{{ csrf_field() }}
						@if(isset($absence))
							<input type="hidden" name="id" value="{{ $absence->id }}">
						@endif
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="type">Tipo de ausencia</label>
									<select name="type" id="type" class="form-control" required>
									    <option value="1">Permiso</option>
									    <option value="0">Reposo</option>
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="start_date">Fecha inicio</label>
									<input type="text" class="form-control" id="start_date" name="start_date" placeholder="20/01/2017" value="{{ isset($absence) ? $absence->start_date->format('d/m/Y') : ''}}" data-inputmask="'mask' : '99/99/9999'">
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="end_date">Fecha fin</label>
									<input type="text" class="form-control" id="end_date" name="end_date" placeholder="20/01/2017" value="{{ isset($absence) ? $absence->end_date->format('d/m/Y') : ''}}" data-inputmask="'mask' : '99/99/9999'">

								</div>

							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="form-group has-feedback">
									<label for="user_id">Usuario</label><br>
									<select name="user_id" id="user_id" class="form-control">
										@foreach ($users as $user)
											<option value="{{$user->id}}" {{ isset($absence) && $absence->user->id == $user->id ? 'selected' : '' }}>{{ $user->fullname }}</option>
										@endforeach
									</select>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<label for="details">Detalles</label>
								<div class="form-group has-feedback">
									<textarea name="details" id="details" rows="8" cols="80" placeholder="Cita medica">{{ isset($absence) ? $absence->details : ''}}</textarea>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="submit" value="{{isset($absence) ? 'Editar' : 'Registrar'}} ausencia" class="btn btn-info">
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
