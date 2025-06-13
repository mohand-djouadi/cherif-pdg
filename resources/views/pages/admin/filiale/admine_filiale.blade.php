@extends('layouts/admine_layout', ['title' => 'Filiales'])

<title>Filiales</title>

@push('custom-styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <link rel="stylesheet"
        href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <!-- Select2 -->
    {{-- <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}"> --}}

    <!-- bs-custom-file-input -->
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href=" {{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <style>
        .content-wrapper {
            min-height: 100% !important;
            padding-bottom: 50px;

        }

        .wrapper {

            width: 100%;
            min-height: 100% !important;
            height: auto !important;
            position: absolute;
        }
    </style>

    <style>
        .note-btn.dropdown-toggle:after {
            content: none;
        }

        label.require::after,
        legend.require::after {
            content: "*";
            color: red;
            margin-left: 5px;
            font-size: 16px;
        }
    </style>
    <style>
        .custom-file-input~.custom-file-label::after {
            content: "Choisir une image" !important;
            /* Add !important to ensure priority */
        }

        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Fond semi-transparent */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Toujours au-dessus de tout */
            pointer-events: auto;
            /* Désactiver les clics */
        }

        .loader-content {
            text-align: center;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
@endpush


@push('custom-scripts')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

    <!-- SweetAlert2 -->
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <!-- Select2 -->
    {{-- <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script> --}}
    <!-- Page specific script -->
    <script>
        // $('.select2').select2();
        $(function() {

            $("#secteurTbel").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                ordering: true,
                order: [],
                pageLength: 10,

                buttons: [{
                    text: `<i class="fas fa-plus"></i> Ajouter`,
                    attr: {

                        name: "add",
                        id: "add_button",
                        class: "btn btn-outline-primary btn-block",
                        'data-toggle': "modal",
                        'data-target': "#add-modal"
                    },
                    action: (e) => {}
                }],
                language: {
                    searchPlaceholder: "Chercher",
                    search: "Recherche:",
                    emptyTable: "Aucune enregistrement trouvé dans le tableau",
                    loadingRecords: "Chargement en cours...",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ ligne(s)",
                    infoEmpty: "",
                    infoFiltered: " ",
                    zeroRecords: "Aucun enregistrement trouvé",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent",
                    },
                },
            }).buttons().container().appendTo('#secteurTbel_wrapper .col-md-6:eq(0)');

            bsCustomFileInput.init();

            // Récupérer les données du tableau.
            function fetchData() {
                $.ajax({
                    url: '{{ route('admin.secteurs.get') }}',
                    method: 'GET',
                    dataType: "json",
                    success: function(response) {
                        console.log('heloooo : ', response.data);

                        $('tbody').html("");
                        $.each(response.data, function(key, item) {
                            $('tbody').append(
                                '<tr> \
                                        <td class="text-center align-middle">' +
                                item
                                .id +
                                '</td> \
                                                                                                                                <td class="text-center align-middle">' +
                                item
                                .titre +
                                '</td> \
                                                                                                                                <td class="text-center align-middle">' +
                                item
                                .description +
                                '</td> \
                                                                                                                                <td class="text-center align-middle">' +
                                item
                                .date_ajout +
                                '</td> \
                                                                                                                                <td class="text-center align-middle">    \
                                                                                                                        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"  value="' +
                                item.id +
                                '"  class="btn btn-outline-warning edit-secteur" > \
                                                                                                                            <i class="fas fa-edit"></i> </button> \
                                                                                                                              <button  data-bs-toggle="tooltip" data-bs-placement="top"   title="Supprimer" value="' +
                                item.id +
                                '" class="btn btn-outline-danger delete-secteur">  <i class="fas fa-trash"></i>  </button> \
                                                                                                                                </td> \
                                                                                                                                 </tr>'
                            );
                        });
                    },
                    error: function(response) {
                        Swal.fire(
                            'Erreur !',
                            "Erreur lors de la récupération des données.",
                            'error'
                        );
                    }
                });




            }
            // fetchData()
        });
    </script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Récupérer les données du tableau.
        function fetchData() {
            $.ajax({
                url: '{{ route('gestion.filiales.get') }}',
                method: 'GET',
                dataType: "json",
                beforeSend: function() {
                    // Afficher le loader avant que la requête ne soit envoyée
                    $('#loader').removeClass('d-none');
                },
                success: function(response) {
                    console.log('heloooo : ', response.data);
                    let apiUrl = "{{ config('app.url') }}";
                    //  apiUrl = 'http://127.0.0.1:8000'  ;

                    $('tbody').html("");
                    $.each(response.data, function(key, item) {
                        $('tbody').append(
                            '<tr> \
                                                                        <td class="text-center align-middle">  <img style="max-width: 100px; height: auto;" src="' +
                                                                           item.logo + '"/> </td> \
                                                                        <td class="text-center align-middle">' + item
                            .secteur + '</td> \
                                                                        <td class="text-center align-middle">' + item
                            .sigle_commercial + '</td> \
                                                                        <td class="text-center align-middle">' + item
                            .date_creation +
                            '</td> \
                                                                        <td class="text-center align-middle"> \
                                                                        <button  data-bs-toggle="tooltip" data-bs-placement="top"   title="Supprimer" value="' +
                            item.id +
                            '" class="btn btn-outline-danger delete-filiale">  <i class="fas fa-trash"></i>  </button>\
                                                                         <button data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"  value="' +
                            item.id +
                            '"  class="btn btn-outline-warning edit-secteur" > \
                                                            <i class="fas fa-edit"></i> </button> \
                                                                              </td> \
                                                                         </tr>');
                    });
                    $('#loader').addClass('d-none');

                },
                error: function(response) {
                    Swal.fire(
                        'Erreur !',
                        "Erreur lors de la récupération des données.",
                        'error'
                    );
                    $('#loader').addClass('d-none');

                }
            });




        }
        fetchData();

        // Formulaire d'ajout da la filiale
        $('.add_btn').on('click', function(e) {
            e.preventDefault();
            var formData = new FormData($('#addForm')[0]);
            console.log('secteur :', formData.get('secteur'));


            // Réinitialiser les messages d'erreur
            $('.text-danger').text('');

            $.ajax({
                url: '{{ route('gestion.filiales.store') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire(
                        'Ajouté !',
                        'Filiale créé avec succès',
                        'success'
                    );
                    fetchData();

                    $('#addForm')[0].reset();
                    $('#btn-add-close').click();
                },
                error: function(response) {
                    if (response.status === 422) {
                        // Afficher les messages d'erreur de validation
                        var errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '-error-add').text(value[0]);
                        });
                    } else {
                        Swal.fire(
                            'Erreur !',
                            'Erreur lors de la création dela filiale',
                            'error'
                        );
                    }
                }
            });
        });
        //----------------------- Supprimer une filiale -----------------------
        $(document).on('click', '.delete-filiale', function(e) {
            e.preventDefault();

            var filiale_id = $(this).val();

            // Confirmation de la suppression
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous ne pourrez pas annuler cela !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('gestion.filiales.destroy', '') }}/' + filiale_id,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Supprimé !',
                                'Filiale supprimé avec succès.',
                                'success'
                            );
                            fetchData(); // Recharger les données après suppression
                        },
                        error: function(response) {
                            Swal.fire(
                                'Erreur !',
                                'Erreur lors de la suppression de la Filiale.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
        //  ----------------------   Editer  un secteur   -----------
        $(document).on('click', '.edit-secteur', function(e) {
            e.preventDefault();
            var secteur_id = $(this).val();
            $.ajax({
                url: '{{ route('gestion.filiales.edit', '') }}/' + secteur_id,
                method: 'GET',
                success: function(response) {

                    var formattedDate = moment(response.data.date_creation).format('YYYY-MM-DD');

                    if (response.success) {
                        $('#id-update').val(response.data.id);
                        $('#update-denomination').val(response.data.denomination);
                        $('#update-sigle_commercial').val(response.data.sigle_commercial);
                        $('#update-email').val(response.data.email);
                        $('#update-telephone').val(response.data.telephone);
                        $('#update-fixe').val(response.data.fix);
                        $('#update-date_creation').val(formattedDate);
                        $('#update-capital').val(response.data.capital_social);
                        $('#update-site').val(response.data.site_web);
                        $('#update-nom_du_dg').val(response.data.nom_dg);
                        $('#update-secteur').val(response.data.secteur_id).trigger(
                            'change'); // Sélectionner le secteur
                        $('#update-longitude').val(response.data.longitude);
                        $('#update-latitude').val(response.data.latitude);

                        // Afficher le modal de mise à jour
                        $('#update-modal').modal('show');
                    } else {
                        Swal.fire(
                            'Erreur !',
                            'Impossible de récupérer les informations de la filiale.',
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Erreur !',
                        'Erreur lors de la récupération des détails de la filiale.',
                        'error'
                    );
                }
            });

        });

        // Update  soumission du formulaire de modification
        // Update soumission du formulaire de modification
        $('.update_btn').on('click', function(e) {
            e.preventDefault();
            var filiale_id = $('#id-update').val();


            var formData = new FormData($('#updateForm')[0]);

            $.ajax({
                url: '{{ route('gestion.filiales.update', ':id') }}'.replace(':id', filiale_id),
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('response :', response);
                    if (response.success) {
                        Swal.fire(
                            'Modifié !',
                            'Filiale modifiée avec succès',
                            'success'
                        );
                        $('#update-modal').modal('hide');
                        // Rechargez les données du tableau ou mettez à jour la ligne modifiée
                        fetchData();
                    } else {
                        Swal.fire(
                            'Erreur !',
                            'Erreur survenue lors de la modification de la filiale',
                            'error'
                        );
                    }
                },
                error: function(response) {
                    if (response.status === 422) {
                        // Afficher les messages d'erreur de validation
                        var errors = response.responseJSON.errors;
                        if (errors.denomination) {
                            $('#denomination-error-update').text(errors.denomination[0]);
                        }
                        if (errors.sigle_commercial) {
                            $('#sigle_commercial-error-update').text(errors.sigle_commercial[0]);
                        }
                        if (errors.email) {
                            $('#email-error-update').text(errors.email[0]);
                        }
                        if (errors.telephone) {
                            $('#telephone-error-update').text(errors.telephone[0]);
                        }
                        if (errors.fixe) {
                            $('#fixe-error-update').text(errors.fixe[0]);
                        }
                        if (errors.date_creation) {
                            $('#date_creation-error-update').text(errors.date_creation[0]);
                        }
                        if (errors.capital) {
                            $('#capital-error-update').text(errors.capital[0]);
                        }
                        if (errors.nom_du_dg) {
                            $('#nom_du_dg-error-update').text(errors.nom_du_dg[0]);
                        }
                        if (errors.secteur) {
                            $('#secteur-error-update').text(errors.secteur[0]);
                        }
                        if (errors.latitude) {
                            $('#latitude-error-update').text(errors.latitude[0]);
                        }
                        if (errors.longitude) {
                            $('#longitude-error-update').text(errors.longitude[0]);
                        }
                        if (errors.imgDirecteur) {
                            $('#imgDirecteur-error-update').text(errors.imgDirecteur[0]);
                        }
                        if (errors.logo) {
                            $('#logo-error-update').text(errors.logo[0]);
                        }
                    } else {
                        Swal.fire(
                            'Erreur !',
                            'Erreur lors de la modification de la filiale.',
                            'error'
                        );
                    }
                }
            });
        });
    </script>
@endpush


@section('main')
    <div id="">

        <div class="content-wrapper" style="min-height:  100% !important;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Filiales</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Gitrama </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div id="loader" class="d-none">
                <div class="loader-content">
                    <div class="spinner-border text-light" role="status">
                        <span class="sr-only">Chargement...</span>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content h-100">
                <div class="container-fluid  container">

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-10 ">
                                    <h3 class="card-title"> Liste des filiales </h3>
                                </div>
                                {{-- <div class="col-2  d-flex  justify-content-end">
                                    <button type="button" class=" btn btn-outline-primary btn-block" id="add_button"
                                        data-toggle="modal" data-target="#add-modal">
                                        Ajouter
                                    </button>
                                </div> --}}

                            </div>


                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="secteurTbel" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle">Logo</th>
                                                <th class="text-center align-middle">Secteur d'activité</th>
                                                <th class="text-center align-middle">Sigle commercial</th>
                                                {{-- <th class="text-center align-middle">Dénomination</th> --}}
                                                <th class="text-center align-middle">Date de création</th>
                                                <th class="text-center align-middle">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($secteurs as $secteur)
                                                <tr>
                                                    <td class="text-center align-middle"> {{ $secteur->id }} </td>
                                                    <td class="text-center align-middle"> {{ $secteur->titre }} </td>


                                                    <td class="text-center align-middle"> {{ $secteur->description }}
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        test
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        test
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection



@push('myModals')
    <div class="modal fade " id="add-modal">
        <div class="modal-dialog   modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Ajouter une filiale </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <form method="POST" id="addForm" action="{{ route('gestion.filiales.store') }}">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label class="require form-label">Dénomination :</label>
                                            <input name="denomination" type="text"
                                                class="form-control @error('denomination') is-invalid @enderror"
                                                id="denomination" placeholder="Dénomination"
                                                value="{{ old('denomination') }}">
                                            <span id="denomination-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="require form-label">Sigle commercial :</label>
                                            <input name="sigle_commercial" type="text"
                                                class="form-control @error('sigle_commercial') is-invalid @enderror"
                                                id="sigle_commercial" placeholder="Sigle commercial"
                                                value="{{ old('sigle_commercial') }}">
                                            <span id="sigle_commercial-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="require form-label">Email :</label>
                                            <input name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                placeholder="Email" value="{{ old('email') }}">
                                            <span id="email-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="require form-label">Téléphone :</label>
                                            <input name="telephone" type="tel"
                                                class="form-control @error('telephone') is-invalid @enderror"
                                                id="telephone" placeholder="Téléphone" value="{{ old('telephone') }}">
                                            <span id="telephone-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class=" form-label">Fax :</label>
                                            <input name="fixe" type="tel"
                                                class="form-control @error('fixe') is-invalid @enderror" id="fixe"
                                                placeholder="Fix" value="{{ old('fixe') }}">
                                            <span id="fixe-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label
                                                class="require form-label @error('date_creation') is-invalid @enderror">Date
                                                de création :</label>
                                            <input class="form-control" type="date" id="date_creation"
                                                name="date_creation" value="{{ old('date_creation') }}">
                                            <span id="date_creation-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="require form-label">Capital social :</label>
                                            <input name="capital" type="number"
                                                class="form-control @error('capital') is-invalid @enderror" id="capital"
                                                placeholder="Capital social" value="{{ old('capital') }}">
                                            <span id="capital-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class=" form-label">Site Web :</label>
                                            <input name="site" type="text"
                                                class="form-control @error('site') is-invalid @enderror" id="site"
                                                placeholder="Site Web" value="{{ old('site') }}">
                                            <span id="site-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class=" form-label">Nom du DG :</label>
                                            <input name="nom_du_dg" type="text"
                                                class="form-control @error('nom_du_dg') is-invalid @enderror"
                                                id="nom_du_dg" placeholder="Nom du DG" value="{{ old('nom_du_dg') }}">
                                            <span id="nom_du_dg-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class=" @error('imgDirecteur') is-invalid @enderror">Image du
                                                directeur :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imgDirecteur"
                                                        id="imgDirecteur" lang="fr"
                                                        accept=".jpg,.jpeg,.gif,.png,.jfif">
                                                    <label class="custom-file-label" for="imgDirecteur">Choisir une
                                                        image</label>
                                                </div>
                                            </div>
                                            <span id="imgDirecteur-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label class="require @error('logo') is-invalid @enderror">Logo :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo"
                                                        id="logo" lang="fr"
                                                        accept=".jpg,.jpeg,.gif,.png,.jfif">
                                                    <label class="custom-file-label" for="logo">Choisir une
                                                        image</label>
                                                </div>
                                            </div>
                                            <span id="logo-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="require @error('secteur') is-invalid @enderror">Secteur
                                                d'activité</label>
                                            <select id="secteur" name="secteur" class="form-control"
                                                style="width: 100%;">
                                                <option value="" disabled selected>Sélectionner un secteur</option>
                                                @foreach ($secteurs as $secteur)
                                                    <option value="{{ $secteur->id }}">{{ $secteur->titre }}</option>
                                                @endforeach
                                            </select>
                                            <span id="secteur-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="require form-label">Latitude :</label>
                                            <input name="latitude" type="number"
                                                class="form-control @error('latitude') is-invalid @enderror"
                                                id="latitude" placeholder="Latitude" value="{{ old('latitude') }}">
                                            <span id="latitude-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="require form-label">Longitude :</label>
                                            <input name="longitude" type="number"
                                                class="form-control @error('longitude') is-invalid @enderror"
                                                id="longitude" placeholder="Longitude" value="{{ old('longitude') }}">
                                            <span id="longitude-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" id="btn-add-close"
                                data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary add_btn">Enregistrer</button>
                        </div>
                    </form>


                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    {{-- ---------------------------------- update model ---------------------------------------- --}}
    <div class="modal fade " id="update-modal">
        <div class="modal-dialog   modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier une filiale</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <form method="POST" id="updateForm" action="{{ route('gestion.filiales.store') }}">
                        <div class="modal-body">
                            <div class="card-body">
                                <input name="titre-update" type="hidden" id="id-update"></input>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label class="require form-label">Dénomination :</label>
                                            <input name="denomination" type="text"
                                                class="form-control @error('denomination') is-invalid @enderror"
                                                id="update-denomination" placeholder="Dénomination"
                                                value="{{ old('denomination') }}">
                                            <span id="denomination-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="require form-label">Sigle commercial :</label>
                                            <input name="sigle_commercial" type="text"
                                                class="form-control @error('sigle_commercial') is-invalid @enderror"
                                                id="update-sigle_commercial" placeholder="Sigle commercial"
                                                value="{{ old('sigle_commercial') }}">
                                            <span id="sigle_commercial-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="require form-label">Email :</label>
                                            <input name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="update-email" placeholder="Email" value="{{ old('email') }}">
                                            <span id="email-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="require form-label">Téléphone :</label>
                                            <input name="telephone" type="tel"
                                                class="form-control @error('telephone') is-invalid @enderror"
                                                id="update-telephone" placeholder="Téléphone"
                                                value="{{ old('telephone') }}">
                                            <span id="telephone-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class=" form-label">Fax :</label>
                                            <input name="fixe" type="tel"
                                                class="form-control @error('fixe') is-invalid @enderror" id="update-fixe"
                                                placeholder="Fix" value="{{ old('fixe') }}">
                                            <span id="fixe-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label
                                                class="require form-label @error('date_creation') is-invalid @enderror">Date
                                                de création :</label>
                                            <input class="form-control" type="date" id="update-date_creation"
                                                name="date_creation" value="{{ old('date_creation') }}">
                                            <span id="date_creation-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label class="require form-label">Capital social :</label>
                                            <input name="capital" type="number"
                                                class="form-control @error('capital') is-invalid @enderror"
                                                id="update-capital" placeholder="Capital social"
                                                value="{{ old('capital') }}">
                                            <span id="capital-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="require form-label">Site Web :</label>
                                            <input name="site" type="text"
                                                class="form-control @error('site') is-invalid @enderror" id="update-site"
                                                placeholder="Site Web" value="{{ old('site') }}">
                                            <span id="site-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class=" form-label">Nom du DG :</label>
                                            <input name="nom_du_dg" type="text"
                                                class="form-control @error('nom_du_dg') is-invalid @enderror"
                                                id="update-nom_du_dg" placeholder="Nom du DG"
                                                value="{{ old('nom_du_dg') }}">
                                            <span id="nom_du_dg-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class=" @error('imgDirecteur') is-invalid @enderror">Image du
                                                directeur :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imgDirecteur"
                                                        id="update-imgDirecteur" lang="fr"
                                                        accept=".jpg,.jpeg,.gif,.png">
                                                    <label class="custom-file-label" for="imgDirecteur">Choisir une
                                                        image</label>
                                                </div>
                                            </div>
                                            <span id="imgDirecteur-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label class="require @error('logo') is-invalid @enderror">Logo :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo"
                                                        id="update-logo" lang="fr" accept=".jpg,.jpeg,.gif,.png">
                                                    <label class="custom-file-label" for="logo">Choisir une
                                                        image</label>
                                                </div>
                                            </div>
                                            <span id="logo-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="require @error('secteur') is-invalid @enderror">Secteur
                                                d'activité</label>
                                            <select id="update-secteur" name="secteur" class="form-control"
                                                style="width: 100%;">
                                                <option value="" disabled selected>Sélectionner un secteur</option>
                                                @foreach ($secteurs as $secteur)
                                                    <option value="{{ $secteur->id }}">{{ $secteur->titre }}</option>
                                                @endforeach
                                            </select>
                                            <span id="secteur-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="require form-label">Latitude :</label>
                                            <input name="latitude" type="number"
                                                class="form-control @error('latitude') is-invalid @enderror"
                                                id="update-latitude" placeholder="Latitude"
                                                value="{{ old('latitude') }}">
                                            <span id="latitude-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="require form-label">Longitude :</label>
                                            <input name="longitude" type="number"
                                                class="form-control @error('longitude') is-invalid @enderror"
                                                id="update-longitude" placeholder="Longitude"
                                                value="{{ old('longitude') }}">
                                            <span id="longitude-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" id="btn-add-close"
                                data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary update_btn">Enregistrer</button>
                        </div>
                    </form>


                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endpush
