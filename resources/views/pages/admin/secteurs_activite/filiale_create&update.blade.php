@extends('layouts/admine_layout', ['title' => 'Ajouter une nouvelle actualité'])

<title>Ajouter une nouvelle actualité</title>


@push('custom-styles')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    <style>
        .custom-file-input~.custom-file-label::after {
            content: "Choisir une image" !important;
            /* Add !important to ensure priority */
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
@endpush

@push('custom-scripts')
    <!-- Summernote -->
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('.submit_btn').click((e) => {
                // e.preventDefault();

                let form = $('#myForm');

                if (form[0].reportValidity()) {
                    // console.log('heloo :',form)
                    form.submit();
                }
            });

            // function sendFile(file, editor, welEditable) {
            //     data = new FormData();
            //     data.append("file", file);
            //     $.ajax({
            //         data: data,
            //         type: "POST",
            //         url: '{{ route('actualite.upload_summernote') }}',
            //         cache: false,
            //         processData: false,
            //         contentType: false,
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function(url) {
            //             var image = $('<img>').attr('src', url);
            //             $('#compose-textarea').summernote("insertImage", url);
            //         },
            //         error: function(xhr, ajaxOptions, thrownError) {
            //             alert('failed to load image');
            //         }
            //     });
            // }

            // function removeFile(src) {
            //     data = new FormData();
            //     data.append("src", src);
            //     $.ajax({
            //         data: data,
            //         type: "POST",
            //         url: '{{ route('actualite.remove_summernote') }}',
            //         cache: false,
            //         processData: false,
            //         contentType: false,
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function(url) {},
            //         error: function(xhr, ajaxOptions, thrownError) {
            //             alert('failed to remove image');
            //         }
            //     });
            // }



        })
    </script>
@endpush

@section('main')
    <main id="main">

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class=" container-fluid ">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Ajouter un nouveau secteur d'activité     </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin-actualites"> Liste des secteurs d'activité                     </a></li>
                                <li class="breadcrumb-item active">Gitrama </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title"> nouveau secteur d'activité </h3>
                                </div>
                                <form method="POST" id="myForm" action="{{ route('admin.actualites.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- /.card-header -->
                                    <div class="card-body">


                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="require form-label">Titre :</label>

                                                <textarea  name="titre" class="form-control  @error('titre') is-invalid @enderror" id="titre" placeholder="Titre">{{ old('titre') }}</textarea>
                                                @error('titre')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group ">
                                                <label class="require  form-label">Description :</label>
                                                <textarea  name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label class="require form-label">Latitude :</label>

                                                        <input  name="latitude" class="form-control  @error('latitude') is-invalid @enderror" id="latitude" placeholder="Latitude">{{ old('latitude') }}</input>
                                                        @error('latitude')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="require form-label">Longetude :</label>

                                                        <input  name="longetude" class="form-control  @error('longetude') is-invalid @enderror" id="longetude" placeholder="Longetude">{{ old('longetude') }}</input>
                                                        @error('longetude')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->


                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-end">
                                            {{-- <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i>
                                                Draft</button> --}}
                                            <button type="submit" class="btn btn-primary submit_btn"><i    class="fab fa-firstdraft"></i> Ajouter </button>
                                        </div>

                                    </div>
                                    <!-- /.card-footer -->
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </main>
@endsection
