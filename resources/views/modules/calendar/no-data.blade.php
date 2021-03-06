@extends('layouts.main')
@section('css')

@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sin datos de calendario laboral</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
				<div class="alert alert-danger">
					<h3 class="text-center">¡No se ha cargado el calendario!</h3>
					<p class="text-center">
						Al perecer no se han cargado los días del calendario laboral
						pongase en contacto con el administrador del sistema para
						que se registren.
					</p>
					<p class="text-center">
						El no tener los datos del calendario laboral en el sistema deshabilita
						ciertas muchas de las funciones del sistema. Es muy importante mantener
						actualizados los datos del calendario.
					</p>
				</div>
			</div>
			<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
			  <p class="text-center">
				  <a href="{{url("/calendario/actualizar")}}" class="btn btn-success">¡Cargar Datos!</a>
			  </p>
			</div>
		</div><!-- -/.row-->
	</div>
@endsection
@section('js')

@endsection
