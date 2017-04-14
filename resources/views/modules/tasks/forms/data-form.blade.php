@extends('layouts.main')
@section('css')

@endsection

@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-12">
					<h2 class="pageTitle">{{isset($department) ? 'Edición' : 'Registro'}} de tareas</h2>
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
				@if ($errors->has('type'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('type') }}</strong>
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
									<label for="title">Nombre</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="Departamento de Informática" value="{{ isset($department) ? $department->title : ''}}">
									<i class="fa fa-users form-control-feedback"></i>
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group has-feedback">
									<label for="type">Descripción</label>
									<textarea rows="8" cols="80" class="form-control" id="type" name="type" >{{ isset($department) ? $department->type : ''}}</textarea>
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
	<script type="text/javascript" src="/js/jquery.inputmask.bundle.min.js"></script>
	<script type="text/javascript">
		$(":input").inputmask();
		or
		Inputmask().mask(document.querySelectorAll("input"));
	</script>
@endsection
