<head>
    <title><?= $title; ?></title>
</head>

<body>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="p-t-30">
                    <div class="wrapper--w680 container">
                        <div class="row g-3 mb-4 align-items-center justify-content-between">
                            <div class="col-auto">
                                <h1 class="app-page-title mb-0"><?= $title; ?></h1>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-info" href="<?= base_url('item'); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                    </svg>
                                    Kembali</a>
                            </div>
                        </div>
                        <?php
                        if (session()->getFlashdata('pesan')) {
                            echo '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                            echo session()->getFlashdata('pesan');
                            echo '</div>';
                        }
                        if (session()->getFlashdata('peringatan')) {
                            echo '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                            echo session()->getFlashdata('peringatan');
                            echo '</div>';
                        }
                        ?>
                        <div class="card card-3">
                            <div class="card-body">
                                <form method="post" action="<?= base_url('Item/edit'); ?>" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <?php foreach($item as $val) ?>
                                    <input hidden type="text" class="form-control" value="<?= $val['id_item']; ?>" name="id_item" id="id_item">
                                    <div class="row row-space">
                                        <div class="row form-group">
                                            <div class="col">
                                                <label for="nama">
                                                    <h6>Nama Barang</h6>
                                                </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" value="<?= $val['nama_item']; ?>" name="nama" id="nama">
                                            </div>
                                        </div>
                                        <!-- <div class="row form-group">
                                            <div class="col">
                                                <label for="nama">
                                                    <h6>Kode Barang</h6>
                                                </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" value="<?= $val['kode_item']; ?>" name="kode" id="kode">
                                            </div>
                                        </div> -->
                                        <div class="row form-group">
                                            <div class="col">
                                                <label class="label">
                                                    <h6>Stok</h6>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="number" min="1" value="<?= $val['stok_item']; ?>" step="any" id="stok" name="stok">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col">
                                                <label class="label">
                                                    <h6>Harga</h6>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="number" min="1" step="any" value="<?= $val['harga_item']; ?>" id="harga" name="harga">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col">
                                                <label class="label">
                                                    <h6>Gambar</h6>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <img src="<?= base_url('assets/images/upload/' . $val['foto_item']); ?>" width="80px" alt="">
                                                <input type="file" class="form-control" onchange="readURL(this);" name="gambar" id="gambar">
                                            </div>
                                        </div>
                                        <div class=" row form-group">
                                            <div class="col">
                                                <label for="gambar">
                                                    <h6>Gambar</h6>
                                                </label>
                                            </div>
                                            <div class="col-md-8">
                                            </div>
                                        </div>
                                        <div class="text-center justify-content-center">
                                            <div class="p-t-15">
                                                <img id="preview" src="<?= base_url('assets/images/upload/' . $val['foto_item']); ?>" alt="preview" style="width: 150px; height: auto;" />
                                            </div>
                                            <div class="p-t-15">
                                                <button class="btn btn-primary mt-3" value="submit" type="submit">Submit</button>
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


</body>

</html>
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