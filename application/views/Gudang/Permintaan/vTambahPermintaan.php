<div class="container-fluid py-4">
	<div class="row">
		<div class="col-6">
			<div class="card mb-4">
				<div class="card-header pb-0">
					<h6>Tambah Permintaan Produk</h6>

				</div>
				<div class="card-body px-0 pt-0 pb-2 m-3">
					<form action="<?= base_url('Gudang/cPermintaan/tambah_permintaan') ?>" method="POST">
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Produk</label>
							<select id="produk" class="form-control" name="produk">
								<option value="">---Pilih Produk---</option>
								<?php
								foreach ($produk as $key => $value) {
								?>
									<option data-nama="<?= $value->nama_produk ?>" data-harga="<?= $value->harga ?>" data-keterangan="<?= $value->keterangan ?>" value="<?= $value->id_produk ?>"><?= $value->nama_produk ?></option>
								<?php
								}
								?>
							</select>
							<?= form_error('produk', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
						</div>
						<hr>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Nama Produk</label>
							<input type="text" name="nama" class="nama form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>

						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="mb-3">
									<label for="exampleInputPassword1" class="form-label">Harga</label>
									<input type="text" name="harga" class="harga form-control" id="exampleInputPassword1" readonly>
								</div>
							</div>
							<div class="col-lg-1 mt-5"><strong>/</strong></div>
							<div class="col-lg-5">
								<div class="mb-3">
									<label for="exampleInputPassword1" class="form-label">Keterangan</label>
									<input type="text" name="keterangan" class="keterangan form-control" id="exampleInputPassword1" readonly>
								</div>
							</div>
						</div>
						<hr>
						<div class="mb-3">
							<label for="exampleInputPassword1" class="form-label">Quantity</label>
							<input type="text" name="qty" class="form-control" id="exampleInputPassword1">
							<?= form_error('qty', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
						</div>

						<button type="submit" class="btn btn-primary">Submit</button>
						<a href="<?= base_url('Gudang/cPermintaan') ?>" class="btn btn-danger ml-2">Kembali</a>
					</form>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="card h-100">
				<div class="card-header pb-0">
					<h6>Keranjang Permintaan Produk</h6>
					<p class="text-sm">
						<i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
						<span class="font-weight-bold">Total Pembayaran: </span> Rp. <?= number_format($this->cart->total()) ?>
					</p>
					<?php
					if ($this->session->userdata('success')) {
					?>
						<div class="alert alert-success" role="alert"><strong>Sukses!</strong>
							<?= $this->session->userdata('success') ?>
						</div>
					<?php
					}
					?>
				</div>
				<div class="card-body p-3">
					<div class="timeline timeline-one-side">
						<?php
						foreach ($this->cart->contents() as $key => $value) {
						?>
							<div class="timeline-block mb-3">
								<span class="timeline-step">
									<i class="ni ni-cart text-info text-gradient"></i>
								</span>
								<div class="timeline-content">
									<h6 class="text-dark text-sm font-weight-bold mb-0"><?= $value['name'] ?></h6>
									<p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= $value['qty'] ?> <?= $value['keterangan'] ?> x Rp. <?= number_format($value['price'])  ?></p>
									<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Sub Total: Rp. <?= number_format($value['qty'] * $value['price']) ?></p>
									<a href="<?= base_url('Gudang/cPermintaan/delete_cart/' . $value['rowid']) ?>" class="btn btn-danger btn-sm text-xs mt-2 mb-0">Hapus</a>
								</div>
							</div>
						<?php
						}
						?>



					</div>
					<?php
					if ($this->cart->contents()) {
					?>
						<a href="<?= base_url('Gudang/cPermintaan/selesai') ?>" class="btn btn-success">Selesai</a>
					<?php
					}
					?>

				</div>
			</div>
		</div>