<style>

    .sidebar-toggler {
        border: none;
        color: #fff;
        padding: 10px;
        transform: translateY(90px);
        width: 40px;
        border-top-right-radius: 50px;
        border-bottom-right-radius: 50px;
        background-color: #3c5cff;
        margin-right: 20px;
        position: fixed;
        cursor: pointer;
        box-shadow: 1px 5px 5px rgba(0, 0, 0, 0.2);
        transition: all 200ms ease;
        z-index: 40;
    }

    .sidebar-toggler:hover {
        width: 45px;
        padding-left: 15px;
    }

    .sidebar {
        width: 280px;
        background-color: #f8f9fa;
        height: 100vh;
        padding-top: 20px;
        position: fixed;
        top: 0;
        left: 0;
        border-right: 1px solid #e0e0e0;
        box-shadow: 5px 0 5px rgba(0, 0, 0, 0.1);
        z-index: 40;
        transform: translateX(-101%);
        transition: transform 0.3s ease;
    }

    .sidebar.show {
        transform: translateX(0);
    }

    .sidebar .close-sidebar {
        transform: translateY(20px);
        text-align: end;
        padding: 0px 10px 0px 10px;
    }

    .sidebar .close-sidebar button {
        border: none;
        border-radius: 50%;
        font-size: 20px;
        width: 32px;
    }

    .sidebar .user-info {
        margin-top: 10px;
        padding-left: 20px;
        border-bottom: 1px solid #e0e0e0;
        align-items: center;
    }

    /* .sidebar .user-info img {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        margin-bottom: 10px;
        margin-top: 10px;
        object-fit: cover;
        padding: 2px;
        border: 2px solid #d6d6d6;
    } */

    .sidebar .user-info h5 {
        margin-bottom: 5px;
        font-size: 16px;
        font-weight: 600;
    }

    .sidebar .user-info p {
        font-size: 12px;
        color: #828282;
    }

    .sidebar .user-name {
        align-items: center;
        padding-left: 10px;
    }

    .sidebar .user-name h5 {
        font-size: 15px;
    }

    .sidebar .user-name p {
        margin: 0;
    }

    .sidebar .menu ul {
        padding: 0;
        list-style: none;
    }

    .sidebar .menu ul li {
        padding: 5px 20px;
    }

    .sidebar .menu ul li.active a {
        margin-top: 10px;
        background-color: #5356ff;
        border: 2px solid #5356ff;
        color: #fff;
    }

    .sidebar .menu ul li a i {
        margin-right: 10px;
        margin-left: 5px;
    }

    .sidebar .menu ul li a {
        text-decoration: none;
        padding: 10px 5px;
        color: #595959;
        display: flex;
        align-items: center;
        transition: all 100ms ease-in;
    }

    .sidebar .menu ul li a:hover,
    .sidebar .menu ul li.active a {
        background-color: #5356ff;
        border-radius: 10px;
        color: #fff;
    }

    .menu-items {
        padding-bottom: 60px;
    }

    .logout-button {
        position: absolute;
        bottom: 20px;
        right: 20px;
        width: calc(100% - 40px);
    }

    .btn-logout {
        background: none;
        border: none;
        color: #595959;
        display: flex;
        align-items: center;
        padding: 10px;
        cursor: pointer;
        gap: 7px;
        width: 100%;
        text-align: right;
        transition: all 100ms ease-in;
    }

    .btn-logout:hover {
        background-color: #5356ff;
        border-radius: 10px;
        color: #fff;
    }
    
    .user-info-link {
        text-decoration: none;
        color: inherit;
    }
    .user-info-link:hover {
        color: inherit;
    }

    .admin-restricted a {
        border: 1px solid #ffc107;
        border-radius: 4px;
        padding: 8px 12px;
        margin: 4px 0;
    }

    .admin-restricted a:hover {
        background-color: rgba(255, 193, 7, 0.1);
    }   
