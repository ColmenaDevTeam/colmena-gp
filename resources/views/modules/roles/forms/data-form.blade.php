@extends('layouts.main')
@section('css')

@endsection

@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-12">
					<h2 class="pageTitle">{{isset($role) ? 'Edición' : 'Registro'}} de roles</h2>
				</div>
			</div>
		</div>
		@include('components.notification.notification')
		<div class="row">
			@if ($errors->has('name'))
				<div class="alert alert-warning help-block">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>{{ $errors->first('name') }}</strong>
				</div>
			@endif
			@if ($errors->has('permissions'))
				<div class="alert alert-warning help-block">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>{{ $errors->first('permissions') }}</strong>
				</div>
			@endif
		</div><!-- /..row-->
		<div class="row">
			<div class="department-data-form">
				<form id="department-data-form" role="form" method="post" data-parsley-validate>
					{{ csrf_field() }}
					@if(isset($role))
						<input type="hidden" name="id" value="{{ $role->id }}">
					@endif
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-group has-feedback">
								<label for="name">Nombre</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Jefe de departamento" value="{{ isset($role) ? $role->name : ''}}">
							</div>
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="list-group">
								<label for="details">Listado de permisos</label>
								<div class="row">
									<div class="alert alert-info">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<p>En esta sección podrás seleccionar los permisos que tendrá el rol dentro del sistema, los permisos se encuentran dispuestos por categoria, recuerda seleccionar los adecuados para cada rol</p>
									</div>
									@foreach ($permissions as $key => $perms)
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
											<div class="list-group">
												<a href="#l_{{strtolower(str_replace(' ', '_', $key ))}}" class="list-group-item active" data-toggle="collapse">
													{{$key}}
												</a>
												<div class="collapse" id="l_{{strtolower(str_replace(' ', '_', $key ))}}">
													@foreach ($perms as $permission)
														<p class="list-group-item">
															<input type="checkbox" {{isset($role) && $role->permissions->contains($permission) ? 'checked' : ''  }} id="{{$permission->id}}" name="permissions[]" value="{{$permission->id}}">
																{{$permission->action}}
															</input>
														</p>
													@endforeach
												</div>
											</div>
										</div>
									@endforeach
								</div><!-- /.row-->
							</div><!-- /.list-group-->
						</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<input type="submit" value="{{isset($role) ? 'Editar' : 'Registrar'}} rol" class="btn btn-info">
						</div> <!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
					</div><!-- -/.row-->
				</form>
			</div><!-- /.contact-form -->
		</div><!-- /.row -->
	</div>
@endsection

@section('js')
@endsection
