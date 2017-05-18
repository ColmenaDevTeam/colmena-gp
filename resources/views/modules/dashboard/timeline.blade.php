@if($hotToday != [])
	<div class="timeline">
	<div class="row">

		<div class="col-xs-12">
			<div id="timeline">
				<ul id="dates">
					@foreach($hotToday as $item)
						<li><a href="#{{$item->idTag}}">{{$item->idTag}}</a></li>
						<!--<li><a href="#1930">1930</a></li>-->
					@endforeach
				</ul>
				<ul id="issues">
					@foreach($hotToday as $item)
						<li id="{{$item->idTag}}">
							@if($item->itemKind == 'birthdates')
								<img src="/img/cartelera/cumpleanios.png" width="256" height="256" />
								<h1>{{$item->fullname}}</h1>
								<p>
									Está de cumpleaños el día de hoy
								</p>
							@elseif($item->itemKind == 'tasks')
								<img src="/img/cartelera/tarefas.png" width="256" height="256" />
								<p>
									Tarea pendiente por entregar el día de hoy:
									<a href="{{--$item->getURL()--}}">{{$item->titulo}}</a><br>
									Responsable: {{$item->responsible->fullname}}<hr>
									{{$item->details}}
								</p>
							@elseif($item->itemKind == 'absences')
								<img src="{{$item->type ? '/img/cartelera/reposos.png' : '/img/cartelera/medical-logo.png'}}" width="256" height="256" />
								<h1>{{$item->user->fullname}}</h1>
								<p>
									Está de {{$item->type ? 'Permiso' : 'Reposo'}} hasta: {{$item->end_date}}<br>
									<a href="{{--$item->getURL()--}}">Ver</a><hr>
									{{$item->details}}
								</p>
							@endif
						</li>
					@endforeach
				</ul>
				<div id="grad_left"></div>
				<div id="grad_right"></div>
				<a href="#" id="next">+</a>
				<a href="#" id="prev">-</a>
			</div><!-- /.timeline-->
		</div><!-- /.col-xs-12 -->
	</div><!-- /.row -->
</div>
@endif
