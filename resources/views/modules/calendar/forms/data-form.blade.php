@extends('layouts.main')
@section('css')
	<style media="screen">
		td, tr {
			text-align: center;
			max-width: 15px;
			max-height: 15px;
		}
	</style>
@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Actualización del Calendario {{date('Y')}}</h2>
			</div>
		</div><!--/.row-->
		@include('components.notification.notification')
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="alert alert-info">

					<font color="#6198fd" size="5"><strong>¡Atención!</strong></font>
					<ul>
						<li>
							Al actualizar el calendario, seleccionará un conjunto de
							fechas que representarán los días que seran tomados
							cómo <font color="#6198fd" size="5">DISPONIBLES</font>
							para asignar tareas.
						</li>
						<li>
							Debe considerar que actualizar el calendario puede tomar cierto tiempo, pues las actividades seran reprogramadas y
							el sistema debera notificar a los usuarios.
						</li>
						<li>
							Los sabados y domingos son tomados como días no laborables para el sistema
						</li>
						<li>
							Si deselecciona un dia laborable <font color="#6198fd" size="5">TODAS</font>
							las tareas que fueron asignadas
							para dicha fecha seran reasignadas a la siguiente fecha laborable.
						</li>
						<li>
							Tome en cuenta que el sistema <font color="#6198fd" size="5">BlOQUEARA</font>
							ciertas funcionalidades si no se tienen datos de calendario cargados.
						</li>
						<li>
							Al seleccionar una fecha, esta es marcada en color <font color="#6198fd" size="5">AZUL</font>,
							indicando que es una fecha laborable.
						</li>
					</ul>
				</div>
			</div>
		</div><!-- /.row -->
		<div class="row">
			@php $m=0; @endphp
            <form id="calendar-form" role="form" method="post" name="formularioCalendario" action="/calendario/actualizar">
            {!! csrf_field() !!}
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
														<div  style="{{ in_array(date('Y').'-'.str_pad($m+1,2,'0',STR_PAD_LEFT).'-'.str_pad($days[$i],2,'0',STR_PAD_LEFT), $calendar) ? 'background-color:#6198fd' : ''}}" id="{{date('Y')}}-{{str_pad($m+1,2,'0',STR_PAD_LEFT)}}-{{str_pad($days[$i],2,'0',STR_PAD_LEFT)}}-div" >
                                                    		<a style="background-color:transparent;" href="#{{$days[$i]}}" onClick="setCheck('{{date('Y')}}-{{str_pad($m+1,2,'0',STR_PAD_LEFT)}}-{{str_pad($days[$i],2,'0',STR_PAD_LEFT)}}')" class="list-group-item">
                                                            	<input {{ in_array(date('Y').'-'.str_pad($m+1,2,'0',STR_PAD_LEFT).'-'.str_pad($days[$i],2,'0',STR_PAD_LEFT), $calendar) ? 'checked' : ''}} type="checkbox" id="{{date('Y')}}-{{str_pad($m+1,2,'0',STR_PAD_LEFT)}}-{{str_pad($days[$i],2,'0',STR_PAD_LEFT)}}" name="dates[]" value="{{date('Y')}}-{{str_pad($m+1,2,'0',STR_PAD_LEFT)}}-{{str_pad($days[$i],2,'0',STR_PAD_LEFT)}}" hidden="">
                                                                {{$days[$i]}}
															</a>
														</div>
                                                        @php $week=$week.$days[$i]." " @endphp
                                                    @endif
                                                </td>
                                            @endif
                                        @endfor
                                        @php $dmonth=$dmonth.$week."-" @endphp
                                        <td align="center" >
                                            <a href="#" name="checkWeek" onClick="checkWeek('{{$week}}', '{{$m+1}}');return false;" type="button">
                                                Marcar semana<i class="fa fa-check" value=""></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div><!--"table responsive"-->
						<div class="text-right">
							<br>
							<a href="#" id="Checkmonths" onClick="checkMonth('{{$dmonth}}','{{$m+1}}');return false;" type="button">
								Marcar mes {{$m+1}}<i class="fa fa-check" value=""></i>
							</a>

						</div>
                    </div><!-- /.col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
                    @php $m+=1; @endphp
                    @php $dmonth=""; @endphp
                @endforeach
				<div class="text-center">
					<br>
					<button type="button" class="btn btn-success" onClick="validar()">Actualizar Calendario</button>
				</div>
            </form>

		</div>
	</div>
@endsection
@section('js')
	<script type="text/javascript">
	    function setCheck(item){
	      //alert(item);
	        if(document.getElementById(item).checked){
	            document.getElementById(item).checked = false;
	            document.getElementById(item+"-div").style.background="#FFF";
	        }
	        else{
	            document.getElementById(item).checked = true;
	            document.getElementById(item+"-div").style.background="#6198fd";
	        }
	    }

	    function checkWeek (week,month){
	        var dia="";
	        var day;
	        if (!week) {}
	        else{
	            semana = week.split(" ");
	            d = new Date();
	            year = d.getFullYear();
	            month = (month < 10) ? ("0" + month) : month;
	            for(var i=0; i<semana.length-1; i++){
	                day=semana[i];
	                day = (day < 10) ? ("0" + day) : day;
	                dia = year+"-"+month+"-"+day;
	                setCheck(dia);
	            }
	        }
	    }

	    function checkMonth(dmonth, month){
	        var aux = "";
	        mWeeks = dmonth.split("-");
	        for(var q=0; q<(mWeeks.length-1); q++){
	            aux=mWeeks[q];
	            checkWeek(aux,month);
	        }
	    }
	    function checkYear(dates){
	        //alert(dates);
	        aDates= dates.split("//");
	        for(var l=0; l<(aDates.length-1); l++){
	            setCheck(aDates[l]);
	        }
	    }

	    function validar(){
	        //Validar las fechas
	        var fechas = document.getElementsByName("dates[]");
	        var contieneFechas = false;
	        for(var i = 0; i < fechas.length; i++){
	            //Si existe alguna fecha "checkeada", digamos qque
	            //contiene fechas y rompemos el ciclo
	            if(fechas[i].checked == true){
	                contieneFechas = true;
	                break;
	            }
	        }
	        //Si no fue seleccionada ninguna fecha
	        if(!contieneFechas){
	            //Lanzar dialogo de alerta para que seleccione fechas
	            alert("Debe seleccionar las fechas del calendario");
	            return false;
	        }
	        else{
	            document.formularioCalendario.submit();
	            return true;
	        }
	    }
	</script>
@endsection
