<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        $(document).ready(function () {
            console.log("jQuery version:", $.fn.jquery); // Check jQuery version

            function formatRupiah(amount) {
                return 'Rp. ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function cleanRupiah(value) {
                return parseFloat(value.replace(/[^0-9]/g, '')) || 0;
            }

            function fetchBarangData(query, inputElement) {
                $.ajax({
                    url: "<?= base_url('home/search'); ?>",
                    method: "GET",
                    data: { query: query },
                    dataType: "json",
                    success: function (data) {
                        const resultsContainer = inputElement.siblings('.search-results');
                        resultsContainer.empty().show();

                        if (data.length > 0) {
                            data.forEach(item => {
                                resultsContainer.append(`<div class="p-2 cursor-pointer search-item" data-kode="${item.kode_barang}" data-nama="${item.nama_barang}" data-harga="${item.harga_satuan}">${item.kode_barang} - ${item.nama_barang}</div>`);
                            });
                        } else {
                            resultsContainer.append(`<div class="p-2 text-gray-500">Barang tidak ditemukan</div>`);
                        }
                    }
                });
            }

            function calculateSubTotal(row) {
                const harga = cleanRupiah(row.find('.harga-barang').text()) || 0;
                const qty = parseFloat(row.find('.qty-input').val()) || 1;
                const subTotal = harga * qty;
                row.find('.subtotal-barang').text(formatRupiah(subTotal));
                calculateTotal();
            }

            function calculateTotal() {
                let total = 0;
                $('.subtotal-barang').each(function () {
                    total += cleanRupiah($(this).text()) || 0;
                });
                $('.total-value').text(formatRupiah(total));
                calculateKembali();
            }

            function calculateKembali() {
                let bayar = cleanRupiah($('.bayar-input-raw').val()) || 0;
                let total = cleanRupiah($('.total-value').text()) || 0;
                let kembali = bayar - total;

                $('.kembali-input').val(formatRupiah(kembali));
                $('.kembali-input-raw').val(kembali); // Store raw value in hidden input

                // Enable/disable buttons based on kembali AND initial state
                if (kembali < 0) {
                    $('.cetak-btn, .simpan-btn').prop('disabled', true).addClass('opacity-50 cursor-not-allowed');
                } else if (total > 0) {
                    $('.cetak-btn, .simpan-btn').prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
                }
            }

            function addNewRow() {
                const newRow = `
                <tr class="barang-row">
                <td class="border border-gray-300 p-2 text-center">${$('.barang-row').length + 1}</td>
                <td class="border border-gray-300 p-2 relative">
                <input type="text" placeholder="Klik Kode / Nama Barang" class="w-full p-2 rounded border border-gray-300 kode-barang-input">
                <div class="absolute w-full bg-white shadow-md z-10 hidden search-results"></div>
                </td>
                <td class="border border-gray-300 p-2 nama-barang"></td>
                <td class="border border-gray-300 p-2 harga-barang"></td>
                <td class="border border-gray-300 p-2">
                <input type="number" min="1" value="1" class="w-16 border rounded p-1 qty-input text-center">
                </td>
                <td class="border border-gray-300 p-2 subtotal-barang">0</td>
                <td class="border border-gray-300 p-2 text-center">
                <button class="text-red-500 remove-item"><i class="fas fa-times"></i></button>
                </td>
                </tr>
                `;
                $('tbody').append(newRow);
                updateRowNumbers();
            }

            $(document).on('input', '.kode-barang-input', function () {
                const input = $(this);
                const query = input.val();

                if (query.length > 0) {
                    fetchBarangData(query, input);
                } else {
                    input.siblings('.search-results').hide();
                }
            });

            $(document).on('click', '.search-item', function () {
                const item = $(this);
                const row = item.closest('.barang-row');
                row.find('.kode-barang-input').val(item.data('kode'));
                row.find('.nama-barang').text(item.data('nama'));
                row.find('.harga-barang').text(formatRupiah(item.data('harga'))); // Format harga
                row.find('.search-results').hide();

                // Set default quantity to 1 and trigger subtotal calculation
                row.find('.qty-input').val(1);
                calculateSubTotal(row); // Automatically calculate subtotal

                addNewRow();
            });

            $(document).on('input', '.qty-input', function () {
                const row = $(this).closest('.barang-row');
                calculateSubTotal(row);
            });

            $(document).on('click', '.remove-item', function () {
                $(this).closest('.barang-row').remove();
                calculateTotal();
            });

            // Handle Bayar input
            $('.bayar-input').on('input', function () {
                let bayar = cleanRupiah($(this).val());
                $(this).val(formatRupiah(bayar)); // Display formatted value
                $('.bayar-input-raw').val(bayar); // Store raw value in hidden input
                calculateKembali();
            });

            // Ensure buttons are disabled on page load
            $(document).ready(function () {
                $('.cetak-btn, .simpan-btn').prop('disabled', true).addClass('opacity-50 cursor-not-allowed');
                calculateTotal(); // Ensure total is calculated on load
                calculateKembali(); // Ensure kembali is calculated on load
            });

            addNewRow();

            function updateRowNumbers() {
                $('.barang-row').each(function (index) {
                    $(this).find('td:first-child').text(index + 1);
                });
            }

            $('.reset-btn').on('click', function () {
                // $('tbody').empty();
                // $('.total-value').text("Rp. 0");
                // $('.bayar-input, .kembali-input').val('');
                // addNewRow();
                location.reload(); // Refresh the page after transaction
            });

            $('.add-row-btn').on('click', function () {
                addNewRow();
            });

            $(document).on('click', '.remove-item', function () {
                $(this).closest('.barang-row').remove();
                updateRowNumbers();
            });

            function getTransactionData() {
                let items = [];
                $('.barang-row').each(function () {
                    let kode = $(this).find('.kode-barang-input').val();
                    let qty = parseInt($(this).find('.qty-input').val()) || 0;
                    let harga = cleanRupiah($(this).find('.harga-barang').text()) || 0;
                    let subtotal = harga * qty;

                    if (kode && qty > 0) {
                        items.push({
                            kode_barang: kode,
                            jumlah: qty,
                            sub_total: subtotal
                        });
                    }
                });

                return {
                    grand_total: cleanRupiah($('.total-value').text()) || 0,
                    bayar: cleanRupiah($('.bayar-input-raw').val()) || 0,
                    kembali: cleanRupiah($('.kembali-input').val()) || 0,
                    id_kasir: $('select[name="kasir"]').val(),
                    tanggal: new Date().toISOString().slice(0, 19).replace("T", " "),
                    items: items
                };
            }

            $('.cetak-btn, .simpan-btn').on('click', function () {
                console.log("Button clicked!"); // Debugging line
                let bayar = cleanRupiah($('.bayar-input-raw').val()) || 0;

                if (bayar <= 0) {
                    alert('Harap masukkan jumlah pembayaran sebelum melanjutkan!');
                    $('.bayar-input').focus();
                    return;
                }

                let transactionData = getTransactionData();
                console.log("Transaction Data:", transactionData); // Debugging line
                let action = $(this).hasClass('cetak-btn') ? 'cetak' : 'simpan';

                $.post("<?= base_url('home/processTransaction'); ?>", 
                    { data: JSON.stringify(transactionData), action: action }, 
                    function(response) {
                        console.log("Response:", response); // Debugging line
                        if (response.success) {
                            alert(action === 'cetak' ? 'Transaksi berhasil dan siap dicetak!' : 'Transaksi berhasil disimpan!');

                            if (action === 'cetak') {
                                let printUrl = "<?= base_url('home/print_nota'); ?>/" + response.nomor_nota;
                                window.open(printUrl, '_blank');
                            }
                        } else {
                            alert('Terjadi kesalahan: ' + response.error);
                        }
                    }, "json"
                );
            });
        });
    </script>
