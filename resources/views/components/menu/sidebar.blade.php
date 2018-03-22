<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<ul class="nav menu">
		<li class="active"><a href="{{url("/")}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Cartelera</a></li>
		@foreach (Auth::user()->accessList() as $category => $permissions)
			<li class="parent">
				<a href="#">
					<span data-toggle="collapse" href="#{{strtolower($category)}}">
						<svg class="glyph stroked chevron-down">
							<use xlink:href="#stroked-chevron-down">
							</use>
						</svg>
						{{ $category }}
					</span>
				</a>
				<ul class="children collapse" id="{{strtolower($category)}}">
					@foreach ($permissions as $permission)
						<li>
							<a class="" href="{{$permission->url}}">
								<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> {{ $permission->action }}
							</a>
						</li>
					@endforeach
				</ul>
			</li>
		@endforeach
		<li role="presentation" class="divider"></li>
	</ul>

	<div class="text-center">
		<ol class="breadcrumb">
  			  <li>
  				  <a target="_blank" href="{{ env('REPOSITORY_URL') }}" data-placement="top" title="Repositorio del Proyecto en GitHub">
  					  <i class="fa fa-github-alt"></i>
  				  </a>
  			  </li>
  			  <li>
  				  <a target="_blank" href="{{ env('REPOSITORY_URL') }}/wiki" data-placement="top" title="Manual de Usuario: Wiki">
  					  <i class="fa fa-file-text"></i>
  				  </a>
  			  </li>
  			  <li>
  				  <a target="_blank" href="{{ env('REPOSITORY_URL') }}/issues?utf8=%E2%9C%93&q=is%3Aopen" data-placement="top" title="Reportar fallas o incidencias">
  					  <i class="fa fa-bug"></i>
  				  </a>
  			  </li>
  			  <li>
  				  <a target="_blank" href="{{ env('REPOSITORY_URL') }}/stargazers" data-placement="top" title="Calificar Colmena-GP con una estrella">
  					  <i class="fa fa-star-half-full"></i>
  				  </a>
  			  </li>
  			  <li>
  				  <a href="/acerca-de" data-placement="top" title="Acerca De Colmena-GP">
  					  <i class="fa fa-info-circle"></i>
  				  </a>
  			  </li>

		</ol>
	</div>
</div><!--/.sidebar-->
