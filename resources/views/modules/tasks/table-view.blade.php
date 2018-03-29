<h3>{{$data['title']}}</h3>
<table data-toggle="table" data-show-refres41758498h="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
	<thead>
			<tr>
				<th data-sortable="true" data-field="title">Titulo</th>
				<th data-sortable="true" data-field="type">Tipo de tarea</th>
				<th data-sortable="true" data-field="details">Detalles</th>
				<th data-sortable="true" data-field="dificulty">Dificultad</th>
				<th data-sortable="true" data-field="estimated_date">Fecha tope</th>
				<th>Ver</th>
				<th>Modificar</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['tasks'] as $task)
				<tr>
					<td>{{$task->title}}</td>
					<td>{{$task->type}}</td>
					<td>{{$task->details}}</td>
					<td>{{ $task->dificulty }}</td>
					<td>{{$task->estimated_date->format('d/m/Y')}}</td>
					<td>
						<a href="{{url("/tareas/$task->id/ver")}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
					</td>
					<td>
						@if (\Auth::user()->canDo('tasks.update'))
							<a class="btn btn-warning" id="update" href="{{url("/tareas/modificar/$task->id")}}">
								<i class="fa fa-pencil" value="Actualizar"></i>
							</a>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
<hr>
