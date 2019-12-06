<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - The Pub</title>
    <link rel="stylesheet" href={{asset('assets/bootstrap/css/bootstrap.min.css')}}>
    <link rel="stylesheet" href={{asset('https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i')}}>
    <link rel="stylesheet" href={{asset('https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css')}}>
    <link rel="stylesheet" href={{asset('assets/css/smoothproducts.css')}}>
</head>

<body>
<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
    <div class="container"><a class="navbar-brand logo" href="#">The Pub</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
             id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link active" href="home">Home</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="menu">Menu</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="order">Order now</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="viewOrder">view order</a></li>
                <li class="nav-item" role="presentation"></li>
            </ul>
        </div>
    </div>
</nav>
@yield('header')
<footer class="page-footer dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h5>Get Food</h5>
                <ul>
                    <li><a href="home">Home</a></li>
                    <li><a href="order">Order</a></li>
                    <li><a href="menu">Menu</a></li>
                </ul>
            </div>
            <div class="col-sm-4">
                <h5>Edit Your Order</h5>
                <ul>
                    <li><a href="viewOrder">Edit Order</a></li>
                    <li><a href="admin">Admin Page</a></li>
                </ul>
            </div>
            <div class="col-sm-4">
                <h5>Legal</h5>
                <ul>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="clearfix"></div>
            <div class="clearfix"></div>
        </div>
    </div>
</footer>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js')}}"></script>
<script src="{{asset('assets/js/smoothproducts.min.js')}}"></script>
<script src="{{asset('assets/js/theme.js')}}"></script>
</body>
@yield('footer')
