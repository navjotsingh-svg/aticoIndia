<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Aticoexport</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Custom Admin Theme Design" />
<meta name="csrf-token" content="{!! csrf_token() !!}" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
{!! HTML::style('assets/css/bootstrap.css') !!}
<!-- //bootstrap-css -->
<!-- Custom CSS -->
{!! HTML::style('assets/css/style.css') !!}

<!-- font CSS -->
{!! HTML::style('http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic') !!}
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
{!! HTML::style('assets/css/font.css') !!}
{!! HTML::style('assets/css/font-awesome.css') !!}

<!-- //font-awesome icons -->
<!-- {!! HTML::script('assets/js/jquery2.0.3.min.js') !!} -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{!! HTML::script('assets/js/modernizr.js') !!}
{!! HTML::script('assets/js/jquery.cookie.js') !!}
{!! HTML::script('assets/js/screenfull.js') !!}

@yield('css')
    <script>
    $(function () {
        $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

        if (!screenfull.enabled) {
            return false;
        }            

        $('#toggle').click(function () {
            screenfull.toggle($('#container')[0]);
        }); 
    });
    </script>
<!-- charts -->
{!! HTML::script('assets/js/raphael-min.js') !!}
{!! HTML::script('assets/js/morris.js') !!}
{!! HTML::script('assets/js/morris.js') !!}
{!! HTML::style('assets/css/morris.css') !!}
{!! HTML::style('assets/css/template.css') !!}
<!-- //charts -->
<!--skycons-icons-->
{!! HTML::script('assets/js/skycons.js') !!}

<!--//skycons-icons-->
</head>
<body class="dashboard-page">
    @include('admin.layouts.sidebar')    
    <section class="wrapper scrollable">
        <nav class="user-menu">
            <a href="javascript:;" class="main-menu-access">
            <i class="icon-proton-logo"></i>
            <i class="icon-reorder"></i>
            </a>
        </nav>
        @include('admin.layouts.header')
        <div class="main-grid">
            @yield('content')
        </div>
        @include('admin.layouts.footer')       
    </section>
</body>
</html>
