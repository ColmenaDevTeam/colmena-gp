@if(session()->has('success'))
	@if (session('success') == true)
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡Muy bien!</strong> La accion se ha realizado con exito.
		</div>
	@else
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡Error!</strong> Ocurrió un error al procesar. Por favor intentelo de nuevo
		</div>
	@endif
@endif
