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
				<div class="col text-end">
					<a class="btn btn-info" href="<?= base_url('orders'); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
						</svg>
						Kembali</a>
				</div>
			</div>
            <!--//row-->
            <div class="row d-flex justify-content-start">
                <div class="col-md-3">
                    <h6 class="app-card-title mb-3">List Barang</h6>
                </div>
                <div class="">
                    <input style="width: 200px; height: 2rem;" type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari Item">
                </div>
            </div>
            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <!-- <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Daftar Pembeli</a>
						<a class="flex-sm-fill text-sm-center nav-link" id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Daftar Barang</a> -->
                <!-- <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a> -->
            </nav>

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
            <div class="row d-flex justify-content-between">
                <div class="col-md-6">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover text-left" id="myTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="cell">Nama</th>
                                            <th class="cell">Gambar</th>
                                            <th class="cell">Harga</th>
                                            <th class="cell">Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($item as $items) :
                                            $items['id_item'] = $i;
                                        ?>

                                            <tr class="text-center">
                                                <td class="cell"><?= $items['nama_item']; ?></td>
                                                <td class="cell"><img src="<?= base_url('assets/images/upload/' . $items['foto_item']); ?>" width="40px"></td>
                                                <td class="cell"><?= number_to_currency($items['harga_item'], 'IDR'); ?></td>
                                                <td class="cell"><?= $items['stok_item']; ?></td>
                                                <td class="cell">
                                                    <!-- <button class="btn btn-sm app-btn-primary " type="submit"><i class="fas fa-shopping-cart"></i></button> -->
                                                    <a class="btn btn-sm app-btn-primary " href="<?= base_url('orders/add/' . $items['id_item']) . '/' . $id; ?>"><i class="fas fa-shopping-cart"></i></a>
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
                <!--//tab-content-->


                <div class="col-md-6">
                    <?= form_open('orders/aksi/' . $id) ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="app-card-title">Keranjang Pembelian</h5>
                            <h6 class="app-card-title mb-2 mt-4">Nama Pembeli</h6>
                            <div class="item border-bottom py-2">
                                <div class="input-group-prepend md-3">
                                    <?php
                                    $i = 0;
                                    foreach ($order as $key => $row) :
                                        if ($order[$key]['id_pembelian'] == $id) {
                                            $rowOrder = $order[$key];
                                            // print_r($order[$key]);
                                            break;
                                        }
                                        $key++;
                                    endforeach; ?>
                                    <input hidden type="text" name="id_order" value="<?= $id ?>">
                                    <!-- <input list="pembeli" class="form-control search-orders" type="text" placeholder="Nama Pembeli"> -->
                                    <select class="custom-select" name="pembeli">
                                        <option selected value=<?= $rowOrder['id_pembeli']; ?>|<?= $rowOrder['nama_pembeli']; ?>><?= $rowOrder['nama_pembeli']; ?></option>
                                        <?php foreach ($pembeli as $pembeli) : ?>
                                            <option value="<?= $pembeli['id_pembeli']; ?>|<?= $pembeli['nama_pembeli']; ?>" name=""><?= $pembeli['nama_pembeli']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!--//row-->
                            </div>
                            <h6 class="app-card-title mb-2 mt-4">Barang</h6>
                            <div class="table-responsive">
                                <table class="table app-table-hover text-left" id="myTable">
                                    <thead>
                                        <tr class="text-center" style="font-size: 12px;">
                                            <th class="cell">Nama</th>
                                            <th class="cell">jumlah</th>
                                            <th class="cell">Total</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $i = 1;
                                        foreach ($cart->contents() as $key => $value) :
                                        ?>
                                            <tr class="text-center" style="font-size: 12px;">
                                                <td class="cell" name="nama_item<?= $i; ?>"><?= $value['nama_item']; ?></td>
                                                <td class="cell">
                                                    <input min="1" type="number" value="<?= $value['jumlah_item']; ?>" name="jumlah_item<?= $i; ?>" id="jumlah_item" class="form-control" style="width: 4rem; height: 1.5rem;" />
                                                </td>
                                                <td class="cell" name="harga_item<?= $i; ?>"><?= number_to_currency($value['harga_item'] * $value['jumlah_item'], 'IDR'); ?></td>
                                                <td class="cell">
                                                    <a class="btn-sm app-btn-secondary" href="<?= base_url('orders/clearPerItem/' . $value['rowid'] . '/' . $id); ?>"><i class="fas fa-trash"></i></a>
                                                </td>
                                                <?php $i++; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <table class="table app-table-hover text-left" id="myTable2">
                                    <div>
                                        <tr style="font-size: 14px;">
                                            <th class="cell">Total Barang</th>
                                            <td><?= $cart->totalItems(); ?></td>
                                        </tr>
                                        <tr style="font-size: 14px;">
                                            <th class="cell">Total</th>
                                            <td><?= number_to_currency($cart->total(), 'IDR'); ?></td>
                                        </tr>
                                    </div>
                                </table>
                            </div>
                        </div>


                        <!-- <input class="form-control search-orders" id="jumlah" name="jumlah"> -->
                        <div class="row justify-content-start ml-3">
                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class=" row justify-content-between m-3">
                            <div class="col-auto">
                                <button type="submit" name="action" value="update" class="btn btn-sm btn-secondary">Update Keranjang</button>
                                <a href="<?= base_url('orders/clear/' . $id) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </div>
                            <div class="col-auto">
                                <button type="submit" name="action" value="saveupdate" class="btn btn-sm btn-success">Ubah</button>
                            </div>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>



</div>
<!--//container-fluid-->
</div>
<!--//app-content-->

<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>