<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <style>
        body {
            background: url('../img/labtek_v.jpg') center center/cover no-repeat fixed;
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
        }

        .heading {
            position: fixed;
            background-color: rgba(10,0,0,0.7);
            z-index: 1;
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
            padding-top: 20vh;
        }
    </style>
    
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div class="heading">
        @if (isset($message))
            <div class="container">
                <div class="heading">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="container">
            <div class="content-login">
                <img class="homepage-logo" src="../img/logo-new.png" />
                <h1 style="font-size:8vh"> Motask</h1>
                <h3>Place Where You Can Find Your Own Projects</h3>
                <h4>For more information and user guide, <a href="http://bit.ly/TutorialMotask">click me!</a></h4>
                <a href="auth/google" class="btn btn-warning btn-lg">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Sign In
                </a>
                <h6>*Please sign in with std email</h6>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
