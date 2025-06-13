@extends('layouts/admine_layout', ['title' => ' PROJETS'])

<title> PROJETS</title>

@push('custom-styles')
    <!-- BS Stepper -->
    {{-- <link rel="stylesheet" href="{{ asset('admin/plugins/bs-stepper/css/bs-stepper.min.css') }}"> --}}
    <!-- bs-custom-file-input -->
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href=" {{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/min/dropzone.min.css') }}">
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
        /* loader style  */
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
    <!-- BS-Stepper -->
    <script src="{{ asset('admin/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <!-- dropzonejs -->
    <script src="{{ asset('admin/plugins/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Ekko Lightbox -->
    <script src="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

    <!-- Page specific script -->
    <script>
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
        // BS-Stepper end


        // DropzoneJS 2     ( Initialisation du Dropzone de la modification. )
        Dropzone.autoDiscover = false
        var previewNode2 = document.querySelector("#template2")
        previewNode2.id = ""
        var previewTemplate2 = previewNode2.parentNode.innerHTML
        previewNode2.parentNode.removeChild(previewNode2)


        var myDropzone2 = new Dropzone(
            "#update_file", { // Make the whole body a dropzone
                paramName: "update_file",
                url: "/target-url", // Set the url
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 20,
                previewTemplate: previewTemplate2,
                autoQueue: false, // Make sure the files aren't queued until manually added
                previewsContainer: "#previews2", // Define the container to display the previews
                clickable: ".fileinput-button2" // Define the element that should be used as click trigger to select files.
            })

        myDropzone2.on("addedfile", function(file) {

        })

        document.querySelector("#update_file .cancel").onclick =
            function() {
                myDropzone2.removeAllFiles(true)
            }

        // FIN DropzoneJS 2


        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        //   Récupérer les données du DataTable

        function fetchData() {
            $.ajax({
                url: '{{ route('gestion.projet.get') }}',
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
                        $('tbody').append(
                            `<tr>
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
                                    <td class="text-center align-middle" style="width: 300px;""> ${ item.intitule}  </td>
                                    <td class="text-center align-middle"> ${ item.date} </td>
                                    <td class="text-center align-middle"> ${ item.filiale}</td>
                                    <td class="text-center align-middle">
                                        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"  value="${ item.id}"  class="btn btn-outline-warning edit-projet" >
                                                          <i class="fas fa-edit"></i>
                                        </button>
                                         <button  data-bs-toggle="tooltip" data-bs-placement="top"   title="Supprimer" value="${ item.id}" class="btn btn-outline-danger delete-projet">
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
            console.log('radio : ', $('input[name="img_ouverture"]:checked').val());
            console.log(' updat efiles : ', myDropzone2.getFilesWithStatus(Dropzone.ADDED));
            var id_project = $('#id-update').val();

            var formData = new FormData();
            var div = document.getElementById('info-part');
            var inputs = div.querySelectorAll('input');


            inputs.forEach(function(input) {
                formData.append(input.name, input.value);
            });

            formData.append('filiale', $('#update-filiale').val());
            formData.append('img_ouverture', $('input[name="img_ouverture"]:checked').val());


            var addedFiles = myDropzone2.getFilesWithStatus(Dropzone.ADDED);

            addedFiles.forEach(function(file, index) {
                formData.append('file[]', file, file.name);
            });

            $.ajax({
                url: '{{ route('gestion.projet.update', ':id') }}'.replace(':id', id_project),
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
                            'Projet modifiée avec succès',
                            'success'
                        );
                        $('#update-modal').modal('hide');
                        var errorSpans = div.querySelectorAll('span[id$="-error-update"]');
                        errorSpans.forEach(function(span) {
                            span.innerHTML = ''; // Vider le contenu du span
                        });
                        stepper.to(1);
                        myDropzone2.removeAllFiles(true);
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
                        stepper.to(1);
                        // Afficher les messages d'erreur de validation
                        var errors = response.responseJSON.errors;
                        if (errors.intitule) {
                            $('#intitule-error-update').text(errors.intitule[0]);
                        }
                        if (errors.maitre_ouvrage) {
                            $('#maitre_ouvrage-error-update').text(errors.maitre_ouvrage[0]);
                        }
                        if (errors.maitre_ouvrage) {
                            $('#montant-error-update').text(errors.maitre_ouvrage[0]);
                        }
                        // if (errors.date_debut) {
                        //     $('#date_debut-error-update').text(errors.date_debut[0]);
                        // }
                        // if (errors.date_fin) {
                        //     $('#date_fin-error-update').text(errors.date_fin[0]);
                        // }
                        if (errors.duree) {
                            $('#duree-error-update').text(errors.duree[0]);
                        }

                        if (errors.localisation) {
                            $('#localisation-error-update').text(errors.localisation[0]);
                        }

                        if (errors.filiale) {
                            $('#filiale-error-update').text(errors.filiale[0]);
                        }
                        if (errors.participant) {
                            $('#participant-error-update').text(errors.participant[0]);
                        }

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

        // La fonction qui supprime les images dans le modèle de la modification

        function deleteImg(id, index) {
            console.log('id : ', id);
            $.ajax({
                url: '{{ route('gestion.projet.deleteImg', '') }}/' + id,
                method: 'GET',
                success: function(response) {
                    Swal.fire(
                        'Supprimé !',
                        'Image supprimé avec succès.',
                        'success'
                    );
                    var element = document.querySelector(`div[value="${id}"]`);
                    element.parentNode.removeChild(element);
                },
                error: function(response) {

                    if (response.status === 409) {
                        Swal.fire(
                            'Erreur !',
                            'Vous ne pouvez pas supprimer l\'image de couverture.',
                            'error'
                        );
                    } else {
                        Swal.fire(
                            'Erreur !',
                            'Erreur lors de la suppression de l\'image.',
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

            fetchData();


            // DropzoneJS Demo Code Start
            Dropzone.autoDiscover = false

            // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
            var previewNode = document.querySelector("#template")
            previewNode.id = ""
            var previewTemplate = previewNode.parentNode.innerHTML
            previewNode.parentNode.removeChild(previewNode)

            var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                paramName: "file",
                url: "/target-url", // Set the url
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 20,
                previewTemplate: previewTemplate,
                autoQueue: false, // Make sure the files aren't queued until manually added
                previewsContainer: "#previews", // Define the container to display the previews
                clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
            })

            myDropzone.on("addedfile", function(file) {

            })

            document.querySelector("#actions .cancel").onclick = function() {
                myDropzone.removeAllFiles(true)
            }
            // DropzoneJS Demo Code End

            // Formulaire d'ajout d'un projet
            $('.add_btn').on('click', function(e) {
                e.preventDefault();
                var formData = new FormData($('#addForm')[0]);

                var addedFiles = myDropzone.getFilesWithStatus(Dropzone.ADDED);

                addedFiles.forEach(function(file, index) {
                    formData.append('file[]', file, file.name);
                });

                $.ajax({
                    url: '{{ route('gestion.projet.store') }}',
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

            //----------------------- Supprimer le projet  -----------------------
            $(document).on('click', '.delete-projet', function(e) {
                e.preventDefault();

                var projet = $(this).val();

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
                            url: '{{ route('gestion.projet.destroy', '') }}/' + projet,
                            method: 'GET',
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

            //  ----------------------   Editer  un projet   -----------
            $(document).on('click', '.edit-projet', function(e) {
                e.preventDefault();
                var project_id = $(this).val();
                $.ajax({
                    url: '{{ route('gestion.projet.edit', '') }}/' + project_id,
                    method: 'GET',
                    beforeSend: function() {
                        // Afficher le loader avant que la requête ne soit envoyée
                        $('#loader').removeClass('d-none');
                    },
                    success: function(response) {
                        console.log('respoens : ', response);

                        $('#update-modal').modal('show');
                        if (response.success) {
                            $('#id-update').val(response.data.id);
                            $('#update-intitule').val(response.data.intitule);
                            $('#update-maitre_ouvrage').val(response.data.maitre_ouvrage);
                            // $('#update-date_debut').val(response.data.date_debut);
                            // $('#update-date_fin').val(response.data.date_fin);
                            $('#update-duree').val(response.data.duree);
                            $('#update-montant').val(response.data.montant);
                            $('#update-localisation').val(response.data.localisation);
                            $('#update-filiale').val(response.data.id_filiale);
                            $('#update-participant').val(response.data.participation);

                            var myDiv = document.getElementById('images');
                            myDiv.innerHTML = '';
                            // Loop through the array and create new elements
                            response.data.images.forEach(function(item, index) {

                                if (item.img_ouvertur) {
                                    $('#img_ouvertur').val(item.id);
                                }
                                // Create a new div element and set its inner HTML
                                var newElement = document.createElement('div');
                                newElement.setAttribute('value', item.id);

                                newElement.className =
                                    'col-6 d-flex align-items-center mt-2';
                                newElement.innerHTML = `
                                        <div class="d-flex align-items-center">
                                            <span class="preview"><img src="${item.path}" alt="" data-dz-thumbnail style="width: 100px; height: 100px;" /></span>
                                              <input type="radio" class="btn-check ml-2" id="btncheck1" name="img_ouverture" autocomplete="off" value="${item.id}"  ${item.img_ouverture ? "checked" : ""}  >
                                              <label class="btn" for="option5">Image de couverture</label>

                                            <div class="ml-4 d-flex align-items-center">
                                                <div class="btn-group d-flex align-items-center">
                                                    <button class="btn btn-danger delete img-delete" onclick="deleteImg(${item.id},${index})">
                                                        <i class="fas fa-trash"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                                         `;


                                // Append the new element to the div
                                myDiv.appendChild(newElement);
                            });



                            // Afficher le modal de mise à jour
                            $('#update-modal').modal('show');
                        } else {
                            Swal.fire(
                                'Erreur !',
                                'Impossible de récupérer les informations de la filiale.',
                                'error'
                            );
                        }
                        $('#loader').addClass('d-none');
                    },
                    error: function(error) {
                        $('#loader').addClass('d-none');
                        Swal.fire(
                            'Erreur !',
                            'Erreur lors de la récupération des détails de la filiale.',
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
                            <h1 class="m-0"> PROJETS</h1>
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
                                    <h3 class="card-title"> Liste des projets </h3>
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
                                                <th class="text-center align-middle">Date</th>
                                                <th class="text-center align-middle">Filiale</th>
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
                    <h4 class="modal-title"> Ajouter un projet </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <form method="POST" id="addForm" action="{{ route('gestion.filiales.store') }}">
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
                                {{-- ------------------------------ Maître d'ouvrage  / Montant ----------------------- --}}

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="require form-label"> Maître d'ouvrage :</label>
                                            <input name="maitre_ouvrage" type="text"
                                                class="form-control @error('maitre_ouvrage') is-invalid @enderror"
                                                id="maitre_ouvrage" placeholder="Maître d'ouvrage"
                                                value="{{ old('maitre_ouvrage') }}">
                                            <span id="maitre_ouvrage-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="require form-label">Montant :</label>
                                            <input name="montant" type="number"
                                                class="form-control @error('montant') is-invalid @enderror" id="montant"
                                                placeholder="Montant" value="{{ old('montant') }}">
                                            <span id="montant-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>


                                {{-- ------------------------------ Localisation  / Filiale----------------------- --}}

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="require form-label">Localisation :</label>
                                            <input name="localisation" type="text"
                                                class="form-control @error('localisation') is-invalid @enderror"
                                                id="localisation" placeholder="Localisation"
                                                value="{{ old('localisation') }}">
                                            <span id="localisation-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="require @error('filiale') is-invalid @enderror">Entreprise de
                                                réalisation</label>
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
                                {{-- ------------------------------ Participant ----------------------- --}}

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="require form-label">Participant :</label>
                                            <input name="participant" type="text"
                                                class="form-control @error('participant') is-invalid @enderror"
                                                id="participant" placeholder="Participant"
                                                value="{{ old('Participant') }}">
                                            <span id="participant-error-add" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                {{-- ------------------------------ Date ----------------------- --}}

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="require form-label @error('duree') is-invalid @enderror">Durée
                                                :</label>
                                            <input class="form-control" type="text" id="duree" name="duree"
                                                value="{{ old('duree') }}">
                                            <span id="duree-error-add" class="text-danger"></span>
                                        </div>
                                    </div>

                                </div>

                                {{-- ------------------------------ files ----------------------- --}}

                                <div class="row">
                                    <div class="card-body">
                                        <div id="actions" class="row">
                                            <div class="col-lg-6">
                                                <div class="btn-group w-100">
                                                    <span class="btn btn-success col fileinput-button">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Add files</span>
                                                    </span>

                                                    <button type="reset" class="btn btn-warning col cancel">
                                                        <i class="fas fa-times-circle"></i>
                                                        <span>Cancel upload</span>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="table table-striped files" id="previews">
                                            <div id="template" class="row mt-2">
                                                <div class="col-auto">
                                                    <span class="preview"><img src="data:," alt=""
                                                            data-dz-thumbnail /></span>
                                                </div>
                                                <div class="col d-flex align-items-center">
                                                    <p class="mb-0">
                                                        <span class="lead" data-dz-name></span>
                                                        (<span data-dz-size></span>)
                                                    </p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                                <div class="col-4 d-flex align-items-center">
                                                    <div class="progress progress-striped active w-100" role="progressbar"
                                                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                        <div class="progress-bar progress-bar-success" style="width:0%;"
                                                            data-dz-uploadprogress></div>
                                                    </div>
                                                </div>
                                                <div class="col-auto d-flex align-items-center">
                                                    <div class="btn-group">

                                                        <button data-dz-remove class="btn btn-danger delete">
                                                            <i class="fas fa-trash"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
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
                    <div method="" id="updateForm" action="">
                        <div class="modal-body">
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <!-- your steps here -->
                                        <div class="step" data-target="#info-part">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="logins-part" id="logins-part-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Information </span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#images-part">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="information-part" id="information-part-trigger">
                                                <span class="bs-stepper-circle">2</span>
                                                <span class="bs-stepper-label">Images</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="info-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
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
                                            {{-- ------------------------------ Maître d'ouvrage  / Montant ----------------------- --}}

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="require form-label"> Maître d'ouvrage :</label>
                                                        <input name="maitre_ouvrage" type="text"
                                                            class="form-control @error('maitre_ouvrage') is-invalid @enderror"
                                                            id="update-maitre_ouvrage" placeholder="Maître d'ouvrage"
                                                            value="{{ old('maitre_ouvrage') }}">
                                                        <span id="maitre_ouvrage-error-update" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="require form-label">Montant :</label>
                                                        <input name="montant" type="number"
                                                            class="form-control @error('montant') is-invalid @enderror"
                                                            id="update-montant" placeholder="Montant"
                                                            value="{{ old('montant') }}">
                                                        <span id="montant-error-update" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- ------------------------------ Localisation  / Filiale----------------------- --}}

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="require form-label">Localisation :</label>
                                                        <input name="localisation" type="text"
                                                            class="form-control @error('localisation') is-invalid @enderror"
                                                            id="update-localisation" placeholder="Localisation"
                                                            value="{{ old('localisation') }}">
                                                        <span id="localisation-error-update" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label
                                                            class="require @error('filiale') is-invalid @enderror">Entreprise
                                                            de réalisation</label>
                                                        <select id="update-filiale" name="filiale" class="form-control"
                                                            style="width: 100%;">
                                                            <option value="" disabled selected>Sélectionner une
                                                                Filiale</option>
                                                            @foreach ($filiales as $filiale)
                                                                <option value="{{ $filiale->id }}">
                                                                    {{ $filiale->sigle_commercial }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span id="filiale-error-update" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- ------------------------------ Participant ----------------------- --}}

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="require form-label">Participant :</label>
                                                        <input name="participant" type="text"
                                                            class="form-control @error('participant') is-invalid @enderror"
                                                            id="update-participant" placeholder="Participant"
                                                            value="{{ old('Participant') }}">
                                                        <span id="participant-error-update" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- ------------------------------ Duree ----------------------- --}}

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label
                                                            class="require form-label @error('duree') is-invalid @enderror">Durée
                                                            :</label>
                                                        <input class="form-control" type="text" id="update-duree"
                                                            name="duree" value="{{ old('duree') }}">
                                                        <span id="duree-error-update" class="text-danger"></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <button class="btn btn-primary" onclick="stepper.next()">Suivant</button>
                                        </div>

                                        <div id="images-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            <div id="images" class="row">

                                            </div>
                                            <div class="row">
                                                <div class="card-body">
                                                    <input name="id" type="hidden" id="id_img_couverture"></input>
                                                    <div id="update_file" class="row ">
                                                        <div class='col-4'></div>
                                                        <div class="col-4">
                                                            <div class="   btn-group w-100">
                                                                <span class=" btn btn-success col fileinput-button2">
                                                                    <i class="fas fa-plus"></i>
                                                                    <span>Add files</span>
                                                                </span>

                                                                <button type="reset" class="btn btn-warning col cancel">
                                                                    <i class="fas fa-times-circle"></i>
                                                                    <span>Cancel upload</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class='col-4'></div>

                                                    </div>
                                                    <div class="table table-striped files" id="previews2">
                                                        <div id="template2" class="row mt-2">
                                                            <div class="col-auto">
                                                                <span class="preview"><img src="data:," alt=""
                                                                        data-dz-thumbnail /></span>
                                                            </div>
                                                            <div class="col d-flex align-items-center">
                                                                <p class="mb-0">
                                                                    <span class="lead" data-dz-name></span>
                                                                    (<span data-dz-size></span>)
                                                                </p>
                                                                <strong class="error text-danger"
                                                                    data-dz-errormessage></strong>
                                                            </div>
                                                            <div class="col-4 d-flex align-items-center">
                                                                <div class="progress progress-striped active w-100"
                                                                    role="progressbar" aria-valuemin="0"
                                                                    aria-valuemax="100" aria-valuenow="0">
                                                                    <div class="progress-bar progress-bar-success"
                                                                        style="width:0%;" data-dz-uploadprogress></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto d-flex align-items-center">
                                                                <div class="btn-group">

                                                                    <button data-dz-remove class="btn btn-danger delete">
                                                                        <i class="fas fa-trash"></i>
                                                                        <span>Delete</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between  mt-4">
                                                <button class="btn btn-primary"
                                                    onclick="stepper.previous()">Précédent</button>
                                                <button type="submit" class="btn btn-primary"
                                                    onclick="update()">Enregistrer</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" id="btn-update-close"
                                data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary update_btn">Enregistrer</button>
                        </div> --}}
                    </div>


                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.modal -->
@endpush
