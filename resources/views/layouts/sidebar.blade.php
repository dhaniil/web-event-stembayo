<style>
    /* Fixed sidebar positioning and layout */
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
        width: 270px; /* Increased from 250px */
        background-color: #f8f9fa;
        height: 100vh;
        padding-top: 0; /* Remove default top padding */
        position: fixed;
        top: 0;
        left: -55px; /* Move significantly more to the left */
        border-right: 1px solid #e0e0e0;
        box-shadow: 5px 0 5px rgba(0, 0, 0, 0.1);
        z-index: 40;
        transform: translateX(-101%);
        transition: transform 0.3s ease;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        overflow-x: hidden; /* Changed from visible to hidden */
        padding-left: 55px; /* Add left padding equal to the negative left position */
    }

    .sidebar.show {
        transform: translateX(0);
    }

    /* Consistent header area for the sidebar */
    .sidebar-header {
        padding: 1rem;
        padding-left: 20px; /* Adjust header padding */
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        z-index: 5;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .sidebar-brand {
        font-weight: 700;
        font-size: 1.25rem;
        color: #3c5cff;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .sidebar-brand img {
        width: 32px;
        height: 32px;
    }

    .sidebar .close-sidebar {
        margin: 0;
        padding: 0;
    }

    .sidebar .close-sidebar button {
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #3c5cff;
        color: white;
        transition: all 0.2s ease;
        cursor: pointer;
        font-size: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
    
    .sidebar .close-sidebar button:hover {
        background-color: #2a41c8;
        transform: scale(1.1);
    }
    
    .sidebar .close-sidebar button i {
        font-size: 22px;
        font-weight: bold;
    }
    
    /* Content area of the sidebar */
    .sidebar-content {
        flex: 1;
        overflow-y: auto;
        padding: 1rem 0;
    }

    .sidebar .user-info {
        margin: 0.5rem 1rem 1.5rem;
        padding: 1rem;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        align-items: center;
        gap: 15px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        margin-right: 20px; /* Increased from 15px */
        position: relative; /* For proper positioning context */
    }

    .sidebar .user-info.guest {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }

    .auth-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 100%;
        padding-top: 10px;
    }

    .auth-buttons .btn {
        width: 100%;
        padding: 8px;
        margin: 5px 0;
    }

    .auth-buttons .btn-primary {
        background-color: #3c5cff;
        color: white;
        border: none;
    }

    .auth-buttons .btn-outline-primary {
        background-color: transparent;
        color: #3c5cff;
        border: 1px solid #3c5cff;
    }

    .auth-buttons .btn-outline-primary:hover {
        background-color: #3c5cff;
        color: white;
    }

    .user-profile {
        flex-shrink: 0;
    }

    .avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #3c5cff;
        padding: 2px;
        background-color: white;
    }

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
        flex-grow: 1;
        overflow: hidden;
    }

    .sidebar .user-name h5 {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        color: #2d3748;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar .user-name p {
        font-size: 13px;
        color: #718096;
        margin: 4px 0 0 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar .menu ul {
        padding: 0;
        list-style: none;
    }

    .sidebar .menu ul li {
        padding: 5px 25px 5px 20px; /* Increased right padding */
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
        padding: 12px 15px;
        color: #4a5568;
        display: flex;
        align-items: center;
        border-radius: 10px;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .sidebar .menu ul li a:hover,
    .sidebar .menu ul li.active a {
        background-color: #3c5cff;
        color: white;
        transform: translateX(5px);
    }

    .menu-items {
        padding: 10px 0;
        margin-bottom: 70px;
        padding-bottom: 100px;
    }

    .logout-button {
        position: fixed;
        bottom: 0;
        left: 55px; /* Match the sidebar padding-left */
        right: 0;
        padding: 15px; /* Reduced padding */
        background: linear-gradient(to top, #f8f9fa 80%, transparent);
        width: 215px; /* Adjusted to match new sidebar width (270px - 55px) */
        z-index: 10;
    }

    .btn-logout {
        width: 100%;
        padding: 8px 16px; /* Reduced padding */
        border-radius: 8px; /* Smaller border radius */
        background-color: #fff;
        color: #dc3545;
        border: 1px solid #dc3545; /* Thinner border */
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px; /* Reduced gap */
        font-weight: 500; /* Slightly reduced font weight */
        font-size: 0.9rem; /* Smaller font size */
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-logout:hover {
        background-color: #dc3545;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
    }

    .btn-logout i {
        font-size: 1rem; /* Smaller icon */
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

    /* Redesigned close button that straddles the edge of the sidebar */
    .sidebar .close-button-container {
        position: absolute;
        top: 90px; /* Moved up from 100px to 80px */
        right: 15px; /* Keep this adjustment */
        z-index: 45; /* Higher than sidebar z-index */
    }
    
    .sidebar .close-button {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #3c5cff;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
        padding: 0;
        outline: none;
        position: relative;
        right: -10px;
    }
    
    .sidebar .close-button:hover {
        transform: scale(1.1);
        background-color: #2a41c8;
    }
    
    .sidebar .close-button i {
        font-size: 20px;
    }
    
    /* Make sure the sidebar animation works with the button */
    .sidebar {
        transform: translateX(-101%);
        transition: transform 0.3s ease;
    }
    
    .sidebar.show {
        transform: translateX(0);
    }
    
    .sidebar.show .close-button-container {
        opacity: 1;
        visibility: visible;
        transition: opacity 0.3s ease 0.1s, visibility 0s linear;
    }
    
    .sidebar:not(.show) .close-button-container {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease, visibility 0s linear 0.2s;
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
            <!-- New consistent sidebar header -->
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <img src="{{ asset('storage/assets/stembayo.png') }}" alt="Logo" />
                    <span>STEMBAYO</span>
                </div>
            </div>
            
            <!-- Improved close button with clear positioning -->
            <div class="close-button-container">
                <button type="button" class="close-button" x-on:click="toggleSidebar" aria-label="Close Sidebar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <!-- Sidebar content in scrollable area -->
            <div class="sidebar-content">
                @auth
                    <a href="{{ route('profile.edit') }}" class="user-info-link">
                        <div class="user-info">
                            <div class="user-profile">
                                @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                    alt="Profile picture" 
                                    class="avatar"
                                    onerror="setDefaultImage(this)">
                                @else
                                    <img src="{{ asset('storage/assets/default-avatar.jpg') }}" 
                                        alt="Default avatar" 
                                        class="avatar">
                                @endif
                            </div>
                            <div class="user-name">
                                <h5>{{ Auth::user()->name }}</h5>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </a>
                @else
                    <div class="user-info guest">
                        <img src="https://api.dicebear.com/7.x/initials/svg?seed= &backgroundColor=d3d3d3"
                            alt="Anonymous" 
                            class="avatar">
                        <div class="guest-info">
                            <h5>Selamat datang!</h5>
                            <p class="text-muted">Silahkan login untuk mengakses semua fitur</p>
                        </div>
                        <div class="auth-buttons">
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                        </div>
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
            </div>

            <!-- Replace just the logout section -->
            <!-- <div class="logout-button">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="mb-0">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @endauth
            </div> -->
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

<script>
function setDefaultImage(img) {
    img.onerror = null; // prevent infinite loop
    img.src = "https://api.dicebear.com/7.x/initials/svg?seed= &backgroundColor=d3d3d3";
}
</script>