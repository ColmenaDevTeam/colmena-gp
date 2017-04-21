@extends('layouts.main')
@section('css')

@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Detalles de ausencia</h1>
			</div>
		</div><!--/.row-->
		@include('components.notification.notification')
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="list-group">
					<a href="" class="list-group-item active text-center" onClick="return false;">
						<h3 style="color: white;">{{$absence->user->fullname}}
						</h3>
					</a>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<a href="" class="list-group-item" onClick="return false;">
								<p class="text-justify">
									{{$absence->details}}
								</p>
								<hr>
								<p class="text-center">
									<label for="" style="margin-left: 10pt;">Tipo de ausencia: </label>
									<span class="label label-default">{{$absence->type}}</span>
									<label for="" style="">Fecha Inicio: </label>
									<span class="label label-default">{{$P_BMA[$absence->priority-1]}}</span>

									<label for="" style="margin-left: 10pt;">Fecha Fin: </label>
									<span class="label label-default">{{$P_BMA[$absence->complexity-1]}}</span>
								</p>
								<hr>
							</a><!-- ./list-group-item -->
							<a href="#{{--$absence->responsible->getURL()--}}" class="list-group-item active text-center">
								<span class="label label-default">Responsable:</span><h4 style="color: white;">{{$absence->responsible->fullname}}</h4>
							</a>
							<hr>
						</div><!-- ./col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="text-center">
								<a class="btn btn-warning" id="update" href="/ausencias/editar/{{$absence->id}}">
									<i class="fa fa-pencil"></i>Modificar
								</a>
								<a class="btn btn-danger" href="#" onclick="$('#delete-form-modal').modal().show();">
									Eliminar <i class="fa fa-times" value="Eliminar"></i>
								</a>
							</div>
						</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						</div><!-- -/.row-->
					</div><!-- -/.row-->
				</div><!-- -/.list-group-->
			</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
		</div><!-- -/.row-->
	</div>
	@include('modules.tasks.forms.transact-form-modal')
	@include('modules.absences.forms.delete-form-modal')
@endsection
@section('js')

@endsection
