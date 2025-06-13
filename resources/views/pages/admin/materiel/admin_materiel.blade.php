@extends('layouts/admine_layout', ['title' => ' NOTRE MATERIEL'])

<title> NOTRE MATERIEL</title>

@push('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href=" {{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">

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
    </style>

    <style>
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

    <style>
        /* image lightbox  style  */
        .image-container {
            position: relative;
            width: 300px;
            /* Ajustez la largeur en fonction de vos besoins */
            height: 200px;
            /* Ajustez la hauteur en fonction de vos besoins */
        }

        .hover-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            /* Assombrit légèrement l'image */
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-container:hover .overlay {
            opacity: 0.5;
        }

        .overlay i {
            color: #171616;
            font-size: 50px;
            /* Taille de l'icône */
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .image-container:hover .overlay i {
            transform: scale(1.2);
            /* Agrandit l'icône lors du survol */
            color: #201f1f;
            /* Change la couleur de l'icône */
        }
    </style>
@endpush


@push('custom-scripts')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <!-- Ekko Lightbox -->
    <script src="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

    <!-- Page specific script -->
    <script>
        //   Récupérer les données du DataTable

        function fetchData() {
            $.ajax({
                url: '{{ route('gestion.materiel.get') }}',
                method: 'GET',
                dataType: "json",
                beforeSend: function() {
                    // Afficher le loader avant que la requête ne soit envoyée
                    $('#loader').removeClass('d-none');
                },
                success: function(response) {
                    console.log('heloooo : ', response.data);

                    $('tbody').html("");
                    $.each(response.data, function(key, item) {
                        var etatElment = item.etat == '1' ?
                            ' <span class="badge bg-success">Publié</span>' :
                            '  <span class="badge bg-danger">Brouillon</span>';
                        var publie = item.etat == '0' ?
                            ' <button data-bs-toggle="tooltip" data-bs-placement="top" title="Publier"  value="' +
                            item.id +
                            '"  class="btn btn-outline-success publie-materil" > \
                                                    <i class="fas fa-upload"></i> \
                                                </button>' : '';
                        $('tbody').append( `
                            <tr>
                            <td style="max-width: 100px; max-height: 100px; overflow: hidden;">
                               <span class="preview">
                                 <a href="${item.img }" data-toggle="lightbox" data-title="" class='image-container'>
                                      <div  class=''>
                                        <img src="${item.img }" class="img-fluid mb-2 hover-image" alt="white sample" style="max-width: 100%; max-height: 100px;" />
                                             <div class="overlay w-100">
                                                <i class="fas fa-search-plus"></i>
                                             </div>
                                       </div>
                                       </a>
                                </span>

                             </td>

                            <td class="text-center align-middle" style="width: 300px;""> ${ item.intitule }  </td>
                            <td class="text-center align-middle"> ${ item.filiale }  </td>
                            <td class="text-center align-middle"> ${ etatElment }  + '</td>

                            <td class="text-center align-middle">    ${ publie }
                              <button data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"   value="${ item.id}"  class="btn btn-outline-warning edit-projet" >
                                        <i class="fas fa-edit"></i>
                               </button>
                              <button  data-bs-toggle="tooltip" data-bs-placement="top"   title="Supprimer"  value="${ item.id}" class="btn btn-outline-danger delete-projet">
                                 <i class="fas fa-trash"></i>
                               </button>
                            </td>
                          </tr>`
                        );
                    });
                    $('#loader').addClass('d-none');
                },
                error: function(response) {
                    $('#loader').addClass('d-none');
                    Swal.fire(
                        'Erreur !',
                        "Erreur lors de la récupération des données.",
                        'error'
                    );

                }
            });

        }

        // Mise à jour du projet

        function update() {

            var id_materiel = $('#id-update').val();

            var formData = new FormData($('#updateForm')[0]);

            $.ajax({
                url: '{{ route('gestion.materiel.update', ':id') }}'.replace(':id', id_materiel),
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
                            'Matériel modifié avec succès.',
                            'success'
                        );
                        $('#update-modal').modal('hide');

                        // Rechargez les données du tableau ou mettez à jour la ligne modifiée
                        fetchData();
                    } else {
                        Swal.fire(
                            'Erreur !',
                            'Erreur survenue lors de la modification ',
                            'error'
                        );
                    }
                },
                error: function(response) {
                    if (response.status === 422) {
                        var errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '-error-update').text(value[0]);
                        });

                    } else {
                        Swal.fire(
                            'Erreur !',
                            'Erreur lors de la modification .',
                            'error'
                        );
                    }
                }
            });
        }


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

            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            fetchData();


            // Formulaire d'ajout du matériel
            $('.add_btn').on('click', function(e) {
                e.preventDefault();
                var formData = new FormData($('#addForm')[0]);

                $.ajax({
                    url: '{{ route('gestion.materiel.store') }}',
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
                            'Materiel créé avec succès',
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
                                'Erreur lors de la création du Materiel',
                                'error'
                            );
                        }
                    }
                });

            });

            //-----------------------  suppression du matériel  -----------------------
            $(document).on('click', '.delete-projet', function(e) {
                e.preventDefault();

                var materiel = $(this).val();

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
                            url: '{{ route('gestion.materiel.destroy', '') }}/' + materiel,
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Supprimé !',
                                    'Matériel  supprimé avec succès.',
                                    'success'
                                );
                                fetchData(); // Recharger les données après suppression
                            },
                            error: function(response) {
                                Swal.fire(
                                    'Erreur !',
                                    'Erreur lors de la suppression du matériel.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            //  ----------------------   Editer  un matériel   -----------
            $(document).on('click', '.edit-projet', function(e) {
                e.preventDefault();
                var materiel_id = $(this).val();
                $.ajax({
                    url: '{{ route('gestion.materiel.edit', '') }}/' + materiel_id,
                    method: 'GET',
                    success: function(response) {
                        console.log('respoens : ', response);


                        if (response.success) {
                            $('#id-update').val(response.data.id);
                            $('#update-intitule').val(response.data.titre);
                            $('#update-filiale').val(response.data.id_filiale);



                            // Afficher le modal de mise à jour
                            $('#update-modal').modal('show');
                        } else {
                            Swal.fire(
                                'Erreur !',
                                'Impossible de récupérer les informations du matériel.',
                                'error'
                            );
                        }
                    },
                    error: function(error) {
                        console.log('error : ', error);
                        Swal.fire(
                            'Erreur !',
                            'Erreur lors de la récupération des détails du matériel.',
                            'error'
                        );
                    }
                });

            });


            //  ----------------------   Editer  un matériel   -----------
            $(document).on('click', '.publie-materil', function(e) {
                e.preventDefault();
                var materiel_id = $(this).val();
                $.ajax({
                    url: '{{ route('gestion.materiel.publie', '') }}/' + materiel_id,
                    method: 'GET',
                    success: function(response) {
                        console.log('respoens : ', response);


                        if (response.success) {
                            fetchData();
                        } else {
                            Swal.fire(
                                'Erreur !',
                                'Impossible de récupérer les informations du matériel.',
                                'error'
                            );
                        }
                    },
                    error: function(error) {
                        console.log('error : ', error);
                        Swal.fire(
                            'Erreur !',
                            'Erreur lors de la récupération des détails du matériel.',
                            'error'
                        );
                    }
                });

            });



        })
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
                            <h1 class="m-0"> NOTRE MATERIEL</h1>
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


            <!-- Loader Full Page -->
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
                                    <h3 class="card-title"> Liste de notre matériel </h3>
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
                                                <th class="text-center align-middle">Image</th>
                                                <th class="text-center align-middle">Intitulé</th>
                                                <th class="text-center align-middle">Filiale</th>
                                                <th class="text-center align-middle">Etat</th>
                                                <th class="text-center align-middle">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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
                    <h4 class="modal-title"> Ajouter un matériel </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <form method="POST" id="addForm" action="{{ route('gestion.materiel.store') }}">
                        <div class="modal-body">
                            <div class="card-body">

                                {{-- ------------------------------ Intitulé ----------------------- --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="require form-label">Intitulé :</label>
                                            <input name="intitule" type="text"
                                                class="form-control @error('intitule') is-invalid @enderror" id="intitule"
                                                placeholder="Intitulé" value="{{ old('intitule') }}">
                                            <span id="intitule-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>


                                {{-- ------------------------------ Image  / Filiale----------------------- --}}

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label class="require @error('img') is-invalid @enderror">Image :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="img"
                                                        id="img" lang="fr" accept=".jpg,.jpeg,.gif,.png,.jfif">
                                                    <label class="custom-file-label" for="img">Choisir une
                                                        image</label>
                                                </div>
                                            </div>
                                            <span id="img-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="require @error('filiale') is-invalid @enderror">Filiale</label>
                                            <select id="filiale" name="filiale" class="form-control"
                                                style="width: 100%;">
                                                <option value="" disabled selected>Sélectionner une Filiale</option>
                                                @foreach ($filiales as $filiale)
                                                    <option value="{{ $filiale->id }}">{{ $filiale->sigle_commercial }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span id="filiale-error-add" class="text-danger"></span>
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
                    <h4 class="modal-title"> Modifier le projet </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>

                    <form method="POST" id="updateForm" action="{{ route('gestion.materiel.store') }}">
                        <div class="modal-body">
                            <div class="card-body">
                                <input name="id" type="hidden" id="id-update"></input>
                                {{-- ------------------------------ Intitulé ----------------------- --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="require form-label">Intitulé :</label>
                                            <input name="intitule" type="text"
                                                class="form-control @error('intitule') is-invalid @enderror"
                                                id="update-intitule" placeholder="Intitulé"
                                                value="{{ old('intitule') }}">
                                            <span id="intitule-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>


                                {{-- ------------------------------ Image  / Filiale----------------------- --}}

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label class="require @error('img') is-invalid @enderror">Image :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="img"
                                                        id="update-img" lang="fr"
                                                        accept=".jpg,.jpeg,.gif,.png,.jfif">
                                                    <label class="custom-file-label" for="img">Choisir une
                                                        image</label>
                                                </div>
                                            </div>
                                            <span id="img-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="require @error('filiale') is-invalid @enderror">Filiale</label>
                                            <select id="update-filiale" name="filiale" class="form-control"
                                                style="width: 100%;">
                                                <option value="" disabled selected>Sélectionner une Filiale</option>
                                                @foreach ($filiales as $filiale)
                                                    <option value="{{ $filiale->id }}">{{ $filiale->sigle_commercial }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span id="filiale-error-update" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" id="btn-update-close"
                                data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary update_btn"
                                onclick="update()">Enregistrer</button>
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
