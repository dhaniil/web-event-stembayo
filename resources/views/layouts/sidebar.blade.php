    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sidebar Layout</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" /> 
    
    </head>
    <body>
        <div class="d-flex">
            <div class="sidebar">
            <div class="user-info">
                <img src="https://via.placeholder.com/60" alt="User Profile">
                <h5>{{ $user->nama }}</h5> <!-- Display user Nama -->
                <p>{{ $user->email }}</p>  <!-- Display user email -->
            </div>

                <div class="menu">
                    <ul>
                        <li class="active">
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
                    </ul>
                </div>
            </div>
            <div class="content p-4">
                @yield('content')
            </div>
        </div>
        
    </body>
    </html>
