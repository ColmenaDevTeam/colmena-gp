<div class="modal fade" id="transact-form-modal" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Tramitar Tarea</h4>
      </div>

      <form class="" action="{{url("/tareas/tramitar")}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="task_log_id" value="" id="task_log_id">
        <div class="modal-body">
          <div id="log_transactions">

          </div>
          
          <div class="text-center">
            <div class="form-group">
              <label for="status">Cambiar Estado</label>
              <select name="status" id="status" class="form-control" required="">
                @for ($i=0; $i < count($statuses); $i++)
                  <option value="{{ $statuses[$i] }}">{{ $statuses[$i] }}</option>
                @endfor
              </select>
            </div>
            <div class="form-group">
              <label for="detail">Detalles</label>
              <textarea rows="4" class="form-control" id="detail" name="detail" required=""></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="" class="btn btn-default" data-dismiss="modal">Cancelar</a>
          <button type="submit" class="btn btn-primary">Continuar</button>
        </div>
      </form>
    </div>
  </div>
</div>
