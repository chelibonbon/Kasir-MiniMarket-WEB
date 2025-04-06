  
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
      <h5 class="card-header">Nota</h5>
      
      <div class="table-responsive text-nowrap">
        <table class="table datatable">
          <thead class="table-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">no. nota</th>
              <th scope="col">grand total</th>
              <th scope="col">bayar</th>
              <th scope="col">kembali</th>
              <th scope="col">keterangan</th>
              <th scope="col">kasir</th>
              <th scope="col">tanggal</th>
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
              <td ><?= $value->nomor_nota ?></td>
              <td ><?= $value->grand_total ?></td>
              <td ><?= $value->bayar ?></td>
              <td ><?= $value->kembali ?></td>
              <td ><?= $value->keterangan ?></td>
              <td ><?= $value->id_kasir ?></td>
              <td ><?= $value->tanggal ?></td>
              <td > 
                <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('fontawesome/css/fontawesome.min.css');?>">
                <link rel="stylesheet" type="text/css" href="<?=base_url('fontawesome/css/all.css');?>"> -->
                <a href="<?= base_url('home/print_ulang_nota/'.$value->id_nota) ?>"
                 button class="btn btn-primary">
                 <i class="fas fa-info-circle"></i>
                 cetak
               </button>
             </a>
           </td>
         <?php } ?>
       </tr>
     </tbody>
   </table>
 </div>
</div>
<!-- Bootstrap Table with Header - Light -->
