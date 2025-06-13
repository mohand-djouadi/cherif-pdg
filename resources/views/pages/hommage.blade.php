@extends('layouts/master', ['title' => 'HOMMAGE'])
@push('custom-styles')
    <!-- Timeline CSS -->
    <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">
    <style>
        .indent-first-word span:first-child {
            margin-left: 3rem;
            /* Ajustez la valeur selon vos besoins */
            display: inline-block;

        }
    </style>
@endpush
<title> HOMMAGE </title>

@section('main')
    <main id="main">
        <!-- ======= Titel Page ======= -->
        @include('layouts.partials._page_Title', ['title' => 'HOMMAGE '])
        <!-- Titel Page -->

        <!-- About Section -->
        <section id="about2" class="about2 section">

            <div class="container">

                <div class="row position-relative">
                    <div class="col-lg-4 about-img2" data-aos="zoom-out" data-aos-delay="200" style=""><img
                            src="img/hommage.PNG"></div>

                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="inner-title2">Hommage </h2>
                        <div class="our-story2">
                            {{-- <h4>Est 1988</h4> --}}
                            <h3>Boualem AKHROUF</h3>
                     
                            <p claas=" indent-first-word">
                                <span style="     margin-left: 3rem;"> Nous   </span> souhaitons rendre un hommage sincère à Boualem AKHROUF, premier président du Groupe
                                GITRAMA. Son leadership et sa vision ont été inestimables, et sa disparition soudaine a
                                laissé un grand vide parmi nous.
                                    <br><br>
                                <span style="     margin-left: 3rem;"> Boualem </span>  AKHROUF avait pour ambition de hisser notre groupe au rang de leader national dans
                                le domaine des travaux maritimes et de lui offrir une place prépondérante dans d'autres
                                segments des Travaux Publics, tant en Algérie qu'à l'international. Il ne manquait jamais de
                                montrer son courage et sa détermination, affichant clairement son désir d'explorer de
                                nouveaux horizons, notamment le marché africain.
                                        <br><br>
                                <span style="     margin-left: 3rem;">Son</span>  slogan, « Une synergie pour développer notre continent », témoigne de son engagement
                                profond pour l'Afrique et son développement. Son héritage continue de nous inspirer chaque
                                jour, et nous nous efforçons de réaliser ses rêves et ses aspirations.
                                        <br><br>
                                <span style="     margin-left: 3rem;">Nous</span>  ne pourrons jamais suffisamment exprimer notre gratitude et notre admiration pour cet
                                homme exceptionnel. Que son esprit continue de guider notre chemin et de nous inspirer à
                                atteindre les sommets qu'il avait imaginés.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

    </main>
@endsection
{{-- @push('custom-scripts')

    <script src="{{ asset('vendor/horizontal-timeline/js/horizontal-timeline.js') }}"></script>
@endpush --}}
