<div class="modal fade" id="delete-form-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Borrar Tarea</h4>
      </div>
      <div class="modal-body">

		  <div class="text-center">
			  <span class="label label-warning">ATENCIÓN</span><br>
			  Esta a punto de borrar la tarea:<br>
			  <strong>{{ $task->title }}</strong><br>
			  de el/los usuario(s):&nbsp
      </div>
        <ul>
          @foreach ($task->responsibles as $responsible)
            <li>{{$responsible->fullname}}</li>
          @endforeach
        </ul>
        <br>
			  <p class="text-right">
          ¿Desea continuar?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		<a href="#" onclick="$('#deleteTask').submit();" class="btn btn-danger">Continuar</a>
      </div>
    </div>
  </div>
</div>
<form id="deleteTask" method="post" action="{{url("/tareas/eliminar")}}">
	{{ csrf_field() }}
	<input type="hidden" name="task_id" value="{{$task->id}}" name="task_id">
</form>
