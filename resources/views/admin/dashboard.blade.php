<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://themewagon.github.io/kaiadmin-lite/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://themewagon.github.io/kaiadmin-lite/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="https://themewagon.github.io/kaiadmin-lite/assets/css/kaiadmin.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css" />
  </head>
  <body>
  <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
       @include('admin.partial.sidebar')
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          
          @include('admin.partial.header')
          <!-- End Navbar -->
        </div>

        <div class="container">
          @yield('content')
        </div>

        <footer class="footer">
         @include('admin.partial.footer')
        </footer>
      </div>

      <!-- Custom template | don't include it in your project! -->
      
      <!-- End Custom template -->
    </div>
      <!-- Custom template | don't include it in your project! -->
      
      <!-- End Custom template -->
   
    <!--   Core JS Files   -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/core/popper.min.js"></script>
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="https://themewagon.github.io/kaiadmin-lite/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo.js"></script>
    <script src="assets/js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
  </body>
</html>
