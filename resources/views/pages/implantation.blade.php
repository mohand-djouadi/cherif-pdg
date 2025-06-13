@extends('layouts/master', ['title' => 'IMPLANTATION'])
@push('custom-styles')
    <!-- Timeline CSS -->
    <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">
    <style>
        .indent-first-word span:first-child {
            margin-left: 3rem;
            /* Ajustez la valeur selon vos besoins */
            display: inline-block;

        }

        .custom-marker {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            /* Largeur du marqueur */
            height: 50px;
            /* Hauteur du marqueur */
            background-color: #f1e8e8;
            /* Couleur de fond */
            border: 2px solid #000;
            /* Bordure du marqueur */
            border-radius: 50%;
            /* Bordure arrondie pour créer un cercle */
        }

        .model-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            /* Largeur du marqueur */
            height: 50px;
            /* Hauteur du marqueur */
            background-color: #f1e8e8;
            /* Couleur de fond */
            border: 2px solid #000;
            /* Bordure du marqueur */
            border-radius: 50%;
            /* Bordure arrondie pour créer un cercle */
        }

        .custom-marker-icon {
            width: 30px;
            /* Largeur de l'icône */
            height: 30px;
            /* Hauteur de l'icône */
            object-fit: cover;
            /* Assure que l'image s'adapte bien */
            border-radius: 50%;
            /* Bordure arrondie pour l'image */
        }

        .btn-close {
            filter: invert(1);
        }

        .btn-close:hover {
            filter: invert(1);
        }
    </style>
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> --}}

    <link rel="stylesheet"
        href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
@endpush


<title> IMPLANTATION </title>

@section('main')
    <!-- ======= Titel Page ======= -->
    @include('layouts.partials._page_Title', ['title' => 'IMPLANTATION '])
    <!-- Titel Page -->


    <section> <!--Nos metiers-->
        <div class="container-fluid">
            <div class="container">
                <div class="container section-header" data-aos="fade-up">
                    <h2 style="padding-top: 20px; text-align: center;">IMPLANTATION DU GROUPE GITRAMA</h2>
                </div>
                <div class="row">

                    <div class="container d-flex justify-content-center" data-aos="fade-up" data-aos-delay="600">

                        {{-- <img src="img/algeria.png" alt="Cover Image" class="cover-image w-50"> --}}
                        <div id="map2" style="width: 100%; height: 600px;"></div>
                    </div>
                    {{-- <article class="col-md-12">
                          <img src="img/algeria.png" alt="TRAVAUX DE ROUTES ">
                      </div>
              </article> --}}
                </div>
            </div>

        </div>
    </section>

    </main>
@endsection


@push('custom-scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Moment.js -->
    <script src=" {{ asset('admin/plugins/moment/moment.min.js') }}"></script>

    <script>
        function createCustomIcon(htmlContent) {
            return L.divIcon({
                className: 'custom-icon',
                html: htmlContent,
                iconSize: [50, 50], // Taille de l'icône en pixels [largeur, hauteur]
                iconAnchor: [25,
                    50
                ] // Point d'ancrage de l'icône [x, y] (position relative du point d'ancrage dans l'image)
            });
        }

        // Exemple de contenu HTML avec un logo
        var htmlContent = null;
        // Création de l'icône personnalisée
        var customIcon = null;
        $(function() {


            // Convertir les données filiales PHP en objet JavaScript
            var filiales = @json($filiales);
            console.log(filiales);

            // Initialiser la carte
            var map = L.map('map2').setView([34.6728, 3.263], 6.3);
            var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            var customIcon = null;
            // Fonction pour ajouter des marqueurs à la carte
            function addMarkers(outlets) {
                outlets.forEach(function(outlet) {
                    if (outlet.latitude && outlet.longitude) {
                        var latitude = parseFloat(outlet.latitude);
                        var longitude = parseFloat(outlet.longitude);
                        // Exemple de contenu HTML avec un logo
                        htmlContent = '<div class="custom-marker">' +
                            '<img src="' + outlet.logo + '" class="custom-marker-icon">' +
                            '</div>';
                        customIcon = createCustomIcon(htmlContent);
                        // Vérifier que les valeurs de latitude et longitude sont valides
                        if (!isNaN(latitude) && !isNaN(longitude)) {
                            var marker = L.marker([latitude, longitude], {
                                icon: customIcon
                            }).addTo(map);
                            // marker.bindPopup(outlet.intitule_proj);
                            marker.on('click', function() {
                                // $('#outletLogo').attr('src', outlet.logo);
                                // $('#outletDetails').text(outlet.intitule_proj);
                                // $('#outletModal').modal('show');

                                getInfoFiliale(outlet.id);
                                var myModal = new bootstrap.Modal($('#exampleModal'));
                                myModal.show();
                            });
                        }
                    }
                });
            }

            // Appeler la fonction pour ajouter les marqueurs
            addMarkers(filiales);

            // Fonction pour convertir DMS (Degrees, Minutes, Seconds) en degrés décimaux
            function convertDMStoDD(dms) {
                var parts = dms.split(/[^\d\w]+/);
                var degrees = parseFloat(parts[0]);
                var minutes = parseFloat(parts[1]);
                var seconds = parseFloat(parts[2]);
                var direction = parts[3];

                var dd = degrees + minutes / 60 + seconds / (60 * 60);

                if (direction === 'S' || direction === 'W') {
                    dd = -dd;
                }
                return dd;
            }

            function replaceSpacesWithNbsp(inputString) {
                return inputString.replace(/\s+/g, '&nbsp;&nbsp;&nbsp;');
            }

            function getInfoFiliale(id) {



                $.ajax({
                    url: '{{ route('gestion.filiales.geInfo', ':id') }}'.replace(':id', id),
                    method: 'GET',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (response.success) {
                            console.log('response :', response);
                            var modifiedString = '<p class=" text-center">' + replaceSpacesWithNbsp(
                                response.data.denomination) + ' </p>';
                            var formattedDate = moment(response.data.date_creation).format(
                            'YYYY-MM-DD');

                            $('#exampleModalLabel').html(modifiedString);
                            $('#logo').attr('src', response.data.logo_path != "" ?
                                'storage/' + response.data.logo_path : 'img/anonyme.png'
                            );
                            $('#sigle_commercial').html(response.data.sigle_commercial);
                            $('#Sigle').html(response.data.sigle_commercial);
                            $('#date_creation').html(formattedDate);
                            $('#capital_social').html(response.data.capital_social);
                            $('#site').attr('href', response.data.site_web);


                            $('#str_directeur').attr('src', response.data.photo_dg != "" && response
                                .data.photo_dg != null ? 'storage/' + response.data.photo_dg :
                                'img/anonyme.png');
                            $('#dr_nom_directeur').html(response.data.nom_dg);

                            $('#str_mail').html(response.data.email);
                            $('#str_tel').html(response.data.telephone);
                            $('#str_fix').html(response.data.fix);
                            // $('#str_tel').html(response.data.email);

                        } else {
                            Swal.fire(
                                'Erreur !',
                                'Erreur survenue lors de la récupération de l\'information',
                                'error'
                            );
                            console.log('Erreur survenue lors de la récupération de l\'information');

                        }
                    },
                    error: function(response) {
                        console.log('Erreur survenue lors de la récupération de l\'information');
                    }
                });
            }

        });
    </script>
