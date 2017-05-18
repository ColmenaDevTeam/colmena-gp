<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Agenda de Tareas y Elementos Relevantes</h2>
			</div>
		</div>
	</div>
</section>
<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="portfolio-categ filter">
					<li class="all active"><a href="#">Todo</a></li>
					@foreach ($itemKinds as $itemKind)
						<li class="{{$itemKind}}">
							<a href="#">
								{{str_replace("NI", "Ñ",strtoupper(str_replace("_", " ", $itemKind)))}}
							</a>
						</li>
					@endforeach
				</ul>
				<div class="clearfix">
				</div>
				<div class="row">
					<section id="pendientes">
						<ul id="thumbs" class="portfolio">
							@foreach($pending as $pen)
								<!-- Item  and Filter Name -->
								<li class="item-thumbs design col-xs-12 col-sm-6 col-md-4 col-lg-4" data-id="id-0" data-type="{{$pen->itemKind}}">
									<div class="list-group">
										<a href="{{$pen->getURL()}}" class="{{$cssClassPerKind[$pen->itemKind]}} list-group-item active">
											@if($pen->itemKind == 'tareas')
												<i class="fa fa-tasks"> </i>
												{{$pen->title}}
											@elseif($pen->itemKind == 'cumpleanios')
												<i class="fa fa-birthday-cake"> </i>
												Cumpleaños de {{$pen->fullname}}
											@elseif($pen->itemKind == 'ausencias')
												<i class="fa fa-calendar-times-o"> </i>
												En vigencia {{($pen->getTypeString()}} de {{$pen->user->fullname}}
											@endif
										</a>
										<a href="" class="list-group-item {{$cssClassPerKind[$pen->itemKind]}}">
											<span>
												@if($pen->itemKind == "ausencias")
													Fecha fin:
												@elseif($pen->itemKind == 'tareas')
													Fecha estimada de entrega:
												@elseif($pen->itemKind == 'cumpleanios')
													Fecha:
												@endif
											</span>
											@if($pen->itemKind == "ausencias")
												{{$pen->start_date}}
											@elseif($pen->itemKind == 'tareas')
												{{$pen->estimated_date}}
											@elseif($pen->itemKind == 'cumpleanios')
												El {{$pen->birthdate->day." de ".$pen->birthdate->month}}
											@endif
										</a>
										<a href="{{($pen->itemKind == 'tareas') ? $pen->getURL() : '#'}}" class="list-group-item {{$cssClassPerKind[$pen->itemKind]}}">
											<span>Tipo: </span>
											@if($pen->itemKind == 'ausencias')
												{{$pen->getTypeString()}}
											@else
												{{str_replace("ni", "ñ",ucwords(str_replace("_", " ", $pen->itemKind)))}}
											@endif
											@if($pen->itemKind == 'tareas')
												<div class="pull-right">
													<span>Estado: </span>{{$pen->status}}
												</div>
											@endif
										</a>

										<a href="{{($pen->itemKind == 'cumpleanios') ? $pen->getURL() : $pen->user->getURL()}}" class="list-group-item {{$cssClassPerKind[$pen->itemKind]}}">
											<span>{{($pen->itemKind == 'cumpleanios') ? 'Cumpleañero: ' : 'Implicado: '}} </span>
											@if($pen->itemKind == "ausencias")
												{{$pen->user->fullname}}
											@elseif($pen->itemKind == 'tareas')
												{{$pen->responsible->fullname}}
											@elseif($pen->itemKind == 'cumpleanios')
												{{$pen->fullname}}
											@endif
										</a>
										<a href="#" class="list-group-item {{$cssClassPerKind[$pen->itemKind]}}">
											<div class="progress {{($pen->itemKind == 'tareas') ? 'progress-striped' : ''}} pb-md">
												<div class="progress-bar {{$pen->cssStatus}}" role="progressbar" aria-valuenow="{{$pen->percent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$pen->percent.'%'}}">
													<span class="sr-only">{{$pen->percent}}%</span>
												</div>
											</div>
										</a>
									</div><!-- /.list-group -->
								</li><!-- /.item-thumbs-->
							@endforeach
						</ul><!-- /#thumbs -->
					</section>
				</div>
			</div> <!-- /.col-lg-12 -->
		</div> <!-- /.row -->
	</div><!-- /.container -->
</section>
