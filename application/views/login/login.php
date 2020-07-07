<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>

    <!-- link bootsrapt -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">  

</head>
<body>
    <div id="page-container">
        <div class="bg-image" style="background-image: url('assets/oneui/media/photos/photo36@2x.jpg');">
            <div class="hero-static bg-white-95">
                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-4">
                            <div class="block block-themed block-fx-shadow mb-0">
                                <div class="block-content">
                                    <img class="img-fluid mt-3" src="<?php echo base_url('assets/img/keranjang.png')?> " alt="AISPS STORE">
                                    <div class=" px-lg-4 py-lg-5 " >
                                        <div id="page-loader" class="show"></div>
                                            <h1 class="mb-2 ">Sign In</h1>
                                            <p>Masuk untuk melanjutkan akses.</p>
                                            <form class="js-validation-signin" action="<?php echo base_url('index.php/login/login')?>" method="POST" id="form-login">
                                                <div class="py-1">
                                                    <div class="form-group">
                                                        <input type="text" name="username" class="form-control form-control-alt form-control-lg " id="email-admin" name="login-username" placeholder="Email / Username">
                                                    </div>
                                                    <div class="form-group ">
                                                        <input type="password" class="form-control form-control-alt form-control-lg" id="password-admin" name="password" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <div class="container-fluid  ">
                                                        <input type="submit" class="btn btn-block btn-primary mt-3 " value="Sign In"></input>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
        </div>
    </div>
</body>
</html>