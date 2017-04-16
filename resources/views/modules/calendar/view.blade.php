@extends('layouts.main')
@section('css')
<style media="screen">
	td, th {
		text-align: center;
	}
</style>
@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Calendario Laboral {{date('Y')}}</h2>
			</div>
		</div><!--/.row-->
		@include('components.notification.notification')
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="alert alert-info">
					<font color="#6198fd" size="5"><strong>¡Atención!</strong></font>
					<ul>
						<li>
							Las fechas marcadas como <font color="#6198fd" size="5">DISPONIBLES</font>
							para asignar tareas estan marcadas en color <font color="#6198fd" size="5">AZUL</font>.
						</li>
						<li>
							Si no hay fechas cargadas en el sistema, pongase en contacto con el administrador del sistema.
						</li>
						<li>
							Tome en cuenta que el sistema <font color="#6198fd" size="5">BlOQUEARA</font>
							ciertas funcionalidades si no se tienen datos de calendario cargados.
						</li>
					</ul>
				</div>
			</div>
		</div><!-- /.row -->
		<div class="row">
			@php $m=0; @endphp
			@php $dmonth="" @endphp
			@foreach ($dates as $weeks)
				<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
					<h4>
						<i class="fa fa-calendar" value=""></i>  {{$months[$m]}}
					</h4>
					<div class="table-responsive">
						<table class="table">
							<tr>
								<td class="text-center">Lunes</td>
								<td class="text-center">Martes</td>
								<td class="text-center">Miércoles</td>
								<td class="text-center">Jueves</td>
								<td class="text-center">Viernes</td>
								<td class="text-center"><font color="#7C0101">Sábado</font>
								<td class="text-center"><font color="#7C0101">Domingo</font></td>
							</tr>

							@foreach ($weeks as $days)
								@php $week ="" @endphp
								<tr>
									@for ($i=1;$i<=7;$i++)

										@if ($i==6 or $i==7)
											<td align="center">
												<font color="#7C0101"> {{isset($days[$i]) ? $days[$i] : ''}}</font>
											</td>
										@else
											<td align="center" >
												@if(isset($days[$i]))
													<div>
														@if (in_array(date('Y').'-'.str_pad($m+1,2,'0',STR_PAD_LEFT).'-'.str_pad($days[$i],2,'0',STR_PAD_LEFT), $calendar))
															<span class="label label-info"> {{$days[$i]}} </span>
														@else
															{{$days[$i]}}
														@endif
													</div>
													@php $week=$week.$days[$i]." " @endphp
												@endif
											</td>
										@endif
									@endfor
									@php $dmonth=$dmonth.$week."-" @endphp
								</tr>
							@endforeach
						</table>
					</div><!--"table responsive"-->
				</div><!-- /.col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
				@php $m+=1; @endphp
				@php $dmonth=""; @endphp
			@endforeach
		</div>
	</div>
@endsection
@section('js')
@endsection
