@extends('layouts/master', ['title' => 'les dernières actualités'])
@push('custom-styles')
    <!-- Timeline CSS -->
    <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">
    <style>
 .quote-icon-left {
  display: inline-block;
  left: -5px;
  position: relative;
}

.quote-icon-right {
  display: inline-block;
  right: -5px;
  position: relative;
  top: 10px;
  transform: scale(-1, -1);
}
    </style>
@endpush
<title> les dernières actualités </title>
@section('main')
    <!-- ======= Titel Page ======= -->
    @include('layouts.partials._page_Title', ['title' => '  les dernières actualités '])
    <!-- Titel Page -->





     <!-- Recent Blog Posts Section -->
     <section id="recent-blog-posts" class="recent-blog-posts section">

        <!-- Section Title -->
        <div class="container section-header" data-aos="fade-up">
          <h2 class=""> les dernières actualités </h2>
          <p>
            Bienvenue sur la page des actualités de GTM. Ici, nous partageons les informations les plus récentes
             et les mises à jour importantes sur nos projets, événements, et initiatives.
             Restez connecté pour découvrir les dernières nouveautés et les réalisations marquantes de notre groupe.
          </p>
        </div><!-- End Section Title -->

        <div class="container">

          <div class="row gy-5">
            @foreach ($actualites as $actualite)
            <div class="col-xl-4 col-md-6">


                <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                    <div class="post-img position-relative overflow-hidden">
                        <img src="{{ asset($actualite->path_img) }}" class="img-fluid" alt="">
                        <span class="post-date">{!! $actualite->date_debut !!}</span>
                    </div>

                    <div class="post-content d-flex flex-column">

                        <h3 class="post-title">{!! $actualite->titre !!}</h3>

                        <div class="meta d-flex align-items-center">
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span class="px-3 text-black-50">
                                {!! truncateText($actualite->description) !!}
                            </span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </div>

                        <hr>

                        <a href="{{ route('actualite.show', $actualite->id) }}" class="readmore stretched-link"><span>
                                Lire la suite </span><i class="bi bi-arrow-right"></i></a>

                    </div>

                </div>
                <!-- End post item -->



            </div><!-- End testimonial item -->
        @endforeach
            {{-- <div class="col-xl-4 col-md-6">
              <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                <div class="post-img position-relative overflow-hidden">
                  <img src="assets/img/blog/blog-1.jpg" class="img-fluid" alt="">
                  <span class="post-date">December 12</span>
                </div>

                <div class="post-content d-flex flex-column">

                  <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3>

                  <div class="meta d-flex align-items-center">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-person"></i> <span class="ps-2">Julia Parker</span>
                    </div>
                    <span class="px-3 text-black-50">/</span>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                    </div>
                  </div>

                  <hr>

                  <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                </div>

              </div>
            </div> --}}



          </div>

        </div>

      </section><!-- /Recent Blog Posts Section -->

@endsection
@push('custom-scripts')
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

@endpush
