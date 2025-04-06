  
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
      <h5 class="card-header">Transaksi</h5>

   <div class="table-responsive text-nowrap">
    <table class="table datatable">
      <thead class="table-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">tanggal</th>
          <th scope="col">no. nota</th>
          <th scope="col">kasir</th>
          <th scope="col">kode barang</th>
          <th scope="col">jumlah</th>
          <th scope="col">sub total</th>
          <!-- <th scope="col">Buttons</th> -->
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

       <?php
       $ms=1;
       foreach ($child as $key => $value) {
         ?>
         <tr>
          <th scope="row"><?= $ms++ ?></th>
          <td ><?= $value->tanggal ?></td>
          <td ><?= $value->nomor_nota ?></td>
          <td ><?= $value->id_kasir ?></td>
          <td ><?= $value->kode_barang ?></td>
          <td ><?= $value->jumlah ?></td>
          <td ><?= $value->sub_total ?></td>
          <td > 
            <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('fontawesome/css/fontawesome.min.css');?>">
            <link rel="stylesheet" type="text/css" href="<?=base_url('fontawesome/css/all.css');?>"> -->

         <!-- <a href="<?= base_url('home/hapus_nota/'.$value->id_nota) ?>"
           button class="btn btn-danger">
           <i class="fas fa-info-circle"></i>
           Hapus
         </button>
       </a> -->
     </td>
   <?php } ?>
 </tr>
</tbody>
</table>
</div>
</div>
<!-- Bootstrap Table with Header - Light -->
