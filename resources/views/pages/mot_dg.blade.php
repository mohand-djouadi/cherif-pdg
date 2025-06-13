@extends('layouts/master', ['title' => 'MOT DU PDG'])
@push('custom-styles')
    <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">
    <style>
        .mudiv {
            padding: 40px;
            padding-right: 0;
            /* padding-right: 0px; */
            background-color: color-mix(in srgb, var(--default-color), transparent 96%);
            margin-top: 0px;
        }

        @media (min-width: 991px) {
            .mudiv {
                padding-right: 5%;
            }
        }
        .mudiv p:last-child {
    margin-bottom: 0;
}
    </style>
@endpush
<title> MOT DU PDG </title>
@section('main')
    <main id="main">
        <!-- ======= Titel Page ======= -->
        @include('layouts.partials._page_Title', ['title' => 'MOT DU PDG '])
        <!-- Titel Page -->

        <!-- About Section -->
        {{-- <section id="about2" class="about2 section">

            <div class="container">

                <div class="row position-relative">

                    <div class="col-lg-7 about-img2" data-aos="zoom-out" data-aos-delay="200"><img src="/img/dg.jpg"></div>

                    <div class="col-lg-7 " data-aos="fade-up" data-aos-delay="100">
                        <h2 class="inner-title2">MOT &nbsp; DU &nbsp; PRESIDENT&nbsp; DIRECTEUR &nbsp;GÉNÉRAL</h2>
                        <div class="our-story2">

                            <h3>M. SAIDANI Mostefa</h3>

                            <p>
                                &emsp; Votre visite de notre site Web sera pour vous l’occasion de découvrir le Groupe
                                d’Infrastructures
                                de Travaux Maritimes « GITRAMA ». En effet, nous nous inscrivons, résolument, avec courage
                                et détermination, dans la participation à la réalisation d’infrastructures relevant des
                                domaines
                                de nos activités, qu’elles soient en Algérie ou à l’Etranger, que nous soyons seuls ou en
                                partenariat d’égal à égal, notamment quand on sait que déjà en Algérie, des régions sont à
                                découvrir pour faire valoir leurs richesses, tant en matières premières que culturelles.
                            </p>
                            <p>Un moment décisif est aux abords, un moment à saisir pour prendre les bonnes décisions quant
                                à l’avenir de
                                notre groupe, étroitement lié à l’avenir de notre pays qui regorge de gisements à mettre en
                                valeur par tous
                                les acteurs.<br></p>
                            <p>La réalisation d’infrastructures de travaux publics accélèrera le processus d’une mutation
                                indispensable
                                pour notre pays et pour ce faire, nous voulons être un acteur d’envergure, du fait que nous
                                sommes déjà
                                présents dans tous les métiers liés à la construction et l'entretien des infrastructures de
                                travaux publics
                                et de transport (maritimes, routiers, aériens, ferroviaires, hydrauliques et sous terrains),
                                d'aménagements
                                urbains et de loisirs, à travers trois segments de métiers : <br>
                            <ul style="padding-left: 35px;">
                                <li>Travaux maritimes ; </li>
                                <li>Travaux d’ouvrages d’art ;</li>
                                <li>Travaux routiers, autoroutiers et aéroportuaires ;</li>
                            </ul>
                            </p>

                        </div>
                    </div>

                </div>

            </div>

        </section> --}}
        <!-- /About Section -->

        <!-- About Section -->
        <section id="about2" class="about2 section">

            <div class="container">

                <div class="row position-relative">

                    <div class="col-lg-4 about-img2 " data-aos="zoom-out" data-aos-delay="200" style="">
                        <img src="/img/dg.jpg">
                    </div>

                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="inner-title2">MOT &nbsp; DU &nbsp; PRESIDENT&nbsp; DIRECTEUR &nbsp;GÉNÉRAL </h2>
                        <div class="our-story2">
                            {{-- <h4>Est 1988</h4> --}}
                            <h3>M. SAIDANI Mostefa</h3>

                            <div>
                                <p class="text-justify">
                                    &emsp; Votre visite de notre site Web sera pour vous l’occasion de découvrir le Groupe
                                    d’Infrastructures
                                    de Travaux Maritimes « GITRAMA ». En effet, nous nous inscrivons, résolument, avec
                                    courage
                                    et détermination, dans la participation à la réalisation d’infrastructures relevant des
                                    domaines
                                    de nos activités, qu’elles soient en Algérie ou à l’Etranger, que nous soyons seuls ou
                                    en
                                    partenariat d’égal à égal, notamment quand on sait que déjà en Algérie, des régions sont
                                    à
                                    découvrir pour faire valoir leurs richesses, tant en matières premières que culturelles.
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class=' mudiv '>
                            <p> &emsp; Un moment décisif est aux abords, un moment à saisir pour prendre les bonnes
                                décisions quant
                                à l’avenir de
                                notre groupe, étroitement lié à l’avenir de notre pays qui regorge de gisements à
                                mettre en
                                valeur par tous
                                les acteurs.<br></p>
                            <p>&emsp; La réalisation d’infrastructures de travaux publics accélèrera le processus
                                d’une mutation
                                indispensable
                                pour notre pays et pour ce faire, nous voulons être un acteur d’envergure, du fait
                                que nous
                                sommes déjà
                                présents dans tous les métiers liés à la construction et l'entretien des
                                infrastructures de
                                travaux publics
                                et de transport (maritimes, routiers, aériens, ferroviaires, hydrauliques et sous
                                terrains),
                                d'aménagements
                                urbains et de loisirs, à travers trois segments de métiers : <br>
                            <ul style="padding-left: 35px;">
                                <li> <i class="bi bi-check-circle"></i> <span> Travaux maritimes . </span></li>
                                <li> <i class="bi bi-check-circle"></i> <span>Travaux d’ouvrages d’art . </span>
                                </li>
                                <li> <i class="bi bi-check-circle"></i> <span> Travaux routiers, autoroutiers et
                                        aéroportuaires . </span></li>
                            </ul>
                            </p>

                            <p class="text-justify"> &emsp; Ces trois segments de métiers qui constituent le cœur de
                                métier du groupe sont confortées par d’autres
                                activités de spécialités telles que la signalisation pour la sécurité routière, la
                                production d’agrégats et
                                les réseaux divers.</p>
                            <p class="text-justify"> &emsp; Entre diversité des activités et capitalisation de
                                savoir, depuis plus d’une cinquantaine d’années
                                d’existence de ses filiales, le groupe GITRAMA a l’ambition d’être leader en Algérie
                                et se veut une place à
                                l’international, notamment dans le continent Africain.</p>
                            <p class="text-justify"> &emsp; Réputé pour sa grandeur, ses références, ses potentiels
                                tant humains que matériels, GITRAMA est un groupe
                                qui fascine par ses potentialités, son personnel bien imprégné de sa culture et par
                                la diversité et la
                                qualité de ses réalisations. </p>
                            <p class="text-justify"> &emsp; Ayant élu son siège social à la capitale du pays, Alger,
                                doté d’un capital social de 28 milliards de DZD,
                                GITRAMA est communément appelé le groupe de tous les défis. Activant dans presque
                                toute l’Algérie,
                                précisément dans 52 wilayas sur 58, ses filiales se déploient dans les régions
                                côtières, des hauts plateaux,
                                du Sahara ainsi que dans le grand sud, où elles sont présentes dans le cadre de la
                                réalisation des projets
                                structurants sous des températures extrêmement chaudes, qui avoisinent parfois les
                                55° Celsius.</p>
                            <p class="text-justify"> &emsp; GITRAMA c’est, 17 filiales : 4 dans le domaine maritime,
                                4 dans celui des ouvrages d’art et les 9 autres
                                filiales sont versées dans la construction des routes.</p>
                            <p class="text-justify"> &emsp; GITRAMA c’est aussi, des dizaines de carrières
                                d’agrégats, plusieurs dizaines de stations d’enrobés, des
                                centaines d’équipements de terrassement, des centaines d’ateliers de mise en œuvre
                                des enrobés, des milliers
                                d’unités de transport de matériaux et de produits finis et semis finis, de milliers
                                de mètres carrés de
                                coffrage (coulissant et autres), des dizaines d’équipements de levage et de
                                manutention, des dizaines
                                d’ateliers de maintenance tous azimuts, des dizaines d’équipements maritimes
                                (chalands, pontons, …) et on en
                                passe.</p>

                                <p> &emsp; Dans le cadre de notre plan stratégique de développement, nous poursuivons une démarche de développement
                                    durable et responsable dans le cadre de notre stratégie de croissance, qui intègre les aspects de management
                                    sur tous les plans et de respect de l’environnement. Cette stratégie est déclinée sur l’ensemble des
                                    filiales afin de répondre aux besoins et aux exigences de nos clients, et à leurs besoins explicites ou
                                    implicites. </p>
                                  <p> &emsp; Cette stratégie repose sur les axes relatifs à :<br>
                                  <ul style="padding-left: 35px;">
                                    <li> <i class="bi bi-check-circle"> </i></i> <span> la recherche d’opportunité de partenariats mutuellement bénéfiques en Algérie et partout ailleurs,
                                      notamment en Afrique.</span></li>
                                    <li> <i class="bi bi-check-circle"></i>  <span>la création des synergies essentielles à la maitrise des ressources nécessaires aux activités que nous
                                      voulons diversifier pour offrir des produits et des services élargis.</span></li>
                                    <li> <i class="bi bi-check-circle"></i>  <span>l’encouragement de l’innovation et de la recherche scientifique, en particulier en ce qui concerne la
                                      conception de nouveaux produits et services.</span></li>
                                    <li> <i class="bi bi-check-circle"></i>  <span>la professionnalisation des femmes et des hommes qui forment l’assise sur laquelle repose la réussite et
                                      le développement du groupe ainsi que la suscitation de leur engagement. L’avenir de GITRAMA dépend donc de
                                      son capital humain qui doit être fidélisé, développé et soutenu par des valeurs sures.</span></li>
                                    <li> <i class="bi bi-check-circle"> </i> <span>la reconnaissance de nos processus par les standards et les référentiels internationaux dans les
                                      domaines de la qualité de nos produits et services, de la qualité de notre management des projets, de
                                      l’environnement et des aspects liés à l’hygiène, la santé et la sécurité au travail.</span></li>
                                  </ul>
                                  </p>

                                  <p> &emsp; Dans tout ce que nous réalisons, on accorde une importance au respect de l’environnement. Nombreuses, sont
                                    les filiales du groupe avoir été reconnues au référentiels et normes internationales, à l’image des normes
                                    ISO.</p>
                                  <p> &emsp; La formation pour le développement du personnel, notamment technique est le point fort du groupe, qui
                                    d’ailleurs s’est approprié son école dédiée aux métiers des travaux publics et entreprend d’étroites
                                    relations avec les écoles supérieures, les universités et les instituts spécialisés, dans le cadre d’accords
                                    de coopération, et notamment dans la recherche scientifique.</p>
                                  <p> &emsp; A mesure des défis, en tant qu’outil national de réalisation d’infrastructures des travaux publics, nous
                                    sommes déterminés à s’inscrire dans la stratégie de notre pays (programme de Monsieur Le Président de la
                                    République et plan d’actions du gouvernement) pour participer à la réalisation des programmes de
                                    développement.</p>
                                  <p> &emsp; L’avenir témoignera de notre bonne volonté affichée et de l’ensemble de nos filiales ainsi que de notre
                                    engagement dans le processus de développement des infrastructures du secteur des Travaux Publics, dans la
                                    voie de la diversification de notre économie.</p>
                                    <div style="text-align: right; padding: 15px;">
                                        M. SAIDANI Mostefa<br>
                                        Président Directeur Général<br>
                                        Groupe GITRAMA.<br>
                                      </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

    </main>
@endsection
