@extends('layouts.base')

@section('body')
    <!--breadcumb start here-->
    <section class="inner-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-banner-content">
                        <h1 class="inner-banner-title">Tentang Kami</h1>
                        <ul class="breadcumbs list-inline">
                            <li><a href="index.html">Beranda</a></li>
                            <li>Tentang Kami</li>
                        </ul>
                        <span class="border-divider style-white"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-image" style="background-image:url('assets/images/backgrounds/background-1.jpg')"></div>
    </section>
    <!--breadcumb end here-->
    <!-- inner banenr end -->

    <!-- seo info section -->
    <section class="xs-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="xs-info-wraper style2 wow fadeInUp">
                        <div class="xs-heading">
                            <h2 class="section-title">PT. Vokasi Indonesia Sejahtera</h2>
                            <span class="line"></span>
                        </div>
                        <p>Vokanesia.id (PT Vokasi Indonesia Sejahtera) adalah sebuah perusahaan start-up yang bergerak
                            di bidang teknologi edukasi (edu-tech). Vokanesia.id menyediakan suatu platform edukasi
                            online. Siapapun dapat belajar materi pembelajaran yang diinginkan langsung dari
                            mentor-mentor ahli yang terbaik di Indonesia. Para ahli ialah praktisi di bidang industri
                            maupun akademisi yang akan membantu Anda mengembangkan skill vokasi yang Anda miliki.</p>
                        <p>Vokanesia.id juga menyediakan materi pembelajaran yang lengkap, eksklusif dan berjangka
                            panjang untuk semua level mulai dari pemula hingga profesional. Dikemas dalam kualitas high
                            definition video dengan gambar yang tajam, mudah diakses kapan pun dan di mana saja, baik
                            melalui gawai maupun PC Anda.</p>
                        <p>Vokanesia.id siap menjadi sarana pembelajaran bagi yang ingin belajar vokasi dari mentor
                            terbaik di Indonesia dan luar negeri.</p>
                    </div><!-- .xs-info-wraper END -->
                </div>
                <div class="col-lg-6">
                    <div class="video-popup-wraper">
                        <div class="xs-info-img">
                            <img src="{{asset('upturn/images/info/info-1.png')}}" alt="">
                        </div>
                        <div class="video-content text-center">
                            <a href="https://www.youtube.com/watch?v=dnGs2eOE6hQ"
                                class="xs-video-popup video-popup-btn pulse-effect">
                                <i class="icon icon-play2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- .row END -->
        </div><!-- .container END -->
    </section><!-- END seo info section -->

    <!-- seo info section -->
    <section class="xs-section-padding gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="xs-info-wraper style2 wow fadeInUp">
                        <div class="xs-heading">
                            <h3 class="section-title">Visi dan Misi</h3>
                            <span class="line"></span>
                        </div>
                        <p>Menjadi edu-tech vokasi terbaik di indonesia.</p>
                        <ul class="xs-list check">
                            <li>Memberikan kualitas terbaik dan penyajian yang dapat diterima semua orang.</li>
                            <li>Menjadi edu-tech inovatif dalam dunia vokasi.</li>
                            <li>Membentuk kerja sama dengan industri untuk menghasilkan kualitas vokasi terbaik.</li>
                            <li>Mencetak generasi penerus bangsa yang unggul dan berdaya saing tinggi.</li>
                            <li>Menjalin kerja sama dengan mentor-mentor ahli dan berkualitas terbaik dari dalam dan
                                luar negeri.</li>
                        </ul>
                        <div class="btn-wraper">
                            <a href="#" class="btn btn-primary style2 icon-right"><i
                                    class="icon icon-arrow-right"></i>Get Our Service</a>
                        </div>
                    </div><!-- .xs-info-wraper END -->
                </div>
                <div class="col-lg-6">
                    <div class="xs-info-img">
                        <img src="assets/images/info/info-2.png" alt="">
                    </div>
                </div>
            </div><!-- .row END -->
        </div><!-- .container END -->
    </section><!-- END seo info section -->
@endsection