<div class="modal fade" id="delete-form-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Borrar Ausencia</h4>
      </div>
      <div class="modal-body">

		  <div class="text-center">
			  <span class="label label-warning">ATENCIÓN</span><br>
			  Esta a punto de borrar la ausencia de:<br>
			  <strong>{{ $absence->user->fullname }}</strong><br>
			  del tipo:&nbsp
			  <strong>{{ $absence->getTypeString() }}</strong><br>
			  <p>Desde {{ $absence->start_date->format('d/m/Y') }} hasta {{ $absence->end_date->format('d/m/Y') }}</p><br>
			  ¿Desea continuar?
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		<a href="#" onclick="$('#deleteabsence').submit();" class="btn btn-primary">Continuar</a>
      </div>
    </div>
  </div>
</div>
<form id="deleteabsence" method="post" action="/ausencias/eliminar">
	{{ csrf_field() }}
	<input type="hidden" name="absence_id" value="{{$absence->id}}" name="absence_id">
</form>
