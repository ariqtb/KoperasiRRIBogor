<head>
    <title><?= $title; ?></title>
</head>

<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-3">
        <div class="container-xl">
            <div class="p-t-30">
                <div class="">
                    <div class="row g-3 mb-3 align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0"><?= $title; ?></h1>
                        </div>
                        <div class="col text-end">
                            <a class="btn btn-info" href="<?= base_url('admin'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                </svg>
                                Kembali</a>
                        </div>
                        <?php
                    if (session()->getFlashdata('peringatan')) {
                        echo '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        echo session()->getFlashdata('peringatan');
                        echo '</div>';
                    }
                    ?>
                    </div>
                    <div class="card card-3">
                        <div class="card-body">
                            <form method="post" action="<?= base_url('admin/create'); ?>" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input hidden type="text" class="form-control" name="id_admin" id="id_admin">
                                <div class="row row-space p-3">
                                    <div class="col">
                                        <div class="row form-group">
                                            <div class="col-3">
                                                <label for="nama">
                                                    <h6>Nama</h6>
                                                </label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="nama" id="nama">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-3">
                                                <label class="label">
                                                    <h6>Username</h6>
                                                </label>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="username" id="username">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-3">
                                                <label class="label">
                                                    <h6>Email</h6>
                                                </label>
                                            </div>
                                            <div class="col">
                                                <input type="email" class="form-control" name="email" id="email">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-3">
                                                <label class="label">
                                                    <h6>Password</h6>
                                                </label>
                                            </div>
                                            <div class="col">
                                                <input type="password" class="form-control" name="password" id="password">
                                            </div>
                                        </div>
                                        <div class=" row form-group">
                                            <div class="col-3">
                                                <label for="gambar">
                                                    <h6>Gambar</h6>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" class="form-control" name="gambar" id="gambar" onchange="readURL(this);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 mr-3">
                                        <img id="preview" src="" class="rounded" alt="preview" style="width:12rem;height:12rem;object-fit:cover;" />
                                        <button class="btn btn-primary mt-3" value="submit" type="submit">Submit</button>
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
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>