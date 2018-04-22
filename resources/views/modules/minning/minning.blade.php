@extends('layouts.main')
@section('css')

@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
					<h2 class="pageTitle">Segmentación de Datos</h2>
					<div class="alert alert-info">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<p>En esta sección podrás seleccionar un conjunto de variables para posteriormente realizar un proceso de segmentación de datos.
						<br> Además podrás seleccionar la cantidad de datos que quieres procesar</p>
					</div>
					<form class="" method="post">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-xs-12" id="check-combo">
								<h2>Variables</h2>
								@foreach($variables as $variable)
									<div class="form-group has-feedback col-xs-4">
										<input type="checkbox" name="variables" value="{{ $variable->id }}" class=".checkbox"> {{ $variable->name }}
									</div>										
								@endforeach
							</div><!-- /.col-xs-1 col-sm-4 col-md-4 col-lg-3 -->
							
							<div class="col-xs-12">
								<h2>Número de registros disponibles: <label id="avaliable_records" class="label label-success">0</label></h2>
								<hr>
							</div>

							<div class="col-xs-6">
								<h2>Rango de registros</h2>
								Desde <input type="number" name="range_min" min="1" required>
								Hasta <input type="number" name="range_max" max="" id="range_max" required>
								<hr>
							</div>
							<div class="col-xs-6">
								<h2>Segmentos</h2>
								Cantidad de segmentos requeridos <input type="number" name="clusters" min="2" required>
								<hr>
							</div>
							<div class="col-xs-12 text-center">
								<button type="submit" name="button" class="btn btn-success">Continuar</button>
								<hr>
							</div>
					</form>
				</div>
		</div>
		</div><!-- /..row-->
	</div>
@endsection
@section('js')
	<script type="text/javascript">
		
		$(":checkbox").change(function() {
		    getCount(getCheckedVariables());
		});		

		function getCount(variables){
			$.get( "contador-de-registros", { "variables[]": variables }, function(data){
				var total = jQuery.parseJSON(data);
				setCountResult(total.count);
				setMax(total.count);
			});
			
		}

		function setCountResult(total){
			$('#avaliable_records').text(total);
		}

		function setMax(max){
			$('#range_max').attr('max', max);
		}
		
		function getCheckedVariables(){
	        var variables = [];
	        $('#check-combo input:checked').each(function() {
	            variables.push(this.value);
	        });
	        return variables;
		}
	</script>
@endsection
