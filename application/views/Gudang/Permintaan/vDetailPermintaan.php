<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Invoice Permintaan Produk</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<style>
		body {
			background: #f5f6fa;
			color: #344767;
		}

		.invoice-card {
			max-width: 1000px;
			margin: 30px auto;
			background: #fff;
			border-radius: 12px;
			padding: 35px;
			box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
		}

		.invoice-title {
			letter-spacing: 2px;
			font-weight: 800;
		}

		.table thead th {
			background: #f8f9fa;
			font-size: 12px;
			text-transform: uppercase;
		}

		.total-box {
			max-width: 350px;
			margin-left: auto;
		}

		@media print {
			body {
				background: #fff;
			}

			.invoice-card {
				max-width: 100%;
				margin: 0;
				padding: 10px;
				box-shadow: none;
			}

			.no-print {
				display: none !important;
			}
		}
	</style>
</head>

<body>

	<div class="container-fluid">
		<div class="invoice-card">

			<div class="d-flex justify-content-between align-items-start mb-4">
				<div>
					<h2 class="invoice-title">INVOICE</h2>
					<p class="text-muted mb-0">Detail Permintaan Produk</p>
				</div>

				<div class="text-end">
					<h4 class="fw-bold mb-1">SIMPANG TIGA</h4>
					<p class="text-muted mb-0">Sistem Informasi Gudang</p>
				</div>
			</div>

			<hr>

			<div class="row g-3 mb-4">
				<div class="col-md-6">
					<p class="text-muted mb-1">Nomor Permintaan</p>
					<h6>
						PRM-<?= str_pad(
								$permintaan->id_permintaan,
								4,
								'0',
								STR_PAD_LEFT
							) ?>
					</h6>
				</div>

				<div class="col-md-6 text-md-end">
					<p class="text-muted mb-1">Tanggal Permintaan</p>
					<h6>
						<?= date(
							'd-m-Y',
							strtotime($permintaan->tgl_permintaan)
						) ?>
					</h6>
				</div>

				<div class="col-md-6">
					<p class="text-muted mb-1">Status Permintaan</p>

					<?php if ($permintaan->status == '0') : ?>
						<span class="badge bg-warning text-dark">
							Menunggu Konfirmasi Pemilik
						</span>
					<?php elseif (
						$permintaan->status == '1'
					) : ?>
						<span class="badge bg-info">
							Menunggu Pembayaran
						</span>
					<?php elseif (
						$permintaan->status == '2'
					) : ?>
						<span class="badge bg-primary">
							Menunggu Konfirmasi Supplier
						</span>
					<?php elseif ($permintaan->status == '3') : ?>
						<span class="badge bg-success">
							Permintaan Selesai
						</span>
					<?php endif; ?>
				</div>

				<div class="col-md-6 text-md-end">
					<p class="text-muted mb-1">Status Pembayaran</p>

					<?php if ($permintaan->payment == '1') : ?>
						<span class="badge bg-success">
							Bukti Pembayaran Diunggah
						</span>
					<?php else : ?>
						<span class="badge bg-danger">
							Belum Bayar
						</span>
					<?php endif; ?>
				</div>
			</div>

			<h6 class="fw-bold mb-3">Rincian Produk</h6>

			<div class="table-responsive">
				<table class="table table-bordered align-middle">
					<thead>
						<tr>
							<th width="50">No.</th>
							<th>Nama Produk</th>
							<th class="text-center">Kuantitas</th>
							<th class="text-end">Harga</th>
							<th class="text-end">Subtotal</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$no = 1;
						$total = 0;

						foreach ($detail as $item) :
							$qty = (int) $item->qty;
							$harga = (float) $item->harga;
							$subtotal = $qty * $harga;
							$total += $subtotal;
						?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= html_escape($item->nama_produk) ?></td>
								<td class="text-center"><?= $qty ?></td>
								<td class="text-end">
									Rp<?= number_format($harga, 0, ',', '.') ?>
								</td>
								<td class="text-end">
									Rp<?= number_format($subtotal, 0, ',', '.') ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="total-box mt-4">
				<div class="d-flex justify-content-between mb-2">
					<span>Total Produk</span>
					<strong>
						Rp<?= number_format($total, 0, ',', '.') ?>
					</strong>
				</div>

				<hr>

				<div class="d-flex justify-content-between">
					<h5>Total Pembayaran</h5>
					<h5 class="fw-bold">
						Rp<?= number_format(
								$permintaan->total_bayar,
								0,
								',',
								'.'
							) ?>
					</h5>
				</div>
			</div>

			<hr class="mt-4">

			<p class="text-muted small">
				Invoice ini merupakan rincian permintaan produk gudang
				Toko Simpang Tiga.
			</p>

			<div class="d-flex justify-content-between no-print mt-4">
				<a href="<?= base_url('Gudang/cPermintaan') ?>" class="btn btn-secondary">
					Kembali
				</a>

				<button type="button" class="btn btn-primary" onclick="window.print()">
					Cetak Invoice
				</button>
			</div>

		</div>
	</div>

</body>

</html>