@endpush


@push('myModals')
    <!-- Modal -->
    <div class="modal fade" id="outletModal" tabindex="-1" aria-labelledby="outletModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="outletModalLabel">Détails de la Filiale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenu du modal -->
                    <img id="outletLogo" src="" alt="Logo" class="img-fluid">
                    <p id="outletDetails"></p>
                </div>
            </div>
        </div>
    </div>








    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="multiplewilaya" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="">
                <div class="modal-header " style="background-color: #18313a ">
                    <div>
                        <div class=" text-center text-white" id="exampleModalLabel"></div>
                        <div class="text-white pe-none  " id="location-href">
                            <img id="logo" src="" class="custom-marker-icon  bg-light">

                            <span id="sigle_commercial"></span>
                        </div>


                    </div>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    <br>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="row p-4" id='content-info'>
                                <div class="col-lg-8">
                                    <p><span style="font-weight: bold"><i class="fa fa-envelope"></i> Email : </span> <span
                                            id="str_mail"></span> </p>
                                    <p><span style="font-weight: bold"><i class="fa fa-phone"></i> Tel : </span> <span
                                            id="str_tel"></span> - <i class="fa fa-fax"></i> Fix : </span> <span
                                            id="str_fix"></span> </p>
                                    <p><span style="font-weight: bold"><i class="bi bi-caret-right-fill"></i> Affiliation :
                                        </span> <span id=""> Groupe GITRAMA Spa</span> </p>
                                    <p><span style="font-weight: bold"> <i class="bi bi-caret-right-fill"></i> Sigle
                                            commercial : </span> <span id="Sigle"> </span> </p>
                                    <p><span style="font-weight: bold"> <i class="bi bi-caret-right-fill"></i> Date de
                                            création : </span> <span id="date_creation"> </span> </p>
                                    <p><span style="font-weight: bold"> <i class="bi bi-caret-right-fill"></i> Capital
                                            social : </span> <span id="capital_social"> </span> </p>
                                    <p><span style="font-weight: bold"> <i class="bi bi-browser-chrome"></i> Site Web :
                                            <span>
                                                <a  id="site" href="" target="_blank">
                                                    Pour plus d'informations, visitez le site web
                                                </a>
                                            </span></p>
                                    </span>
{{--
                                    <p><span style="font-weight: bold"><i class="fa fa-map-location-dot"></i> Adresse :
                                        </span> <u style="text-decoration-color: var(--color-primary)"><a id="str_adr"
                                                class="external fw-bold" target="_blank"></a></u> </p> --}}
                                </div>
                                <div class="col-lg-4  flex-row">
                                    <div class="d-flex justify-content-center"> <img src="" alt=""
                                            id="str_directeur" class="img-fluid services-img mb-2 w-50 h-50">
                                    </div>

                                    <h5 class="text-center d-flex justify-content-center" id="dr_nom_directeur"></h5>
                                    <h6 class="text-center" id="str_fonction_directeur"></h6>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info text-center"
                        data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endpush
