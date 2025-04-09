<div class="container-fluid py-4">
	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header pb-0">
					<h6>Informasi Permintaan Produk</h6>
					<a href="<?= base_url('Gudang/cPermintaan/tambah_permintaan') ?>" class="btn btn-primary">Tambah Data Permintaan Produk</a>
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
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Permintaan</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Pembayaran</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($permintaan as $key => $value) {
								?>
									<tr>
										<td>
											<div class="d-flex px-2 py-1">

												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm"><?= $value->tgl_permintaan ?></h6>

												</div>
											</div>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0">Rp. <?= number_format($value->total_bayar)  ?></p>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0 text-center"><?php if ($value->status == '0') {
																										echo '<span class="badge bg-warning">Permintaan Diterima Supplier</span>';
																									} else if ($value->status == '1') {
																										echo '<span class="badge bg-info">Berhasil Dikonfirmasi</span>';
																									} else if ($value->status == '2') {
																										echo '<span class="badge bg-success">Pesanan Selesai</span>';
																									} ?></p>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0 text-center"><?php if ($value->payment == '0') {

																									?>
													<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
														Upload Bukti Pembayaran
													</button>
													<!-- Modal -->
											<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<?= form_open_multipart('Gudang/cPermintaan/bayar/' . $value->id_permintaan) ?>
													<div class="modal-content">
														<div class="modal-header">
															<h6 class="modal-title" id="exampleModalLabel">Pembayaran Permintaan Produk <br> Sebesar <strong>Rp. <?= number_format($value->total_bayar) ?></strong></h6>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body">
															<div class="form-group">
																<input class="form-control" type="file" name="gambar">
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
																									} else {
																										echo '<span class="badge bg-success">Berhasil Bayar</span>';
																									} ?>
										</p>
										</td>
										<td class="align-middle text-center text-sm">

											<a href="<?= base_url('Gudang/cPermintaan/delete/' . $value->id_permintaan) ?>" class="btn btn-danger btn-sm">Hapus</a>
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