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
        z-index: 100;
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
        z-index: 999;
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

    .sidebar .user-info img {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        margin-bottom: 10px;
        margin-top: 10px;
        object-fit: cover;
        padding: 2px;
        border: 2px solid #d6d6d6;
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

</style>

<div id="app">
    <a class="sidebar-toggler" @click="toggleSidebar" aria-label="Toggle Sidebar">
        <i class="bi bi-caret-right-fill"></i>
    </a>
    <div class="d-flex">
        <div class="sidebar" :class="{ show: isSidebarVisible }">
            <div class="close-sidebar mt-5">
                <button type="button" @click="toggleSidebar" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <a href="{{ route('profile.edit') }}" class="user-info-link">
                <div class="user-info d-flex">
                    @if($user)
                        <div class="user-profile">
                            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://as2.ftcdn.net/v2/jpg/05/89/93/27/1000_F_589932782_vQAEAZhHnq1QCGu5ikwrYaQD0Mmurm0N.jpg' }}" alt="Avatar" class="avatar">
                        </div>
                        <div class="user-name">
                            <h5>{{ $user->name }}</h5>
                            <p>{{ $user->email }}</p>
                        </div>
                    @else
                        <div class="user-name">
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        </div>
                    @endif
                </div>
            </a>
            
            @if($user)
                <div class="menu" id="sidebar">
                    <ul class="menu-items">
                        <li :class="{ active: currentRoute === 'events.dashboard' }">
                            <a href="{{ route('events.dashboard') }}" @click="setCurrentRoute('events.dashboard')">
                                <i class="bi bi-house-fill"></i>Dashboard
                            </a>
                        </li>
                        <li :class="{ active: currentRoute === 'events.eventonly' }">
                            <a href="{{ route('events.eventonly') }}" @click="setCurrentRoute('events.eventonly')">
                                <i class="bi bi-calendar"></i>Agenda Acara
                            </a>
                        </li>
                        <li :class="{ active: currentRoute === 'news' }">
                            <a href="#" @click="setCurrentRoute('news')">
                                <i class="bi bi-newspaper"></i>Berita Acara
                            </a>
                        </li>
                        <li :class="{ active: currentRoute === 'tickets' }">
                            <a href="#" @click="setCurrentRoute('tickets')">
                                <i class="bi bi-bookmark"></i>Bookmark
                            </a>
                        </li>
                        <li :class="{ active: currentRoute === 'settings' }">
                            <a href="#" @click="setCurrentRoute('settings')">
                                <i class="bi bi-gear"></i>Settings
                            </a>
                        </li>
                        <li :class="{ active: currentRoute === 'support' }">
                            <a href="#" @click="setCurrentRoute('support')">
                                <i class="fas fa-headset"></i>Help & Support
                            </a>
                        </li>
                        <li :class="{ active: currentRoute === 'back' }">
                            <a href="{{ route('events.dashboard') }}" @click="setCurrentRoute('back')">
                                <i class="bi bi-arrow-left-short"></i>Back
                            </a>
                        </li>
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
            @endif
        </div>
    </div>
</div>

<script>
    new Vue({
        el: '#app',
        data: {
            isSidebarVisible: false,
            currentRoute: 'events.eventonly' // Set default route
        },
        methods: {
            toggleSidebar() {
                this.isSidebarVisible = !this.isSidebarVisible;
            },
            setCurrentRoute(route) {
                this.currentRoute = route;
            }
        }
    });
</script>
