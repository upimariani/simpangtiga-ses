<div class="container-fluid py-4">
	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header pb-0">
					<h6>Tambah Produk</h6>

				</div>
				<div class="card-body px-0 pt-0 pb-2 m-3">
					<?= form_open_multipart('Admin/cProduk/create') ?>
					<div class="row">
						<div class="col-lg-6">
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Nama Produk</label>
								<input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
								<?= form_error('nama', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>

							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Gambar Produk</label>
								<input type="file" name="gambar" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>


							</div>
						</div>
					</div>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Nama Suppllier</label>
						<select class="form-control" name="supplier">
							<option value="">---Pilih Supplier---</option>
							<?php
							foreach ($supplier as $key => $value) {
								if ($value->level_user == '4') {

							?>
									<option value="<?= $value->id_user ?>"><?= $value->nama_user ?></option>
							<?php
								}
							}
							?>


						</select>
						<?= form_error('supplier', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Harga</label>
								<input type="number" name="harga" class="form-control" id="exampleInputPassword1">
								<?= form_error('harga', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Keterangan</label>
								<input type="text" name="keterangan" class="form-control" id="exampleInputPassword1">
								<?= form_error('keterangan', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Stok</label>
								<input type="number" name="stok" class="form-control" id="exampleInputPassword1">
								<?= form_error('stok', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
							</div>
						</div>
					</div>


					<button type="submit" class="btn btn-primary">Submit</button>
					<a href="<?= base_url('Admin/cProduk') ?>" class="btn btn-danger ml-2">Kembali</a>
					</form>
				</div>
			</div>
		</div>
	</div>