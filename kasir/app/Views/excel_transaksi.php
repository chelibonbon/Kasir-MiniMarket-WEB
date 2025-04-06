 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Laporan transaksi</title>
   <style type="text/css">
    table,
    tr,
    th,
    td{
      border-collapse: collapse;
      font-family: sans-serif;
      padding: 5px;
    }
  /*button {
    color: #
    }*/
  </style>

</head>
<body>
  <table>
    <tr>
     <td width="100px"><img src="<?= base_url('img/logo_kasir.jpg');?>" width="100px"></td>
     <td width="250%">Kasir</td>
   </tr>
 </table>

 <table border="1" id="my-table">
   <thead>
     <tr>
      <th scope="col">#</th>
      <th scope="col">tanggal</th>
      <th scope="col">no. nota</th>
      <th scope="col">kasir</th>
      <th scope="col">kode barang</th>
      <th scope="col">jumlah</th>
      <th scope="col">sub total</th>
      <th scope="col">grand total</th>
      <!--  <th scope="col">Buttons</th> -->
    </tr>
  </thead>
  <tbody>

    <?php
    $ms = 1;
    foreach ($child as $key => $value) {
    ?>
    <tr>
     <th scope="row"><?= $ms++ ?></th>
     <td ><?= $value->tanggal ?></td>
     <td ><?= $value->nomor_nota ?></td>
     <td ><?= $value->nama_kasir ?></td>
     <td ><?= $value->nama_barang ?></td>
     <td ><?= $value->jumlah ?></td>
     <td ><?= $value->sub_total ?></td>
     <td ><?= $value->grand_total ?></td>
   </tr>
   <?php } ?>
 </tbody>
</table>
<br>

<script>
  window.onload = () => {
    const table = document.getElementById('my-table');
    exportTable(table, 'laporan_transaksi.xls');
  };

  function exportTable(table, filename) {
    const tableHTML = encodeURIComponent(table.outerHTML);
    const downloadLink = document.createElement('a');

    downloadLink.href = `data:application/vnd.ms-excel,${tableHTML}`;
    downloadLink.download = filename;
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
    window.close();
  }
</script>

</body>
</html>