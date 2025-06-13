@extends('layouts/master', ['title' => 'Projects'])
@push('custom-styles')
    <!-- Timeline CSS -->
    <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">
    <style>
        .wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 0 auto;
            width: 90%;
        }

        .card_project {
            width: 280px;
            height: 360px;
            background: #fff;
            display: flex;
            align-items: flex-end;
            padding: 2rem 1rem;
            position: relative;
            transition: 0.5s all ease-in-out;
            margin-bottom: 2rem;
        }

        .card_project:hover {
            transform: translateY(-10px);
        }

        .card_project::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(13, 36, 63, 0.3), rgba(13, 36, 63, 1));
            z-index: 2;
            opacity: 0;
            transition: 0.5s all;
        }

        .card_project:hover::before {
            opacity: 1;
        }

        .card_project img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .card_project .info {
            position: relative;
            color: #fff;
            z-index: 3;
            opacity: 0;
            transform: translateY(30px);
            transition: 0.5s all;
        }

        .card_project:hover .info {
            opacity: 1;
            transform: translateY(0);
        }

        .card_project .info h1 {
            line-height: 40px;
            margin-bottom: 10px;
        }

        .card_project .info p {
            font-size: 15px;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .card_project .info .btn {
            background: #fff;
            padding: 0.5rem 1rem;
            color: #000;
            font-size: 12px;
            cursor: pointer;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            transition: .4s ease-in-out;
        }

        .card_project .info .btn:hover {
            background: #04346b;
            color: #fff;
            box-shadow: 0 7px 10px rgba(0, 0, 0, 0.5);
        }

        .card_project .info .btn2 {
            background: #fff;
            padding: 4px 0px;
            color: #000;
            font-size: 12px;
            cursor: pointer;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: .4s ease-in-out;
        }

        .card_project .info .btn2:hover {
            background: #04346b;
            color: #fff;
            box-shadow: 0 7px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
@endpush
<title> Nos Projects </title>
@section('main')
    <!-- ======= Titel Page ======= -->
    @include('layouts.partials._page_Title', ['title' => 'NOS PROJETS'])
    <!-- Titel Page -->

    <!-- Projects Section -->
    <section id="projects" class="projects section">

        <!-- Section Title -->
        <div class="container section-header" data-aos="fade-up">
            <h2 class="">Projects</h2>

        </div><!-- End Section Title -->

        <div class="container" >

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">Tous </li>
                    <li data-filter=".filter-industriels">  <i class="fa-solid fa-signs-post"></i> TRAVAUX INDUSTRIELS</li>
                    <li data-filter=".filter-maritimes"><i class="fa-solid fa-anchor"></i> TRAVAUX MARITIMES</li>
                    <li data-filter=".filter-ouvrage"><i class="fa-sharp fa-solid fa-bridge"></i>  TRAVAUX D'OUVRAGE D'ART</li>
                    <li data-filter=".filter-route"> <i class="fa-sharp fa-solid fa-road"></i> TRAVAUX DE ROUTE</li>
                </ul><!-- End Portfolio Filters -->

                <div class="row gy-4 isotope-container mt-4" data-aos="fade-up" data-aos-delay="200">


                    @foreach ($secteurs as $secteur)
                        @foreach ($secteur->filiales as $filiale)
                            @foreach ($filiale->projets as $projet)
                                <div

                                          @class([
                                              'col-lg-3 col-md-6 portfolio-item isotope-item ',
                                              'filter-industriels' => $secteur->id == 6 ,
                                              'filter-maritimes' => $secteur->id == 5 ,
                                              'filter-ouvrage' => $secteur->id == 2 ,
                                              'filter-route' => $secteur->id == 3 ,

                                          ])
                                    >
                                    <div class="card_project">
                                        <img src="{{ asset('' . $projet->imgCouverture2) }}" alt="">

                                        <div class="info w-100">
                                            <h1>{{ $projet->filiale->sigle_commercial }} :</h1>
                                            <p>{{ $projet->intitule }}</p>
                                            <div class="d-flex justify-content-between w-100">
                                                <a href="{{'/projets/'.$projet->id}}"  class="btn">Lire la suite</a>
                                               <a href="{{$projet->localisation}}"  target="_blank">  <i class="bi bi-geo-alt fs-4  btn2"></i></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach
                    <!-- End Portfolio Item -->



                </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Projects Section -->
@endsection
@push('custom-scripts')
    <!-- Horizontal-timeline JavaScript -->
    <script src="{{ asset('vendor/horizontal-timeline/js/horizontal-timeline.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <script>
        /**
         * Init isotope layout and filters
         */
        document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
            let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
            let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
            let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

            let initIsotope;
            imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
                initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
                    itemSelector: '.isotope-item',
                    layoutMode: layout,
                    filter: filter,
                    sortBy: sort
                });
            });

            isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
                filters.addEventListener('click', function() {
                    isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove(
                        'filter-active');
                    this.classList.add('filter-active');
                    initIsotope.arrange({
                        filter: this.getAttribute('data-filter')
                    });
                    if (typeof aosInit === 'function') {
                        aosInit();
                    }
                }, false);
            });

        });
    </script>

@endpush
