<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Colmena - Sistema de Gestión de Talento Humano</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="colmena geek pro edition" />
		<meta name="author" content="Qsoto" />
        <!-- css -->
        <link href="/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/css/styles.css" rel="stylesheet">
        <link href="/css/super.css" rel="stylesheet" />
        @yield('css')

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
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
        </div>
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/main.js"></script>
        <script type="text/javascript">
            !function ($) {
            $(document).on("click","ul.nav li.parent > a > span.icon", function(){
                $(this).find('em:first').toggleClass("glyphicon-minus");
            });
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
            }(window.jQuery);

            $(window).on('resize', function () {
              if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
            })
            $(window).on('resize', function () {
              if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
            })
        </script>
    </body>
</html>
