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


			<div class="tab-content" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="row ">
						<div class="col mb-3">
							<!-- <a class="btn btn-primary" href="<?= base_url('orders/inputData'); ?>"><i class="fas fa-download"></i> Input Data</a> -->
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
							<div class="table-responsive">
								<table class="table table-bordered app-table-hover mb-0 text-left datatable" id="table3">
									<thead>
										<tr>
											<th class="cell">Order ID</th>
											<th class="cell">Nama Pembeli
												<?php echo ($sort_by == 'name' ? 'class="sort_' . $sort_order . '"' : ''); ?>
											</th>
											<th class="cell">Jumlah Barang</th>
											<th class="cell">Total Harga</th>
											<th class="cell">Tanggal</th>
											<!-- <th class="cell">Penanggung Jawab</th> -->
											<th class="cell"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($orders as $order) : ?>
											<tr>
												<td class="cell"><?= $order['id_pembelian']; ?></td>
												<td class="cell"><?= $order['nama_pembeli']; ?></td>
												<td class="cell"><?= $order['total_item']; ?></td>
												<td class="cell">Rp.
													<?= number_format($order['total_harga'], 2, ',', '.'); ?></td>
												<td class="cell">
													<span><?= date('d M Y', strtotime($order['tanggal_pembelian'])); ?></span>
												</td>
												<!-- <td class="cell"><?= $order['penanggung_jawab']; ?></td> -->
												<td class="cell">
													<a class="btn-sm btn-secondary" href="<?= base_url('orders/viewDetail/' . $order['id_pembelian']); ?>" id="modalView">Detail</a>
													<a class=" btn-sm app-btn-secondary" href="<?= base_url('orders/itemToCart/' . $order['id_pembelian']); ?>"><i class="fas fa-edit"></i></a>
													<a class=" btn-sm btn-danger confirmation" href="<?= base_url('orders/deleteOrder/' . $order['id_pembelian']); ?>"><i class="fas fa-trash"></i></a>
												</td>

												<!-- <td class="cell"><span class="badge bg-success">Paid</span></td> -->
											</tr>
										<?php endforeach; ?>

									</tbody>
								</table>
							</div>
							<!--//table-responsive-->

						</div>
						<!--//app-card-body-->
					</div>
					<!--//app-card-->

				</div>
				<!--//tab-pane-->
			</div>
			<!--//container-fluid-->
		</div>
		<!--//app-content-->

		<script>
			var elems = document.getElementsByClassName('confirmation');
			var confirmIt = function(e) {
				if (!confirm('Apakah anda yakin ingin menghapus data?')) e.preventDefault();
			};
			for (var i = 0, l = elems.length; i < l; i++) {
				elems[i].addEventListener('click', confirmIt, false);
			}


			$("#table3").DataTable({
				dom: 'Bfrtip',
				"buttons": ['pageLength',
					{
						'extend': 'copy',
						'text': 'Copy',
						'exportOptions': {
							columns: [0, 1, 2, 3, 4, 5]
						},
						'title': '<?= $title; ?>',
					},
					{
						'extend': 'excel',
						'text': 'Excel',
						'exportOptions': {
							columns: [0, 1, 2, 3, 4, 5]
						},
						'title': '<?= $title; ?>',
					},
					{
						'extend': 'pdf',
						'text': 'PDF',
						'exportOptions': {
							columns: [0, 1, 2, 3, 4, 5]
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
							columns: [0, 1, 2, 3, 4, 5]
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
		</script>