{{-- <header id="header" class="header d-flex align-items-center fixed-top">

    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between "> --}}
        <header id="header" class="  fixed-top">
            <div class="container-fluid d-flex align-items-center justify-content-between pt-2 pb-0 px-5">
        <!-- <div class="container-fluid d-flex align-items-center justify-content-evenly"> -->
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <h1><img src="{{asset('img\icons_filiales\logos\logogitrama.png')}}" alt="" width="200px" height="90px""><span class="fs-1">GTM</span></h1>
        {{--<h1 class="sitename ms-2">GITRAMA</h1> <span>.</span>--}}

        </a>
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
            <ul>
          <li><a href="/" class="{{ set_active_route('home') }}">Accueil</a></li>
                <li class="dropdown" > <a  class="#" > <span> PRÉSENTATION </span><i class="bi bi-chevron-down dropdown-indicator"></i> </a>
                    <ul>
                        <li><a class="#" href="/mot-dg">MOT DU PRÉSIDENT DIRECTEUR GÉNÉRAL  </a></li>
                        <li><a class="#" href="/groupe">LE GROUPE</a></li>
                        <li><a class="#" href="/groupe#org">ORGANIGRAMME</a></li>
                        <li><a class="#" href="/gouvernance">LA GOUVERNANCE </a></li>
                        <li><a class="#" href="/hommage">HOMMAGE </a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"><span> FILIALES </span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a class="#" href="/implantation">IMPLANTATION</a></li>
                        <li><a class="#" href="/entreprises/TRAVAUX-MARITIMES" >NOS FILIALES</a></li>
                        <li><a class="#"  href="/projets" >NOS PROJETS </a></li>
                        <li><a class="#" href="/notre-materiel">NOTRE MATERIEL </a></li>


                    </ul>
                </li>

                <li class="">
                    <a href="/actualites"><span> ACTUALITÉ </span> </a>
                    {{-- <ul>
                        <li><a class="#" href="/actualites" >NOS DÉRNIÈRES ACTUALITÉS</a></li>


                        <li><a class="#" >NOS COMMUNICATIONS </a></li>
                        <li><a class="#" >ESPACE PRESSE  </a></li>

                    </ul> --}}
                </li>
                {{-- <li class="">
                    <a href="#"><span> APPEL D'OFFRE   </span>

                     </a>

                </li> --}}
                <li class="" > <a  class="#" href="/contact" > <span> CONTACT </span> </a> </li>

            </ul>
        </nav><!-- .navbar -->
    </div>
</header>


