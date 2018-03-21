<div class="modal fade" id="desactivate-form-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Inhabilitar Usuario</h4>
      </div>
      <div class="modal-body">

		  <div class="text-center">
			  <span class="label label-warning">ATENCIÓN</span><br>
			  Esta a punto de inhabilitar al usuario:
			  <br>
			  <strong id="userInfo"></strong>
			  <br>
			  ¿Desea continuar?
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		<a href="#" onclick="$('#desactivateForm').submit();" class="btn btn-primary">Continuar</a>
      </div>
    </div>
  </div>
</div>
