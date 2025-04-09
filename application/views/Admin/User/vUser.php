<div class="container-fluid py-4">
	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header pb-0">
					<h6>Informasi User Akun</h6>
					<a href="<?= base_url('Admin/cUser/create') ?>" class="btn btn-primary">Tambah Data User</a>
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
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama User</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Akun</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($user as $key => $value) {
								?>
									<tr>
										<td>
											<div class="d-flex px-2 py-1">

												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm"><?= $value->nama_user ?></h6>
													<p class="text-xs text-secondary mb-0"><?php if ($value->level_user == '1') {
																								echo 'Admin';
																							} else if ($value->level_user == '2') {
																								echo 'Gudang';
																							} else if ($value->level_user == '3') {
																								echo 'Pemilik';
																							} else if ($value->level_user == '4') {
																								echo 'Supplier';
																							} ?></p>
												</div>
											</div>
										</td>
										<td>
											<p class="text-xs font-weight-bold mb-0"><?= $value->username ?></p>
											<p class="text-xs text-secondary mb-0"><?= $value->password ?></p>
										</td>
										<td class="align-middle text-center text-sm">
											<a href="<?= base_url('Admin/cUser/edit/' . $value->id_user) ?>" class="btn btn-warning btn-sm">Edit</a>
											<a href="<?= base_url('Admin/cUser/delete/' . $value->id_user) ?>" class="btn btn-danger btn-sm">Hapus</a>
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