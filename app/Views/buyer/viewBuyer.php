<head>
    <title><?= $title; ?></title>
</head>
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0"><?= $title; ?></h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                            <div class="col-auto">

                            </div>
                        </div>
                        <!--//row-->
                    </div>
                    <!--//table-utilities-->
                </div>
                <!--//col-auto-->
            </div>
            <!--//row-->

            <div class="row d-flex justify-content-between">
                <div class="row">
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
                        echo " <script type=\"text/javascript\"> document.getElementById('nomor_anggota').focus();</script>";
                        echo session()->getFlashdata('peringatan');
                        echo '</div>';
                    }
                    ?>
                    <div class="col-md-8">
                        <div class="card shadow-sm mb-5">
                            <div class="card-body">
                                <div class="table-responsive table-scroll">
                                    <table class="table table-hover text-left" id="table">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="cell">Nomor</th>
                                                <th class="cell">Nama</th>
                                                <th class="cell">ID Anggota</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($pembeli as $key => $buyer) : ?>
                                                <tr class="text-center">
                                                    <td class="cell"><?= $buyer['id_pembeli']; ?></td>
                                                    <td class="cell"><?= $buyer['nama_pembeli']; ?></td>
                                                    <td class="cell"><?= $buyer['nomor_anggota']; ?></td>

                                                    <td class="cell p-1">
                                                        <a class=" btn-sm app-btn-secondary" href="<?= base_url('Buyer/viewEdit/' . $i); ?>"><i class="fas fa-edit"></i></a>
                                                        <a class=" btn-sm btn-danger confirmation" href="<?= base_url('Buyer/delete/' . $buyer['id_pembeli']); ?>"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form method="post" action="<?= base_url('Buyer/create'); ?>" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="row row-space">
                                        <div class="row form-group mt-2 ml-1">
                                            <p>Nama Anggota</p>
                                            <div class="col">
                                                <input onload="" id="myText" type="text" class="form-control" name="nama" id="nama">
                                            </div>
                                        </div>
                                        <div class="row form-group mt-2 ml-1">
                                            <p>Nomor Anggota</p>
                                            <div class="col">
                                                <input onload="" id="myText" type="text" class="form-control" name="nomor_anggota" id="nomor_anggota">
                                            </div>
                                        </div>
                                        <div class="row form-group mt-2 ml-1">
                                            <div class="col">
                                                <button class="btn btn-primary" value="submit" type="submit"><i class="fas fa-download"></i> Input Data</button>
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
    <script>
        document.getElementById("myText").focus();

        var elems = document.getElementsByClassName('confirmation');
        var confirmIt = function(e) {
            if (!confirm('Apakah anda yakin ingin menghapus data?')) e.preventDefault();
        };
        for (var i = 0, l = elems.length; i < l; i++) {
            elems[i].addEventListener('click', confirmIt, false);
        }
    </script>