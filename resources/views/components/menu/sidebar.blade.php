<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<ul class="nav menu">
		<li class="active"><a href="/"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Cartelera</a></li>
{{--
		<li><a href="/widgets"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Widgets</a></li>
		<li><a href="/charts"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>
		<li><a href="/tables"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Tables</a></li>
		<li><a href="/forms"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Forms</a></li>
		<li><a href="/panels"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Alerts &amp; Panels</a></li>
		<li><a href="/icons"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li>


		<li class="parent ">
			<a href="#">
				<span data-toggle="collapse" href="#tareas">
					<svg class="glyph stroked chevron-down">
						<use xlink:href="#stroked-chevron-down">
						</use>
					</svg>
					Tareas
				</span>
			</a>
			<ul class="children collapse" id="tareas">
				<li>
					<a class="" href="/tareas/registrar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Registrar
					</a>
				</li>
				<li>
					<a class="" href="/tareas/listar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Listar
					</a>
				</li>
			</ul>
		</li>

		<li class="parent ">
			<a href="#">
				<span data-toggle="collapse" href="#departamentos">
					<svg class="glyph stroked chevron-down">
						<use xlink:href="#stroked-chevron-down">
						</use>
					</svg>
					Departamentos
				</span>
			</a>
			<ul class="children collapse" id="departamentos">
				<li>
					<a class="" href="/departamentos/registrar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Registrar
					</a>
				</li>
				<li>
					<a class="" href="/departamentos/listar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Listar
					</a>
				</li>
			</ul>
		</li>

		<li class="parent ">
			<a href="#">
				<span data-toggle="collapse" href="#usuarios">
					<svg class="glyph stroked chevron-down">
						<use xlink:href="#stroked-chevron-down">
						</use>
					</svg>
					Usuarios
				</span>
			</a>
			<ul class="children collapse" id="usuarios">
				<li>
					<a class="" href="/usuarios/registrar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Registrar
					</a>
				</li>
				<li>
					<a class="" href="/usuarios/listar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Listar
					</a>
				</li>
			</ul>
		</li>

		<li class="parent ">
			<a href="#">
				<span data-toggle="collapse" href="#ausencias">
					<svg class="glyph stroked chevron-down">
						<use xlink:href="#stroked-chevron-down">
						</use>
					</svg>
					Ausencias
				</span>
			</a>
			<ul class="children collapse" id="ausencias">
				<li>
					<a class="" href="/ausencias/registrar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Registrar
					</a>
				</li>
				<li>
					<a class="" href="/ausencias/listar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Listar
					</a>
				</li>
			</ul>
		</li>

		<li class="parent ">
			<a href="#">
				<span data-toggle="collapse" href="#calendario">
					<svg class="glyph stroked chevron-down">
						<use xlink:href="#stroked-chevron-down">
						</use>
					</svg>
					Calendario
				</span>
			</a>
			<ul class="children collapse" id="calendario">
				<li>
					<a class="" href="/calendario/ver">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Ver
					</a>
				</li>
				<li>
					<a class="" href="/calendario/actualizar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Actualizar
					</a>
				</li>
			</ul>
		</li>
		<li class="parent ">
			<a href="#">
				<span data-toggle="collapse" href="#roles">
					<svg class="glyph stroked chevron-down">
						<use xlink:href="#stroked-chevron-down">
						</use>
					</svg>
					Roles
				</span>
			</a>
			<ul class="children collapse" id="roles">
				<li>
					<a class="" href="/roles/registrar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Registrar
					</a>
				</li>
				<li>
					<a class="" href="/roles/listar">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Listar
					</a>
				</li>
			</ul>
		</li>
		--}}
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
