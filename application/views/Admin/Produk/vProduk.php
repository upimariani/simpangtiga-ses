<div class="container-fluid py-4">
	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header pb-0">
					<h6>Informasi Produk</h6>
					<a href="<?= base_url('Admin/cProduk/create') ?>" class="btn btn-primary">Tambah Data Produk</a>
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
				<div class="card-body px-0 pt-0 pb-2 m-3">
					<div class="table-responsive p-0">
						<table id="myTable" class="table align-items-center mb-0">
							<thead>
								<tr>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stok</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($produk as $key => $value) {
								?>
									<tr>
										<td>
											<div class="d-flex px-2 py-1">
												<div>
													<img src="<?= base_url('asset/produk/' . $value->gambar) ?>" class="avatar avatar-sm me-3" alt="user4">
												</div>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm"><?= $value->nama_produk ?></h6>
													<p class="text-xs text-secondary mb-0"><?= $value->nama_user ?></p>
												</div>
											</div>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0">Rp. <?= number_format($value->harga)  ?></p>
											<p class="text-xs text-secondary mb-0">/<?= $value->keterangan ?></p>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0"><?= $value->stok ?> <?= $value->keterangan ?></p>
										</td>
										<td class="align-middle text-center text-sm">
											<a href="<?= base_url('Admin/cProduk/edit/' . $value->id_produk) ?>" class="btn btn-warning btn-sm">Edit</a>
											<a href="<?= base_url('Admin/cProduk/delete/' . $value->id_produk) ?>" class="btn btn-danger btn-sm">Hapus</a>
										</td>

									</tr>
								<?php
								}
								?>


							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>