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
                            <a class="btn btn-info" href="<?= base_url('Orders'); ?>">
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

                        <div class="flashdata"></div>
                    </div>
                    <div class="card card-3">
                        <div class="card-body">
                            <?= form_open('Orders/aksi/') ?>
                            <div class="row form-group">
                                <div class="col-2">
                                    <label for="nama">Nama Anggota</label>
                                </div>
                                <div class="col-5">
                                    <select class="custom-select" name="pembeli">
                                        <option value="">Choose...</option>
                                        <?php foreach ($pembeli as $pembeli) : ?>
                                            <option value="<?= $pembeli['id_pembeli']; ?>|<?= $pembeli['nama_pembeli']; ?>" name=""><?= $pembeli['nama_pembeli']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-2">
                                    <label for="nama">Barang</label>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" name="barang" id="barang" placeholder="kode barang">
                                </div>
                                <div class="col-5">
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#baranginput"><i class="fas fa-list"></i> Cari Barang</a>
                                    <!-- <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#baranginput"><i class="fas fa-download"></i> Input Data</a> -->
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="table-responsive">
                                    <table class="table app-table-hover text-left" id="tablecart">
                                        <thead>
                                            <tr class="text-center" style="font-size: 12px;">
                                                <th class="cell">Nama</th>
                                                <th class="cell">jumlah</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabledata2">
                                            <?php
                                            $i = 1;
                                            foreach ($cart->contents() as $key => $value) :
                                            ?>
                                                <tr class="text-center" style="font-size: 12px;">
                                                    <td class="cell" name="nama_item<?= $i; ?>"><?= $value['nama_item']; ?></td>
                                                    <td class="cell">
                                                        <input min="1" type="number" value="<?= $value['jumlah_item']; ?>" name="jumlah_item<?= $i; ?>" id="jumlah_item" class="form-control" style="width: 4rem; height: 1.5rem;" />
                                                    </td>
                                                    <td class="cell" name="hargatotal_item<?= $i; ?>"><?= number_to_currency($value['harga_item'] * $value['jumlah_item'], 'IDR'); ?></td>
                                                    <td class="cell" hidden name="harga_item"><?= number_to_currency($value['harga_item'] * $value['jumlah_item'], 'IDR'); ?></td>
                                                    <td class="cell">
                                                        <a class="btn-sm app-btn-secondary" href="<?= base_url('Orders2/clearPerItem/' . $value['rowid']); ?>"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                    <?php $i++; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="tabledataaa"></div>
                                <div id="tabledataaa2"></div>
                                <div id="tabledataaa3"></div>
                                <div id="tabledataaa4"></div>
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
                                <div class=" row justify-content-between m-3">
                                    <div class="col-auto">
                                        <button type="submit" name="action" value="update" class="btn btn-sm btn-secondary">Update Keranjang</button>
                                        <a href="<?= base_url('Orders2/clear') ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" name="action" value="save" class="btn btn-sm btn-success">Simpan</button>
                                    </div>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade show inputorder" id="baranginput" tabindex="-1" aria-labelledby="inputlabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputlabel">Input Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('Orders/aksi/') ?>
            <div class="modal-body">
                <div class="mb-3">
                    <input style="width: 200px; height: 2rem;" type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari Item">
                </div>
                <div class="table-responsive" style="overflow-y: scroll; width:100%; height:23rem;">
                    <table class="table table-sm app-table-hover text-left" id="myTable">
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
                                // $items['id_item'] = $i;
                                if ($items['stok_item'] > 0) {
                            ?>
                                    <tr class="text-center">
                                        <td class="cell"><?= $items['nama_item']; ?></td>
                                        <td class="cell"><img class="rounded" style="width: 3rem; height: 3rem; object-fit:cover;" src="<?= base_url('assets/images/upload/' . $items['foto_item']); ?>" width="40px"></td>
                                        <td class="cell"><?= number_to_currency($items['harga_item'], 'IDR'); ?></td>
                                        <td class="cell"><?= $items['stok_item']; ?></td>
                                        <td class="cell">
                                            <!-- <button class="btn btn-sm app-btn-primary " type="submit"><i class="fas fa-shopping-cart"></i></button> -->
                                            <a class="btn btn-sm btn-success addItem" href="<?= base_url('Orders/add/' . $items['id_item']); ?>"><i class="fas fa-plus"></i></a>
                                        </td>
                                        <?php $i++; ?>
                                <?php }
                            endforeach; ?>
                                    </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-sm col">
                    <?php
                    if (session()->getFlashdata('peringatan')) {
                        echo '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        echo session()->getFlashdata('peringatan');
                        echo '</div>';
                    ?>
                        <script>
                            $(document).ready(function() {
                                $("#barang").modal('show');
                            });
                        </script>
                    <?php } ?>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" value="submit" type="submit">Submit</button>
            </div>
            <?= form_close() ?>
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

    $('.addItem').click(function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('href'),
            method: "get",
            // data: {
            //     data:'data',
            // },
            // dataType: 'JSON',

            success: function(response) {
                // alert(response.cart);
                $('.inputorder').modal('hide');
                $('#tabledataaa').html(response);

            },

            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    })
    // $(document).ready(function() {
    //     $('.addItem').click(function(e) {
    //         var array = new array();
    //         var fruitsArray = {
    //             "Apple": "hayu",
    //             "Banana": "hayu",
    //             "Orange": "hayu",
    //             "Mango": "hayu",
    //             "Pineapple": "hayu"
    //         };

    //         array = fruitsArray;
    //         $.each(array, function(index, value) {
    //             $("#tabledataaa").append(index + ": " + value + '<br>');
    //         });
    //     });
    // });
    // $('.addItem').click(function(e) {
    //     var table = document.getElementById("tablecart");
    //     table.refresh();
    // });

    function displaystudent() {
        $.ajax({
            url: '<?= site_url('fetch-student') ?>',
            method: 'get',
            dataType: 'JSON',
            success: function(response) {
                $.each(response.allstudents, function(key, value) {
                    $('#tableData').append('<tr>\
					<td> ' + value['student_id'] + ' </td>\
					<td> ' + value['firstname'] + ' </td>\
					<td> ' + value['lastname'] + ' </td>\
					<td>\
						<a id="btn_edit" table-id=' + value['student_id'] + ' data-toggle="modal" data-target="#updateModal" class="btn btn-warning">Edit</a>\
					</td>\
					<td>\
						<a id="btn_delete" table-id=' + value['student_id'] + ' class="btn btn-danger">Delete</a>\
					</td>\
				</tr>');
                });
            }

        });

    }
</script>