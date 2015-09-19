<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Instruksi Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<div>
    <h3>Kode pembayaran <i>Virtual Account</i>:</h3>
    <h3 >{!! $result->permata_va_number !!}</h3>
    <h3>Nominal pembayaran :</h3>
    <h3 >Rp {!! number_format(Session::get('DATA_COSTUMER')['TRAVEL_TRANSACTION_PRICE']) !!}</h3>

    <div>
        <h4>
            Pembayaran lewat ATM BCA/Jaringan ATM Prima
        </h4>
        <ol>
            <li>Masukkan PIN Anda.</li>
            <li>Di Menu utama, Pilih <strong>Transaksi Lainnya</strong>.</li>
            <li>Pilih <strong>Transfer</strong>.</li>
            <li>Pilih <strong>Ke Rek Bank Lain</strong>.</li>
            <li>Masukkan kode <strong>013</strong> untuk Bank Permata lalu tekan <strong>Benar</strong>.</li>
            <li>Masukkan jumlah harga tiket yang akan Anda bayar secara lengkap (tanpa pembulatan). Pembayaran untuk dua no. pesanan harus dilakukan secara terpisah. Setelah itu tekan <strong>Benar</strong>.</li>
            <li>Masukkan <strong>{!! $result->permata_va_number !!}</strong> (16 digit no. <i>virtual account</i> pembayaran) lalu tekan <strong>Benar</strong>.</li>
            <li>Di halaman konfirmasi transfer akan muncul jumlah yang dibayarkan dan no. rekening tujuan. Jika informasinya telah sesuai tekan <strong>Benar</strong>.</li>
            <li>Transaksi berhasil.</li>
        </ol>
    </div>
    <div>
        <h4>
            Pembayaran lewat ATM Mandiri/Jaringan ATM Bersama
        </h4>
        <ol style="display: block;">
            <li>Masukkan PIN Anda.</li>
            <li>Di Menu utama, pilih <strong>Transaksi Lainnya</strong>.</li>
            <li>Pilih <strong>Transfer</strong>.</li>
            <li>Pilih Ke <strong>Rekening Bank Lain ATM Bersama/Link</strong>.</li>
            <li>Masukkan nomor <strong>013{!! $result->permata_va_number !!}</strong> (kode 013 dan 16 digit <i>Virtual account</i>).</li>
            <li>Masukkan jumlah harga tiket yang akan Anda bayar secara lengkap (tanpa pembulatan). Pembayaran untuk dua no. pesanan harus dilakukan secara terpisah. Setelah itu tekan <strong>Benar</strong>.</li>
            <li>No. referensi dapat dikosongkan, lalu tekan <strong>Benar</strong>.</li>
            <li>Di halaman konfirmasi transfer akan muncul jumlah yang dibayarkan dan no. rekening tujuan. Jika informasinya telah sesuai tekan <strong>Benar</strong>.</li>
            <li>Transaksi Berhasil.</li>
        </ol>
    </div>
    <div>
        <h4>
            Pembayaran lewat ATM Bank Permata
        </h4>
        <ol>
            <li>Masukkan PIN Anda.</li>
            <li>Di Menu Utama, pilih <strong>Transaksi Lainnya</strong>.</li>
            <li>Pilih <strong>Transaksi Pembayaran</strong>.</li>
            <li>Pilih <strong>Lain-lain</strong>.</li>
            <li>Pilih <strong>Pembayaran Virtual Account</strong>.</li>
            <li>Masukkan 16 digit no. <i>Virtual Account</i> <strong>{!! $result->permata_va_number !!}</strong>.</li>
            <li>Di halaman konfirmasi transfer akan muncul jumlah yang dibayarkan dan no. rekening tujuan. Jika informasinya telah sesuai tekan <strong>Benar</strong>.</li>
            <li>Pilih rekening pembayaran Anda dan tekan <strong>Benar</strong>.</li>
        </ol>
    </div>
    <div>
        <h4>
            Pembayaran lewat ATM Alto
        </h4>
        <ol>
            <li>Masukkan PIN Anda.</li>
            <li>Di Menu utama, Pilih <strong>Transaksi Lainnya</strong>.</li>
            <li>Pilih <strong>Transfer</strong>.</li>
            <li>Pilih <strong>Ke Rek Bank Lain</strong>.</li>
            <li>Masukkan kode <strong>013</strong> untuk Bank Permata lalu tekan <strong>Benar</strong>.</li>
            <li>Masukkan jumlah harga tiket yang akan Anda bayar secara lengkap (tanpa pembulatan). Pembayaran untuk dua no. pesanan harus dilakukan secara terpisah. Setelah itu tekan <strong>Benar</strong>.</li>
            <li>Masukkan <strong>013{!! $result->permata_va_number !!}</strong> (kode 013 dan 16 digit no. <i>virtual account</i> pembayaran) lalu tekan <strong>Benar</strong>.</li>
            <li>Di halaman konfirmasi transfer akan muncul jumlah yang dibayarkan, no. rekening tujuan serta detail penumpang. Jika informasinya telah cocok tekan <strong>Benar</strong>.</li>
            <li>Transaksi berhasil.</li>
        </ol>
    </div>
</div>
</body>
</html>