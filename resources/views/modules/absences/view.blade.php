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
					<a href="{{url("/usuarios/perfil/".$absence->user->id)}}" class="list-group-item active text-center" >
						<small style="color: white;">ausencia de: </small><h3 style="color: white;">{{$absence->user->fullname}}</h3>
					</a>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<a href="" class="list-group-item" onClick="return false;">
								<p class="text-center">
									<label for="" style="margin-left: 10pt;">Tipo de ausencia: </label>
									<span class="label label-default">{{$absence->getTypeString()}}</span>
									<label for="" style="">Fecha Inicio: </label>
									<span class="label label-default">{{$absence->start_date->format('d/m/Y')}}</span>

									<label for="" style="margin-left: 10pt;">Fecha Fin: </label>
									<span class="label label-default">{{$absence->end_date->format('d/m/Y')}}</span>
								</p>
								<hr>
								<p class="text-justify">
									<h4>Detalles <small>:</small></h4>
									{{$absence->details}}
								</p>
								<hr>
							</a><!-- ./list-group-item -->
						</div><!-- ./col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="text-center">
								<a class="btn btn-warning" id="update" href="{{url("/ausencias/modificar/".$absence->id)}}">
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
	@include('modules.absences.forms.delete-form-modal')
@endsection
@section('js')

@endsection
