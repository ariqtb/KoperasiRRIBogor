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
                        </div>
                    </div>
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

            <div class="app-card shadow-sm mb-3 border-left-decoration">
                <div class="inner">
                    <div class="app-card-body p-3">
                        <?php foreach ($admin as $key => $data) {
                            if ($data['username'] == $logged_in['username']) {
                                $admindata = $data;
                                break;
                            }
                        } ?>
                        <div class="row">
                            <div class="col-auto">
                                <div class="item-data"><img class="profile-image rounded" style="width: 5rem;height:5rem;object-fit:cover;" src="<?= base_url('assets/images/upload/' . $admindata['foto']); ?>" alt=""></div>
                            </div>
                            <div class="col">
                                <h2 class=""><?= $logged_in['nama']; ?></h2>
                                <h6 class=""><?= $logged_in['username']; ?></h6>
                            </div>
                            <div class="col text-end align-middle">
                                <a class="btn-sm btn-primary confirmation" href="<?= base_url('Login/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                <a class="btn-sm btn-secondary" href="<?= base_url('Admin/edit/' . $logged_in['id_admin']); ?>"><i class="fas fa-edit"></i> Edit</a>
                                <!-- <a class="btn-sm btn-danger" href="<?= base_url('Admin/delete/' . $key); ?>"><i class="fas fa-trash"></i> Hapus</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <h6>List Akun Admin</h6>
                </div>
                <div class="col m-3 text-end">
                    <a type="button" class="btn-sm btn-primary" href="<?= base_url('admin/add'); ?>"><i class="fas fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="card shadow-sm mb-5">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered app-table-hover mb-0 text-left" id="table">
                            <thead>
                                <tr>
                                    <th class="cell">Nama Admin</th>
                                    <th class="cell">Foto</th>
                                    <th class="cell">Username</th>
                                    <th class="cell">Email</th>
                                    <th class="cell"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($admin as $key => $val) : ?>
                                    <tr>
                                        <td class="cell"><?= $val['nama']; ?></td>
                                        <?php if ($val['foto'] == '') { ?>
                                            <td class="cell"><img class="rounded" style="width: 3rem; height: 3rem; object-fit:cover;" src="<?= $imageDefault; ?>"></td>
                                        <?php } else { ?>
                                            <td class="cell"><img class="rounded" style="width: 3rem; height: 3rem; object-fit:cover;" src="<?= base_url('assets/images/upload/' . $val['foto']); ?>"></td>
                                        <?php } ?>
                                        <td class="cell"><?= $val['username']; ?></td>
                                        <td class="cell"><?= $val['email']; ?></td>
                                        <td class="cell">
                                            <a class=" btn-sm app-btn-secondary" href="<?= base_url('Admin/edit/' . $val['id_admin']); ?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn-sm btn-danger confirmation_delete" href="<?= base_url('Admin/delete/' . $val['id_admin']); ?>"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var elems_del = document.getElementsByClassName('confirmation_delete');
    var confirmIt = function(e) {
        if (!confirm('Apakah anda yakin ingin logout?')) e.preventDefault();
    };
    var confirmItAcc = function(e) {
        if (!confirm('Apakah anda yakin ingin menghapus akun ini?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
    for (var i = 0, l = elems_del.length; i < l; i++) {
        elems_del[i].addEventListener('click', confirmItAcc, false);
    }
</script>