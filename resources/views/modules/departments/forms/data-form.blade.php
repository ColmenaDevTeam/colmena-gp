@extends('layouts.main')
@section('css')

@endsection

@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-12">
					<h2 class="pageTitle">{{isset($department) ? 'Edición' : 'Registro'}} de departamentos</h2>
				</div>
			</div>
		</div>
			<div class="row">
				@include('components.notification.notification')
				@if ($errors->has('name'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('name') }}</strong>
					</div>
				@endif
				@if ($errors->has('description'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('description') }}</strong>
					</div>
				@endif
			</div><!-- /..row-->
			<div class="row">
				<div class="department-data-form">
					<form id="department-data-form" role="form" method="post" data-parsley-validate>
						{{ csrf_field() }}
						@if(isset($department))
							<input type="hidden" name="id" value="{{ $department->id }}">
						@endif
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group has-feedback">
									<label for="name">Nombre</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Departamento de Informática" value="{{ isset($department) ? $department->name : ''}}">
									<i class="fa fa-users form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group has-feedback">
									<label for="description">Descripción</label>
									<textarea rows="8" cols="80" class="form-control" id="description" name="description" >{{ isset($department) ? $department->description : ''}}</textarea>
									<i class="fa fa-pencil form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="submit" value="{{isset($department) ? 'Editar' : 'Registrar'}} departamento" class="btn btn-info">
							</div> <!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
						</div><!-- -/.row-->
					</form>
				</div><!-- /.contact-form -->
			</div><!-- /.row -->
		</div>
@endsection

@section('js')
@endsection
