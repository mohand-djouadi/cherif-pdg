@extends('layouts/admine_layout', ['title' => 'Carrousel'])

<title> Carrousel</title>

@push('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href=" {{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

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
    <!-- dropzonejs -->
    <script src="{{ asset('admin/plugins/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Ekko Lightbox -->
    <script src="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        //   Récupérer les données du DataTable
        function fetchData() {
            $.ajax({
                url: '{{ route('gestion.carrousel.get') }}',
                method: 'GET',
                dataType: "json",
                beforeSend: function() {
                    // Afficher le loader avant que la requête ne soit envoyée
                    $('#loader').removeClass('d-none');
                },
                success: function(response) {
                    var myDiv = document.getElementById('images');
                    myDiv.innerHTML = '';

                    // Loop through the array and create new elements
                    response.data.forEach(function(item, index) {
                        var titre_img = '';
                        if (item.image_principale == false) {
                            titre_img = 'Image secondaire';
                        } else {
                            titre_img = 'Image principale';
                        }
                        var newElement = document.createElement('div');
                        newElement.setAttribute('value', item.id);
                        newElement.className = 'col-6 d-flex align-items-center mt-4';
                        newElement.innerHTML = `
                    <div class="row">
                        <span class="col-12 preview">
                      <a href="${item.img_path}" data-toggle="lightbox" data-title="${ titre_img}" class='image-container'>
                        <div  class=''>
                        <img src="${item.img_path}" class="img-fluid mb-2 hover-image" alt="white sample" style="width: 100%; height: 400px;"/>
                         <div class="overlay">
                          <i class="fas fa-search-plus"></i>
                           </div>
                           </div>
                      </a>
                        </span>
                        <div class="col-12 mt-4 d-flex align-items-center w-100 justify-content-center">
                            <input type="radio" class="btn-check ml-2" id="btncheck${index}" name="img_ouverture" autocomplete="off" value="${item.id}" ${item.image_principale ? "checked" : ""}>
                            <label class="btn" for="btncheck${index}"> Image principale </label>
                            <div class="btn-group d-flex align-items-center" style="width: 50%;">
                                <button class="btn btn-danger delete img-delete" style="width: 50%;" onclick="deleteImg(${item.id}, ${index})">
                                    <i class="fas fa-trash"></i>
                                <span>Supprimer</span>
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                        myDiv.appendChild(newElement);
                    });

                    // Track changes in radio buttons
                    document.querySelectorAll('input[name="img_ouverture"]').forEach(function(radio) {
                        radio.addEventListener('change', function() {
                            if (this.checked) {
                                var selectedId = this.value;

                                // Make an AJAX request with the selected value
                                $.ajax({
                                    url: '{{ route('gestion.carrousel.update.imgPrincipale', '') }}/' +
                                        selectedId,
                                    type: 'GET',
                                    success: function(response) {
                                        Swal.fire(
                                            'Mis à jour !',
                                            'Image principale mise à jour avec succès.',
                                            'success'
                                        );
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire(
                                            'Erreur !',
                                            'Erreur lors de la mise à jour de l\'image principale.',
                                            'error'
                                        );
                                    }
                                });
                            }
                        });
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

        // La fonction qui supprime les images

        function deleteImg(id, index) {

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
                    console.log('id : ', id);
                    $.ajax({
                        url: '{{ route('gestion.carrousel.deleteImg', '') }}/' + id,
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
                            Swal.fire(
                                'Erreur !',
                                'Erreur lors de la suppression de l\'image.',
                                'error'
                            );
                        }
                    });
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

            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            // Formulaire d'ajout du matériel
            $('.add_btn').on('click', function(e) {
                e.preventDefault();
                var formData = new FormData();
                var addedFiles = myDropzone.getFilesWithStatus(Dropzone.ADDED);

                addedFiles.forEach(function(file, index) {
                    formData.append('file[]', file, file.name);
                });

                $.ajax({
                    url: '{{ route('gestion.carrousel.store') }}',
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
                            'Images créé avec succès',
                            'success'
                        );
                        fetchData();
                        $('#btn-add-close').click();
                    },
                    error: function(response) {

                        Swal.fire(
                            'Erreur !',
                            'Erreur lors de l\'upload.',
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
                            <h1 class="m-0"> Carrousel</h1>
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
                                    <h3 class="card-title"> Les images du carrousel. </h3>
                                </div>
                                <div class="col-2  d-flex  justify-content-end">
                                    <button type="button" class=" btn btn-outline-primary btn-block" id="add_button"
                                        data-toggle="modal" data-target="#add-modal">
                                        Ajouter
                                    </button>
                                </div>

                            </div>


                        </div>
                        <div class="row   p-5" id="images">
                            {{-- @foreach ($images as $item)
                            <div class="col-6 d-flex align-items-center mt-2">
                                <div class="row">
                                    <span class="col-12 preview"><img src="{{ $item->img_path }}" alt="" data-dz-thumbnail style="width: 100%; height: 100%;" /></span>

                                    <div class="col-12 mt-4 d-flex align-items-center">
                                        <div class="btn-group d-flex align-items-center w-100">
                                            <button class="btn btn-danger delete img-delete" onclick="deleteImg(${item.id},${index})">
                                                <i class="fas fa-trash"></i>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             @endforeach --}}
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
                    <h4 class="modal-title"> Ajouter des photos au carrousel. </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <form method="POST" id="addForm" action="{{ route('gestion.carrousel.store') }}">
                        <div class="modal-body">
                            <div class="card-body">


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
@endpush
