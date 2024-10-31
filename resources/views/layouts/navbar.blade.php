<style>
    
    .navbar {
        display: flex;
        justify-content: space-between;
        position: fixed;
        align-items: center;
        padding: 10px 20px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        top: 0;
        width: 100%;
        z-index: 1000;
    }
    
    .navbar-brand {
        font-size: 20px;
        font-weight: bold;
        color: #3c5cff;
        text-decoration: none;
        display: flex;
        align-items: center;
        z-index: 100;
        margin: 0;
        transition: all 200ms ease;
    }
    
    .navbar-brand:hover{
        color: #378CE7;
    }
    
    .navbar img{
        width: 50px;
        height: 50px;
        margin-right: 5px; 
    }
    
    .navbar-brand i {
        margin-right: 10px;
        font-size: 24px;
    }
    .navbar-toggler{
        border: none;
        color: #3c5cff;
    }
    .navbar-toggler, .navbar-toggler:focus, 
    .navbar-toggler-icon:focus {
        outline: none;
        border: none;
        box-shadow: none;
    }
    
    .no-border {
        outline: none;
        box-shadow: none;
    }
    
    .navbar-center {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-grow: 1;
        margin-right: 20px;
    }
    
    .search-bar {
        padding: 8px;
        border: 2px solid #e0e0e0;
        border-radius: 20px;
        font-size: 12px;
        background-color: #ededed;
    }
    
    .search-btn {
        padding: 8px 15px;
        border: none;
        background-color: #3c5cff;
        color: #fff;
        border-radius: 20px;
        cursor: pointer;
        margin-left: 5px;
    }   
    
    .search-bar:focus {
        outline: 2px solid #3c5cff
    }
    
    .navbar-right {
        display: flex;
        align-items: center;
    }
    
    .navbar-right a {
        text-decoration: none;
        color: #3c5cff;
        margin-left: 20px;
    }
    
    
    
    .login-container .login-btn {
        padding: 8px 10px 8px;
        border: 2px solid #3c5cff;
        border-radius: 20px;
        text-align: center;
        font-size: 12px;
        width: 100% ;
        font-weight: 600;
        transition: all 200ms ;
    }
    
    .login-container .login-btn:hover {
        background-color: #3c5cff;
        color: #ffffff;
    }
    
    .login-container .signup-btn {
        padding: 8px 10px 8px;  
        background-color: #3c5cff;
        border: 2px solid #3c5cff;
        color: #ffffff;
        border-radius: 20px;
        text-align: center;
        font-size: 12px;
        font-weight: 600;
        margin-left: 10px;
        transition: all 200ms ;
    }
    
    .login-container .signup-btn:hover {
        background-color: #324dd2;
    }
    
    @media (max-width: 576px) {
        .navbar-brand{
            font-size: 16px;
        }
    }
    </style>
    <body>
        
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
                                        <input type="text" class="search-bar" placeholder="Search">
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
        <script>
            document.addEventListener('click', function(e) {
                  const navbar = document.querySelector('.navbar-collapse');
                  const navbarToggler = document.querySelector('.navbar-toggler');
            
                  if (!navbar.contains(e.target) && e.target !== navbarToggler) {
                    navbar.classList.remove('show');
                  }
                });
    
        </script>