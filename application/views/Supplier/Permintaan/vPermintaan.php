<div class="container-fluid py-4">
	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header pb-0">
					<h6>Informasi Permintaan Produk</h6>

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
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($permintaan as $key => $value) {
									if ($value->status == '1') {
										$dt_produk = $this->db->query("SELECT * FROM `permintaan` JOIN detail_permintaan ON permintaan.id_permintaan=detail_permintaan.id_permintaan JOIN produk ON produk.id_produk=detail_permintaan.id_produk WHERE permintaan.id_permintaan='" . $value->id_permintaan . "'")->result();
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
																											echo '<span class="badge bg-danger">Menunggu Konfirmasi Pemilik</span>';
																										} else if ($value->status == '1') {
																											echo '<span class="badge bg-info">Menunggu Dikonfirmasi</span>';
																										} else if ($value->status == '2') {
																											echo '<span class="badge bg-success">Pesanan Selesai</span>';
																										} ?></p>
											</td>
											<td>
												<?php
												foreach ($dt_produk as $key => $a) {
													echo '<p class="text-xs font-weight-bold mb-0 text-center">' . $a->nama_produk . ' x' . $a->qty . '</p>';
												}
												?>

											</td>
											<td>
												<p class="text-xs font-weight-bold mb-0 text-center">
													<?php
													if ($value->payment == '0' && $value->status == 0) {
														echo '<span class="badge bg-danger">Belum Bayar</span>';
													} else if ($value->payment == '0' && $value->status != 0) {
													?>

													<?php
													} else {
														echo '<span class="badge bg-success">Berhasil Bayar</span><br>';
													?>
														<a href="<?= base_url('asset/bayar/' . $value->payment) ?>">View Pembayaran</a>
													<?php
													} ?>
												</p>
											</td>
											<td class="align-middle text-center text-sm">

												<a href="<?= base_url('Supplier/cPermintaan/konfirmasi/' . $value->id_permintaan) ?>" class="btn btn-warning btn-sm">Konfirmasi Pesanan</a>
											</td>

										</tr>
								<?php
									}
								}
								?>


							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>