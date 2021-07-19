<div class="vertical-nav bg-white" id="sidebar">
                  <div class="py-4 px-3 mb-4 bg-light">
                        <div class="media d-flex align-items-center">
                           <img src="" alt="">
                           <div class="media-body">
                              <h4 class="m-0"><?='Bonjour '.get_director_name_with_id($connect,$_SESSION["id_directeur"]) ?></h4>
                              <p class="font-weight-normal text-muted mb-0">Directeur</p>
                              <p class="btn btn-success"><?=get_director_school($connect,$_SESSION["id_directeur"])?></p>
                           </div>
                        </div>
                  </div>
               <ul class="nav flex-column bg-white mb-0">
                  <li class="nav-item">
                        <a href="index.php" class="nav-link text-muted">
                           <i class="fa fa-th-large text-muted"></i>
                           Tableau de Bord
                        </a>
                  </li>
<!--                  <li class="nav-item">
                        <a href="index.php" class="nav-link text-muted">
                        <i class="fas fa-save text-muted"></i>
                           Inscription
                        </a>
                  </li>-->
                  <li class="nav-item">
                        <a href="inscription.php" class="nav-link text-muted">
                        <i class="fas fa-user-graduate text-muted"></i>
                           Eleves
                        </a>
                  </li>
                  <li class="nav-item">
                        <a href="teacher.php" class="nav-link text-muted">
                        <i class="fas fa-chalkboard-teacher text-muted"></i>
                           Enseignants
                        </a>
                  </li>
                  <li class="nav-item">
                        <a href="parent.php" class="nav-link text-muted">
                        <i class="fas fa-user-alt text-muted"></i>
                           Parents
                        </a>
                  </li>
                  <li class="nav-item">
                        <a href="classe.php" class="nav-link text-muted">
                        <i class="fas fa-school text-muted"></i>
                            Classe
                        </a>
                  </li>
                  <li class="nav-item">
                        <a href="matiere.php" class="nav-link text-muted">
                        <i class="fas fa-school text-muted"></i>
                            Matières
                        </a>
                  </li>
                  <li class="nav-item">
                        <a href="directeur.php" class="nav-link text-muted">
                        <i class="fas fa-user text-muted"></i>
                           Scolarité
                        </a>
                  </li>
                  
               </ul>
               <ul class="nav flex-column bg-white mb-0">

                  <li class="nav-item">
                        <a href="#" class="nav-link text-muted">
                        <i class="far fa-clipboard text-muted"></i>
                           Notes
                        </a>
                  </li>
                  <li class="nav-item">
                        <a href="calendar.php" class="nav-link text-muted">
                        <i class="far fa-clipboard text-muted"></i>
                           Emploi du temps
                        </a>
                  </li>
                  <li class="nav-item">
                        <a href="#" class="nav-link text-muted">
                        <i class="fas fa-credit-card text-muted"></i>
                           Paiement
                        </a>
                  </li>
                  <li class="nav-item">
                        <a href="#" class="nav-link text-muted">
                        <i class="fas fa-cogs text-muted"></i>
                           Configuration
                        </a>
                  </li>
                  <li class="nav-item">
                        <a href="logout.php" class="nav-link text-muted">
                        <i class="fas fa-sign-out-alt text-muted"></i>
                           Deconnexion
                        </a>
                  </li>
                  
               </ul>
               </div>


    <div class="page-content p-5" id="content">
        <nav class="navbar navbar-expand navbar-light my-navbar">

            <!-- Sidebar Toggle (Topbar) -->
              <div type="button"  id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
              <button id="sidebarCollapse" type="button" class="btn btn-light bg-white ">
            <i class="fa fa-bars mr-2"><small class="text-uppercase font-weight-bold"></small></i>
        </button>
              </div>
              
  
            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light " placeholder="Search for..." aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
  
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
  
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown  d-sm-none">
           
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3">
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small"
                      placeholder="Search for..." >
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>
  
              <!-- Nav Item - Alerts -->
              <!--Notification-->
              <!--
             <li class="nav-item dropdown">
                              <a class="nav-icon dropdown" href="#" id="alertsDropdown" data-toggle="dropdown" aria-expanded="false">
                                  <div class="position-relative" id="right">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell align-middle"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                      <span class="indicator">4</span>
                                  </div>
                              </a>
                              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">-->
                               <!--  <div class="dropdown-menu-header">
                                      4 New Notifications
                                  </div>
                                  <div class="list-group">
                                      <a href="#" class="list-group-item">
                                          <div class="row no-gutters align-items-center">
                                              <div class="col-2">
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                              </div>
                                              <div class="col-10">
                                                  <div class="text-dark">Update completed</div>
                                                  <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                                  <div class="text-muted small mt-1">30m ago</div>
                                              </div>
                                          </div>
                                      </a>
                                      
                                  </div>
                                  <div class="dropdown-menu-footer">
                                      <a href="#" class="text-muted">Show all notifications</a>
                                  </div>
                              -->
            <!--FIN NOTIF    </div>
               </li>
            -->
              <!-- Nav Item - Messages -->
              
  
              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="right">Vishweb Design</span>
                  <img class="img-profile rounded-circle" src="img/logo3.png">
                </a>
              </li>
  
            </ul>
  
          </nav>