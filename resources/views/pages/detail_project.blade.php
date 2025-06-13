@extends('layouts/master', ['title' => 'Détail du projet'])
@push('custom-styles')
    <!-- Timeline CSS -->
    <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">
    <style>
        /*--------------------------------------------------------------
    # Alt Services Section
    --------------------------------------------------------------*/
        .alt-services .features-image {
            position: relative;
            min-height: 400px;
        }

        .alt-services .features-image img {
            position: absolute;
            inset: 0;
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .alt-services h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 20px;
            position: relative;
        }

        .alt-services h3:after {
            content: "";
            background: var(--accent-color);
            position: absolute;
            display: block;
            width: 50px;
            height: 3px;
            left: 0;
            bottom: 0;
        }

        .alt-services .icon-box {
            margin-top: 40px;
        }

        .alt-services .icon-box i {
            color: var(--accent-color);
            background-color: var(--contrast-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 25px;
            font-size: 28px;
            width: 56px;
            height: 56px;
            border-radius: 4px;
            line-height: 0;
            box-shadow: 0px 2px 30px color-mix(in srgb, var(--default-color), transparent 90%);
            transition: 0.3s;
        }

        .alt-services .icon-box:hover i {
            background-color: var(--accent-color);
            color: var(--contrast-color);
        }

        .alt-services .icon-box h4 {
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .alt-services .icon-box h4 a {
            color: var(--heading-color);
            transition: 0.3s;
        }

        .alt-services .icon-box h4 a:hover {
            color: var(--accent-color);
        }

        .alt-services .icon-box p {
            line-height: 20px;
            font-size: 14px;
            margin-bottom: 0;
        }
    </style>
@endpush
<title> Détail du projet </title>
@section('main')
    <!-- ======= Titel Page ======= -->
    @include('layouts.partials._page_Title', ['title' => ' Détail du projet '])
    <!-- Titel Page -->


    <!-- Alt Services Section -->
    <section id="alt-services" class="alt-services section">

        <div class="container">

            <div class="row justify-content-around gy-4">
                <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100">

                    {{-- <img src="{{ asset('assets/img/alt-services.jpg')}}" alt=""> --}}
                    <div class="project-details section" style="height: 100% !important;">
                        <div class="portfolio-details-slider swiper   " style="height: 100% !important;">
                            <script type="application/json" class="swiper-config">
                               {
                               "loop": true,
                               "speed": 600,
                               "autoplay": {
                                 "delay": 3000
                               },
                               "slidesPerView": "auto",
                               "navigation": {
                                 "nextEl": ".swiper-button-next",
                                 "prevEl": ".swiper-button-prev"
                               },
                               "pagination": {
                                 "el": ".swiper-pagination",
                                 "type": "bullets",
                                 "clickable": true
                               }
                             }
                           </script>
                            <div class="swiper-wrapper  align-items-center" style="height: 100% !important;">
                                @foreach ($projet->images as $image)
                                    <div class="swiper-slide  " style="height: 100% !important;">
                                        {{-- <div class="features-image "> --}}

                                            <img src="{{ asset($image->path) }}" alt="Image">
                                            <a href="{{asset($image->path)}}" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                                        {{-- </div> --}}

                                    </div>
                                @endforeach



                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-pagination"></div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <h3>{{ $projet->intitule }}</h3>
                    <p></p>

                        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-building"></i>
                            {{-- <i class="bi bi-easel flex-shrink-0"></i> --}}
                            <div>
                                <h4><a href="" class="stretched-link"> Entreprise de réalisation :</a></h4>
                                <p>(  {{$projet->filiale->sigle_commercial}}  ) : {{ $projet->filiale->denomination }}  </p>
                            </div>
                        </div>

                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">

                        <i class="bi bi-person-check"></i>

                        <div>
                            <h4><a href="" class="stretched-link"> Maître d'ouvrage :</a></h4>
                            <p>{{ $projet->maitre_ouvrage }}</p>
                        </div>
                    </div><!-- End Icon Box -->
                    @php
                        use Carbon\Carbon;
                    @endphp
                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
                        {{-- <i class="bi bi-patch-check flex-shrink-0"></i> --}}
                        <i class="bi bi-calendar"></i>

                        <div>
                            <h4><a href="" class="stretched-link">Durée</a></h4>
                            <p>{{ $projet->duree }} </p>

                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="500">
                        {{-- <i class="bi bi-brightness-high flex-shrink-0"></i> --}}
                        <i class="bi bi-currency-dollar"></i>
                        {{-- <i class="bi bi-bank"></i> --}}


                        <div>
                            <h4><a href="" class="stretched-link">Montant</a></h4>
                            <p> {{ $projet->montant }} DZD</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="600">
                        {{-- <i class="bi bi-brightness-high flex-shrink-0"></i> --}}
                        {{-- <i class="bi bi-person"></i> --}}
                        <i class="bi bi-people"></i>

                        <div>
                            <h4><a href="" class="stretched-link">Participant </a></h4>
                            <p> {{ $projet->participation }} </p>
                        </div>
                    </div><!-- End Icon Box -->

                </div>
            </div>

        </div>

    </section><!-- /Alt Services Section -->
@endsection
@push('custom-scripts')
<script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script>

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

</script>
@endpush
