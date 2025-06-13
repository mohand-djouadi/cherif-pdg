@extends('layouts/admine_layout', ['title' => "Secteurs d'activité"])

<title>Secteurs d'activité</title>

@push('custom-styles')
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
    <!-- SweetAlert2 -->
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    {{-- <script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script> --}}
    {{-- <script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script> --}}
    {{-- <script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script> --}}
    {{-- <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script> --}}

    <!-- Page specific script -->
    <script>
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
                        'data-target': "#modal-lg"
                    },
                    action: (e) => {
                        // e.preventDefault();
                        // window.location.href = "{{ route('admin.secteurs.secteur', ['etat' => 'create', 'id' => 0]) }}";
                    }
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

            // Récupérer les données du tableau.
            function fetchData() {
                $.ajax({
                    url: '{{ route('admin.secteurs.get') }}',
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
                            $('tbody').append('<tr> \
                                                                            <td class="text-center align-middle">' + item
                                .id + '</td> \
                                                                            <td class="text-center align-middle">' + item
                                .titre + '</td> \
                                                                            <td class="text-center align-middle">' + item
                                .description + '</td> \
                                                                            <td class="text-center align-middle">' + item
                                .date_ajout +
                                '</td> \
                                                                            <td class="text-center align-middle">    \
                                                                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"  value="' +
                                item.id +
                                '"  class="btn btn-outline-warning edit-secteur" > \
                                                                        <i class="fas fa-edit"></i> </button> \
                                                                          <button  data-bs-toggle="tooltip" data-bs-placement="top"   title="Supprimer" value="' +
                                item.id + '" class="btn btn-outline-danger delete-secteur">  <i class="fas fa-trash"></i>  </button> \
                                                                            </td> \
                                                                             </tr>');
                        });
                        // Masquer le loader une fois les données récupérées
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
            fetchData();

            // fin recuperation

            // Formulaire d'ajout du secteur

            $('.add_btn').on('click', function(e) {
                e.preventDefault();

                var formData = $('#addForm').serializeArray();
                var formObject = {};
                $.each(formData, function(index, field) {
                    formObject[field.name] = field.value;
                });

                console.log("ff :", formObject);
                // Réinitialiser les messages d'erreur
                $('#titre-error').text('');
                $('#description-error').text('');

                $.ajax({
                    url: '{{ route('admin.secteurs.store') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formObject,
                    success: function(response) {
                        Swal.fire(
                            'Ajouté !',
                            'Secteur d\'activité créé avec succès',
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
                            if (errors.titre) {
                                $('#titre-error').text(errors.titre[0]);
                            }
                            if (errors.description) {
                                $('#description-error').text(errors.description[0]);
                            }
                        } else {
                            Swal.fire(
                                'Erreur !',
                                'Erreur lors de la création du secteur d\'activité',
                                'error'
                            );
                        }
                    }
                });
            });



            //----------------------- Supprimer un secteur -----------------------
            $(document).on('click', '.delete-secteur', function(e) {
                e.preventDefault();

                var secteur_id = $(this).val();
                console.log('ID du secteur à supprimer :', secteur_id);

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
                            url: '{{ route('admin.secteurs.destroy', '') }}/' + secteur_id,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Supprimé !',
                                    'Secteur d\'activité supprimé avec succès.',
                                    'success'
                                );
                                fetchData(); // Recharger les données après suppression
                            },
                            error: function(response) {
                                Swal.fire(
                                    'Erreur !',
                                    'Erreur lors de la suppression du secteur d\'activité.',
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
                    url: '{{ route('admin.secteurs.edit', '') }}/' + secteur_id,
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('#titre-update').val(response.data.titre);
                            $('#id-update').val(response.data.id);
                            $('textarea[name="description-update"]').val(response.data
                                .description);
                            $('#modal-update').modal('show');
                        } else {
                            Swal.fire(
                                'Erreur !',
                                'Impossible de récupérer les détails du secteur d\'activité.',
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Erreur !',
                            'Erreur lors de la récupération des détails du secteur d\'activité.',
                            'error'
                        );
                    }
                });

            });

            // Update  soumission du formulaire de modification
            $('.update_btn').on('click', function(e) {
                e.preventDefault();
                var secteur_id = $('#id-update').val();
                console.log('ID du secteur à modifier :', secteur_id);

                var formData = {
                    titre: $('#titre-update').val(),
                    description: $('textarea[name="description-update"]').val(),
                };

                $.ajax({
                    url: '{{ route('admin.secteurs.update', ':id') }}'.replace(':id', secteur_id),
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Modifié !',
                                'Secteur d\'activité modifié avec succès',
                                'success'
                            );
                            $('#modal-update').modal('hide');
                            // Rechargez les données du tableau ou mettez à jour la ligne modifiée
                            fetchData();
                        } else {
                            Swal.fire(
                                'Erreur !',
                                'Erreur lors de la modification du secteur d\'activité.',
                                'error'
                            );
                        }
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            // Afficher les messages d'erreur de validation
                            var errors = response.responseJSON.errors;
                            if (errors.titre) {
                                $('#titre-error-update').text(errors.titre[0]);
                            }
                            if (errors.description) {
                                $('#description-error-update').text(errors.description[0]);
                            }
                        } else {
                            Swal.fire(
                                'Erreur !',
                                'Erreur lors de la modification du secteur d\'activité.',
                                'error'
                            );
                        }
                    }
                });
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
                            <h1 class="m-0">Secteurs d'activité</h1>
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
            <!-- Loader -->
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
                                    <h3 class="card-title"> Liste des secteurs d'activité </h3>
                                </div>
                                {{-- <div class="col-2  d-flex  justify-content-end">
                                    <button type="button" class=" btn btn-outline-primary btn-block" id="add_button"
                                        data-toggle="modal" data-target="#modal-lg">
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
                                                <th class="text-center align-middle"> ID </th>
                                                <th class="text-center align-middle"> Titre </th>

                                                <th class="text-center align-middle"> Description </th>
                                                <th class="text-center align-middle"> Date d'ajout </th>
                                                <th class="text-center align-middle"> Action </th>
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
    <div class="modal fade " id="modal-lg">
        <div class="modal-dialog   modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter un nouveau secteur d'activité </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="addForm" action="{{ route('admin.secteurs.store') }}">

                    <div class="modal-body">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label class="require form-label">Titre :</label>

                                <input name="titre" class="form-control  @error('titre') is-invalid @enderror"
                                    id="titre" placeholder="Titre">{{ old('titre') }}</input>
                                <span id="titre-error" class="text-danger"></span>
                            </div>
                            <div class="form-group ">
                                <label class="  form-label">Description :</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old('description') }}</textarea>
                                <span id="description-error" class="text-danger"></span>
                            </div>
                            <!-- /.card-body -->

                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default " id="btn-add-close"
                            data-dismiss="modal">Fermer</button>
                        <button type="button" type="submit " class="btn btn-primary add_btn">Enregistrer</button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    {{-- ---------------------------------- update model ---------------------------------------- --}}

    <div class="modal fade " id="modal-update">
        <div class="modal-dialog   modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier un secteur d'activité</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="addForm" action="{{ route('admin.secteurs.store') }}">

                    <div class="modal-body">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <input name="titre-update" type="hidden" id="id-update"></input>
                            <div class="form-group">
                                <label class="require form-label">Titre :</label>

                                <input name="titre-update"
                                    class="form-control  @error('titre-update') is-invalid @enderror" id="titre-update"
                                    placeholder="Titre"></input>
                                <span id="titre-error-update" class="text-danger"></span>
                            </div>
                            <div class="form-group ">
                                <label class="  form-label">Description :</label>
                                <textarea name="description-update" class="form-control @error('description-update') is-invalid @enderror"
                                    placeholder="Description-update">{{ old('description') }}</textarea>
                                <span id="description-error-update" class="text-danger"></span>
                            </div>
                            <!-- /.card-body -->

                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default " id="btn-add-close"
                            data-dismiss="modal">Fermer</button>
                        <button type="button" type="submit " class="btn btn-primary update_btn">Enregistrer</button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endpush
