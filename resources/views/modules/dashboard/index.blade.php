@extends('layouts.main')
@section('css')
	<link href="/css/styletimeliner.css" rel="stylesheet">
@endsection
@section('content')

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Cartelera</h1>
			</div>
		</div><!--/.row-->
		@include('modules.dashboard.stats', ['tasksCount' => $tasksCount,
											'absencesCount' => $absencesCount,
											'birthdates' => $birthdates])
		@include('modules.dashboard.timeline')
		{{--@include('modules.dashboard.boxes')--}}
	</div>	<!--/.main-->

@endsection
@section('js')
	<script src="/js/timelinr/jquery.js"></script>
	<script src="/js/timelinr/jquery.min.js"></script>
	<script src="/js/jquery.timelinr-0.9.6.js"></script>
@endsection
