<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Not Found</title>

    <link href="{{ url('/public/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ url('/public/dashboard-design/css/custom.css')}}" rel="stylesheet" type="text/css" />
     <!-- Style Css-->
     <link href="{{ url('/public/dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>
    
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100 bg-white">
    
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden p-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="text-center">
                        <img src="../dashboard-design/images/404.png" alt="error img" class="img-fluid">
                        <div class="mt-3">
                            {{-- <h3 class="text-uppercase">Sorry, Page not Found 😭</h3> --}}
                            <h3 class="text-uppercase">Sorry, Page not Found</h3>
                            <p class="text-muted mb-4">The page you are looking for not available!</p>
                            <a href="{{route('homepage')}}" class="btn btn-black">Back to home</a>
                        </div>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth-page content -->
    </div>
    
</body>
</html>


