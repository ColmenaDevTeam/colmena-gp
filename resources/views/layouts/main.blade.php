<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Colmena - Sistema de Gestión de Talento Humano</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="colmena geek-pro edition" />
		<meta name="author" content="Qsoto" />

		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<link href="/css/datepicker3.css" rel="stylesheet">
		<link href="/css/bootstrap-table.css" rel="stylesheet">
		<link href="/css/styles.css" rel="stylesheet">
		<link href="/css/font-awesome.min.css" rel="stylesheet">
		<!--Icons-->
		<script src="/js/lumino.glyphs.js"></script>
		@yield('css')
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>
		<div class="container-fluid">
			@include("components.menu.top")
			@include("components.menu.sidebar")
			@yield('content')
		</div>
		<script src="/js/jquery-1.11.1.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		@yield('js')
		<script>
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
