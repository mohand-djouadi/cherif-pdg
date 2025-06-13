@extends('layouts/master', ['title' => 'Accueil'])
@section('slider-section')
    @include('layouts.partials._slider-section')
@endsection
<title>Accueil</title>
@section('main')
    <main id="main">

        <!-- ======= About Section ======= -->
        @include('layouts.partials._nos_filiale_secteur')

        <!-- ======= Actualités Section ======= -->
        @include('layouts.partials._acualite')


          <!-- ======= Nos Projets ======= -->
          @include('layouts.composant.projets.no_projets')

    </main>
@endsection
