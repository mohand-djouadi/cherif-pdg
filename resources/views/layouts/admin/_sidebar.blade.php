  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-navy elevation-4">
      <!-- Brand Logo -->
      <a href="/dashboard" class="brand-link  bg-navy">
          <img src="{{ asset('img/logomounchaat2.JPG') }}" alt="GTM Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">GTM Dashboard</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src=" {{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                      alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{ Auth::user()->name }}</a>
              </div>
          </div>



          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar  flex-column nav-child-indent" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item menu-open">
                      <a href="/dashboard" class="nav-link  {{ set_active_route('dashboard') }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                              {{-- <i class="right fas fa-angle-left"></i> --}}
                          </p>
                      </a>

                  </li>
                  <li class="nav-item">
                      <a href="/admin-actualites" class="nav-link {{ set_active_route('admin.actualites') }}">
                          <i class="">
                              <span class="right badge badge-danger">New</span>
                          </i>
                          <p>
                              Gestion des actualités

                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="/gestion-projets" class="nav-link {{ set_active_route('gestion.projet') }}">
                          <i class="fas fa-project-diagram"></i>
                          <p>
                              Gestion de projets
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="/gestion-materiel" class="nav-link {{ set_active_route('gestion.materiel') }}">
                        <i class="fas fa-tools"></i>
                        <p>
                            Gestion de Matériel
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/gestion-carrousel" class="nav-link {{ set_active_route('gestion.carrousel') }}">

                        <i class="fas fa-images"></i>
                        <p>
                            gestion page principale
                        </p>
                    </a>
                </li>
                  {{-- <li class="nav-item">
                      <a href='/admin-appel-offres' class="nav-link {{ set_active_route('admin.appel.offres') }}">
                          <i class="far fa-newspaper"></i>
                          <p>
                              Gestion des appels d'offres
                          </p>
                      </a>
                  </li> --}}
                  <li class="nav-item {{ set_active_route_dropdown('admin.secteurs') }} {{ set_active_route_dropdown('gestion.filiales') }}">
                      <a href="#" class="nav-link  {{ set_active_route('admin.secteurs')}}  {{ set_active_route('gestion.filiales') }}">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Filiales & Secteur
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="/admin-secteurs" class="nav-link {{ set_active_route('admin.secteurs') }}">
                                <i class="nav-icon fas fa-network-wired"></i>
                                  <p>Secteur</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/gestion-filiales" class="nav-link {{ set_active_route('gestion.filiales') }}">
                                <i class="nav-icon fas fa-sitemap"></i>


                                  <p>Filiales</p>
                              </a>
                          </li>

                      </ul>
                  </li>

{{--
                  <li class="nav-item">
                      <a href='/gestion-utilisateurs' class="nav-link {{ set_active_route('gestion.utilisateurs') }}">
                          <i class="fas fa-users"></i>
                          <p>
                              Gestion des utilisateurs
                          </p>
                      </a>
                  </li> --}}


                  <li class="nav-item {{ set_active_route_dropdown('gestion.utilisateurs') }} ">
                    <a href="#" class="nav-link  {{ set_active_route('gestion.utilisateurs')}}  ">
                        <i class="fas fa-users"></i>
                        <p>
                            Gestion des utilisateurs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/gestion-utilisateurs" class="nav-link {{ set_active_route('gestion.utilisateurs') }}">
                                <i class="fas fa-user"></i>
                                <p>Utilisateurs</p>
                            </a>
                        </li>


                    </ul>
                </li>


              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
