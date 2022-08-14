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
                            <div class="mb-3"><a class="logo" href="index.html"><img class="logo-icon" style="width: 25%; height: 25%;" src="<?= base_url('assets/images/logorri.png'); ?>" alt="logo"></a></div>
                            <h3 class="">Login</h3>
                            <p class="mb-3">Koperasi RRI Bogor</p>

                            <?php
                            if (session()->getFlashdata('error')) { ?>
                                <div class="app-card alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" onclick="this.parentElement.style.display='none';">&times;</button>
                                    <?php echo session()->getFlashdata('error'); ?>
                                </div>
                            <?php }
                            ?>
                            <?php
                            if (session()->getFlashdata('success')) { ?>
                                <div class="app-card alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" onclick="this.parentElement.style.display='none';">&times;</button>
                                    <?php echo session()->getFlashdata('success'); ?>
                                </div>
                            <?php }
                            ?>

                            <form method="post" action="<?= base_url('login/process'); ?>">
                                <?= csrf_field(); ?>
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control form-control" />
                                </div>

                                <div class="form-outline mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="lihatpassword" name="password" class="form-control form-control" />
                                </div>

                                <!-- Checkbox -->
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check d-flex justify-content-start mb-4">
                                            <input class="form-check-input" type="checkbox" onclick="fungsipassword()" />
                                            <label class="form-check-label" for="form1Example3"> Lihat Password </label>
                                        </div>
                                    </div>
                                    <div class="col text-end">
                                        <a style="color:#212529;" href="<?=base_url('Login/forget')?>">Lupa Password?</a>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block" type="submit">Login</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    function fungsipassword() {
        var x = document.getElementById("lihatpassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<script>
    document.getElementById("username").focus();
</script>

</html>