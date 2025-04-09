<div class="container-fluid py-4">
	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<div class="card-header pb-0">
					<h6>Perbaharui Produk</h6>
				</div>
				<div class="card-body px-0 pt-0 pb-2 m-3">
					<?= form_open_multipart('Admin/cProduk/edit/' . $produk->id_produk) ?>
					<div class="row">
						<div class="col-lg-6">
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Nama Produk</label>
								<input type="text" value="<?= $produk->nama_produk ?>" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
								<?= form_error('nama', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Gambar Produk</label><br>
								<input type="file" name="gambar" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
								<a class="form-label text-info" href="<?= base_url('asset/produk/' . $produk->gambar) ?>">Klik View Gambar!</a>
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
									<option value="<?= $value->id_user ?>" <?php if ($produk->id_user == $value->id_user) {
																				echo 'selected';
																			} ?>><?= $value->nama_user ?></option>
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
								<input type="number" value="<?= $produk->harga ?>" name="harga" class="form-control" id="exampleInputPassword1">
								<?= form_error('harga', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Keterangan</label>
								<input type="text" name="keterangan" value="<?= $produk->keterangan ?>" class="form-control" id="exampleInputPassword1">
								<?= form_error('keterangan', '<div id="emailHelp" class="form-text text-danger">', '</div>') ?>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Stok</label>
								<input type="number" name="stok" value="<?= $produk->stok ?>" class="form-control" id="exampleInputPassword1">
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