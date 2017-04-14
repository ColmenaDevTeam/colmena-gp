@extends('layouts.main')
@section('css')

@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
					<h2 class="pageTitle">Actualizacion de Calendario {{date('Y')}}</h2>
				</div>
			</div><!--/.row-->
			@include('components.notification.notification')
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Atención!</strong>
						<ul>
							<li>
								Al actualizar el calendario, seleccionará un conjunto de
								fechas que representarán los días que seran tomados
								como laborables.
							</li>
							<li>
								Si deselecciona un dia laborable las tareas que fueron asignadas
								para dicha fecha seran reasignadas a la siguiente fecha laborable.
							</li>
							<li>
								Tome en cuenta que el sistema solo permitira la modificacion de las
								fechas que se encuentren en un rango de dos(2) semanas antes de la fecha
								actual.
							</li>
							<li>
								Al seleccionar una fecha, esta es marcada en color <font color="#6198fd" size="5">AZUL</font>.
							</li>
						</ul>
					</div>
				</div>
			</div><!-- /.row -->
		</div>
@endsection
@section('css')

@endsection
