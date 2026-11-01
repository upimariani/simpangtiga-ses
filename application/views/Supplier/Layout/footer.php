<footer class="footer pt-3  ">
	<div class="container-fluid">
		<div class="row align-items-center justify-content-lg-between">
			<div class="col-lg-6 mb-lg-0 mb-4">
				<div class="copyright text-center text-sm text-muted text-lg-start">
					© <script>
						document.write(new Date().getFullYear())
					</script>,
					made with <i class="fa fa-heart"></i> by
					<a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Toko Simpang Tiga Cigugur</a>
					for a better web.
				</div>
			</div>
			<div class="col-lg-6">
				<ul class="nav nav-footer justify-content-center justify-content-lg-end">
					<li class="nav-item">
						<a href="<?= base_url('Supplier/cDashboard') ?>" class="nav-link text-muted" target="_blank">Dashboard</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('Supplier/cPermintaan') ?>" class="nav-link text-muted" target="_blank">Permintaan Produk</a>
					</li>

				</ul>
			</div>
		</div>
	</div>
</footer>
</div>
</main>

<!--   Core JS Files   -->
<script src="<?= base_url('asset/') ?>jquery.min.js"></script>
<script src="<?= base_url('asset/soft-ui-dashboard/') ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url('asset/soft-ui-dashboard/') ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url('asset/soft-ui-dashboard/') ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url('asset/soft-ui-dashboard/') ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
	var win = navigator.platform.indexOf('Win') > -1;
	if (win && document.querySelector('#sidenav-scrollbar')) {
		var options = {
			damping: '0.5'
		}
		Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
	}
</script>
<link href="<?= base_url('asset/') ?>datatables/datatables.min.css" rel="stylesheet">

<script src="<?= base_url('asset/') ?>datatables/datatables.min.js"></script>

<script>
	$('#myTable').DataTable({
		select: true
	});
</script>
<script>
	console.log = function() {}
	$("#produk").on('change', function() {

		$(".nama").html($(this).find(':selected').attr('data-nama'));
		$(".nama").val($(this).find(':selected').attr('data-nama'));

		$(".harga").html($(this).find(':selected').attr('data-harga'));
		$(".harga").val($(this).find(':selected').attr('data-harga'));

		$(".keterangan").html($(this).find(':selected').attr('data-keterangan'));
		$(".keterangan").val($(this).find(':selected').attr('data-keterangan'));

	});
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url('asset/soft-ui-dashboard/') ?>assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
