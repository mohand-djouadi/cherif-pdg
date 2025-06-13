@extends('layouts/admine_layout', ['title' => 'Accueil'])

<title>ACTUALITÉ</title>

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
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <!-- Ekko Lightbox -->
    <script src="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

    {{-- <script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script> --}}
    {{-- <script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script> --}}
    {{-- <script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script> --}}
    {{-- <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script> --}}
    {{-- <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script> --}}
    {{-- <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script> --}}

    <!-- Page specific script -->
    <script>
        $(function() {

            $("#example1").DataTable({
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
                    },
                    action: (e) => {
                        e.preventDefault();
                        window.location.href = "{{ route('admin.actualites.create') }}";
                    }
                }],
                language: {
                    searchPlaceholder: "Chercher",
                    search: "Recherche:",
                    emptyTable: "Aucune enregistrement trouvé dans le tableau",
                    loadingRecords: "Chargement en cours...",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ ligne(s)",
                    infoEmpty: "Affichage 0 à 0 sur 0 ligne",
                    infoFiltered: " ",
                    zeroRecords: "Aucun enregistrement trouvé",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent",
                    },
                },
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            //  ------------  supprimer  une actualite -----------

            $('.dele').click(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Êtes-vous sûr?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'orange',
                    confirmButtonText: 'Oui, supprimez-le !',
                    cancelButtonText: "Annuler",
                    cancelButtonColor: "red",

                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $(this).find('form');
                        form.submit();
                    }
                })
            });
            //  ------------  publier une actualite -----------
            $('.pub').click(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Êtes-vous sûr?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    confirmButtonText: 'Oui, publiez-le !',
                    cancelButtonText: "Annuler",
                    cancelButtonColor: "red",

                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $(this).find('form');
                        form.submit();
                    }
                })
            });

        });
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
                            <h1 class="m-0">ACTUALITÉ</h1>
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

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid  container">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des Articles</h3>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle"> Image </th>
                                                <th class="text-center align-middle"> Titre </th>

                                                <th class="text-center align-middle"> Type </th>
                                                <th class="text-center align-middle"> Date </th>
                                                <th class="text-center align-middle"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($actualites as $actualite)
                                                <tr>
                                                    <td style="max-width: 100px; max-height: 100px; overflow: hidden;">

                                                            <a href="{{ asset($actualite->path_img) }}" data-toggle="lightbox" data-title="" class='image-container'>
                                                                <div  class=''>
                                                                  <img src="{{ asset($actualite->path_img) }}" class="img-fluid mb-2 hover-image" alt="white sample" style="max-width: 100%; max-height: 100px;" />
                                                                       <div class="overlay w-100">
                                                                          <i class="fas fa-search-plus"></i>
                                                                       </div>
                                                                 </div>
                                                            </a>
                                                    </td>
                                                    <td class="text-center align-middle"> {{ $actualite->titre }} </td>
                                                    <td class="text-center align-middle">
                                                        @if ($actualite->etat == 1)
                                                            <span class="badge bg-success">Publié</span>
                                                        @else
                                                            <span class="badge bg-danger">Brouillon</span>
                                                        @endif
                                                    </td>

                                                    <td class="text-center align-middle"> {{ $actualite->date_debut }}
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if ($actualite->etat == 0)
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Publier" role="button"
                                                                class="btn btn-outline-success pub">
                                                                <form
                                                                    action="{{ route('admin.actualites.publication', $actualite->id) }}"
                                                                    method="POST" class="d-none">
                                                                    @csrf
                                                                </form>
                                                                <i class="fas fa-upload"></i>
                                                            </a>
                                                        @endif
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier"
                                                            role="button" class="btn btn-outline-warning"
                                                            href="{{ route('admin.actualites.edit', $actualite->id) }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Consulter" role="button" class="btn btn-outline-dark"
                                                            href="{{ route('admin.actualites.show', $actualite->id) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Supprimer" role="button"
                                                            class="btn btn-outline-danger dele">
                                                            <form
                                                                action="{{ route('admin.actualites.destroy', $actualite->id) }}"
                                                                method="POST" class="d-none">
                                                                @csrf
                                                                {{-- @method('DELETE') --}}
                                                            </form>
                                                            <i class="fas fa-trash"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        {{-- <tfoot>
                                            <tr>
                                                <th>Rendering engine</th>
                                                <th>Browser</th>
                                                <th>Platform(s)</th>
                                                <th>Engine version</th>
                                                <th>CSS grade</th>
                                            </tr>
                                        </tfoot> --}}
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
    </main>
    <!-- SweetAlert2 -->
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    @if (session()->has('store-success'))
        <script>
            Swal.fire(
                'Ajouté !',
                '{{ session()->get('store-success') }}',
                'success'
            )
        </script>
    @endif

    @if (session()->has('destroy-success'))
        <script>
            Swal.fire(
                'Supprimé !',
                '{{ session()->get('destroy-success') }}',
                'success'
            )
        </script>
    @endif

    @if (session()->has('state-changed'))
        <script>
            Swal.fire(
                'État mis à jour !',
                'État mis à jour avec succès',
                'success'
            )
        </script>
    @endif

    @if (session()->has('update-success'))
        <script>
            Swal.fire(
                'Modifier !',
                '{{ session()->get('update-success') }}',
                'success'
            )
        </script>
    @endif
@endsection
