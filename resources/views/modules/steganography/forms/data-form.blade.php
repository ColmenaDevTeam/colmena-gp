@extends('layouts.main')
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-12">
					<h2 class="pageTitle">Selección de imagen y frase de seguridad</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="user-data-form">
				<form id="user-data-form" role="form" method="post" data-parsley-validate>
					{{ csrf_field() }}
					<div class="row">
					  @foreach ($baseImages as $image => $key)
						  <div class="col-sm-2">
							  <img src="{{ route('baseimage', $key)  }}" alt="{{ $key }}">
						  </div>
					  @endforeach
					</div>
				</form>
			</div><!-- /.contact-form -->
		</div><!-- /.row -->
	</div>
@endsection
