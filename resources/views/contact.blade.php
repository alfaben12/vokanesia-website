@extends('layouts.base')

@section('body')
    <!-- inner banenr start -->
    <!--breadcumb start here-->
    <section class="inner-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-banner-content">
                        <h1 class="inner-banner-title">Hubungi Kami</h1>
                        <ul class="breadcumbs list-inline">
                            <li><a href="index.html">Beranda</a></li>
                            <li>Hubungi Kami</li>
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

    <!-- contact info strart -->
    <section class="xs-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="xs-heading text-center style4">
                        <h2 class="section-title">Hubungi Kami</h2>
                        <span class="line"></span>
                        <p>Anda bisa menghubungi kami melalui informasi di bawah ini :</p>
                    </div><!-- .xs-heading END -->
                </div>
            </div><!-- .row END -->
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="contact-info-wraper">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="single-contact-info">
                                    <div class="round-icon">
                                        <i class="icon icon-map-marker2"></i>
                                    </div><!-- .round-icon END -->
                                    <a href="https://www.google.com/maps/place/New+York,+NY,+USA/@40.6971494,-74.2598712,10z/data=!3m1!4b1!4m5!3m4!1s0x89c24fa5d33f083b:0xc80b8f06e177fe62!8m2!3d40.7127753!4d-74.0059728"
                                        target="_blank" class="info-content">Green Living Residence C14, Malang, Jawa
                                        Timur</a>
                                </div><!-- .single-contact-info END -->
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="single-contact-info">
                                    <div class="round-icon">
                                        <i class="icon icon-phone-call3"></i>
                                    </div><!-- .round-icon END -->
                                    <a href="callto:0341-8205510" class="info-content">0341-8205510</a>
                                </div><!-- .single-contact-info END -->
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="single-contact-info">
                                    <div class="round-icon">
                                        <i class="icon icon-envelope4"></i>
                                    </div><!-- .round-icon END -->
                                    <a href="mailto:halo@vokanesia.id" class="info-content">halo@vokanesia.id</a>
                                </div><!-- .single-contact-info END -->
                            </div>
                        </div><!-- .row END -->
                    </div><!-- .contact-info-wraper END -->
                </div>
            </div><!-- .row END -->
        </div><!-- .container END -->
    </section><!-- end contact info -->

    <!-- search panel strart -->
    <!-- xs modal -->
    <div class="zoom-anim-dialog mfp-hide modal-searchPanel" id="modal-popup-2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="xs-search-panel">
                    <form action="#" method="POST" class="xs-search-group">
                        <input type="search" class="form-control" name="search" id="search" placeholder="Search">
                        <button type="submit" class="search-button"><i class="icon icon-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End xs modal -->
@endsection