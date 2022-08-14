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

			<div class="row mb-3">

				<div class="col-auto">
					<a class="btn btn-primary" href="<?= base_url('report/toExcel'); ?>"><i class="fas fa-file-excel"></i> Download Excel</a>
				</div>
				<div class="col-auto">
					<a class="btn btn-primary" href="<?= base_url('report/toPDF'); ?>"><i class="fas fa-file-pdf"></i> Download PDF</a>
				</div>
				<div class="col">
					<div class="input-group">
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
				</div>
				<div class="col">
					<form id="form_filter" name="form_filter">
						<div class="input-group mb-3">
							<input type="number" class="form-control" placeholder="Tahun" name="year" id="year">
							<div class="input-group-prepend">
								<button class="btn btn-outline-secondary" type="submit">Button</button>
							</div>
						</div>
					</form>
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

		<div class="card shadow-sm mb-5">
			<div class="card-body">
				<form method="post" action="<?= base_url('report/pertahun'); ?>" enctype="multipart/form-data">
					<?= csrf_field(); ?>
					<div class="row items-align-center">
						<div class="row form-group">
							<div class="col-auto">
								<label for="nama">
									<p>Date from</p>
								</label>
							</div>
							<div class="col-md-3">
								<input type="date" class="form-control" name="datefrom" class="form-control" id="datefilterfrom" value="<?= $datefrom; ?>" data-date-split-input="true">
							</div>
							<div class="col-auto">
								<label class="label">
									<p>Date to</p>
								</label>
							</div>
							<div class="col-md-3">
								<input type="date" class="form-control" name="dateto" class="form-control" id="datefilterto" value="<?= $dateto; ?>" data-date-split-input="true">
							</div>
							<div class="col p-t-15">
								<button class="btn btn-success" value="submit" type="submit"><i class="fas fa-search"></i></button>
								<a class="btn btn-warning" href="<?= base_url('Report/pertahun'); ?>"><i class="fas fa-sync"></i></a>
							</div>
						</div>
					</div>
				</form>

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

<script>
	var today = moment().format('YYYY/MM/DD');
	$('#datefilterfrom').val(today);

	$(document).ready(function() {
		$('#tabel_data').DataTable({
			dom: 'Bfrtip',
			lengthMenu: [
				[5, 10, 25, -1],
				['10 rows', '25 rows', '50 rows', 'Show all']
			],
			buttons: [
				'pageLength', 'copy', 'excel', 'pdf', 'print'
			]
		});
	});
</script>


<script>
	jQuery(".dropdown-item").on("click", function() {
		jQuery(this).attr("aria-selected", "true");
		jQuery(this).addClass("active");
		jQuery(".dropdown-item").not(this).attr("aria-selected", "false");
		jQuery(".dropdown-item").not(this).removeClass("active");
	})
</script>
<script>
	var elems = document.getElementsByClassName('confirmation');
	var confirmIt = function(e) {
		if (!confirm('Apakah anda yakin ingin menghapus riwayat pembelian anggota?')) e.preventDefault();
		if (!confirm('Apakah anda yakin?')) e.preventDefault();
	};
	for (var i = 0, l = elems.length; i < l; i++) {
		elems[i].addEventListener('click', confirmIt, false);
	}

	function filterRows() {
		var from = $('#datefilterfrom').val();
		var to = $('#datefilterto').val();

		if (!from && !to) { // no value for from and to
			return;
		}

		from = from || '1970-01-01'; // default from to a old date if it is not set
		to = to || '2999-12-31';

		var dateFrom = moment(from);
		var dateTo = moment(to);

		$('#table2 tr').each(function(i, tr) {
			var val = $(tr).find("td:nth-child(3)").text();
			var dateVal = moment(val, "DD/MM/YYYY");
			var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
			$(tr).css('display', visible);
		});
	}

	$('#datefilterfrom').on("change", filterRows);
	$('#datefilterto').on("change", filterRows);
</script>
<script>
	// reloadTable()

	// function reloadTable() {
	// 	var year = $('year').val();
	// 	$.ajax({
	// 		url: <?= base_url('report/filterByYear'); ?>,
	// 		type: 'post',
	// 		dataType: 'json',
	// 		headers: {
	// 			'X-Requested-With': 'XMLHttpRequest'
	// 		},
	// 		data: {
	// 			query: query
	// 		},
	// 		success: function(data) {
	// 			alert(data);
	// 		}
	// 	})
	// };

	$(document).ready(function() {
		$("#month").change(function() {
			var selected_month = $(this).val();
			location.href = "<?= base_url('report/pertahun'); ?>?month=" + selected_month;
			$.ajax({
				type: 'post',
				url: "<?= base_url('Report/filterByYear') ?>",
				data: {
					'month' : selected_month,
				},
				success: function(data) {
					var hasil = JSON.parse(data);
					alert(hasil);
					//alert(Fmonth);
				},
				error: function(data) {
					alert('Failed');
				}
			});
		});
	});

	function reloadMonth(month) {
		//console.log(month);
		location.href = "<?= base_url('report/pertahun'); ?>?month=" + month;
	}
</script>