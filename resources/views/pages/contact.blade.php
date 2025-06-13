@extends('layouts/master', ['title' => 'Projects'])
@push('custom-styles')
    <!-- Timeline CSS -->
    <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">

@endpush
<title> Contact </title>
@section('main')
    <!-- ======= Titel Page ======= -->
    @include('layouts.partials._page_Title', ['title' => 'Contact '])
    <!-- Titel Page -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row gy-4">

            <div class="col-lg-6">
              <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt"></i>
                <h3>RENDEZ-NOUS VISITE</h3>
                <p>Zone Industrielle, Voie C, BP 143, Réghaia - Alger 16000</p>
              </div>
            </div><!-- End Info Item -->

            <div class="col-lg-3 col-md-6">
              <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone"></i>
                <h3>APPLEZ-NOUS</h3>
                <p>+213 23 86 60 /61</p>
              </div>
            </div><!-- End Info Item -->

            <div class="col-lg-3 col-md-6">
              <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope"></i>
                <h3>Email Us</h3>
                <p>info@example.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="row gy-4 mt-1">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3197.929050250686!2d3.313843375299383!3d36.72426517197728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128e5b3848eec2e1%3A0xc9eb5c6d5c7c014e!2sGroupe%20GITRAMA!5e0!3m2!1sfr!2sdz!4v1723656544990!5m2!1sfr!2sdz" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
            </div><!-- End Google Maps -->

            <div class="col-lg-6">
                <form method="POST" action="{{ route('mail.contact') }}" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="400">
                    @csrf
                    <div class="row gy-4">

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Votre nom" value="{{ old('name') }}" required="">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Votre adresse e-mail" value="{{ old('email') }}" required="">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="subject" placeholder="Objet" value="{{ old('subject') }}" required="">
                            @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Rédigez votre message" required="">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                            @if(session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                             @endif

                            <button type="submit">Envoyer le message</button>
                        </div>

                    </div>
                </form>

            </div><!-- End Contact Form -->

          </div>

        </div>

      </section><!-- /Contact Section -->

@endsection
@push('custom-scripts')
    <!-- Horizontal-timeline JavaScript -->
    <script src="{{ asset('vendor/horizontal-timeline/js/horizontal-timeline.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
@endpush
