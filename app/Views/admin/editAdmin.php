<head>
    <title><?= $title; ?></title>
</head>
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="">
                <div class="row">
                    <div class="col">
                        <h4 class="app-page-title mb-0"><?= $title; ?></h4>
                    </div>
                    <div class="col-auto mb-3">
                        <a class="btn btn-info" href="<?= base_url('admin'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                            </svg>
                            Kembali</a>
                    </div>
                    <?php
                    $validation = \Config\Services::validation();
                    if (session()->getFlashdata('peringatan')) {
                        echo '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        echo session()->getFlashdata('peringatan');
                        echo '</div>';
                    }
                    ?>
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">

                            <form method="post" action="<?= base_url('admin/edit/' . $admin['id_admin']); ?>" accept-charset="utf-8" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="row row-space p-4">
                                    <div class="col-auto">
                                        <?php if ($admin['foto'] == '') { ?>
                                            <img class="rounded-circle" style="width: 12rem; height: 12rem; object-fit:cover;" src="<?= $imageDefault; ?>">
                                        <?php } else { ?>
                                            <img class="rounded-circle" style="width: 12rem; height: 12rem; object-fit:cover;" src="<?= base_url('assets/images/upload/' . $admin['foto']); ?>">
                                        <?php } ?>
                                    </div>
                                    <div class="col">
                                        <div class="row form-group">
                                            <div class="col-3">
                                                <label for="nama">
                                                    <h6>Nama</h6>
                                                </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $admin['nama']; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-3">
                                                <label class="label">
                                                    <h6>Username</h6>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input disabled type="text" class="form-control" value="<?= $admin['username']; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-3">
                                                <label class="label">
                                                    <h6>Email</h6>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="email" name="email" id="email" class="form-control" value="<?= $admin['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-3">
                                                <label class="label">
                                                    <h6>Password</h6>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <!-- <input hidden type="password" class="form-control" name="password" id="password" value="<?= $admin['password']; ?>"> -->
                                                <input type="password" class="form-control" placeholder="kosongkan bila tidak ingin diubah" value="">
                                            </div>
                                        </div>
                                        <div class=" row form-group">
                                            <div class="col-3">
                                                <label for="gambar">
                                                    <h6>Gambar</h6>
                                                </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="file" class="form-control" name="gambar" id="gambar" onchange="readURL(this);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center justify-content-center">
                                        <div class="p-t-15">
                                            <img class="rounded" id="preview" src="" alt="preview" style="width:12rem;height:12rem;object-fit:cover;" />
                                        </div>
                                        <div class="mt-3 p-t-15">
                                            <button class="btn btn-primary" value="submit" type="submit">Simpan</button>
                                        </div>
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