@extends('layouts/master', ['title' => 'FILIALES'])
@push('custom-styles')
    <!-- Timeline CSS -->
    <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">
@endpush
<title> FILIALES </title>
@section('main')
    <main id="main">
        <!-- ======= Titel Page ======= -->
        @include('layouts.partials._page_Title', ['title' => 'FILIALES '])
        <!-- Titel Page -->
        <section class="container">

            <div class=" tab-pane  ">
                <div class="row ">
                    <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center"
                        data-aos="fade-up" data-aos-delay="100">
                        {{-- <h4 class="text-uppercase">Les phases du Diagnostic et Expertise</h4> --}}
                        <div class="section-header">
                            <h2>NOS FILIALES PAR SECTEUR D'ACTIVITÉ</h2>
                        </div>
                        <div class="inner-content">
                            <ul class="nav nav-tabs row testee horizontal-tabs  g-2 d-flex" role="tablist"
                                style="width: 100%">
                                <li class="nav-item col-3   " role="presentation">
                                    <a class="nav-link   text-wrap  {{ $name === 'TRAVAUX-MARITIMES' ? 'active' : '' }} " data-bs-toggle="tab" data-bs-target="#tab-4-1">
                                        TRAVAUX MARITIMES
                                    </a>
                                </li><!-- End tab nav item -->
                                <li class="nav-item col-3" role="presentation">
                                    <a class="nav-link  {{ $name === 'TRAVAUX-OUVRAGES-ART' ? 'active' : '' }} " data-bs-toggle="tab" data-bs-target="#tab-4-2">
                                        TRAVAUX D'OUVRAGE D'ART
                                    </a><!-- End tab nav item -->
                                </li>
                                <li class="nav-item col-3" role="presentation">
                                    <a class="nav-link  {{ $name === 'TRAVAUX-ROUTIERS' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#tab-4-3">
                                        TRAVAUX DE ROUTE
                                    </a>
                                </li>
                                <li class="nav-item col-3" role="yy">
                                    <a class="nav-link {{ $name === 'TRAVAUX-INDUSTRIELS' ? 'active' : '' }} " data-bs-toggle="tab" data-bs-target="#tab-4-4">
                                        TRAVAUX INDUSTRIELS
                                    </a>
                                </li>
                                <!-- End tab nav item -->
                            </ul>
                            <div class="tab-content" style="width: 95%">
                                <div class="tab-pane {{ $name === 'TRAVAUX-MARITIMES' ? 'active' : '' }} show" id="tab-4-1" role="tabpanel">


                                    @include('layouts/composant/filiale_detail/entreprise_travaux_maritimes')

                                </div><!-- End tab content item -->
                                <div class="tab-pane {{ $name === 'TRAVAUX-OUVRAGES-ART' ? 'active' : '' }}" id="tab-4-2" role="tabpanel">
                                    @include('layouts\composant\filiale_detail\entreprise_travaux_ouvrage_art')

                                </div><!-- End tab content item -->
                                <div class="tab-pane {{ $name === 'TRAVAUX-ROUTIERS' ? 'active' : '' }}" id="tab-4-3" role="tabpanel">
                                    @include('layouts\composant\filiale_detail\entreprise_travaux_de_route')

                                </div>
                                <div class="tab-pane {{ $name === 'TRAVAUX-INDUSTRIELS' ? 'active' : '' }} " id="tab-4-4" role="tabpanel">
                                    @include('layouts\composant\filiale_detail\entreprise_travaux_industriels')

                                </div>
                            </div><!-- End tab content item -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Features Section -->



    </main><!-- End #main -->
@endsection
@push('custom-scripts')
    <!-- Horizontal-timeline JavaScript -->
    <script src="{{ asset('vendor/horizontal-timeline/js/horizontal-timeline.js') }}"></script>
@endpush
