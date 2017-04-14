<div class="modal fade" id="transact-form-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Tramitar Tarea</h4>
      </div>
	  <form class="" action="/tareas/tramitar" method="post">
		  {{ csrf_field() }}
		  <input type="hidden" name="task_id" value="{{ $task->id }}">
	      <div class="modal-body">
			  <div class="text-center">
				  <h2><span class="label label-success">{{ $task->title }}</span></h2><br>
				  <div class="form-group">
					  <label for="status">Estado de la tarea</label>
					  <select name="type" id="type" class="form-control" required="">
						  @for ($i=0; $i < count($statuses); $i++)
							  <option value="{{ $statuses[$i] }}" {{ isset($log) && $log->status == $statuses[$i] ? 'selected' : '' }}>{{ $statuses[$i] }}</option>
						  @endfor
					  </select>
				  </div>
				  <div class="form-group">
					  <label for="details">Detalles</label>
					  <textarea rows="8" cols="80" class="form-control" id="details" name="details" required=""></textarea>
				  </div>
			  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			<a href="#" onclick="$('#desactivateForm').submit();" class="btn btn-primary">Continuar</a>
	      </div>
	  </form>
    </div>
  </div>
</div>
