<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?></title>

    <link rel="shortcut icon" href="<?= base_url('assets/images/logorri.png') ?>">

    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/css/portal_unminify.css') ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="app">

    <section class="">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">

                    <div class="card">
                        <div class="card-body p-5 text-center">
                            <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon" style="width: 25%; height: 25%;" src="<?= base_url('assets/images/logorri.png'); ?>" alt="logo"></a></div>
                            <h3 class="mb-5">Reset Password</h3>
                            <!-- <p class="">Masukkan Email untuk dapat melakukan reset password</p> -->

                            <?php

                                                                                                                                                                    use function PHPUnit\Framework\isTrue;

                            if (session()->getFlashdata('error')) { ?>
                                <div class="card alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" onclick="this.parentElement.style.display='none';">&times;</button>
                                    <p><?php echo session()->getFlashdata('error'); ?></p>
                                </div>
                            <?php } ?>
                            <?php
                            if (session()->getFlashdata('success')) { ?>
                                <div class="card alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" onclick="this.parentElement.style.display='none';">&times;</button>
                                    <p><?php echo session()->getFlashdata('success'); ?></p>
                                </div>
                            <?php } ?>

                            <form method="post" action="<?= base_url('Login/reset?t='.$_GET['t']); ?>">
                                <?= csrf_field(); ?>
                                <div class="form-outline mb-4 text-left">
                                    <label for="email">Masukkan Password Baru</label>
                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control form-control" />
                                </div>
                                <div class="form-outline mb-4 text-left">
                                    <!-- <label for="email">Konfirmasi Password Baru</label> -->
                                    <input type="password" id="password2" name="password2" placeholder="Konfirmasi Password" class="form-control form-control" />
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check d-flex justify-content-start mb-4">
                                            <input class="form-check-input" type="checkbox" onclick="fungsipassword()" />
                                            <label class="form-check-label" for="form1Example3"> Lihat Password </label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block" type="submit">Simpan</button>

                                <hr class="my-4">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    document.getElementById("email").focus();

    function fungsipassword() {
        var x = document.getElementById("password");
        var y = document.getElementById("password2");
        if (x.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }

</script>

</html>