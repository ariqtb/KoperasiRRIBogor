<head>
	<title><?= $title; ?></title>
</head>
<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0"><?= $title; ?></h1>
					<span id='test'></span>
				</div>
			</div>

			<div class="row mb-3">
				<!-- <div class="col-auto">
					<div class="input-group">
						<select class="custom-select" name="month" id="month">
							<?php if (isset($_GET['month'])) {
							?>
								<option disabled selected value="<?= $_GET['month'] ?>"><?= $bulan; ?></option>
							<?php } else {  ?>
								<option selected value="">Bulan</option>
							<?php } ?>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
					</div>
				</div> -->
				<div class="col-auto">
					<div class="input-group mb-3">
						<select class="custom-select" name="year" id="year">
							<option disabled selected value="">Tahun</option>
							<?php if (isset($value['YEAR(tanggal_pembelian)'])) { ?>
								} else { ?>
								<option disabled selected value="">Tahun</option>
							<?php } ?>
							<?php foreach ($tahun as $value) :
							?>
								<option value="<?= $value['YEAR(tanggal_pembelian)'] ?>"><?= $value['YEAR(tanggal_pembelian)'] ?></option>
							<?php endforeach; ?>


						</select>
					</div>
				</div>
				<div class="col text-end">
					<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#input"><i class="fas fa-calendar"></i> Pilih Tanggal</a>
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
		<div class="modal fade show" id="input" tabindex="-1" aria-labelledby="inputlabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="inputlabel">Pilih Tanggal</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="<?= base_url('report/filterdata'); ?>" enctype="multipart/form-data">
						<?= csrf_field(); ?>
						<div class="modal-body">
							<div class="row row-space">
								<div class="row form-group">
									<div class="col">
										<label for="datefrom">
											<h6>Dari Tanggal</h6>
										</label>
									</div>
									<div class="col-md-8">
										<input type="date" class="form-control" name="datefrom" class="form-control" id="datefrom" value="<?= $datefrom; ?>" data-date-split-input="true">
									</div>
								</div>
								<div class="row form-group">
									<div class="col">
										<label for="dateto">
											<h6>Hingga Tanggal</h6>
										</label>
									</div>
									<div class="col-md-8">
										<input type="date" class="form-control" name="dateto" class="form-control" id="dateto" value="<?= $dateto; ?>" data-date-split-input="true">
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
													$("#input").modal('show');
												});
											</script>
										<?php } ?>
									</div>
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button class="btn btn-primary" value="submit" id="rangedate" type="submit">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="card shadow-sm mb-5">
			<div class="card-body">
				<?php if ($datefrom or $dateto) {  ?>
					<div class="mb-3">
						<span><b>Rentang waktu : </b><?= date('d M Y', strtotime($datefrom)); ?> - </span><span> <?= date('d M Y', strtotime($dateto)); ?></span>
						<a class="btn btn-warning" href="<?= base_url('Report'); ?>"><i class="fas fa-sync"></i></a>
					</div>
				<?php } ?>
				<?php if (isset($_GET['year'])) {  ?>
					<div class="mb-3">
						<span><b>Laporan Tahun : </b><?= $curDate = $_GET['year']; ?></span>
						<a class="btn btn-warning" href="<?= base_url('Report'); ?>"><i class="fas fa-sync"></i></a>
					</div>
				<?php } else { ?>
					<?php $curDate = date("Y"); ?>
				<?php } ?>
				<?php if (!isset($_GET['year'])) { ?>
					<div class="table-responsive table-scroll">
						<table class="table table-hover mb-0 text-center" id="table3">
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
												<a class=" btn-sm btn-danger confirmation" href="<?= base_url('report/deleteAll/' . $report['id_pembeli']); ?>"><i class="fas fa-trash"></i></a>
											</td>
										</tr>
								<?php }
								endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php } else { ?>
					<div class="table-responsive table-scroll">
						<table class="table table-hover mb-0 text-center" id="table3">
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
												<a class=" btn-sm btn-danger confirmation" href="<?= base_url('report/deleteAll/' . $report['id_pembeli']); ?>"><i class="fas fa-trash"></i></a>
											</td>
										</tr>
								<?php }
								endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script>
	$("#table3").DataTable({
		dom: 'Bfrtip',
		"buttons": ['pageLength', 'copy',
			{
				'extend': 'excel',
				'text': 'Excel',
				'title': '<?= $title; ?>',
			},
			{
				'extend': 'pdf',
				'text': 'PDF',
				'exportOptions': {
					columns: [0, 1, 2, 3]
				},
				'customize': function(doc) {
					doc.styles.tableBodyEven.alignment = 'center';
					doc.styles.tableBodyOdd.alignment = 'center';
					doc.content[1].table.widths =
						Array(doc.content[1].table.body[0].length + 1).join('*').split('');
				},
				'title': '<?= $title; ?>',
			},
			{
				'extend': 'print',
				'text': 'Print',
				'exportOptions': {
					columns: [0, 1, 2, 3]
				},
				'customize': function(doc) {
					doc.styles.tableBodyEven.alignment = 'center';
					doc.styles.tableBodyOdd.alignment = 'center';
				},
				'title': '<?= $title; ?>',
			}

		],
		"responsive": true,
		"search": true,
		"paging": true,
		"order": [
			[0, "desc"]
		],
		"info": true,
		"lengthMenu": [
			[5, 10, 20, -1],
			[5, 10, 20, "All"]
		],
		"lengthChange": true,
		"autoWidth": false
	});

	var today = moment().format('YYYY/MM/DD');
	$('#datefilterfrom').val(today);

	$('#year').change(function() {
		var testing = $('#test').val();
		$.ajax({
			url: "<?php echo base_url("Report/test"); ?>",
			headers: {
				'X-Requested-With': 'XMLHttpRequest'
			},
			type: "POST",
			cache: false,
			data: {
				testing: $(this).val(),
			},
			success: function(data) {
				//alert(data);
				$('#test').text(data);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" +
					thrownError);
			}
		});
	});

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

	$(document).ready(function() {
		$("#month").change(function() {
			var selected_month = $(this).val();
			location.href = "<?= base_url('report/'); ?>?month=" + selected_month;
			$.ajax({
				type: 'post',
				url: "<?= base_url('Report/filterByYear') ?>",
				data: {
					'month': selected_month,
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
		$("#year").change(function() {
			var year = $(this).val();
			location.href = "<?= base_url('report/'); ?>?year=" + year;
		});
		$("#rangedate").click(function() {
			var datefrom = $('#datefrom').val();
			var dateto = $('#dateto').val();
			location.href = "<?= base_url('report/'); ?>?datefrom=" + datefrom + "?dateto=" + dateto;
		});
	});
</script>