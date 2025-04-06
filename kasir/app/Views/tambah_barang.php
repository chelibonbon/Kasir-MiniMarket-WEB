<main id="main" class="main">

	<div class="pagetitle">
		<h1>Tambah Barang</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Home</a></li>
				<li class="breadcrumb-item">Forms</li>
				<li class="breadcrumb-item active">Elements</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-12">

				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Tambah Barang</h5>
						<form action="<?= base_url('home/simpan_tambah_barang') ?>" method="POST">
							<table>
								<tr>
									<td>kode barang</td>
									<td><input type="text" class="form-control" name="kode_barang" value="<?= $child->kode_barang ?>"></td>
								</tr>
								<tr>
									<td>nama</td>
									<td><input type="text" class="form-control" name="nama_barang" value="<?= $child->nama_barang ?>"></td>
								</tr>
								<tr>
									<td>jenis</td>
									<td><input type="text" class="form-control" name="jenis_barang" value="<?= $child->jenis_barang ?>"></td>
								</tr>
								<tr>
									<td>harga</td>
									<td>
										<input type="text" 
										class="form-control" 
										name="harga_satuan" 
										value="<?= number_format($child->harga_satuan, 0, ',', '.') ?>" 
										oninput="formatRupiah(this)">
									</td>

								</tr>
								<tr>
									<td>stok</td>
									<td><input type="number" class="form-control" name="stok" value="<?= $child->stok ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="hidden" value="<?= $child->id_barang ?>">
										<button type="submit" class="btn btn-primary">Submit</button>
										<input type="reset" value="reset" class="form-control">
										<input type="button" value="kembali" class="form-control">
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>
	<script>
function formatRupiah(element) {
    let value = element.value.replace(/\D/g, ''); // Remove non-numeric characters
    value = new Intl.NumberFormat('id-ID').format(value);
    element.value = value;
}
</script>


  </main><!-- End #main -->