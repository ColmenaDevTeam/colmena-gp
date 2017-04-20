<div class="row">
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-blue panel-widget ">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large">{{ $tasksCount }}</div>
					<div class="text-muted">Tareas Pendientes</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-orange panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked flag"><use xlink:href="#stroked-flag"/></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large">{{ $absencesCount }}</div>
					<div class="text-muted">Ausencias Activas</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-teal panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"/></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large">{{ $birthdates }}</div>
					<div class="text-muted">Cumpleañeros/Semana</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-red panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large">{{ $usersCount }}</div>
					<div class="text-muted">Usuarios Asignados</div>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
