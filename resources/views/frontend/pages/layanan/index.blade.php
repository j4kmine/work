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
<h1 class="text-center title-page">Layanan Ekspor Lengkap</h1>

<div class="container">
    <div class="sub-title">
        <p class="text-center fs-2r">Kami mengirimkan barang dan melayani kebutuhan ekspor Anda dengan layanan lengkap dan mudah. Ketahui lebih lanjut apa saja layanan kami yang dapat membantu bisnis Anda.</p>
    </div>

    <section class="tanya">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title"><b>Apa yang kami tawarkan?</b></h5>
                        <p class="card-text">Layanan ekspor lengkap dan mudah</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title"><b>Siapa yang dapat menggunakan?</b></h5>
                        <p class="card-text">Untuk semua kalangan dari pemula hingga perusahaan</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title"><b>Bagaimana cara kerjanya?</b></h5>
                        <p class="card-text">Rencanakan pengiriman dan pantau prosesnya</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="produk">
        <div class="row">
            <div>
                <div class="col-md-8">
                    <h1>Pengurusan Izin Ekspor</h1>
                    <p>Kami menyediakan lisensi ekspor untuk berbagai bidang/ komoditas barang baik yang memiliki larangan pembatasan (Lartas) maupun tidak. Kami juga mlayani administrasi pengiriman dari gudang ke Pelabuhan muat / Bongkar yang berhubungan dengan Kepabeanan.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{url('frontend/assets')}}/images/dokumen.png" class="img-responsive">
                </div>
            </div>
            <div>
                <div class="col-md-8">
                    <h1>Pengiriman Udara</h1>
                    <p>Pengiriman via udara / pesawat salah satu moda pengiriman yang kami sediakan. Kelebihan menggunakan pesawat tentu durasi pengiriman lebih cepat. Jenis layanan yang tersedia berupa: LCL dan Full Air Charter. </p>
                </div>
                <div class="col-md-4">
                    <img src="{{url('frontend/assets')}}/images/pesawat.png" class="img-responsive">
                </div>
            </div>
            <div>
                <div class="col-md-8">
                    <h1>Pengiriman Laut</h1>
                    <p>Mode Pengiriman via laut / kapal laut tersedia beberapa jenis layanan yaiu: Less Container Load (LCL), Full Container Load 20 ft (FCL 20”), Full Container Load 40 ft (FCL 40”), dan 4. break bulk. Layanan tersebut akan disesuaikan degan kebutuhan pengguna.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{url('frontend/assets')}}/images/kapal.png" class="img-responsive">
                </div>
            </div>
            <div>
                <div class="col-md-8">
                    <h1>Pelacakan Pengiriman</h1>
                    <p>Setelah memilih layanan yang tersedia, pengguna dapat memantau semua proses ekspor melalui Xportir. Sehingga ekspor menjadi lebih mudah.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{url('frontend/assets')}}/images/rute.png" class="img-responsive">
                </div>
            </div>
        </div>
    </section>
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