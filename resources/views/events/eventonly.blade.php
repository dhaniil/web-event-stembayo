<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Stembayo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" /> 
    <link rel="stylesheet" href="{{ asset('css/eventonly.css') }}"/>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="navbar-brand">
                <i class=""></i>
                EVENT STEMBAYO
            </a>
        </div>

        <div class="navbar-right">
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Cari Event">
                <i class="bi bi-search search-icon"></i>
            </div>
            <button class="search-btn">Search</button>
            <a href="#" class="login-btn">Log In</a>
            <a href="#" class="signup-btn">Sign Up</a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="d-flex">
        <div class="sidebar mt-5">
            <div class="user-info">
                <img src="https://via.placeholder.com/60" alt="User Profile">
                <h5>Nama User</h5>
                <p>email@user.id</p>
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


    <div class="main-content">
        <h2>EVENTS</h2>
        <div class="card-container">
            @foreach($events as $event)
            <div class="card">
                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="CardImage">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    <p class="card-text">{{ $event->description }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>