</style>


<div x-data="sidebarState">
    <button type="button" class="sidebar-toggler" x-on:click="toggleSidebar" aria-label="Toggle Sidebar">
        <i class="bi bi-caret-right-fill"></i>
    </button>
    <div class="d-flex">
        <div class="sidebar" :class="{ 'show': isSidebarVisible }" x-init="$nextTick(() => { 
            isSidebarVisible = localStorage.getItem('sidebarVisible') === 'true';
            window.addEventListener('beforeunload', () => {
                localStorage.setItem('scrollPosition', window.scrollY);
            });
            if (performance.navigation.type === 1) {
                const scrollPosition = localStorage.getItem('scrollPosition');
                if (scrollPosition) {
                    window.scrollTo(0, parseInt(scrollPosition));
                }
            }
        })">
            <div class="close-sidebar mt-5">
                <button type="button" x-on:click="toggleSidebar" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            @auth
                <a href="{{ route('profile.edit') }}" class="user-info-link">
                    <div class="user-info d-flex align-items-center">
                        <div class="user-profile">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Avatar" class="avatar">
                            @else
                                <img src="{{ asset('storage/assets/SOC02116.jpg') }}" alt="Avatar" class="avatar">
                            @endif
                        </div>
                        <div class="user-name px-2">
                            <h5>{{ Auth::user()->name }}</h5>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </a>
            @else
                <div class="user-info d-flex justify-content-center align-items-center flex-column" style="padding: 20px;">
                    <img src="https://as2.ftcdn.net/v2/jpg/05/89/93/27/1000_F_589932782_vQAEAZhHnq1QCGu5ikwrYaQD0Mmurm0N.jpg" alt="Guest" class="avatar mb-3">
                    <h5 class="text-center mb-3">Selamat datang!</h5>
                    <p class="text-center text-muted mb-4">Silahkan login untuk mengakses semua fitur</p>
                    <a href="{{ route('login') }}" class="btn btn-primary mb-2" style="width: 200px;">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary" style="width: 200px;">Register</a>
                </div>
            @endauth

            <div class="menu" id="sidebar">
                <ul class="menu-items">
                    <li class="{{ request()->is('home') ? 'active' : '' }}">
                        <a href="/home">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('berita.index') ? 'active' : '' }}">
                        <a href="{{ route('berita.index') }}">
                            <i class="bi bi-newspaper"></i> Berita Acara
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('favourites') ? 'active' : '' }}">
                        <a href="{{ route('favourites') }}">
                            <i class="bi bi-heart"></i> Favourite
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                        <a href="{{ route('profile.edit') }}">
                            <i class="bi bi-person"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="goBack()">
                            <i class="bi bi-arrow-left-short"></i> Back
                        </a>
                    </li>
                    
                    @if(Auth::check() && Auth::user()->hasAnyRole(['Sekbid', 'Admin', 'Super Admin']))
                    <li class="{{ request()->routeIs('admin') ? 'active' : '' }}">
                        <a href="/admin"  class="text-warning">
                            <i class="bi bi-shield-lock"></i> Admin Panel
                        </a>
                    </li>
                    @endif
                </ul>
            </div>

            <div class="logout-button">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebarState', () => ({
            isSidebarVisible: localStorage.getItem('sidebarVisible') === 'true',
            
            toggleSidebar() {
                this.isSidebarVisible = !this.isSidebarVisible;
                localStorage.setItem('sidebarVisible', this.isSidebarVisible);
            }
        }));
    });

    function goBack() {
        const scrollPosition = window.scrollY;
        localStorage.setItem('scrollPosition', scrollPosition);
        window.history.back();
    }

    // Handle scroll position restoration after navigation
    window.addEventListener('popstate', function() {
        const scrollPosition = localStorage.getItem('scrollPosition');
        if (scrollPosition) {
            window.scrollTo(0, parseInt(scrollPosition));
        }
    });
</script>
