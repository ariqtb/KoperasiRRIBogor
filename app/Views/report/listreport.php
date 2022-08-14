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
            </div>
        </div>
        <div class="row">
            <div class="col card shadow-sm mb-5">
                <ul class="nav flex-column p-3">
                    <li class="nav-item mb-3">
                        <h5>Laporan</h5>
                    </li>
                    <li class="nav-item">
                        <div class="input-group input-group-sm mb-3">
                            <input type="number" class="form-control" placeholder="Tahun" min="2021" name="year" id="year">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">Cari</button>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="input-group input-group-sm mb-5">
                            <select class="custom-select" name="month" id="month">
                                <option selected value="">Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </li>
                    <form method="post" action="<?= base_url('report/filterdata'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <li class="nav-item">
                            <div class="mb-3">
                                <span>Date From</span>
                                <input type="date" class="form-control" name="datefrom" class="form-control" id="datefilterfrom" value="<?= $datefrom; ?>" data-date-split-input="true">
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="">
                            <span>Date To</span>
                                <input type="date" class="form-control" name="dateto" class="form-control" id="datefilterto" value="<?= $dateto; ?>" data-date-split-input="true">
                            </div>
                        </li>
                    </form>
                </ul>
            </div>
            <div class="col-auto card shadow-sm mb-5">
                <div class="card-body">

                    <?php if ($datefrom or $dateto) {  ?>
                        <div class="mb-3">
                            <span><b>Rentang waktu : </b><?= date('d M Y', strtotime($datefrom)); ?> - </span><span> <?= date('d M Y', strtotime($dateto)); ?></span>
                        </div>
                    <?php } ?>

                    <div class="table-responsive table-scroll">
                        <table class="table table-hover mb-0 text-center" id="table2">
                            <thead>
                                <tr>
                                    <th class="cell">Nama Pembeli</th>
                                    <th class="cell">Total Transaksi</th>
                                    <th class="cell">Total Item Dibeli</th>
                                    <th class="cell">Total Nominal Item</th>
                                    <th class="cell"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataReport as $report) :
                                    if ($report['total_transaksi']) {
                                ?>
                                        <tr>
                                            <td class="cell"><?= $report['nama_pembeli']; ?></td>
                                            <td class="cell"><?= $report['total_transaksi']; ?></td>
                                            <td class="cell"><?= $report['total_item']; ?></td>
                                            <td class="cell"><span>Rp. <?= number_format($report['total_harga'], 2, ',', '.'); ?></span></td>
                                            <td class="cell">
                                                <a class="btn-sm app-btn-secondary" href="<?= base_url('report/viewDetail/' . $report['id_pembeli']); ?>" id="modalView"><i class="fa fa-info-circle"></i></a>
                                                <a class=" btn-sm btn-danger confirmation" href="<?= base_url('report/deleteAll/' . $report['id_pembeli']); ?>"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php }
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>