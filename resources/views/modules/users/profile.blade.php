@extends('layouts.main')
@section('css')

@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{isset($title) ? $title : 'Perfiles de usuarios'}}</h1>
			</div>
		</div><!--/.row-->
		@include('components.notification.notification')
		@if ($errors->has('email'))
			<div class="alert alert-warning help-block">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>{{ $errors->first('email') }}</strong>
			</div>
		@endif
		@if ($errors->has('phone'))
			<div class="alert alert-warning help-block">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>{{ $errors->first('phone') }}</strong>
			</div>
		@endif
		@if ($errors->has('password'))
			<div class="alert alert-warning help-block">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>{{ $errors->first('password') }}</strong>
			</div>
		@endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ $user->fullname }}</div>
					<div class="panel-body">
						<div class="alert alert-info">
							<div class="text-center">
								¿Tienes algún error en tus datos y no puedes modificarlos?<br>
								¡Ponte en contacto con el administrador del sistema!
							</div>
						</div>
						<div class="perfil-form">
							<form id="profile-form" method="post" action="/usuarios/actualizar-perfil" name="formPerfil">
								<div class="row">
									{{ csrf_field() }}
									<input type="hidden" name="user_id" value="{{ $user->id }}">
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<div class="form-group has-feedback">
											<label for="nombres">Nombres</label>
											<br>{{$user->firstname}}
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<div class="form-group has-feedback">
											<label for="apellidos">Apellidos</label>
											<br>{{$user->lastname}}
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<div class="form-group has-feedback">
											<label for="birthdate">Fecha de Nacimiento</label>
											<br>{{$user->birthdate->format('d/m/Y')}}
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<div class="form-group has-feedback">
											<label for="status">Estado</label>
											<br>{{$user->active ? 'Activo' : 'Inhabilitado'}}
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<div class="form-group has-feedback">
											<label for="gender">Sexo</label>
											<br>{{ $user->genderString }}
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<div class="form-group has-feedback">
											<label for="usertype">Tipo de Usuario</label>
											<br>{{$user->user_type}}
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<div class="form-group has-feedback">
											<label for="email">Correo Electronico</label>
											<input required type="email" class="form-control" id="email" name="email" autocomplete="off" value={{$user->email}}>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<div class="form-group has-feedback">
											<label for="phone">Telefono</label>
											<input required type="tel" class="form-control" data-inputmask="'mask' : '99999999999'" id="phone" name="phone" autocomplete="off" value={{$user->phone}}>
										</div>
									</div>
								</div><!-- /.row -->
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
										<div class="pull-right">
											<input type="submit" value="Cambiar datos" class="btn btn-success">
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
										<div class="pull-left">
											<a href="#" class="btn btn-warning" onclick="$('#password-form-modal').modal().show()">Cambiar Contraseña</a>
										</div>
									</div>
								</form>
								</div><!-- /.row -->
						</div><!-- /.perfil-form -->
					</div>
				</div>
			</div><!-- /.row -->
		</div>
	</div>
	@include('modules.users.forms.password-form-modal')
@endsection
@section('js')
	<script type="text/javascript" src="/js/jquery.inputmask.bundle.min.js"></script>
	<script type="text/javascript">
		$(":input").inputmask();
		or
		Inputmask().mask(document.querySelectorAll("input"));
	</script>
@endsection
