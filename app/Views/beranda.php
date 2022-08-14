<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= $title; ?></title>
</head>

<body>
	<?php foreach ($admin as $key => $data) {
		if ($data['username'] == $logged_in['username']) {
			$admindata = $data;
			break;
		}
	} ?>
	<div class="app-wrapper">

		<div class="app-content pt-3 p-md-3 p-lg-4">
			<div class="container-xl border-bottom">
				<h1 class="app-page-title"><?= $title; ?></h1>
				<div class="border-bottom mb-3"></div>
			</div>
			<div class="row g-4 mb-4">

				<div class="col-2">
					<div class="app-card app-card-stat shadow-sm contenthover border-left-decoration mb-4">
						<div class="card-body">
							<p class="card-title mb-3">Barang</p>
							<h5 class="stats-figure mb-4"><?= $tot_item; ?></h5>
							<div class="stats-meta">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-collection" viewBox="0 0 16 16">
									<path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z" />
								</svg>
							</div>
						</div>
						<!--//app-card-body-->
						<a class="app-card-link-mask" href="#"></a>
					</div>

					<div class="app-card app-card-stat shadow-sm contenthover border-left-decoration">
						<div class="card-body">
							<p class="card-title mb-3">Anggota</p>
							<h5 class="stats-figure mb-4"><?= $tot_pembeli; ?></h5>
							<div class="stats-meta">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
									<path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
								</svg>
							</div>
						</div>
						<a class="app-card-link-mask" href="#"></a>
					</div>
				</div>


				<!-- //col-->
				<div class="col-2">
					<div class="app-card app-card-stat shadow-sm contenthover border-left-decoration mb-4">
						<div class="card-body">
							<p class="card-title mb-3">Pembelian</p>
							<h5 class="stats-figure mb-4"><?= $tot_pembelian; ?></h5>
							<div class="stats-meta">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
									<path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z" />
									<path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
								</svg>
							</div>
						</div>
						<a class="app-card-link-mask" href="#"></a>
					</div>

					<div class="app-card app-card-stat shadow-sm contenthover border-left-decoration">
						<div class="card-body">
							<p class="card-title mb-3">Item Terjual</p>
							<h5 class="stats-figure mb-4"><?= $tot_sold[0]['total_item']; ?></h5>
							<div class="stats-meta">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
									<path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
									<path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
								</svg>
							</div>
						</div>
						<a class="app-card-link-mask" href="#"></a>
					</div>
				</div>
				<!--//col -->
				<div class="col-8">
					<div class="app-card shadow-sm ">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Diagram Pendapatan Koperasi <?= date("Y") ?></h4>
								</div>
							</div>
						</div>
						<div class="app-card-header p-3">
							<div>
								<canvas style="position: relative; height:63vh; width:80vw" id="chart_pemasukan"></canvas>
							</div>
						</div>
					</div>
				</div>

			</div>


			<div class="row mb-4">
				<?php
				$nontrans = 0;
				$nonitemsold = 0;
				foreach ($pembelian as $nonrowtrans) {
					if ($nonrowtrans['id_pembeli'] == 0) {
						$nonitemsold += $nonrowtrans['total_item'];
						$nontrans++;
					}
				}
				$nontrans_percent = $nontrans / count($pembelian) * 100;
				$nonitemsold_percent = $nonitemsold / $tot_sold[0]['total_item'] * 100;
				?>
				<div class="col">
					<div class="app-card alert alert-dismissible shadow-sm mb-2 contenthover border-left-decoration" role="alert">
						<div class="inner">
							<div class="app-card-body">
								<div class="container text-center">
									<div class="app-card-header p-1">
										<div class="row">
											<div class="col">
												<p class="card-title">Pembelian Non-Anggota</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Transaksi</p>
											<h5 class="stats-figure"><?= number_format($nontrans_percent, 2, ',', ' '); ?>% (<?= $nontrans; ?>)</h5>
										</div>
										<div class="col">
											<p>Item Terjual</p>
											<h5><?= number_format($nonitemsold_percent, 2, ',', ' '); ?>% (<?= $nonitemsold; ?>)</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				$trans = 0;
				$itemsold = 0;
				$itemsold2 = 0;
				foreach ($pembelian as $rowtrans) {
					if ($rowtrans['id_pembeli'] != 0) {
						$itemsold += $rowtrans['total_item'];
						$trans++;
					}
					// $itemsold2 += $rowtrans['total_item'];
				}
				$trans_percent = $trans / count($pembelian) * 100;
				$itemsold_percent = $itemsold / $tot_sold[0]['total_item'] * 100;
				// return print_r($itemsold2);
				?>
				<div class="col">
					<div class="app-card alert alert-dismissible shadow-sm mb-2 contenthover border-left-decoration" role="alert">
						<div class="inner">
							<div class="app-card-body">
								<div class="container text-center">
									<div class="app-card-header p-1">
										<div class="row">
											<div class="col">
												<p class="card-title">Pembelian Anggota</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Transaksi</p>
											<h5 class="stats-figure"><?= number_format($trans_percent, 2, ',', ' '); ?>% (<?= $trans; ?>)</h5>
										</div>
										<div class="col">
											<p>Item Terjual</p>
											<h5><?= number_format($itemsold_percent, 2, ',', ' '); ?>% (<?= $itemsold; ?>)</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--//row-->
			<?php
			$db = db_connect();
			foreach ($item as $key => $value) :
				$items[] = $value['nama_item'];
				$sql = $db->query("SELECT SUM(jumlah_item) AS jumlah_item, nama_item FROM tbl_jual WHERE id_item='" . $value['id_item'] . "'");
				$hasil = $sql->getResultArray();

				foreach ($hasil as $k => $val) {
					if (!$val['nama_item'] && !$val['jumlah_item']) {
						continue;
					}
					$arr[] = $val;
					// $jumlah[] = $val;
				}
			endforeach;
			$totalitem = array_column($arr, 'jumlah_item');
			$arr_totalitem = array_multisort($totalitem, SORT_DESC, $arr);
			foreach ($arr as $key => $val) {
				$jumlah[] = $val['jumlah_item'];
				$namaItems[] = $val['nama_item'];
			}

			foreach ($itemPerMonth as $val) {
				$bulan[] = bulanan($val['bulan']);
				$jumlah_pembelian[] = $val['jumlah_pembelian'];
			}
			foreach ($transaksiperbulan as $val) {
				$jumlah_transaksi[] = $val['jumlah_transaksi'];
			}
			foreach ($pemasukanperbulan as $val) {
				$jumlah_pemasukan[] = $val['total_harga'];
			}
			// print_r(json_encode($jumlah_pemasukan));
			?>
			<script>
				var pemasukan = <?= json_encode($jumlah_pemasukan) ?>;
				var arr = [];
				for (var i = 0; i < pemasukan.length; i++) {
					var test = numeral(pemasukan[i]).format('0,0');

					arr.push(test);
				}
				// document.write(arr);
			</script>
			<div class="row g-4 mb-4">

				<div class="col-12 col-md-8">
					<div class="app-card app-card-chart h-100 shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="col-auto">
									<h4 class="app-card-title">Diagram Penjualan Barang Koperasi Tahun <?= date("Y") ?></h4>
								</div>
							</div>
						</div>
						<div class="app-card-body p-3 p-lg-4">
							<div class="chart-container">
								<canvas id="chartitem"></canvas>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 col-lg-4">
					<div class="app-card app-card-stats-table h-100 shadow-sm">
						<div class="app-card-header p-3">
							<div class="row justify-content-between align-items-center">
								<div class="alert alert-success" style="display:none;">
									<strong>Success!</strong> <span id="success"></span>
								</div>
								<div class="col">
									<h4 class="app-card-title">Penjualan Barang <?= date("Y") ?></h4>
								</div>
								<div class="col-auto">
									<select class="custom-select" name="month" id="month">
										<?php if (isset($_GET['month'])) { ?>
											<option selected disabled value="<?= $_GET['month'] ?>"><?= bulanan($_GET['month']) ?></option>
											<option value="<?= date("Y") ?>"><?= date("Y") ?></option>
										<?php } else { ?>
											<option selected value="2022">2022</option>
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
							</div>
						</div>
						<div class="app-card-body p-3 p-lg-4">
							<div class="table-responsive" style="overflow-y: scroll; height:20rem;">
								<table class="table app-table-hover mb-0">
									<thead class="table-dark">
										<tr>
											<th class="cell">ID</th>
											<th class="cell">Barang</th>
											<th class="cell">Jumlah</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($totalperitem as $val) : ?>
											<!-- <tr style="cursor: pointer;" onclick="window.location='<?= base_url('orders/viewDetail/' . $val['id_item']) ?>'"> -->
											<tr>
												<td class=""><?= $val['id_item']; ?></td>
												<td class="cell"><?= $val['nama_item']; ?></td>
												<td class="cell"><?= $val['jumlah_item']; ?></td>
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
	</div>
	</div>
	<script src="<?= base_url('assets/vendor/jquery/jquery.js') ?>"></script>
	<script>
		// $('.carousel').carousel()
		// const labels = <?php echo json_encode($namaItems); ?>;

		var letters = '0123456789ABCDEF'.split('');
		var color = '#1e325a';
		var color2 = '#0085ae';
		var color3 = '#FCD900';
		// for (var i = 0; i < 6; i++) {
		// 	color += letters[Math.floor(Math.random() * 16)];
		// }


		const labels = [
			<?php foreach ($bulan as $val) : ?> '<?= $val ?>',
			<?php endforeach; ?>

		];
		const data = {
			labels: labels,
			datasets: [{
					label: 'Barang Terjual',
					fill: false,
					backgroundColor: color,
					borderColor: color,
					tension: 0.1,
					data: <?php echo json_encode($jumlah_pembelian); ?>,
				},
				{
					label: 'Transaksi',
					fill: false,
					backgroundColor: color2,
					borderColor: color2,
					tension: 0.1,
					data: <?php echo json_encode($jumlah_transaksi); ?>,
				},
			]
		};

		const config = {
			type: 'bar',
			data: data,
			options: {
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				responsive: true,
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Bulan'
						}
					}],
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Jumlah'
						}
					}]
				}
			}
		};

		const myChart = new Chart(
			document.getElementById('chartitem'),
			config
		);

		var chart_pemasukan_config = {
			type: 'line',


			data: {
				labels: labels,

				datasets: [{
					label: 'Jumlah Pendapatan',
					fill: false,
					backgroundColor: color2,
					borderColor: color2,
					tension: 0.1,
					pointStyle: 'circle',
					pointRadius: 4,
					pointHoverRadius: 12,
					data: <?php echo json_encode($jumlah_pemasukan); ?>,
				}]
			},
			options: {
				tooltips: {
					mode: 'index',
					intersect: false,
					callbacks: {
						label: function(t, d) {
							var xLabel = d.datasets[t.datasetIndex].label;
							var yLabel = t.yLabel >= 1000 ? 'Rp ' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : 'Rp ' + t.yLabel;
							return xLabel + ': ' + yLabel;
						}
					}
				},
				responsive: true,
				scales: {
					xAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Bulan'
						}
					}],
					yAxes: [{
						ticks: {
							callback: function(value, index, values) {
								if (parseInt(value) >= 1000) {
									return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
								} else {
									return 'Rp ' + value;
								}
							}
						},
						scaleLabel: {
							display: true,
							labelString: 'Jumlah'
						}
					}]
				}
			}
		};

		window.addEventListener('load', function() {

			var lineChartIncome = document.getElementById('chart_pemasukan').getContext('2d');
			window.myLine = new Chart(lineChartIncome, chart_pemasukan_config);

		});

		$('.count').each(function() {
			$(this).prop('Counter', 0).animate({
				Counter: $(this).text()
			}, {
				duration: 4000,
				easing: 'swing',
				step: function(now) {
					$(this).text(Math.ceil(now));
				}
			});
		});

		$(document).ready(function() {
			$("#month").change(function() {
				var selected_month = $(this).val();
				location.href = "<?= base_url('home/'); ?>?month=" + selected_month;
				$.ajax({
					url: '<?= base_url() ?>home/tabel_item_ajax/' + selected_month,
					type: 'get',
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					},
					data: {
						month: selected_month,
					},
					success: function(response) {
						document.write(response);
					},

				});
			});
		});
	</script>



</body>

</html>