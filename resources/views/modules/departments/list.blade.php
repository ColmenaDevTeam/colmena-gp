<!--
@author: QSoto
-->
@extends('layouts.main_layout')
@section('customcss')
	<link rel="stylesheet" href="/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
	<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="pageTitle">Gestion de Departamentos</h2>
				</div>
			</div>
		</div>
	</section>
	<section id="content">
		<div class="container">
			@if(session()->has('success'))
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p> </p>
						@if(session('success') == true)
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>¡Muy bien!</strong> La accion se ha realizado con exito.
							</div>
						@else
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>¡Error!</strong> Ocurrió un error al registrar. Por favor intentelo de nuevo
							</div>
						@endif
					</div><!-- /.col-xs-12 col-sm-12 col-md-12 col-lg-12-->
				</div><!-- /.row-->
			@endif
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="pull-left">
						<a class="btn" href="/departamentos/registrar">Registrar Departamento</a><br><br>
					</div>
				</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<table id="datatable" class="table table-striped bulk_action">
							<thead>
								<tr>
									<td align="center"><strong>Nombre</strong></td>
									<td align="center"><strong>Descripción</strong></td>

									<td align="center"><strong>Modificar</strong></td>
									<td align="center"><strong>Usuarios Asignados</strong></td>
								</tr>
							</thead>
							<tbody>
								@foreach($departments as $department)
									<tr>
										<td>{{$department->name}}</td>
										<td align="center">{{$department->description}}</td>
										<td align="center">
											<a class="btn" id="update" href="/departamentos/editar/{{$department->id}}">
												<i class="fa fa-pencil" value="Actualizar"></i>
											</a>
										</td>
										<td align="center">
											{{ count($department->users) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('customjs')
	@include('components.datatables.datatable')
@endsection
