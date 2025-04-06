<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nota Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .receipt {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .receipt h2 {
            text-align: center;
            margin: 0;
            font-size: 1.5em;
        }
        .receipt .header, .receipt .footer {
            text-align: center;
            margin-bottom: 15px;
            font-size: 0.9em;
        }
        .receipt table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        .receipt table th, .receipt table td {
            text-align: left;
            font-size: 0.85em;
            padding: 5px 0;
            border-bottom: 1px dashed #ccc;
        }
        .receipt .total-row td {
            font-weight: bold;
        }
        .receipt .right {
            text-align: right;
        }
        .receipt .center {
            text-align: center;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .receipt {
                width: 400px;
                margin: 0 auto;
                box-shadow: none;
                border: none;
            }
            .receipt h2 {
                font-size: 1.4em;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h2>NOTA KASIR</h2>
        <div class="header">
            app. WEB, kasir minimarket <br>
            Telp: (248) 434-5508
        </div>

         <?php 
        if (!empty($child)): 
        ?>

        <!-- Display Nota Details -->
        <table>
            <tr>
                <td><b>No. Nota:</b></td>
                <td class="right"><?= esc($child[0]->nomor_nota) ?></td>
            </tr>
            <tr>
                <td><b>Tanggal:</b></td>
                <td class="right"><?= esc($child[0]->tanggal) ?></td>
            </tr>
            <tr>
                <td><b>Kasir:</b></td>
                <td class="right"><?= esc($child[0]->nama_kasir) ?></td>
            </tr>
        </table>

        <hr>

        <!-- Display Barang Details -->
        <table>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            <?php 
            $no = 1;
            foreach ($child as $item): 
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($item->nama_barang) ?></td>
                <td class="center"><?= esc($item->jumlah) ?></td>
                <td class="right">Rp <?= number_format($item->sub_total, 0, ',', '.') ?></td>
            </tr>
            <?php 
            endforeach; 
            ?>
        </table>

        <hr>

        <!-- Display Grand Total -->
        <table>
            <tr>
                <td><b>Grand Total</b></td>
                <td class="right">Rp <?= number_format($child[0]->grand_total, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td><b>Bayar</b></td>
                <td class="right">Rp <?= number_format($child[0]->bayar, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td><b>Kembali</b></td>
                <td class="right">Rp <?= number_format($child[0]->kembali, 0, ',', '.') ?></td>
            </tr>
        </table>
        
        <?php else: ?>
            <p style="text-align: center; color: red;">Data tidak ditemukan.</p>
        <?php endif; ?>

        <hr>

        <div class="footer">
            Terima kasih telah berbelanja!<br>
            <i>Have a nice day!</i>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>