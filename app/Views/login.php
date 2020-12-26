<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        body {
            background-color: #666EE4;
        }

        .bg-login {
            width: 100vw;
            height: 100vh;
            background-image: url('/img/background/bg-login.jpg');
            background-size: 70vw 100vh;
            background-repeat: no-repeat;
        }

        .form-login-wrapper {
            height: 100vh;
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .form-login-wrapper h3 {
            text-align: center;
            color: #666EE4;
        }

        .form-login-wrapper .card {
            max-width: 350px;
            width: 100%;
            border: 2px solid rgba(0, 0, 0, .125);
        }

        #form-login .form-control {
            border-radius: 10px;
            border-color: #666EE4;
            padding: .5rem 1rem;
        }

        #form-login .btn {
            width: 100%;
            background-color: #666EE4;
            color: #fff;
            border-radius: 10px;
            font-size: 1.25rem;
        }

        #form-login .btn:hover {
            background-color: #666Eb3;
        }
    </style>
</head>

<body>
    <?php if (session('errors')) { ?>
        <?= $this->include("components/alert_error.php") ?>
    <?php } ?>
    <div class="bg-login">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 d-none d-sm-block"></div>
                <div class="col-12 col-sm-6 align-self-end form-login-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="pb-3 pt-2">Login</h3>
                            <form id="form-login" action="/login" method="POST">
                                <div class="form-group">
                                    <input required type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input required type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="password">
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="ingat">
                                    <label class="form-check-label" for="ingat">Ingat akun</label>
                                </div>
                                <button type="submit" class="btn mt-5 mb-4">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <?php if (session('errors')) { ?>
        <script>
            jQuery('#alertError').modal('show')
        </script>
    <?php } ?>
</body>

</html>