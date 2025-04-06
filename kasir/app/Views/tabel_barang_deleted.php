<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Active Items Table -->
    <div class="card">
      <h5 class="card-header">Deleted Barang</h5>
      <form method="GET" action="<?= base_url('home/tabel_barang_deleted') ?>">
       <a href="<?= base_url('home/tabel_barang') ?>" class="btn btn-primary">
        barang
      </a>
      <a href="<?= base_url('home/restore_all_barang') ?>" class="btn btn-outline-info waves-effect" 
        onclick="return confirm('Are you sure you want to restore all the barang?');">
        <i class="ri-arrow-go-back-line"></i> Restore All
      </a>
      <label for="sort">Sort by:</label>
      <select name="sort" id="sort">
        <option value="id_barang">ID</option>
        <option value="nama_barang">Nama</option>
        <option value="harga_satuan">Harga</option>
        <option value="stok">Stok</option>
      </select>

      <select name="order" id="order">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
      </select>

      <button type="submit">Sort</button>
    </form>

    <!-- Deleted Items Table (Admin Only) -->
    <div class="card mt-4">
      <div class="table-responsive text-nowrap">
        <table class="table datatable">
          <thead class="table-light">
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

            <?php foreach ($deleted_items as $item) { ?>
              <tr>
                <td><?= $item->kode_barang ?></td>
                <td><?= $item->nama_barang ?></td>
                <td>
                  <a href="<?= base_url('home/restore_barang/' . $item->id_barang) ?>" class="btn btn-outline-primary waves-effect">
                   <i class="ri-arrow-go-back-line"></i> Restore
                 </a>
                 <a href="<?= base_url('home/delete_permanently/' . $item->id_barang) ?>" class="btn btn-outline-danger waves-effect"
                  onclick="return confirm('Are you sure you want to delete this item? it will reduce to atoms, disintegrate.');">
                  <i class="ri-delete-bin-line"></i> Delete Permanently
                </a>
                 <a href="<?= base_url('home/detail_barang/' . $item->id_barang) ?>" class="btn btn-info">
                    </i> Detail
                  </a>
                
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    </div>
  </div>
</div>
