@extends('layout.home')

@section('title','Home')

@section('content')
<div class="row">
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                        <img src="img/about-img.jpg" class="img-fluid w-100 h-100" alt="">
                    </div>
                </div>
                <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                    <h5 class="section-about-title pe-3">Tentang Kami </h5>
                    <h1 class="mb-4">Selamat datang di <span class="text-primary">Travela</span></h1>
                    <p class="mb-4">Kami adalah penyedia solusi pemesanan tiket yang inovatif dan handal, menawarkan akses mudah dan cepat ke destinasi di seluruh dunia. Dengan pengalaman yang luas dan komitmen kami untuk memberikan layanan terbaik kepada pelanggan, kami hadir untuk membuat perjalanan Anda menjadi pengalaman yang menyenangkan dan tak terlupakan.</p>
                    <p class="mb-4">Di Travela, kami memahami betapa pentingnya perjalanan bagi Anda. Itulah sebabnya kami berdedikasi untuk menyediakan platform pemesanan yang mudah digunakan, dengan rangkaian produk dan layanan yang luas, mulai dari tiket pesawat hingga kereta api, acara, dan wisata.</p>
                    <p class="mb-4">Kami menempatkan kepuasan pelanggan sebagai prioritas utama. Dengan tim yang berpengalaman dan berkomitmen tinggi, kami selalu siap membantu Anda dalam setiap tahap perjalanan Anda. Dari memilih destinasi hingga saat Anda kembali ke rumah, kami akan memberikan dukungan dan bantuan yang Anda butuhkan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

