@extends('../../../templatefrontend')


@section('content')
<style type="text/css">
    .title-page {
        margin-top: 6%;
        margin-bottom: 6%;
        font-weight: 700;
    }

    .fs-2r {
        font-size: 2rem;
    }

    .sub-title {
        margin-left: 10%;
        margin-right: 10%;
    }

    .img-tanya {
        width: 50%;
        margin: auto;
        margin-top: 20%;
        margin-bottom: 10%;
    }

    .tanya {
        padding-top: 10%;
        padding-bottom: 10%;
        background-color: #F5F5F5;
    }

    .tanya-box {
        border: 1px solid #C2262D;
    }

    .produk {
        padding-top: 10%;
        padding-bottom: 10%;
    }

    .produk img {
        padding: 0 100px 100px 100px;
    }
</style>
<h1 class="text-center title-page">Panduan Ekspor Anda</h1>

<div class="container">
    <div class="sub-title">
        <p class="text-center fs-2r">Melakukan ekspor tidak akan rumit lagi. Anda tinggal memperhatikan beberpa hal berikut sebelum melakukan ekspor</p>
    </div>

    <ol>
        <li>
            <b>Kenali Barang Anda</b>
            <p>Ketahui barang apa saja yang bisa dikirim. Lihat kategori berikut.</p>
            <ol>
                <li><b>General Cargo</b> (Elektronik & mesin
                    ,Barang konsumsi
                    ,Kendaraan & spareparts
                    ,Kain & Pakaian
                    ,Peralatan Rumah
                    ,Obat & kosmetik)</li>
                <li><b>Pertanian & Perikanan</b> (Buah & Sayuran
                    ,Bibit & tanaman
                    ,Perikanan
                    ,Kopi
                    ,Kayu & Furitur)</li>
                <li><b>Hewan Hidup</b> (Hewan peliharaaan
                    ,Serangga
                    ,Reptil
                    ,Unggas
                    ,Lainnya)</li>
            </ol>
        </li>
        <li>
            <b>Mengirimkan barang-barang berbahaya</b>
            <p>Kamu mungkin tidak menyadari bahwa barang kamu berbahaya. Itulah mengapa penting untuk memeriksa klasifikasi dan memastikan pengiriman kamu aman dan sesuai peraturan.</p>
            <ol>
                <li><b>Apa saja yang dianggap berbahaya?</b>
                    <p>Apapun yang, jika tidak ditangani dengan benar, dapat membahayakan Anda, pengemudi, penerima, pengiriman lainnya, atau lingkungan. Jika Anda tidak yakin apakah kiriman Anda adalah barang berbahaya atau tidak, tanyakan kepada produsen atau pemasok untuk Lembar Data Keamanan Bahan (MSDS). Jika terdapat nomor UN, berarti termasuk barang berbahaya. Atau, Anda bisa menghubungi kami.</p>
                </li>
                <li><b>Contoh barang-barang berbahaya</b>
                    <p>Mungkin Anda terkejut bila mengetahui sebagian barang merupakan bahan berbahaya, misalnya aerosol, parfum atau apa pun yang mengandung baterai lithium – misalnya telepon atau laptop.</p>
                    <p><b>Baterai lithium.</b> Jika dikemas dengan cara yang salah atau rusak saat transit, baterai lithium dapat mengalami korsleting, sehingga membuatnya terlalu panas dan terbakar.</p>
                    <p><b>Cat dan pernis.</b> Cat berbahan dasar minyak, cat semprot, dan beberapa pernis dapat menjadi terlalu panas dan terbakar dalam kondisi tertentu.</p>
                    <p><b>Semprotan dan aerosol.</b> Gas terkompresi yang membuat barang-barang ini berbahaya dan dapat meledak jika dikemas dengan tidak benar.</p>
                    <p><b>Parfum.</b> Alkohol, yang merupakan zat yang mudah terbakar, juga merupakan unsur penting di hampir semua parfum dan kolonye.</p>
                </li>
            </ol>
        </li>
        <li>
            <b>Mempersiapkan pengiriman Anda</b>
            <p>Mempersiapkan kiriman Anda dengan benar adalah cara terbaik untuk memastikan kiriman Anda tiba tepat waktu. Ini berarti menggunakan boks dengan ukuran yang tepat serta bahan kemasan dan label yang benar.</p>
            <ol>
                <li><b>Kemasan</b> (Box / kardus, Karung, Palet, Item besar)</li>
                <li><b>Memahami biaya pengiriman anda</b> 
                    <p>Berat volumetrik digunakan untuk menentukan berat paket, yang menentukan biaya pengiriman. Yang kami maksud dengan berat volumetrik adalah kepadatan paket, yang merupakan jumlah ruang yang ditempati sehubungan dengan berat sebenarnya – semakin besar kiriman Anda, semakin tinggi berat volumetriknya.</p>
                </li>
                <li><b>Cara mengemas dengan benar</b>
                    <p><b>Peraturan.</b> Untuk memastikan kiriman Anda tiba dengan selamat dan dalam kondisi yang sama sebagaimana saat pengiriman, Anda harus mematuhi peraturan pengemasan yang sesuai.</p>
                    <p><b>Pelabelan</b> Sangatlah penting memastikan label terlampir ke pengiriman Anda dengan benar karena label tersebut memberikan informasi penting bagi perusahaan jasa pengiriman, seperti tujuan dan bagaimana penanganannya.</p>
                    <p><b>Pengiriman rapuh dan bernilai tinggi</b> Jenis barang ini membutuhkan penanganan ekstra. Sehingga penting untuk memastikan barang ini terbungkus dan ditandai dengan benar guna mengurangi risiko kerusakan selama pengangkutan.</p>
                </li>
            </ol>
        </li>
        <li>
            <b>KETENTUAN PEMBAYARAN</b>
            <ol>
                <li>Nilai Invoice yang terbit dalam aplikasi atau website adalah nilai estimasi dari pengiriman yang akan dijalankan, 
                      Nilai Riil (Fixed Rate) akan diberitahukan setelah proses verifikasi yang dilakukan oleh Mister Exportir</li>
                <li>Biaya yang tercantum dalam Fixed Rate belum termasuk biaya pajak kepabeanan. </li>
                <li>Rate yang diberlakukan adalah hasil penghitungan berat atau volume barang dan layanan yang dipilih, dan 
                      berdasarkan perhitungan yang lebih besar antara Berat barang dan Volume Barang.</li>
                <li>Pengguna Pelayanan hanya melakukan Pembayaran ke rekening atas nama PT. Triton Nusantara Tangguh, selain       
                      pembayaran yang dikirimkan ke rekening tersebut tidak diakui oleh Mister Exportir.</li>
                <li>Pembayaran oleh pengguna layanan dipenuhi setelah Fixed Rate Diterbitkan  dan proses Ekspor tidak akan 
                      dilanjutkan sebelum pembayaran dipenuhi oleh pengguna Layanan </li>
                <li>Pengguna Layanan Menyetujui bahwa segala bentuk pembayaran shipment yang telah diberikan kepada Mister 
                      Exportir tidak bisa dikembalikan.</li>
            </ol>
        </li>
        <li>
            <b>Cara pengiriman internasional</b>
            <p>Pengiriman internasional tidak harus sulit, tetapi membereskan dokumen yang tepat dan memeriksa peraturan terkait sangatlah penting untuk memastikan pengiriman Anda melewati bea cukai dengan lancar.</p>
            <ol>
                <li><b>Kendali ekspor</b>
                    <p>Pastikan Anda mematuhi sanksi dan peraturan ekspor. Ketika mengirim barang ke seluruh dunia, penting untuk menyiapkan dokumen yang diperlukan sebelum mengirimkan. Selain itu, hal tersebut membantu untuk memahami arti dari beberapa istilah penting.</p>
                </li>
                <li><b>Izin bea cukai</b>
                    <p>Cari tahu cara mempersiapkan pengiriman Anda untuk bea cukai Ketika mengirim barang ke luar negeri, bea cukai dapat menyebabkan keterlambatan. Ketahui apa yang dapat diharapkan bila melakukan pengiriman internasional dan cara mempersingkat waktu di perbatasan. Hal-hal mendasar tentang perolehan izin bea cukai</p>
                    <p><b>Lihat peraturan pengiriman</b> Peraturan yang berbeda-beda di setiap negara membuat kegiatan ekspor juga bisa berbeda. Pastikan Anda benar-benar mengetahui perizinan, ketentuan khusus maupun barang yang dibatasi dan dilarang di negara tujuan pengiriman Anda.</p>
                    <p><b>Mempersiapkan dokumen</b> Mempersiapkan dokumen yang diperlukan merupakan hal yang sangat vital apabila tidak ingin barang Anda tertahan di perbatasan. Pastikan Anda menyertakan semua informasi yang diperlukan pada faktur komersial Anda, karena dengan cara itulah pihak bea cukai akan mengklasifikasi dan memproses pengiriman Anda</p>
                    <p><b>Bea & pajak</b> Pengiriman internasional kadang bertanggung jawab untuk dikenai bea masuk dan pajak, tapi bukan berarti Anda harus melakukan kesalahan. Karena bea masuk dan pajak masing-masing negara tidak sama sesuai dengan negara tujuan dan nilai barang yang dikirim, pastikan Anda atau penerima benar-benar mengetahui apa saja yang harus dibayar.</p>
                </li>
            </ol>
        </li>
    </ol>
</div>

<!-- Latest compiled and minified JavaScript -->
<style type="text/css">
    ol {
        counter-reset: item;
    }

    ol li {
        display: block;
    }

    ol li:before {
        content: counters(item, ".") " ";
        counter-increment: item;
        font-weight: 700;
    }
</style>
@endsection