<div class="container-fluid py-4">
	<div class="row">
		<div class="col-12">
			<div class="card mb-4">

				<div class="card-header pb-0">
					<h6>Informasi Permintaan Produk</h6>

					<a href="<?= base_url('Gudang/cPermintaan/tambah_permintaan') ?>" class="btn btn-primary">
						<i class="fas fa-plus me-1"></i>
						Tambah Permintaan Produk
					</a>

					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success">
							<?= $this->session->flashdata('success') ?>
						</div>
					<?php endif; ?>

					<?php if ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger">
							<?= $this->session->flashdata('error') ?>
						</div>
					<?php endif; ?>
				</div>


				<?php
				// Kelompok status permintaan
				$tabStatus = [
					'pemilik' => [
						'judul' => 'Menunggu Konfirmasi Pemilik',
						'status' => '0',
						'payment' => null
					],
					'bayar' => [
						'judul' => 'Upload Bukti Pembayaran',
						'status' => '1',
						'payment' => '0'
					],
					'supplier' => [
						'judul' => 'Menunggu Konfirmasi Supplier',
						'status' => '2',
						'payment' => 'uploaded'
					],
					'selesai' => [
						'judul' => 'Permintaan Selesai',
						'status' => '3',
						'payment' => 'uploaded'
					]
				];

				// Kelompokkan data permintaan berdasarkan status
				$dataTab = [];

				foreach ($tabStatus as $key => $tab) {
					$dataTab[$key] = [];

					foreach ($permintaan as $p) {
						$statusSesuai =
							(string) $p->status === (string) $tab['status'];

						$payment = trim((string) $p->payment);

						if ($tab['payment'] === null) {
							$paymentSesuai = true;
						} elseif ($tab['payment'] === '0') {
							$paymentSesuai = ($payment === '0');
						} elseif ($tab['payment'] === 'uploaded') {
							$paymentSesuai = ($payment !== '' && $payment !== '0');
						} else {
							$paymentSesuai =
								($payment === (string) $tab['payment']);
						}

						if ($statusSesuai && $paymentSesuai) {
							$dataTab[$key][] = $p;
						}
					}
				}
				?>


				<div class="card-body">

					<!-- Navigasi tab -->
					<ul class="nav nav-tabs mb-3" id="tabPermintaan" role="tablist">

						<?php $i = 0;
						foreach ($tabStatus as $key => $tab) : ?>
							<li class="nav-item" role="presentation">
								<button class="text-sm nav-link <?= $i === 0 ? 'active' : '' ?>" id="tab-<?= $key ?>" data-bs-toggle="tab" data-bs-target="#konten-<?= $key ?>" type="button" role="tab">

									<?= $tab['judul'] ?>

									<span class="badge bg-secondary ms-1">
										<?= count($dataTab[$key]) ?>
									</span>
								</button>
							</li>
						<?php $i++;
						endforeach; ?>

					</ul>

					<div class="tab-content" id="kontenTabPermintaan">

						<?php $i = 0;
						foreach ($tabStatus as $key => $tab) : ?>

							<div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="konten-<?= $key ?>" role="tabpanel">

								<h6 class="mb-3">
									<?= $tab['judul'] ?>
								</h6>

								<div class="table-responsive text-sm">
									<table class="tbl table table-hover align-items-center mb-0">
										<thead class="table-light">
											<tr>
												<th>No</th>
												<th>Tanggal Permintaan</th>
												<th>Total Pembayaran</th>
												<th>Pembayaran</th>
												<th class="text-center">Aksi</th>
											</tr>
										</thead>

										<tbody>
											<?php if (!empty($dataTab[$key])) : ?>

												<?php $no = 1;
												foreach ($dataTab[$key] as $value) : ?>
													<tr>
														<td><?= $no++ ?>.</td>

														<td>
															<?= html_escape($value->tgl_permintaan) ?>
														</td>

														<td>
															Rp <?= number_format(
																	$value->total_bayar,
																	0,
																	',',
																	'.'
																) ?>
														</td>
														<td class="text-center">

															<?php if ($key === 'bayar') : ?>

																<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalBayar<?= $value->id_permintaan ?>">
																	Upload Bukti
																</button>

															<?php elseif ($key === 'supplier') : ?>

																<span class="text-sm text-muted">
																	Menunggu supplier
																</span>

															<?php elseif ($key === 'selesai') : ?>

																<span class="text-sm text-success">
																	Selesai
																</span>

															<?php else : ?>

																<span class="text-sm text-muted">
																	Menunggu pemilik
																</span>

															<?php endif; ?>
														</td>
														<td>

															<?php if ($key !== 'selesai') : ?>
																<a href="<?= base_url('Gudang/cPermintaan/delete/' . $value->id_permintaan) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus permintaan ini?')">
																	Hapus
																</a>
															<?php endif; ?>
															<a href="<?= base_url('Gudang/cPermintaan/detail_permintaan/' . $value->id_permintaan) ?>" class="btn btn-warning btn-sm">Detail</a>


														</td>
													</tr>

												<?php endforeach; ?>



											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>

						<?php $i++;
						endforeach; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal upload bukti pembayaran -->
<?php foreach ($dataTab['bayar'] as $value) : ?>

	<div class="modal fade" id="modalBayar<?= $value->id_permintaan ?>" tabindex="-1" aria-hidden="true">

		<div class="modal-dialog">
			<?= form_open_multipart(
				'Gudang/cPermintaan/bayar/' . $value->id_permintaan
			) ?>

			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title">
						Upload Bukti Pembayaran
					</h5>

					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">

					<p>
						Total pembayaran:
						<strong>
							Rp <?= number_format(
									$value->total_bayar,
									0,
									',',
									'.'
								) ?>
						</strong>
					</p>

					<div class="mb-3">
						<label class="form-label">
							Bukti Pembayaran
						</label>

						<input class="form-control" type="file" name="gambar" accept="image/*" required>
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
						Batal
					</button>

					<button type="submit" class="btn btn-primary">
						Upload Pembayaran
					</button>
				</div>

			</div>

			</form>
		</div>
	</div>

<?php endforeach; ?>
