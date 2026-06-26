<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Pizza</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Rising Himachal" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{!! asset('assets/css/bootstrap.css') !!}">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{!! asset('assets/css/style.css') !!}" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{!! asset('assets/css/font.css') !!}" type="text/css"/>
<link href="{!! asset('assets/css/font-awesome.css') !!}" rel="stylesheet"> 
<!-- //font-awesome icons -->
</head>
<body class="signup-body">
<script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
<script src="{!! asset('assets/js/monetization.js') !!}" type="text/javascript"></script>
<script>
(function(){
    if(typeof _bsa !== 'undefined' && _bsa) {
        // format, zoneKey, segment:value, options
        _bsa.init('flexbar', 'CKYI627U', 'placement:w3layoutscom');
    }
})();
</script>
<script>
(function(){
if(typeof _bsa !== 'undefined' && _bsa) {
    // format, zoneKey, segment:value, options
    _bsa.init('fancybar', 'CKYDL2JN', 'placement:demo');
}
})();
</script>
<script>
(function(){
    if(typeof _bsa !== 'undefined' && _bsa) {
        // format, zoneKey, segment:value, options
        _bsa.init('stickybox', 'CKYI653J', 'placement:w3layoutscom');
    }
})();
</script><script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','{!! asset("assets/js/analytics.js") !!}','ga');
ga('create', 'UA-30027142-1', 'w3layouts.com');
  ga('send', 'pageview');
</script>
<body>
    <div class="overlay"></div>
    <div class="agile-signup">  
            <!---728x90--->
            <div class="content2">
                <div class="grids-heading gallery-heading signup-heading">
                    <h2>Login</h2>
                </div>
                {!! Form::open(['url' => 'login', 'class' => '']) !!} 

                    @if (Session::has('error'))
                        <div class="row">
                             <div class="alert alert-danger alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close"> <i class="fa fa-close"></i></button>
                                <strong>Error!</strong> {!! Session::get('error') !!}
                            </div>
                        </div>
                    @endif           

                    <input type="text" name="email" value="" placeholder="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
                    <input type="password" name="password" value="" placeholder="Password"onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
                    <input type="submit" class="register" value="Login">

                {!! Form::close() !!}
                
            </div>
            <!---728x90--->

            <!-- footer -->
            <div class="copyright">
                <p>© 2016 Rising Himachal . All Rights Reserved . Designed by <a href="#">The Girafe</a></p>
            </div>
            <!-- //footer -->
            <!---728x90--->

        </div>
    
</body>
</html>