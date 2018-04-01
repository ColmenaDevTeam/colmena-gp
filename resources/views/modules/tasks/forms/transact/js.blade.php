<script type="text/javascript">
	function loadTransactions(id) {
		$("#task_log_id").val(id);
		$.get('/colmena/tareas/transacciones', {log_id : id}, function(data) {
			$("#log_transactions").empty();
			if (data.logs.length == 0) {
			    $("#transact-form-modal").modal('show');
			}else {
				$.each(jQuery.parseJSON(data.logs), function(index, key){
					var log_text ='('+key.date+')<b>['+key.user+']</b> :<br> '+key.messsage+'<hr>'
					$("#log_transactions").append(log_text);
				});

				$("#transact-form-modal").modal('show');
			}
		}, 'json');
	}
</script>
