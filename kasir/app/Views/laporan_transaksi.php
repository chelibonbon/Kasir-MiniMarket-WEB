<main id="main" class="main">

  <div class="pagetitle">
    <h3>Laporan uang</h3>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Laporan Transaksi</h5>

            <form class="mt-3" action="<?= base_url('home/excel_transaksi')?>" method="POST">
              <div class="row">
                <div class="col">
                  <label for="tanggal_awal" class="form-label">Tanggal Awal:</label>
                  <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" placeholder="Tanggal Awal">
                </div>
                <div class="col-md-4 mb-3">
                  <label for="tanggal_akhir" class="form-label">Tanggal Akhir:</label>
                  <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" placeholder="Tanggal Akhir">
                </div>

                   <!-- <div class="col">
                <label for="tanggal" class="form-label">Tanggal Berobat:</label>
                <input type="date" class="form-control" placeholder="Tanggal Berobat" name="tanggal">
              </div> -->

              <div class="col d-flex align-items-end">
                 <div class="col-md-3 mb-5">
                <button class="btn btn-success" style="width: 100px;" formtarget="_blank">
                  <i class="fas fa-file-excel"></i> Excel
                </button>
              </div>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</section>

  </main><!-- End #main -->