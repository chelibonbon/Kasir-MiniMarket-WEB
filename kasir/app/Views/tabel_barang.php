  
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
      <h5 class="card-header">Barang</h5>
      <form>
        <a href="<?= base_url('home/tambah_barang') ?>" class="btn btn-success">
          <i class="ri-add-circle-line"></i> Tambah
        </a>
        <?php if (session()->get('level') == 3): ?>
        <a href="<?= base_url('home/tabel_barang_deleted') ?>" class="btn btn-primary">
          <i class="ri-delete-bin-line"></i> Deleted barang
        </a>
      <?php endif; ?>
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

    <div class="table-responsive text-nowrap">
      <table class="table datatable">
        <thead class="table-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">kode barang</th>
            <th scope="col">nama</th>
            <th scope="col">jenis</th>
            <th scope="col">harga</th>
            <th scope="col">stok</th>
            <th scope="col">Buttons</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

         <?php
         $ms=1;
         foreach ($child as $key => $value) {
           ?>
           <tr>
            <th scope="row"><?= $ms++ ?></th>
            <td ><?= $value->kode_barang ?></td>
            <td ><?= $value->nama_barang ?></td>
            <td ><?= $value->jenis_barang ?></td>
            <td ><?= $value->harga_satuan ?></td>
            <td ><?= $value->stok ?></td>
            <td > 
              <a href="<?= base_url('home/edit_barang/'.$value->id_barang) ?>" class="btn btn-warning">
                <i class="ri-edit-line"></i> Edit
              </a>
              <a href="<?= base_url('home/hapus_barang/'.$value->id_barang) ?>" class="btn btn-danger" class="btn btn-danger" 
                onclick="return confirm('Are you sure you want to delete this item?');">
                <i class="ri-delete-bin-line"></i> Hapus
              </a>
               <a href="<?= base_url('home/detail_barang/' . $value->id_barang) ?>" class="btn btn-info">
                    </i> Detail
                  </a>
            </td>
          <?php } ?>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<!-- Bootstrap Table with Header - Light -->
