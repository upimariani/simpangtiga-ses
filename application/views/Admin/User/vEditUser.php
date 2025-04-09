<div class="container-fluid py-4">
	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header pb-0">
					<h6>Tambah User Akun</h6>

				</div>
				<div class="card-body px-0 pt-0 pb-2 m-3">
					<form action="<?= base_url('Admin/cUser/edit/' . $user->id_user) ?>" method="POST">
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Nama User</label>
							<input type="text" name="nama" value="<?= $user->nama_user ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							<?= form_error('nama', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>

						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="mb-3">
									<label for="exampleInputPassword1" class="form-label">Username</label>
									<input type="text" name="username" value="<?= $user->username ?>" class="form-control" id="exampleInputPassword1">
									<?= form_error('username', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="mb-3">
									<label for="exampleInputPassword1" class="form-label">Password</label>
									<input type="text" name="password" value="<?= $user->password ?>" class="form-control" id="exampleInputPassword1">
									<?= form_error('password', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
								</div>
							</div>
						</div>

						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Level User</label>
							<select class="form-control" name="level">
								<option value="">---Pilih Level User---</option>
								<option value="1" <?php if ($user->level_user == '1') {
														echo 'selected';
													} ?>>Admin</option>
								<option value="2" <?php if ($user->level_user == '2') {
														echo 'selected';
													} ?>>Gudang</option>
								<option value="3" <?php if ($user->level_user == '3') {
														echo 'selected';
													} ?>>Pemilik</option>
								<option value="4" <?php if ($user->level_user == '4') {
														echo 'selected';
													} ?>>Supplier</option>
							</select>
							<?= form_error('level', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
						<a href="<?= base_url('Admin/cUser') ?>" class="btn btn-danger ml-2">Kembali</a>
					</form>
				</div>
			</div>
		</div>
	</div>