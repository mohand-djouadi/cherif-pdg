@extends('layouts/master', ['title' => 'HOMMAGE'])
@push('custom-styles')
    <style>
        .indent-first-word span:first-child {
            margin-left: 3rem;
            /* Ajustez la valeur selon vos besoins */
            display: inline-block;

        }
    </style>
@endpush
<title> Notre Equipe </title>

@section('main')
    <main id="main">
        <!-- ======= Titel Page ======= -->
        @include('layouts.partials._page_Title', ['title' => 'Notre Equipe '])
        <!-- Titel Page -->

        <!-- Team Section -->
        <section id="team" class="team section">

            <!-- Section Title -->
            <div class="container section-header" data-aos="fade-up">
                <h2>Conseil d'administration</h2>
                <p>
                    Le conseil d'administration du groupe GITRAMA est composé de 05 membres. <br>
                    President: M. SAIDANI Mostefa <br>
                    Administrateurs:&nbsp;&nbsp;&nbsp; Mme. AIT IDIR Hayet &nbsp;&nbsp;&nbsp; M. FERFARA Mustapha &nbsp;&nbsp;&nbsp;
                    M. AIT DAHMANE Kamel &nbsp;&nbsp;&nbsp; &nbsp;et M. DERAMCHI Mohamed.
                </p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-5">

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">

                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="img/dg.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>M. SAIDANI Mostefa</h4>
                            <span> PRÉSIDENT DIRECTEUR GÉNÉRAL  </span>
                            <p> PRÉSIDENT DIRECTEUR GÉNÉRAL  </p>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="300">

                    </div><!-- End Team Member -->



                </div>

                {{-- <div class="row gy-5">
                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="400">
                        <div class="member-img">
                            <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>Amanda Jepson</h4>
                            <span>Accountant</span>
                            <p>Magni voluptatem accusamus assumenda cum nisi aut qui dolorem voluptate sed et veniam quasi
                                quam consectetur</p>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="500">
                        <div class="member-img">
                            <img src="assets/img/team/team-5.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>Brian Doe</h4>
                            <span>Marketing</span>
                            <p>Qui consequuntur quos accusamus magnam quo est molestiae eius laboriosam sunt doloribus quia
                                impedit laborum velit</p>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="600">
                        <div class="member-img">
                            <img src="assets/img/team/team-6.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>Josepha Palas</h4>
                            <span>Operation</span>
                            <p>Sint sint eveniet explicabo amet consequatur nesciunt error enim rerum earum et omnis fugit
                                eligendi cupiditate vel</p>
                        </div>
                    </div><!-- End Team Member -->
                </div> --}}

            </div>

        </section><!-- /Team Section -->

    </main>
@endsection
{{-- @push('custom-scripts')

    <script src="{{ asset('vendor/horizontal-timeline/js/horizontal-timeline.js') }}"></script>
@endpush --}}
