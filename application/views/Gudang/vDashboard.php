<div class="container-fluid py-4">

	<div class="row">
		<div class="col-xl-12 col-sm-12 mb-xl-0 mb-12">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8">
							<div class="numbers">
								<p class="text-sm mb-0 text-capitalize font-weight-bold">Selamat Datang,</p>
								<h5 class="font-weight-bolder mb-0">
									User
									<span class="text-success text-sm font-weight-bolder">Informasi Analisis Produk</span>
								</h5>
							</div>
						</div>
						<div class="col-4 text-end">
							<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
								<i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- Ringkasan Dashboard -->
	<div class="row mt-4">

		<!-- Total Produk -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow-sm border-0 h-100">
				<div class="card-body">
					<p class="text-muted mb-1">Total Produk</p>
					<h4 class="font-weight-bolder">
						<?= number_format($total_produk, 0, ',', '.'); ?>
					</h4>
					<span class="text-sm">Produk terdaftar</span>
				</div>
			</div>
		</div>

		<!-- Stok Menipis -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow-sm border-0 h-100">
				<div class="card-body">
					<p class="text-muted mb-1">Stok Menipis</p>
					<h4 class="font-weight-bolder text-danger">
						<?= number_format($stok_menipis, 0, ',', '.'); ?>
					</h4>
					<span class="text-sm">Stok 20 atau kurang</span>
				</div>
			</div>
		</div>

		<!-- MAPE Keseluruhan -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow-sm border-0 h-100">
				<div class="card-body">
					<p class="text-muted mb-1">MAPE Keseluruhan </p>

					<h4 class="font-weight-bolder">
						<?php if ($mape !== null) : ?>
							<?= number_format($mape, 2, ',', '.'); ?>%
						<?php else : ?>
							-
						<?php endif; ?>
					</h4>

					<span class="text-sm">
						Rata-rata kesalahan peramalan
					</span>
				</div>
			</div>
		</div>

		<!-- Peramalan Terbaru -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow-sm border-0 h-100">
				<div class="card-body">
					<p class="text-muted mb-1">Peramalan Terbaru</p>

					<?php if ($peramalan_terbaru) : ?>
						<h4 class="font-weight-bolder">
							<?= number_format(
								$peramalan_terbaru->dt_peramalan,
								0,
								',',
								'.'
							); ?>
						</h4>

						<span class="text-sm">
							<?= html_escape(
								$peramalan_terbaru->nama_produk
									?? 'Produk'
							); ?>
							<br>
							Periode:
							<?= html_escape($peramalan_terbaru->bulan); ?>/<?= html_escape($peramalan_terbaru->tahun); ?>
						</span>
					<?php else : ?>
						<h4>-</h4>
						<span class="text-sm">
							Belum ada data peramalan
						</span>
					<?php endif; ?>
				</div>
			</div>
		</div>

	</div>

	<!-- Grafik Aktual dan Peramalan -->
	<div class="card shadow-sm border-0 mb-4">
		<div class="card-header bg-white">
			<h6 class="mb-3">
				Grafik Permintaan Aktual dan Peramalan
			</h6>

			<div class="row">
				<div class="col-md-5 col-lg-4">
					<label for="pilihProduk" class="form-label">
						Pilih Produk
					</label>

					<select id="pilihProduk" class="form-control">
						<option value="">-- Pilih Produk --</option>

						<?php foreach ($produk as $p) : ?>
							<option value="<?= (int) $p->id_produk; ?>">
								<?= html_escape($p->nama_produk); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>

		<div class="card-body">
			<div style="position: relative; height: 350px;">
				<canvas id="grafikPermintaan"></canvas>
			</div>

			<p id="pesanGrafik" class="text-muted mt-3 mb-0">
				Pilih produk untuk menampilkan grafik.
			</p>

			<div class="mt-3">
				<span>MAPE produk terpilih: </span>
				<strong id="nilai_mape">-</strong>
			</div>
		</div>
	</div>

	<!-- Tabel Stok Menipis -->


</div>
