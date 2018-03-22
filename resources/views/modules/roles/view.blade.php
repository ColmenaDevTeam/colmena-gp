@extends('layouts.main')
@section('css')

@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Roles / {{$role->name}}</h1>
			</div>
		</div><!--/.row-->
		@include('components.notification.notification')
        <div class="row">
            <div class="col-xs-6 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Categorías</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="{{count($role->permissionsByCategory())}}" >
                            <span class="percent">
                                {{count($role->permissionsByCategory())}}
                            </span>
						</div>
					</div>
				</div>
			</div>
            <div class="col-xs-6 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Permisos</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="{{$role->permissions->count()}}" >
                            <span class="percent">
                                {{$role->permissions->count()}}
                            </span>
						</div>
					</div>
				</div>
			</div>
            <div class="col-xs-6 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Usuarios</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="{{$role->permissions->count()}}" >
                            <span class="percent">
                                {{$role->users->count()}}
                            </span>
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="row">
            @foreach ($role->permissionsByCategory() as $key => $permissions)
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="list-group">
                        <a href="#l_{{strtolower(str_replace(' ', '_', $key ))}}" class="list-group-item active" data-toggle="collapse">
                            {{$key}}
                        </a>
                        <div class="collapse in" id="l_{{strtolower(str_replace(' ', '_', $key ))}}">
                            @foreach ($permissions as $permission)
                                <a href="#" class="list-group-item" onclick="return false;">{{$permission->action}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

		</div><!-- -/.row-->
	</div>
@endsection
@section('js')
	<script src="{{url("/js/easypiechart.js")}}"></script>
	<script src="{{url("/js/easypiechart-data.js")}}"></script>
@endsection
