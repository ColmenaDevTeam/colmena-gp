<div class="modal fade" id="password-form-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="">Cambio de contraseña</h4>
			</div>
			<div class="modal-body">
				<form id="password-change" method="post" action="{{url("/usuarios/actualizar-clave")}}" name="password-change">
					{{ csrf_field() }}
					<input type="hidden" name="user_id" value="{{ $user->id }}">
					<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
						<div class="form-group has-feedback">
							<label for="password">Contraseña Actual</label>
							<input required type="password" class="form-control" id="oldpassword" name="oldpassword">
						</div>
					</div>
					<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
						<div class="form-group has-feedback">
							<label for="npassword">Nueva Contraseña</label>
							<input required type="password" class="form-control" id="password" name="password">
						</div>
					</div>
					<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
						<div class="form-group has-feedback">
							<label for="password_confirmation">Repita la contraseña</label>
							<input required type="password" class="form-control" id="password_confirmation" name="password_confirmation">
						</div>
					</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Continuar</a>
			</div>
			</form>
		</div>
	</div>
</div>
