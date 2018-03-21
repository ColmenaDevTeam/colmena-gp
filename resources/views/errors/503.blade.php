@extends('layouts.public')
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Volveremos en breve</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Error 503</div>
					<div class="panel-body">
						@include('components.common.colmena-quote')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
