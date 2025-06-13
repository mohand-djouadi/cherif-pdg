@extends('layouts/master', ['title' => 'ACTUALITÉS'])
@push('custom-styles')
    <!-- Timeline CSS -->
    {{-- <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet"> --}}
    <style>

    </style>
@endpush
<title> ACTUALITÉS </title>

@section('main')
    <main id="main">
        <!-- ======= Titel Page ======= -->
        @include('layouts.partials._page_Title', ['title' => 'ACTUALITÉS '])
        <!-- Titel Page -->
        <section id="blog" class="blog">
            <div class="container">
                <div class="row g-5 justify-content-center align-items-stretch align-content-stretch ">
                    <div class="col-lg-4 sidebar">
                        {{-- <div class="widgets-container"> --}}
                        <div class="">
                            <!-- Recent Posts Widget -->
                            <blockquote>
                                <div class="recent-posts-widget widget-item">

                                    <h3 class="widget-title">Dernières Actualités</h3>

                                        @foreach ($actualites as $actu)
                                        <blockquote>
                                            <div class="post-item">
                                                <img src=" {{ asset($actu->path_img) }}" alt=""
                                                    class="flex-shrink-0">
                                                <div>
                                                    <h4><a
                                                            href="{{ route('admin.actualites.show', $actu->id) }}">{{ $actu->titre }}</a>
                                                    </h4>
                                                    <time datetime="2020-01-01">{{ $actu->date_debut }}</time>
                                                </div>
                                            </div><!-- End recent post item-->
                                        </blockquote>
                                        @endforeach



                                </div><!--/Recent Posts Widget -->

                            </blockquote>

                        </div>

                    </div>
                    <div class="col-lg-8">

                        <!-- Blog Details Section -->
                        <div id="blog-details" class="blog-details section">
                            <div class="container">

                                <article class="article">

                                    <div class="post-img">
                                        <img src="{{ asset($actualite->path_img) }}" alt="" class="img-fluid w-100">
                                    </div>

                                    <h2 class="title"> {!! $actualite->titre !!}</h2>

                                    <div class="meta-top">
                                        <ul>

                                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                    href="blog-details.html"><time datetime="2020-01-01">
                                                        {!! $actualite->date_debut !!}</time></a></li>

                                        </ul>
                                    </div><!-- End meta top -->

                                    <div class="content">
                                        <p>
                                            {!! $actualite->description !!}
                                        </p>


                                        {!! $actualite->contenu !!}

                                    </div><!-- End post content -->

                                    {{-- <div class="meta-bottom">
                                        <i class="bi bi-folder"></i>
                                        <ul class="cats">
                                            <li><a href="#">Business</a></li>
                                        </ul>

                                        <i class="bi bi-tags"></i>
                                        <ul class="tags">
                                            <li><a href="#">Creative</a></li>
                                            <li><a href="#">Tips</a></li>
                                            <li><a href="#">Marketing</a></li>
                                        </ul>
                                    </div> --}}
                                    <!-- End meta bottom -->

                                </article>

                            </div>
                        </div><!-- /Blog Details Section -->



                    </div>



                </div>
            </div>
        </section>
    </main>
@endsection
{{-- @push('custom-scripts')

    <script src="{{ asset('vendor/horizontal-timeline/js/horizontal-timeline.js') }}"></script>
@endpush --}}
