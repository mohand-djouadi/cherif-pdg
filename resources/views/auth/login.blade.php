@extends('layouts/master', ['title' => "S'authentifier"])
@push('custom-styles')
    <!-- Timeline CSS -->
    <link href="{{ asset('vendor/horizontal-timeline/css/horizontal-timeline.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="admin/login/login_styles.css">
@endpush
<title>Espace Administrateur</title>
@section('main')
    <main id="main">

        <!-- ======= Titel Page ======= -->
        @include('layouts.partials._page_Title', ['title' => 'Espace Administrateur'])
        <!-- Titel Page -->
        <section class="ftco-section">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span>
                                    {{-- <i class="bi bi-person"></i> --}}
                                    <i class="fa-regular fa-user"></i>
                                </span>
                            </div>
                            <h3 class="text-center mb-4">Se connecter</h3>
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <label>
                                      <span class="text-danger ">  <i class="fas fa-exclamation-triangle  fa-beat fa-lg" ></i> </span>
                                        Oups !</label>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login.store') }}" class="login-form">
                                @csrf
                                <div class="form-group">
                                    <input name="email" value="{{ old('email') }}" type="text"
                                        class="form-control rounded-left" placeholder="Nom d'utilisateur" required>
                                </div>
                                <div class="form-group d-flex">
                                    <input name="password" value="{{ old('password') }}" type="password"
                                        class="form-control rounded-left" placeholder="Mot de passe" required>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50">
                                        <label class="checkbox-wrap checkbox-primary">Se souvenir de moi
                                            <input name="remember" type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary rounded submit p-3 px-5"> Se connecter
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
@push('custom-scripts')
@endpush
