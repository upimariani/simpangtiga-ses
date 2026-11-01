<footer class="footer pt-3  ">
	<div class="container-fluid">
		<div class="row align-items-center justify-content-lg-between">
			<div class="col-lg-6 mb-lg-0 mb-4">
				<div class="copyright text-center text-sm text-muted text-lg-start">
					© <script>
						document.write(new Date().getFullYear())
					</script>,
					made with <i class="fa fa-heart"></i> by
					<a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Toko Simpang Tiga Cigugur</a>
					for a better web.
				</div>
			</div>
			<div class="col-lg-6">
				<ul class="nav nav-footer justify-content-center justify-content-lg-end">
					<li class="nav-item">
						<a href="<?= base_url('Pemilik/cDashboard') ?>" class="nav-link text-muted" target="_blank">Dashboard</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('Pemilik/cPermintaan') ?>" class="nav-link text-muted" target="_blank">Permintaan Produk</a>
					</li>

					<li class="nav-item">
						<a href="<?= base_url('Pemilik/cPeramalan') ?>" class="nav-link pe-0 text-muted" target="_blank">Peramalan</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>
</div>
</main>

<!--   Core JS Files   -->
<script src="<?= base_url('asset/') ?>jquery.min.js"></script>
<script src="<?= base_url('asset/soft-ui-dashboard/') ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url('asset/soft-ui-dashboard/') ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url('asset/soft-ui-dashboard/') ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url('asset/soft-ui-dashboard/') ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {

		const selectProduk = document.getElementById('pilihProduk');
		const canvas = document.getElementById('grafikPermintaan');
		const pesanGrafik = document.getElementById('pesanGrafik');
		const nilaiMape = document.getElementById('nilai_mape');

		let grafik = null;

		async function tampilkanGrafik(idProduk) {

			if (grafik) {
				grafik.destroy();
				grafik = null;
			}

			nilaiMape.textContent = '-';

			if (!idProduk) {
				pesanGrafik.textContent = 'Silakan pilih produk.';
				return;
			}

			pesanGrafik.textContent = 'Memuat data grafik...';

			try {
				const url = '<?= site_url("Gudang/cDashboard/data_grafik"); ?>' +
					'?id_produk=' + encodeURIComponent(idProduk);

				const response = await fetch(url);

				if (!response.ok) {
					throw new Error('HTTP ' + response.status);
				}

				const data = await response.json();

				console.log('Respons grafik:', data);

				if (!data.labels || data.labels.length === 0) {
					pesanGrafik.textContent =
						'Belum ada data peramalan untuk produk ini.';
					return;
				}

				grafik = new Chart(canvas, {
					type: 'line',

					data: {
						labels: data.labels,

						datasets: [{
								label: 'Permintaan Aktual',
								data: data.aktual,
								borderColor: '#d63384',
								backgroundColor: 'rgba(214, 51, 132, 0.12)',
								borderWidth: 2,
								pointRadius: 4,
								tension: 0.3
							},
							{
								label: 'Hasil Peramalan SES',
								data: data.peramalan,
								borderColor: '#0d6efd',
								backgroundColor: 'rgba(13, 110, 253, 0.12)',
								borderWidth: 2,
								pointRadius: 4,
								tension: 0.3
							}
						]
					},

					options: {
						responsive: true,
						maintainAspectRatio: false,

						interaction: {
							intersect: false,
							mode: 'index'
						},

						plugins: {
							legend: {
								display: true,
								position: 'top'
							}
						},

						scales: {
							y: {
								beginAtZero: true,
								title: {
									display: true,
									text: 'Jumlah Permintaan'
								}
							},

							x: {
								title: {
									display: true,
									text: 'Periode Bulan'
								}
							}
						}
					}
				});

				pesanGrafik.textContent = '';

				nilaiMape.textContent =
					data.mape !== null && data.mape !== undefined ?
					Number(data.mape).toLocaleString('id-ID', {
						minimumFractionDigits: 2,
						maximumFractionDigits: 2
					}) + '%' :
					'Belum tersedia';

			} catch (error) {
				console.error('Gagal menampilkan grafik:', error);

				pesanGrafik.textContent =
					'Grafik gagal dimuat. Periksa Console browser dan controller.';
			}
		}

		selectProduk.addEventListener('change', function() {
			tampilkanGrafik(this.value);
		});

		// Otomatis pilih produk pertama jika tersedia
		if (selectProduk.options.length > 1) {
			selectProduk.selectedIndex = 1;
			tampilkanGrafik(selectProduk.value);
		}

	});
</script>
<script>
	var win = navigator.platform.indexOf('Win') > -1;
	if (win && document.querySelector('#sidenav-scrollbar')) {
		var options = {
			damping: '0.5'
		}
		Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
	}
</script>
<script>
	var win = navigator.platform.indexOf('Win') > -1;
	if (win && document.querySelector('#sidenav-scrollbar')) {
		var options = {
			damping: '0.5'
		}
		Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
	}
</script>
<link href="<?= base_url('asset/') ?>datatables/datatables.min.css" rel="stylesheet">

<script src="<?= base_url('asset/') ?>datatables/datatables.min.js"></script>

<script>
	$('#myTable').DataTable({
		select: true
	});
</script>
<script>
	console.log = function() {}
	$("#produk").on('change', function() {

		$(".nama").html($(this).find(':selected').attr('data-nama'));
		$(".nama").val($(this).find(':selected').attr('data-nama'));

		$(".harga").html($(this).find(':selected').attr('data-harga'));
		$(".harga").val($(this).find(':selected').attr('data-harga'));

		$(".keterangan").html($(this).find(':selected').attr('data-keterangan'));
		$(".keterangan").val($(this).find(':selected').attr('data-keterangan'));

	});
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url('asset/soft-ui-dashboard/') ?>assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
