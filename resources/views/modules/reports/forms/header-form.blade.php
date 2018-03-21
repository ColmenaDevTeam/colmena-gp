@extends('layouts.main')
@section('css')

@endsection

@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-12">
					<h2 class="pageTitle">Registro de cintillo universitario</h2>
				</div>
			</div>
		</div>
			<div class="row">
				@include('components.notification.notification')
				@if ($errors->has('header'))
					<div class="alert alert-warning help-block">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>{{ $errors->first('header') }}</strong>
					</div>
				@endif
			</div><!-- /..row-->
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="alert alert-info">
						<font color="#6198fd" size="5"><strong>¡Atención!</strong></font>
						<ul>
							<li>
								A continuación se muestra un formulario en donde se debe cargar el cintillo universitario,
								dicho cintillo será utilizado por el sistema para los reportes de data.
							</li>
							<li>
								Recuerda cargar el archivo correcto, el sistema solo permite archivos con extenciones jpg, png, bmp y jpeg.
							</li>
							<li>
								De haber registrado un cintillo con anterioriddad, este será mostrado. Al cambiar el archivo el antiguo
								será automaticamente eliminado y suplantado con el nuevo.
							</li>
						</ul>
					</div>
				</div>
			</div><!-- /.row -->
			<div class="row">
				@if (!is_null($header))
					<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
						<h4>Cintillo actual</h4>
						<img src="{{ $header->fulluri }}" alt="cintillo-universitario" class="img img-responsive">
						<hr>
					</div>

				@endif

				<div class="header-data-form">
					<h2 class="text-center">Formulario de carga de cintillo</h2>
					<form id="header-data-form" runat="server" method="post" data-parsley-validate enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group has-feedback">
									<label for="header">Imagen</label>
									<input type="file" accept="image/*;capture=camera" name="header" id="header">
								</div>
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<input type="submit" value="Guardar Cintillo" class="btn btn-info">
							</div> <!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
						</div><!-- -/.row-->
					</form>
				</div><!-- /.contact-form -->
			</div><!-- /.row -->
		</div>
@endsection

@section('js')
@endsection
