@extends('layouts.admine_layout', ['title' => 'Accueil'])

@push('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
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
@endpush

@push('custom-scripts')
    <!-- SweetAlert2 -->
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- DataTables & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#secteurTbel").DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
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

            // Récupérer les données du tableau
            function fetchData() {
                $.ajax({
                    url: '{{ route('admin.secteurs.get') }}',
                    method: 'GET',
                    dataType: "json",
                    success: function(response) {
                        console.log('heloooo : ', response.data);
                        $('tbody').html("");
                        $.each(response.data, function(key, item) {
                            $('tbody').append(`
                                <tr>
                                    <td class="text-center align-middle">${item.id}</td>
                                    <td class="text-center align-middle">${item.titre}</td>
                                    <td class="text-center align-middle">${item.description}</td>
                                    <td class="text-center align-middle">${item.date_ajout}</td>
                                    <td class="text-center align-middle">
                                        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier" value="${item.id}" class="btn btn-outline-warning edit-secteur">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer" value="${item.id}" class="btn btn-outline-danger delete-secteur">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    },
                    error: function() {
                        Swal.fire('Erreur !', "Erreur lors de la récupération des données.", 'error');
                    }
                });
            }
            // fetchData();

            $('#submitBtn').on('click', function(e) {
                e.preventDefault();
                console.log('heloooooooooooooooooooooooooooooooo');
                $.ajax({
                    url: "{{ route('admin.user.updateMdp') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#updateMdpForm').serialize(),
                    success: function(response) {
                        $('.error-container').hide();
                        Swal.fire('Succès!', 'Mot de passe mis à jour avec succès.', 'success');
                    },
                    error: function(xhr) {
                        console.log(xhr);

                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.message;
                            console.log(errors);
                                $('#err').text(errors);
                                $('.error-container').show();
                        }
                        else {
                            Swal.fire(
                                'Erreur !',
                                'Erreur lors de la création du secteur d\'activité',
                                'error'
                            );
                        }

                    }
                });
            });
        });

        function togglePasswordVisibility(inputId, iconId) {
            var passwordInput = document.getElementById(inputId);
            var icon = document.getElementById(iconId);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
@endpush

@section('main')
    <main id="main">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Modifier le mot de passe</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Gitrama</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <form id="updateMdpForm">
                        @csrf <!-- CSRF token nécessaire pour les requêtes POST -->

                        <div class="card-body">
                            <div class="error-container mb-3"
                            style="border: 1px solid red; padding: 10px; margin-top: 10px; background-color: #f8d7da; border-radius: 5px; display: none;">
                                <span class="text-danger" id="err"></span>
                            </div>


                            <!-- Mot de passe actuel -->
                            <div class="form-group">
                                <label class="require form-label">Mot de passe actuel :</label>
                                <div class="input-group">
                                    <input name="mdp" type="password"
                                        class="form-control @error('mdp') is-invalid @enderror" id="mdp"
                                        placeholder="Mot de passe actuel">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="togglePasswordVisibility('mdp', 'mdp-icon')">
                                            <i id="mdp-icon" class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <!-- Nouveau mot de passe -->
                            <div class="form-group">
                                <label class="require form-label">Nouveau mot de passe :</label>
                                <div class="input-group">
                                    <input name="new_mdp" type="password"
                                        class="form-control @error('new_mdp') is-invalid @enderror" id="new_mdp"
                                        placeholder="Nouveau mot de passe" value="{{ old('new_mdp') }}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="togglePasswordVisibility('new_mdp', 'new_mdp-icon')">
                                            <i id="new_mdp-icon" class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="require form-label">Confirmer le mot de passe :</label>
                                <div class="input-group">
                                    <input name="new_mdp_confirmation" type="password"
                                        class="form-control " id="new_mdp_confirmation"
                                        placeholder="Confirmer le mot de passe" >
                                </div>

                            </div>
                        </div>

                        <div class=" d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary update_btn" id="submitBtn">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection
