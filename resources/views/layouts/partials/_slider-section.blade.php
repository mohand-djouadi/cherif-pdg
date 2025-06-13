<section id="hero" class="hero" style="">
    <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                {{-- <div class="col-lg-6 text-center">
                    <h2 class="pt-3 ">GTM</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <a href="#get-started" class="btn-get-started">Get Started</a>
                </div> --}}
                {{-- <div class=" col-lg-6 text-center" style="position: absolute; bottom: 13em; z-index: 99999; max-width: 35%;width: 50%; ">
                    <div style=" display: -webkit-inline-box;">
                        <div data-aos="fade-right" data-aos-delay="1000" class="d-flex align-items-center bg-blue btn_service">
                            <p style="font-size: 2vw; font-weight: bold; padding: 0 10px;/* margin-right: 16px;*/">NOS MISSIONS </p>
                        </div>
                        <div data-aos="fade-left" data-aos-delay="2000" class="d-flex ">

                            <a href="{{ route('missions-controle-technique') }}" class="btn-get-started btn_service">
                                <img src="img/control_icon.png" alt="" class="img_service"> <br>
                                Contrôle Technique</a>
                            <a href="{{ route('missions-diagnostic-expertise') }}" class="btn-get-started btn_service">
                                <img src="img/diagnostic_icon.png" alt="" class="img_service"> <br>
                                Diagnostic &amp; Expertise</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        {{-- <div class="carousel-item active" style="background-image: url(img/hero-carousel/1.jpg)"></div>
        <div class="carousel-item" style="background-image: url(img/hero-carousel/2.jpg)"></div>
        <div class="carousel-item" style="background-image: url(img/hero-carousel/3.jpg)"></div>
        <div class="carousel-item" style="background-image: url(img/hero-carousel/4.jpg)"></div> --}}
        {{-- <div class="carousel-item">
            <img src="/img/slider/actu_1.jpg" alt="">
        </div>

        <div class="carousel-item ">
            <img src="/img/slider/actu_2.jpg" alt="">
        </div> --}}

        {{-- <div class="carousel-item ">
            <img src="/img/slider/actu_3.jpg" alt="">
        </div> --}}


        

        @foreach ($images as $image)
            <div class="carousel-item {{ $image->image_principale ? 'active' : '' }}">
                <img src="{{ asset($image->img_path) }}" alt="">
            </div>
        @endforeach


        {{-- <div class="carousel-item active">
            <img src="/img/slider/actu_4.jpg" alt="">
        </div>

        <div class="carousel-item">
            <img src="/img/slider/slider.jpg" alt="">
        </div>
        <div class="carousel-item">
            <img src="/img/slider/slider_2.jpg" alt="">
        </div>
        <div class="carousel-item">
            <img src="/img/slider/slider_3.jpg" alt="">
        </div>
        <div class="carousel-item">
            <img src="/img/slider/slider_4.jpg" alt="">
        </div>
        <div class="carousel-item">
            <img src="/img/slider/slider_5.jpg" alt="">
        </div> --}}


        {{-- <div class="carousel-item">
            <img src="assets/img/hero-carousel/hero-carousel-5.jpg" alt="">
          </div> --}}
        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>
    </div>
</section>


<style>
    .hero .info h2:before {
        content: "";
        position: absolute;
        display: block;
        width: 80px;
        height: 4px;
        background: var(--color-primary);
        left: 0;
        right: 0;
        top: 0;
        margin: auto;
    }

    .hero .carousel-item::before {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
</style>