</head>
<body class="bg-gray-200">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="flex">
                <!-- Informasi Nota Section -->
                <div class="w-1/3 p-4 bg-blue-500 text-white rounded-lg">
                    <h2 class="text-lg font-semibold mb-4"><i class="fas fa-info-circle"></i> Informasi Nota</h2>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Tanggal</label>
                        <input type="text" 
                        value="<?= date_default_timezone_set('Asia/Jakarta') ? date('Y-m-d H:i:s') : ''; ?>" 
                        class="w-full p-2 mt-1 rounded border border-gray-300 text-black" 
                        readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Kasir</label>
                        <input 
                        type="text" 
                        class="w-full p-2 mt-1 rounded border border-gray-300 text-black" 
                        value="<?= $kasir ? $kasir->nama_kasir . ' - ' . $kasir->id_kasir : '' ?>" 
                        readonly
                        >
                    </div>
                </div>

                <!-- Table Section -->
                <div class="w-2/3 p-4">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 p-2">#</th>
                                <th class="border border-gray-300 p-2">Kode Barang</th>
                                <th class="border border-gray-300 p-2">Nama Barang</th>
                                <th class="border border-gray-300 p-2">Harga</th>
                                <th class="border border-gray-300 p-2">Qty</th>
                                <th class="border border-gray-300 p-2">Sub Total</th>
                                <th class="border border-gray-300 p-2"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be dynamically added here -->
                        </tbody>
                    </table>
                    <div class="flex justify-between items-center mt-4 p-4 bg-blue-100 rounded-lg">
                        <span class="text-lg font-semibold">Total : <span class="total-value">Rp. 0</span></span>
                    </div>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="flex justify-end mt-4">
                <div class="w-1/3">
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Bayar</label>
                        <input type="hidden" class="bayar-input-raw" value="0">
                        <input type="text" class="w-full p-2 mt-1 rounded border border-gray-300 bayar-input" placeholder="Masukkan jumlah bayar" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Kembali</label>
                        <input type="hidden" class="kembali-input-raw" value="0">
                        <input type="text" class="w-full p-2 mt-1 rounded border border-gray-300 kembali-input" readonly>
                    </div>
                    <div class="flex justify-between">
                        <button class="bg-orange-500 text-white px-4 py-2 rounded-lg cetak-btn">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg simpan-btn">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                    <div class="flex justify-between mt-4">
                        <button class="bg-red-500 text-white px-4 py-2 rounded-lg reset-btn">
                            <i class="fas fa-trash"></i> Reset
                        </button>
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg add-row-btn">
                            <i class="fas fa-plus"></i> Tambah Baris
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>