<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="https://themewagon.github.io/electro/css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="https://themewagon.github.io/electro/css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="https://themewagon.github.io/electro/css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="https://themewagon.github.io/electro/css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="https://themewagon.github.io/electro/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="https://themewagon.github.io/electro/css/style.css"/>
		


		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		<header>
        @include('frontend.partial.header')
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
		

        @include('frontend.partial.nav')
		
		</nav>
		<!-- /NAVIGATION -->

		<!-- SECTION -->
		<div class="container-fluid py-5">
            @yield('content')
        </div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			@include('frontend.partial.footer')
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<!-- jQuery Plugins -->
		<script src="https://themewagon.github.io/electro/js/jquery.min.js"></script>
		<script src="https://themewagon.github.io/electro/js/bootstrap.min.js"></script>
		<script src="https://themewagon.github.io/electro/js/slick.min.js"></script>
		<script src="https://themewagon.github.io/electro/js/nouislider.min.js"></script>
		<script src="https://themewagon.github.io/electro/js/jquery.zoom.min.js"></script>
		<script src="https://themewagon.github.io/electro/js/main.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        

	</body>
</html>
