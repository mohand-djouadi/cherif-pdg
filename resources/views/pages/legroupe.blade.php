@extends('layouts/master', ['title' => 'LE GROUPE'])
@push('custom-styles')
    <!-- Timeline CSS -->
    <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">
@endpush
<title> LE GROUPE </title>
@section('main')
    <!-- ======= Titel Page ======= -->
    @include('layouts.partials._page_Title', ['title' => 'LE GROUPE'])
    <!-- Titel Page -->

    @include('layouts\composant\legroupe\presentation')



    <!-- Alt Services Section -->
    <section id="alt-services" class="alt-services section">

        <div class="container">

            <div class="row justify-content-around gy-4">
                <div class="img-bg  col-lg-6" data-aos="fade-up" data-aos-delay="100"><img
                        src="img/logogitrama.png" alt=""></div>

                <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    {{-- <h3>Enim quis est voluptatibus aliquid consequatur fugiat</h3> --}}

                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
                        <i class="fa-regular fa-building"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Raison social</a></h4>
                            <p>Groupe d’Infrastructures de Travaux Maritimes.</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
                        <i class="fa-solid fa-gavel"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Forme juridique</a></h4>
                            <p>Entreprise Publique Economique EPE – SPA</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="500">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Capital social</a></h4>
                            <p>28.000.000.000 DZD</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="600">
                        <i class="bi bi-person"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Nom du PDG</a></h4>
                            <p>M. SAIDANI MOSTEFA</p>
                        </div>
                    </div><!-- End Icon Box -->

                    <div class="icon-box d-flex position-relative " data-aos="fade-up" data-aos-delay="700">
                        <i class="bi bi-activity fs-1" style="font-size: 20px;"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Activité principale</a></h4>

                            <p>Le suivi, la coordination et le contrôle des entreprises <br /> de Travaux Publics qu’il
                                détient en
                                portefeuille.</p>
                        </div>
                    </div><!-- End Icon Box -->


                </div>
            </div>

        </div>

    </section> <!-- /Alt Services Section -->

    <section class="" id="org">

        <div class="container section-header" data-aos="fade-up">
            <h2>ORGANIGRAMME DU GROUPE</h2>
        </div>
        <div class="container d-flex justify-content-center" data-aos="fade-up" data-aos-delay="600">

            <img src="img/organig.JPG" alt="Cover Image" class="cover-image w-60">
        </div>
    </section>

    <section>
        <div class="container-fluid mt-0" id="filieres">
            <div class="container">
                <div class="container section-header" data-aos="fade-up">
                    <h2>MISSIONS DU GROUPE GITRAMA</h2>
                </div>
                {{-- <h3 style="text-align: center;">MISSIONS DU GROUPE GITRAMA</h3> --}}

                <div class="services-cards ">
                    <div class="container p-5" data-aos="fade-up">

                        <div class="row gy-4">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 d-flex flex-column justify-content-center"
                                data-aos="zoom-in" data-aos-delay="100">
                                <h3><b class="h1" style=" font-size: 30px !important ">A</b> <span
                                        style=" font-size: 18px !important ">ssurer la présidence des Assemblées Générales
                                        des
                                        EPE en portefeuille.</span></h3>

                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column justify-content-center"
                                data-aos="zoom-in" data-aos-delay="200">
                                <h3><b class="h1" style=" font-size: 30px !important ">D</b> <span
                                        style=" font-size: 18px !important ">évelopper les fonctions de support et
                                        développement
                                        des Entreprises du Groupe.</span></h3>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column justify-content-center"
                                data-aos="zoom-in" data-aos-delay="300">
                                <h3><b class="h1" style=" font-size: 30px !important ">D</b> <span
                                        style=" font-size: 18px !important ">éfinir la stratégie de développement et en
                                        assurer
                                        la mise en œuvre et le suivi.</span></h3>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column justify-content-center"
                                data-aos="zoom-in" data-aos-delay="400">
                                <h3><b class="h1" style=" font-size: 30px !important ">A</b> <span
                                        style=" font-size: 18px !important ">ssurer le pilotage stratégique des entreprises
                                        en
                                        portefeuille.</span></h3>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column justify-content-center"
                                data-aos="zoom-in" data-aos-delay="500">
                                <h3><b class="h1" style=" font-size: 30px !important ">D</b> <span
                                        style=" font-size: 18px !important ">éfinir les politiques de croissance, de
                                        recherche,
                                        de développement, d’innovation et de veille technologique.</span></h3>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column justify-content-center"
                                data-aos="zoom-in" data-aos-delay="600">
                                <h3><b class="h1" style=" font-size: 30px !important ">A</b> <span
                                        style=" font-size: 18px !important ">ssurer les missions d’audit et de contrôle de
                                        gestion des EPE du portefeuille.</span></h3>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid p-5" id="filieres">
            <div class="container">
                <div class="container section-header" data-aos="fade-up">
                    <h2>Domaines d’intervention du groupe</h2>
                </div>
                {{-- <h3 style="text-align: center;">Domaines d’intervention du groupe</h3> --}}
                <div class="row"   data-aos="zoom-in" data-aos-delay="700">
                    <article class="col-md-12">

                        <p style="margin-left: 20px; margin-right: 20px; font-size: 16px; text-align: justify;"  data-aos="zoom-in" data-aos-delay="100">
                            <span style="font-size: 24px; color: black;">L</span>e groupe GITRAMA, à travers ses quatre
                            filières d’activités, est présent dans différents
                            projets de réalisations d’infrastructures à l’instar des travaux maritimes, travaux
                            d’ouvrages d’art, travaux routiers, autoroutiers et aéroportuaires, travaux ferroviaires,
                            et travaux hydrauliques, ainsi que les travaux d'aménagements urbains et de loisirs.
                        </p>
                        <p style="margin-left: 20px; margin-right: 20px; font-size: 16px; text-align: justify;" data-aos="zoom-in" data-aos-delay="200">
                            <span style="font-size: 24px; color: black;">C</span>es quatre filières d’activités qui
                            constituent le cœur de métier du groupe sont confortées par
                            d’autres activités de spécialités telles que la signalisation pour la sécurité routière, la
                            production d’agrégats et les réseaux divers.

                        </p>
                        <p style="margin-left: 20px; margin-right: 20px; font-size: 16px; text-align: justify;" data-aos="zoom-in" data-aos-delay="300">
                            <span style="font-size: 24px; color: black;">L</span>e groupe GITRAMA à travers ses filiales
                            maritimes, MEDITRAM, SOTRAMEST, SOTRAMO et
                            ALDIPH est spécialisé dans :
                        <ul
                            style="margin-left: 30px; margin-right: 30px; font-size: 16px; text-align: justify; list-style-type:none;" >
                            <li>
                                La construction des ports, des ouvrages de protection tels que les digues, les jetées
                                ou les brise-lames et la construction des quais et môles ainsi que leur entretien par des
                                confortements ou empiètements.
                            </li>
                            <li> Les travaux sous-marins, par exemple le colmatage des cavernes.</li>
                            <li> le dragage d’entretien des ports et des barrages et le déroctage pour l’augmentation
                                des fonds marins au niveau des bassins et des quais des ports.</li>
                        </ul>
                        </p>
                        <p style="margin-left: 20px; margin-right: 20px; font-size: 16px; text-align: justify;" >
                            Dans le domaine des ouvrages d’arts, SAPTA, SEROR, ENROS et GESI-TP font dans :
                        <ul
                            style="margin-left: 30px; margin-right: 30px; font-size: 16px; text-align: justify; list-style-type:none;">
                            <li> La construction de viaducs, de ponts, des galeries souterraines telles que les stations
                                de métro.</li>
                            <li> La construction d’ouvrages hydrauliques comme les barrages, les retenues collinaires,
                                les stations d’épurations et de relevage des eaux usées.</li>
                        </ul>
                        </p>
                        <p style="margin-left: 20px; margin-right: 20px; font-size: 16px; text-align: justify;"  >
                            Et dans le domaine de la construction et l’entretien des routes, des aéroports et des
                            aérodromes, le groupe dispose de neufs filiales : EPTP ALGER, EPTP CONSTANTINE, ALTRO,
                            ETR BEJAIA, SERA, ERTP TEBESSA, SONATRO, SOTROB Oum-El-Bouaghi et ENPS. Cette dernière
                            est spécialisée dans la signalisation routière.
                        </p>
                        <p style="margin-left: 20px; margin-right: 20px; font-size: 16px; text-align: justify;" data-aos="zoom-in" data-aos-delay="400">
                            <span style="font-size: 24px; color: black;">D</span>ans tout ce qu’il réalise, le groupe
                            GITRAMA accorde une
                            importance au respect de
                            l’environnement. Nombreuses, sont les filiales du groupe avoir été reconnues au référentiels
                            et normes internationales, à l’instar des normes ISO.
                        </p>
                        <p style="margin-left: 20px; margin-right: 20px; font-size: 16px; text-align: justify;" data-aos="zoom-in" data-aos-delay="500">
                            <span style="font-size: 24px; color: black;">L</span>a formation pour le
                            développement du personnel, notamment technique est le point fort du
                            groupe, qui d’ailleurs s’est approprié son école dédiée aux métiers des travaux publics et
                            entreprend d’étroites relations avec les écoles supérieures, les universités et les instituts
                            spécialisés, dans le cadre d’accords de coopération, et notamment dans la recherche
                            scientifique.
                        </p>
                        <p style="margin-left: 20px; margin-right: 20px; font-size: 16px; text-align: justify;" data-aos="zoom-in" data-aos-delay="600">
                            <span style="font-size: 24px; color: black;">A </span>mesure des défis, le groupe GITRAMA, en
                            tant qu’outil national de réalisation
                            d’infrastructures des travaux publics, est déterminé à s’inscrire dans la stratégie de notre
                            pays pour participer à la réalisation des programmes de développement.
                        </p>
                        <p style="margin-left: 20px; margin-right: 20px; font-size: 16px; text-align: justify;" data-aos="zoom-in" data-aos-delay="700">
                            <span style="font-size: 24px; color: black;">L</span>’essentiel c’est de répondre favorablement
                            et rapidement à toute bonne initiative qui vise
                            la diversification de l’économie nationale, afin de déjouer les méfaits de la dépendance
                            vis-à-vis des hydrocarbures.
                        </p>
                        <p style="margin-left: 20px; margin-right: 20px; font-size: 16px; text-align: justify;"data-aos="zoom-in" data-aos-delay="800">
                            <span style="font-size: 24px; color: black;">L</span>a réalisation d’infrastructures de
                            travaux publics et de transports accélèrera le processus de
                            cette mutation indispensable pour notre pays.
                        </p>
                </div>
                </article>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('custom-scripts')
    <!-- Horizontal-timeline JavaScript -->
    <script src="{{ asset('vendor/horizontal-timeline/js/horizontal-timeline.js') }}"></script>
@endpush
