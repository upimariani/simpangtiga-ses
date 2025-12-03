<div class="container-fluid py-4">
	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header pb-0">
					<h6>Informasi Produk Keluar</h6>
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
						Tambah Produk Keluar
					</button>
					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<?= form_open_multipart('Gudang/cProdukKeluar/create') ?>
							<div class="modal-content">
								<div class="modal-header">
									<h6 class="modal-title" id="exampleModalLabel">Masukkan Produk Keluar</h6>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label>Nama Produk</label>
										<select class="form-control" name="produk" required>
											<option value="">Pilih Produk</option>
											<?php
											foreach ($produk as $key => $value) {
												if ($value->stok != 0) {
											?>
													<option value="<?= $value->id_produk ?>"><?= $value->nama_produk ?> | Stok. <?= $value->stok ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Quantity Keluar</label>
										<input type="number" class="form-control" name="qty" required>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</div>
							</form>
						</div>
					</div>
					<?php
					if ($this->session->userdata('success')) {
					?>
						<div class="alert alert-success" role="alert"><strong>Sukses!</strong>
							<?= $this->session->userdata('success') ?>
						</div>
					<?php
					}
					?>
					<?php
					if ($this->session->userdata('error')) {
					?>
						<div class="alert alert-danger" role="alert"><strong>Gagal!</strong>
							<?= $this->session->userdata('error') ?>
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
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Keluar</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Produk</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity Keluar</th>

								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($produk_keluar as $key => $value) {
								?>
									<tr>
										<td>
											<div class="d-flex px-2 py-1">

												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm"><?= $value->tgl_keluar ?></h6>
												</div>
											</div>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0"><?= $value->nama_produk  ?></p>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0"><?= $value->qty  ?> <?= $value->keterangan ?></p>
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