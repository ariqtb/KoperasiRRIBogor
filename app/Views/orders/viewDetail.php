<head>
	<title><?= $title; ?></title>
</head>

<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<div class="row g-3 mb-3 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Detail Pembelian</h1>
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

			<?php
			foreach ($orders as $key => $value) {
				if ($value['id_pembelian'] == $id) {
					$orders = $value;
					break;
				}
			}
			?>

			<div class="app-card app-card-orders-table shadow-sm mb-5">
				<div class="app-card-body">
					<!--//app-card-header-->
					<div class="app-card-body px-4 w-100">
						<div class="item py-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<div class="item-label mb-2"><strong>Nama Pembeli</strong></div>
									<div class="item-data border-bottom"><?= $orders['nama_pembeli']; ?></div>
									<div class="item-data"><?= date('d M Y', strtotime($orders['tanggal_pembelian'])); ?></div>
									<span class="note"><?= $orders['waktu_pembelian']; ?></span>
								</div>
								<div class="col text-end">
								</div>
								<div class="col text-end">
									<a class="btn-sm app-btn-secondary" href="<?= base_url('Orders/itemToCart/' . $orders['id_pembelian']); ?>"><i class="fas fa-edit"></i>Ubah</a>
								</div>
							</div>
							<!--//row-->
						</div>
						<!--//item-->

						<div class="item border-bottom py-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table app-table-hover text-center" id="example1">
											<thead>
												<tr>
													<th class="cell">Nama Barang</th>
													<th class="cell">Harga Barang</th>
													<th class="cell">Jumlah Harga</th>
													<th class="cell">Subtotal Harga</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ($itemJual as $key => $value) :
													if ($value['id_order'] == $id) {
												?>
														<tr>
															<td class="cell"><?= $value['nama_item']; ?></td>
															<td class="cell"><?= $value['harga_item']; ?></td>
															<td class="cell"><?= $value['jumlah_item']; ?></td>
															<td class="cell"><?= $value['subtotal_harga']; ?></td>

														</tr>
												<?php }
												endforeach; ?>

											</tbody>
										</table>
									</div>
								</div>
								<!--//col-->
								<div class="col text-end">

								</div>
								<!--//col-->
							</div>
							<!--//row-->
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>