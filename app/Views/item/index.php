<head>
	<title><?= $title; ?></title>
</head>


<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Daftar Barang</h1>
					<?php
					if (session()->getFlashdata('errors')) {
						echo '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo session()->getFlashdata('errors');
						echo '</div>';
					} ?>
				</div>
				<div class="col-auto">
					<div class="page-utilities">

						<!--//row-->
					</div>
					<!--//table-utilities-->
				</div>
				<!--//col-auto-->
			</div>
			<!--//row-->
			<div class="row mb-3">
				<div class="col-auto">
					<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#input"><i class="fas fa-download"></i> Input Data</a>
				</div>
				<!-- <div class="col text-end">
					<a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#kategori"><i class="fa fa-list"></i> Tambah Kategori</a>
				</div> -->
			</div>
			<div class="row d-flex justify-content-between">
				<div class="col-md-12">
					<?php
					if (session()->getFlashdata('pesan')) {
						echo '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo session()->getFlashdata('pesan');
						echo '</div>';
					}
					?>

					<div class="card shadow-sm mb-5">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-sm table-hover text-left" id="table">
									<thead>
										<tr class="">
											<th class="cell">No.</th>
											<th class="cell">Nama</th>
											<!-- <th class="cell">Kode</th> -->
											<th class="cell">Gambar</th>
											<th class="cell">Harga</th>
											<th class="cell">Stok</th>
											<th class="cell">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 0;
										foreach ($item as $key => $items) :
										?>
											<tr class="">
												<td class="cell"><?= $i; ?></td>
												<td class="cell"><?= $items['nama_item']; ?></td>
												<!-- <td class="cell"><?= $items['kode_item']; ?></td> -->
												<td class="cell"><img src="<?= base_url('assets/images/upload/' . $items['foto_item']); ?>" style="width: 4rem; height: 4rem; object-fit:cover;"></td>
												<td class="cell">Rp. <?= number_format($items['harga_item'], 2, ',', '.'); ?></td>
												<td class="cell" <?php if ($items['stok_item'] == 0) echo 'style="color: red;"'; ?>><?= $items['stok_item']; ?></td>
												<td class="cell p-1">
													<a class=" btn-sm app-btn-secondary openmodaledit" data-id="<?= $items['id_item'] ?>" href="<?= base_url('item/viewedit/' . $items['id_item']); ?>"><i class="fas fa-edit"></i></a>
													<a class=" btn-sm btn-danger confirmation" href="<?= base_url('item/delete/' . $items['id_item']); ?>"><i class="fas fa-trash"></i></a>
												</td>
											</tr>

											<?php $i++; ?>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- End Cart -->
				</div>
			</div>
			<!-- End Row -->
		</div>
		<!--//container-fluid-->
	</div>
</div>
<!--//app-content-->
<script>
	// $(document).ready(function(){
	//     $("#input").modal('show');
	// });
</script>
<div class="modal fade show" id="input" tabindex="-1" aria-labelledby="inputlabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="inputlabel">Input Barang</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="<?= base_url('Item/create'); ?>" enctype="multipart/form-data">
				<?= csrf_field(); ?>
				<div class="modal-body">
					<div class="row row-space">
						<div class="row form-group">
							<div class="col">
								<label for="nama">
									<h6>Nama Barang</h6>
								</label>
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control" name="nama" id="nama">
							</div>
						</div>
						<!-- <div class="row form-group">
							<div class="col">
								<label for="kode">
									<h6>Kode Barang</h6>
								</label>
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control" name="kode" id="kode">
							</div>
						</div> -->
						<div class="row form-group">
							<div class="col">
								<label class="label">
									<h6>Stok</h6>
								</label>
							</div>
							<div class="col-lg-8">
								<input class="form-control" type="number" min="1" step="any" id="stok" name="stok">
							</div>
						</div>
						<div class="row form-group">
							<div class="col">
								<label class="label">
									<h6>Harga</h6>
								</label>
							</div>
							<div class="col-lg-8">
								<input class="form-control" type="number" min="1" step="any" id="harga" name="harga">
							</div>
						</div>
						<div class=" row form-group">
							<div class="col">
								<label for="gambar">
									<h6>Gambar</h6>
								</label>
							</div>
							<div class="col-md-8">
								<input type="file" class="form-control" name="gambar" id="gambar" onchange="readURL(this);">
							</div>
						</div>
						<div class="text-center justify-content-center">
							<div class="p-t-15">
								<img id="preview" src="#" alt="preview" style="width: 150px; height: auto;" />
							</div>
						</div>
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
					<button class="btn btn-primary" value="submit" type="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade show" id="input2" tabindex="-1" aria-labelledby="inputlabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="inputlabel">Input Barang</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" action="<?= base_url('Item/create'); ?>" enctype="multipart/form-data">
				<?= csrf_field(); ?>
				<div class="modal-body">
					<div class="row row-space">
						<div class="row form-group">
							<div class="col">
								<label for="nama">
									<h6>Nama Barang</h6>
								</label>
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control" name="nama" id="nama">
							</div>
						</div>
						<!-- <div class="row form-group">
							<div class="col">
								<label for="kode">
									<h6>Kode Barang</h6>
								</label>
							</div>
							<div class="col-md-8">
								<input hidden type="text" class="form-control" name="kode" id="kode">
							</div>
						</div> -->
						<div class="row form-group">
							<div class="col">
								<label class="label">
									<h6>Stok</h6>
								</label>
							</div>
							<div class="col-lg-8">
								<input class="form-control" type="number" min="1" step="any" id="stok" name="stok">
							</div>
						</div>
						<div class="row form-group">
							<div class="col">
								<label class="label">
									<h6>Harga</h6>
								</label>
							</div>
							<div class="col-lg-8">
								<input class="form-control" type="number" min="1" step="any" id="harga" name="harga">
							</div>
						</div>
						<div class=" row form-group">
							<div class="col">
								<label for="gambar">
									<h6>Gambar</h6>
								</label>
							</div>
							<div class="col-md-8">
								<input type="file" class="form-control" name="gambar" id="gambar" onchange="readURL(this);">
							</div>
						</div>
						<div class="text-center justify-content-center">
							<div class="p-t-15">
								<img id="preview" src="#" alt="preview" style="width: 150px; height: auto;" />
							</div>
						</div>
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
					<button class="btn btn-primary" value="submit" type="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	var elems = document.getElementsByClassName('confirmation');
	var confirmIt = function(e) {
		if (!confirm('Apakah anda yakin ingin menghapus data?')) e.preventDefault();
	};
	for (var i = 0, l = elems.length; i < l; i++) {
		elems[i].addEventListener('click', confirmIt, false);
	}


	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#preview').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	$('.example1').on('click', function() {
		$.alert({
			title: 'Alert!',
			content: 'Simple alert!',
			useBootstrap: false,
		});
	});

	$(document).on("click", ".openmodaledit", function() {
		$(".modal-body #nama").val(idItem);
		// As pointed out in comments,
		// it is unnecessary to have to manually call the modal.
		// $('#addBookDialog').modal('show');
	});
</script>