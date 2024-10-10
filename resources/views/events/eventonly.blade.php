<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stembayo Events</title>
    <!-- CDN Bootsrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- CSS & Logo -->
    <link rel="stylesheet" href="{{ asset('css/eventonly.css') }}" /> 
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <link rel="icon" href="https://smkn2depoksleman.sch.id/utama/wp-content/uploads/2024/09/cropped-Untitled-design-5-3.png" type="image/icon"> 
</head>
<style>
    /* css di public/css/dashboard.css */
</style>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('events.dashboard') }}">
            <img src="https://i.ibb.co.com/P5Lyxyc/stmby.png" alt="Logo" width="80" height="80" class="d-inline-block align-middle">
            EVENT STEMBAYO
        </a>
            <button class="navbar-toggler no-border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <div class="navbar-right ">
                        <div class="search-container ">
                                    <input type="text" class="search-bar" placeholder="Cari Event">
                            <!-- <i class="bi bi-search search-icon"></i> -->
                                    <button class="search-btn"><i class="bi bi-search"></i></button>
                        </div>
                        <div class="login-container">
                                    <a href="#" class="login-btn">Log In</a>
                                    <a href="#" class="signup-btn">Sign Up</a>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

<!-- Sidebar -->
  <div id="app">
      <a class="sidebar-toggler"  @click="toggleSidebar" aria-label="Toggle Sidebar">
        <i class="bi bi-caret-right-fill"></i>
      </a> 
      <div class="d-flex">
          <div class="sidebar" :class="{ show: isSidebarVisible }">
            <div class="close-sidebar" @click="toggleSidebar">
              <button type="button" class="btn-close mt-5" aria-label="Close"></button>
            </div>
                <div class="user-info">
                  <img src="https://via.placeholder.com/60" alt="User Profile">
                  <h5>Nama User</h5>
                  <p>email@user.id</p>
                </div>
                <div class="menu" id="sidebar">
                  <ul class="menu-items">  <li class="active">
                      <a href="#"><i class="bi bi-house-fill"></i>Dashboard</a>
                    </li>
                    <li>
                      <a href="#"><i class="bi bi-bell-fill"></i>Notification</a>
                    </li>
                    <li>
                      <a href="#"><i class="bi bi-ticket-perforated"></i>Ticket</a>
                    </li>
                    <li>
                      <a href="#"><i class="bi bi-question-circle"></i>Help & Support</a>
                    </li>
                    <li>
                      <a href="{{ route('events.dashboard') }}"><i class="bi bi-question-circle"></i>Kembali</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
      </div>


    <section class="event">
      <div class="main-content">
        <h2>EVENTS</h2>
        <div class="card-container">
            @foreach($events as $event)
             <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                  <div class="card">
                      <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="CardImage">
                      <div class="card-body">
                          <h5 class="card-title">{{ $event->name }}</h5>
                          <p class="card-text">{{ $event->description }}</p>
                          <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                      </div>
                  </div>
                </div>
             </div>
          </div>
            @endforeach 
        </div>
    </section>
    </div>

    <footer class=" text-white pt-4">
      <div class="container">
          <div class="row">
          <div class="col-md-6">
              <h5>About Us</h5>
              <p>
              Kita adalah 3L Lazer Limleye Lmx
              <li>Lazer (Ahmad Hanaffi Rahamdhani)</li>
              </p>
          </div>
          <div class="col-md-6 text-end">
              <h5>Contact Us</h5>
              <ul class="list-unstyled">
              <li><i class="bi bi-geo-alt-fill"></i> 79H6+P86, Jl. Magelang, Jaran, Tridadi, Kec. Sleman, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55511</li>
              <li><i class="bi bi-telephone-fill"></i> +62 999 999 999</li>
              <li><i class="bi bi-envelope-fill"></i> 3el@gmail.com</li>
              </ul>
          </div>
          </div>
          <hr class="my-4" />
          <div class="text-center py-3">
          <p>&copy; 2024 Stembayo Events. All rights reserved.</p>
          </div>
      </div>
      </footer>
    
        <script>
            // Close navbar when clicking outside
            document.addEventListener('click', function(e) {
              const navbar = document.querySelector('.navbar-collapse');
              const navbarToggler = document.querySelector('.navbar-toggler');
        
              if (!navbar.contains(e.target) && e.target !== navbarToggler) {
                navbar.classList.remove('show');
              }
            });

            new Vue({
                el: '#app',
                data: {
                    isSidebarVisible: false // Status visibilitas sidebar
                },
                methods: {
                    toggleSidebar() {
                        this.isSidebarVisible = !this.isSidebarVisible; // Toggle visibilitas
                    },
                    toggleNavbar() {
                        // Logika untuk toggle navbar jika diperlukan
                    }
                }
            });

   
          </script>
</body>
</html>
