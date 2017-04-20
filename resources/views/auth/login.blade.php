@extends('layouts.public')
@section('content')
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="login-panel panel panel-default">
				<img src="/img/logo/banner.png" alt="colmenena geek-pro edition" class="img img-responsive">
                <div class="panel-heading">Ingreso</div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group {{ $errors->has('cedula') ? ' has-error' : '' }}">
                                <input class="form-control" placeholder="Cedula" name="cedula" type="cedula" autofocus="" value="{{ old('cedula') }}">
                                @if ($errors->has('cedula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input class="form-control" placeholder="Clave" name="password" type="password" value="">
                                 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Recordarme
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                ¿Olvidó su contraseña?
                            </a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
@endsection
