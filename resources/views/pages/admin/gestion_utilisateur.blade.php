@extends('layouts/admine_layout', ['title' => 'Accueil'])

<title>     Gestion des utilisateurs</title>
@section('main')
    <main id="main">

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">     Gestion des utilisateurs</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">GTM </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid d-flex justify-content-center">
                    Gestion des utilisateurs
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </main>
@endsection
