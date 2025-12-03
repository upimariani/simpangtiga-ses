<div class="container-fluid py-4">
	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header pb-0">
					<h6>Informasi Peramalan Produk</h6>
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
					<?php
					if (!$view_analisis) {
						echo '<span class="badge bg-danger">Belum Ada Permintaan Produk</span>';
					} else {
					?>
						<div class="table-responsive p-0">
							<?php
							$dt = $this->db->query("SELECT * FROM `peramalan` WHERE id_produk='" . $id_produk . "' GROUP BY id_peramalan DESC LIMIT 1")->row();
							$ft = round((0.2 * $dt->dt_permintaan) + ((1 - 0.2) * $dt->dt_peramalan));

							//mengambil data bulan
							$bulan = $this->db->query("SELECT MAX(bulan)+1 as bulan FROM `peramalan` WHERE id_produk='1' AND tahun='2025'")->row();
							if ($bulan->bulan == '1') {
								$next_bulan = 'Januari';
							} else if ($bulan->bulan == '2') {
								$next_bulan = 'Februari';
							} else if ($bulan->bulan == '3') {
								$next_bulan = 'Maret';
							} else if ($bulan->bulan == '4') {
								$next_bulan = 'April';
							} else if ($bulan->bulan == '5') {
								$next_bulan = 'Mei';
							} else if ($bulan->bulan == '6') {
								$next_bulan = 'Juni';
							} else if ($bulan->bulan == '7') {
								$next_bulan = 'Juli';
							} else if ($bulan->bulan == '8') {
								$next_bulan = 'Agustus';
							} else if ($bulan->bulan == '9') {
								$next_bulan = 'September';
							} else if ($bulan->bulan == '10') {
								$next_bulan = 'Oktober';
							} else if ($bulan->bulan == '11') {
								$next_bulan = 'November';
							} else if ($bulan->bulan == '12') {
								$next_bulan = 'Desember';
							}
							?>
							<h5>Peramalan di Bulan <strong><?= $next_bulan ?></strong> adalah <?= $ft ?> pcs</h5>
							<table id="myTable" class="table">
								<thead class="text-center text-xs font-weight-bold mb-0">
									<tr>
										<th class="d-none d-md-table-cell">Nama Barang</th>
										<th class="d-none d-md-table-cell">Bulan</th>
										<th class="d-none d-md-table-cell">Tahun</th>
										<th class="d-none d-md-table-cell">Total Transaksi</th>
										<th class="d-none d-md-table-cell">Data Persediaan</th>
										<th class="d-none d-md-table-cell">Data Peramalan</th>
										<th class="d-none d-md-table-cell">Selisih</th>
										<th class="d-none d-md-table-cell">Absolute</th>
										<!-- <th class="d-none d-md-table-cell">Hapus</th> -->

									</tr>
								</thead>
								<tbody class="text-center text-xs font-weight-bold mb-0">
									<?php
									$mape = 0;
									$tpers = 0;
									foreach ($view_analisis as $key => $value) { ?>
										<tr>
											<td class="d-none d-md-table-cell"><?= $value->nama_produk ?></td>
											<td class="d-none d-md-table-cell"><?php
																				if ($value->bulan == '1') {
																					echo 'Januari';
																				} else if ($value->bulan == '2') {
																					echo 'Februari';
																				} else if ($value->bulan == '3') {
																					echo 'Maret';
																				} else if ($value->bulan == '4') {
																					echo 'April';
																				} else if ($value->bulan == '5') {
																					echo 'Mei';
																				} else if ($value->bulan == '6') {
																					echo 'Juni';
																				} else if ($value->bulan == '7') {
																					echo 'Juli';
																				} else if ($value->bulan == '8') {
																					echo 'Agustus';
																				} else if ($value->bulan == '9') {
																					echo 'September';
																				} else if ($value->bulan == '10') {
																					echo 'Oktober';
																				} else if ($value->bulan == '11') {
																					echo 'November';
																				} else if ($value->bulan == '12') {
																					echo 'Desember';
																				}
																				?></td>
											<td class="d-none d-md-table-cell"><?= $value->tahun ?></td>
											<?php
											$t_tranbulan = $this->db->query("SELECT COUNT(permintaan.id_permintaan) as jml_permintaan, tgl_permintaan FROM `permintaan` JOIN detail_permintaan ON permintaan.id_permintaan=detail_permintaan.id_permintaan WHERE detail_permintaan.id_produk='1' AND MONTH(tgl_permintaan) = '" . $value->bulan . "' AND YEAR(tgl_permintaan)='" . $value->tahun . "'")->row();
											?>
											<td><?= $t_tranbulan->jml_permintaan ?></td>
											<td class="d-none d-md-table-cell"><?= $value->dt_permintaan ?> <?= $value->keterangan ?></td>
											<?php
											$tpers += $value->dt_permintaan;
											?>
											<td class="d-none d-md-table-cell"><span class="badge bg-success"><?= $value->dt_peramalan ?> <?= $value->keterangan ?></span></td>
											<?php
											if ($value->dt_permintaan == '0') {
											?>
												<td><a href="<?= base_url('Owner/cPeramalan/hapus/' . $value->id_peramalan . '/' . $value->id_produk . '/' . $value->bulan) ?>" class="btn btn-danger btn-sm">Hapus</a></td>
											<?php
											}
											?>
											<?php
											$selisih =  $value->dt_permintaan - $value->dt_peramalan;
											$absolute = ($selisih / $value->dt_permintaan) * 100;
											$mape += $absolute;
											?>
											<td><?= abs($selisih) ?></td>
											<?php
											$sel = round($absolute, 2);
											?>
											<td><?= abs($sel)  ?></td>
										</tr>
									<?php } ?>
								<tfoot>
									<?php
									$t_tran = $this->db->query("SELECT COUNT(permintaan.id_permintaan) as jml_permintaan FROM `permintaan` JOIN detail_permintaan ON permintaan.id_permintaan=detail_permintaan.id_permintaan WHERE detail_permintaan.id_produk='" . $id_produk . "'")->row();
									?>
									<tr>
										<td></td>
										<td><strong>Total Transaksi</strong></td>
										<td><?= $t_tran->jml_permintaan ?></td>
										<td><strong>Total Persediaan</strong></td>
										<td><?= $tpers ?></td>
										<td></td>
										<td><strong>MAPE</strong></td>
										<td><?= abs(round($mape / $t_tran->jml_permintaan + 1, 2)) ?>%</td>
									</tr>
								</tfoot>

								</tbody>
							</table>
						</div>
					<?php
					}
					?>

				</div>
			</div>
		</div>
	</div>