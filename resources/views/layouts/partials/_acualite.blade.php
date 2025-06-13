<style>
    /*--------------------------------------------------------------
# Constructions Section
--------------------------------------------------------------*/
    /* .constructions .card-item {
        border: 1px solid color-mix(in srgb, var(#364d59), transparent 85%);
        position: relative;
        border-radius: 0;
    }

    .constructions .card-item .card-bg {
        min-height: 300px;
        position: relative;
    }

    .constructions .card-item .card-bg img {
        position: absolute;
        inset: 0;
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        z-index: 1;
    }

    .constructions .card-item .card-body {
        padding: 30px;
    }

    .constructions .card-item h4 {
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .constructions .card-item p {
        color: color-mix(in srgb, var(--default-color), transparent 40%);
        margin: 0;
    }

    .post-date {
        position: absolute;
        right: 0;
        top: 0;
        width: 100px;
        background-color: #0559b9;
        color: var(--contrast-color);
        text-transform: uppercase;
        font-size: 13px;
        padding: 6px 12px;
        font-weight: 500;
    } */

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
<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <div class="section-header">
            <h2> les dernières actualités </h2>
        </div>

        <p> <a href="/actualites" class=" stretched-link"><span> voir tous les actualite</span>&nbsp;<i
                    class="bi bi-arrow-right ml-4 mr-4"></i></a></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper">


            <script type="application/json" class="swiper-config">

          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "spaceBetween": 40
              },
              "1200": {
                "slidesPerView": 3,
                "spaceBetween": 40
              }
            }
          }
        </script>
            <div class="swiper-wrapper recent-blog-posts  ">

                    @foreach ($actualites as $actualite)
                        <div class="swiper-slide">


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

                                        <a href="{{ route('actualite.show', $actualite->id) }}"
                                            class="readmore stretched-link"><span> Lire la suite </span><i
                                                class="bi bi-arrow-right"></i></a>

                                    </div>

                                </div>
                            <!-- End post item -->



                        </div><!-- End testimonial item -->
                    @endforeach

                {{-- <div class="swiper-slide">
                     <div class="testimonial-wrap">
                         <div class="testimonial-item">
                             <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img"
                                 alt="">
                             <h3>Sara Wilsson</h3>
                             <h4>Designer</h4>
                             <div class="stars">
                                 <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                     class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                     class="bi bi-star-fill"></i>
                             </div>
                             <p>
                                 <i class="bi bi-quote quote-icon-left"></i>
                                 <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum
                                     quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure
                                     amet legam anim culpa.</span>
                                 <i class="bi bi-quote quote-icon-right"></i>
                             </p>
                         </div>
                     </div>
                 </div> --}}

                <!-- End testimonial item -->

                {{-- <div class="swiper-slide">
                     <div class="testimonial-wrap">
                         <div class="testimonial-item">
                             <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img"
                                 alt="">
                             <h3>Jena Karlis</h3>
                             <h4>Store Owner</h4>
                             <div class="stars">
                                 <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                     class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                     class="bi bi-star-fill"></i>
                             </div>
                             <p>
                                 <i class="bi bi-quote quote-icon-left"></i>
                                 <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                     veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint
                                     minim.</span>
                                 <i class="bi bi-quote quote-icon-right"></i>
                             </p>
                         </div>
                     </div>
                 </div> --}}
                <!-- End testimonial item -->

                {{-- <div class="swiper-slide">
                     <div class="testimonial-wrap">
                         <div class="testimonial-item">
                             <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                 alt="">
                             <h3>Matt Brandon</h3>
                             <h4>Freelancer</h4>
                             <div class="stars">
                                 <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                     class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                     class="bi bi-star-fill"></i>
                             </div>
                             <p>
                                 <i class="bi bi-quote quote-icon-left"></i>
                                 <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                     fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore
                                     quem dolore labore illum veniam.</span>
                                 <i class="bi bi-quote quote-icon-right"></i>
                             </p>
                         </div>
                     </div>
                 </div> --}}

                <!-- End testimonial item -->

                {{-- <div class="swiper-slide">
                     <div class="testimonial-wrap">
                         <div class="testimonial-item">
                             <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img"
                                 alt="">
                             <h3>John Larson</h3>
                             <h4>Entrepreneur</h4>
                             <div class="stars">
                                 <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                     class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                     class="bi bi-star-fill"></i>
                             </div>
                             <p>
                                 <i class="bi bi-quote quote-icon-left"></i>
                                 <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor
                                     noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam
                                     esse veniam culpa fore nisi cillum quid.</span>
                                 <i class="bi bi-quote quote-icon-right"></i>
                             </p>
                         </div>
                     </div>
                 </div> --}}

                <!-- End testimonial item -->

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>

</section><!-- /Testimonials Section -->
