@extends('layouts.main')
@section('css')
	<style type="text/css">
		
		div .checked {
		    -moz-box-shadow: 0px 0px 30px #134756;
		    -webkit-box-shadow: 0px 0px 30px #134756;
		    box-shadow: 0px 0px 30px #134756;
		    border: 1px solid #02232d;
		    z-index: 10;
		}
	</style>
@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
					<h2 class="pageTitle">Selección de imagen y frase de seguridad</h2>
			</div>
		</div>
		<div class="alert alert-info">
			Hola, en este apartado se define una palabra clave para el acceso a los modulos sensibles del sistema, ademas deberas seleccionar una imagen de tun preferencia para mayor seguridad.
		</div>
		<div class="row">
			<form id="user-data-form" role="form" method="post" data-parsley-validate>
				{{ csrf_field() }}
				
					<div class="col-xs-12 text-center">
						<h3>Selecciona una de las imagenes</h3>	
					</div>
				
				  @foreach ($baseImages as $image => $key)
					  <div class="col-sm-2 images" onClick='setCheck("{{$key}}");'>
						  <img src="{{ route('baseimage', $key)  }}" alt="{{ $key }}" class="img-responsive">

						  <input type="radio" name="secureimg" value="{{ $key }}" id="{{ $key }}" hidden>
					  </div>
				  @endforeach
				
				<div style="padding: 4px"></div>
				
					<div class="col-xs-12 text-center">
						<h3>Escribe tu clave de operaciones especiales</h3>
					</div>
					
					<div class="col-xs-6">
							<div class="form-group">
								<label for="passphrase">Palabra Clave</label>
								<input type="password" class="form-control" id="passphrase" name="passphrase" placeholder="palabra clave">
							</div>
						</div><!-- /.col-xs-4 -->
						<div class="col-xs-6">
							<div class="form-group">
								<label for="passphrase">Confirmacion</label>
								<input type="password" class="form-control" id="passphrase" name="passphrase_confirmation" placeholder="palabra clave">
							</div>
						</div><!-- /.col-xs-4 -->
				
				<div style="padding: 4px"></div>
				<div class="col-xs-12 text-center">
					<button class="btn btn-block btn-info"> Guardar </button>
				</div>
			</form>
		</div><!-- /.row -->
	</div>
@endsection
@section('js')
	<script type="text/javascript">
			function setCheck(key){
				var id = document.getElementById(key);
				$(id).prop("checked", true);
				$('.images').removeClass('checked');
				$(id).parent("div").addClass('checked');

			}
		
	</script>
@endsection