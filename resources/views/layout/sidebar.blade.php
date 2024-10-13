<style>
    
.sidebar-toggler{
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

.sidebar-toggler:hover{
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
    transform: translateX(0); /* Menampilkan sidebar */
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
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin-bottom: 10px;
    margin-top: 10px;
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

.sidebar .user-profie{
}

.sidebar .user-name {
    align-items: center;
    /* padding-top: 20px;  */
    padding-left: 10px;
}
.sidebar .user-name h5{
  font-size: 15px;
}
.sidebar .user-name p{
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
    background-color: #5356ff;
    border: 2px solid #00027b;
    color: #fff;
}

.sidebar .menu ul li a i {
    margin-right: 10px;
    margin-left: 5px;
}

.sidebar .menu ul li a{
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
</style>
    <div id="app">
        <a class="sidebar-toggler"  @click="toggleSidebar" aria-label="Toggle Sidebar">
          <i class="bi bi-caret-right-fill"></i>
        </a> 
        <div class="d-flex">
            <div class="sidebar" :class="{ show: isSidebarVisible }">
              <div class="close-sidebar mt-5">
                <button type="button" class=""  @click="toggleSidebar" aria-label="Close"><i class="fas fa-times"></i></button>
              </div>
                  <div class="user-info d-flex">
                    <div class="user-profile">
                      <img src="https://via.placeholder.com/60" alt="User Profile">
                    </div>
                    <div class="user-name">
                      <h5>Username</h5>
                      <p>emailuser@gmail.com</p>
                    </div>
                  </div>
                  <div class="menu" id="sidebar">
                    <ul class="menu-items">  <li class="active">
                        <a href="#"><i class="bi bi-house-fill"></i>Dashboard</a>
                      </li>
                      <li>
                        <a href="#"><i class="bi bi-calendar"></i>Agenda Acara</a>
                      </li>
                      <li>
                        <a href="#"><i class="bi bi-newspaper"></i></i>Berita Acara</a>
                      </li>
                      <li>
                        <a href="#"><i class="bi bi-ticket-perforated"></i>Ticket</a>
                      </li>
                      <li>
                        <a href="#"><i class="bi bi-gear"></i>Settings</a>
                      </li>
                      <li>
                        <a href="#"><i class="fas fa-headset"></i></i>Help & Support</a>
                      </li>
                      <li>
                        <a href="{{ route('events.dashboard') }}"><i class="bi bi-arrow-left-short"></i>Back</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
        </div>
        <script>
            new Vue({
                el: '#app',
                data: {
                    isSidebarVisible: false 
                },
                methods: {
                    toggleSidebar() {
                        this.isSidebarVisible = !this.isSidebarVisible; 
                    }
                }
            });
          </script>
