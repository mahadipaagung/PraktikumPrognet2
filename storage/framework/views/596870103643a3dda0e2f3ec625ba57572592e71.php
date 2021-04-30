<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Phone Store</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .jumbotron{
                background-image: url(img/slide4.jpg);
                background-size: cover;
                height:550px;
                width:1200px;
                text-align: center;
            }
            .jumbotron .display-4{
                color:white;
            }
            .jumbotron p{
                color:white;
                font-size: 25px;
            }
            .jumbotron hr{
                border-color: #F05F40;
                width:70px;
                border-width: 3px;
            }
            .jumbotron .btn{
                background-color:  #F05F40;
                border:none;
                border-radius: 25px;
                padding-right: 25px;
                padding-left: 25px;
                margin-top: 40px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/home')); ?>">Home</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Login</a>

                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-4">WELCOME TO <br><span class="font-weight-bold">PHONE STORE</span></h1>
                    <hr class="my-4">
                    <p class="lead">It uses utility classes for typography and spacing to space content out within the larger container.</p>
                    <a class="btn btn-primary btn-lg font-weight-bold" href="#" role="button">KUNJUNGI</a>
                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\xamp\htdocs\pratikumPrognet\resources\views/welcome.blade.php ENDPATH**/ ?>