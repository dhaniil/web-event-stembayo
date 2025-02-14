<style>
    @media (max-width: 640px) {
        .nav-lg{
            display: none;
        }
    }

    @media (max-width: 785px) {
        .nav-lg{
            display: none;
        }
    }
</style>
<nav class="bg-white  fixed w-full p-3  shadow-md z-50 ">
        <div class="mx-auto flex justify-between items-center">
            <a  href="{{ route('events.dashboard') }}" class="text-[#3c5cff] text-xl flex items-center no-underline font-bold">
                <img src="{{ asset('storage/assets/stembayo.png') }}" alt="Logo" width="50" height="50" class="d-inline-block align-middle">
                EVENT STEMBAYO
            </a>
            <div class="nav-lg sm:hidden md:flex space-x-4 items-center">

                <div class="gap-2 flex">
                    <input type="text" placeholder="Search" class="px-3 rounded-full bg-[#e6e6e6] border-none focus:ring-2 transition-all focus:ring-[#3c5cff] focus:outline-none">
                    <button class="bg-[#3c5cff] px-3 py-1 text-white rounded-full active:scale-95 transition-all"><i class="fas fa-search"></i></button>
                </div>
              
              @guest
                <div>
                    <a href="{{ route('login') }}" class="no-underline bg-white text-blue-600 px-4 font-semibold py-2 rounded-md transition-all hover: active:scale-95">Log In</a>
                    <a href="{{ route('register') }}" class="no-underline bg-[#3c5cff] text-sm text-white px-3 font-semibold py-2 rounded-xl transition-all hover:bg-[#1a40ff] active:scale-95">Sign Up</a>
                </div>
              @endguest
            </div>
      
            <button id="menu-toggle" class="md:hidden text-[#3c5cff] focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
      
        <div id="menu" class="lg:hidden max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
            <div class="flex justify-center gap-2 mt-2">
                <input type="text" placeholder="Search" class="bg-gray-300 rounded-full focus:ring-2 focus:ring-[#3c5cff] focus:outline-none transition-all px-3 py-1 text-gray-800">
                <button class="bg-[#3c5cff] px-4 py-2 text-white rounded-full"><i class="fas fa-search"></i></button>
            </div>
            <div class="flex justify-center mt-4">
                <a class="bg-white text-blue-600 px-4 no-underline font-semibold py-1 rounded-md transition-all hover: active:scale-95">Log In</a>
                <a class="bg-[#3c5cff] text-sm text-white no-underline px-3 font-semibold py-2 rounded-xl transition-all hover:bg-[#1a40ff] active:scale-95">Sign Up</a>
            </div>
        </div>
    </nav>

    <script>
        const toggler = document.getElementById("menu-toggle");
        const menu = document.getElementById("menu");

        toggler.addEventListener("click", () => {
            if (menu.classList.contains("max-h-0")) {
                menu.classList.remove("max-h-0");
                menu.classList.add("max-h-[300px]");
            } else {
                menu.classList.add("max-h-0");
                menu.classList.remove("max-h-[300px]");
            }
        });

        document.addEventListener("click", (event) => {
            if (!toggler.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add("max-h-0");
                menu.classList.remove("max-h-[300px]");
            }
        });
    </script>