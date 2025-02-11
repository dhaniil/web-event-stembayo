<style>
    .footer {
        background: linear-gradient(135deg, #5356ff 0%, #3730a3 100%);
        position: relative;
        overflow: hidden;
        padding: 60px 0 30px;
        color: #fff;
    }

    .footer::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        top: -200px;
        right: -100px;
        filter: blur(80px);
    }

    .footer::after {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        bottom: -150px;
        left: -100px;
        filter: blur(70px);
    }

    .footer h5 {
        color: #fff;
        font-weight: 600;
        margin-bottom: 20px;
        font-size: 18px;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .footer-links a:hover {
        color: #fff;
        padding-left: 5px;
    }

    .social-links {
        margin-top: 20px;
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        margin-right: 10px;
        color: #fff;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 20px;
        margin-top: 40px;
    }

    .contact-info i {
        margin-right: 10px;
        width: 20px;
    }

</style>

<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4 mb-4">
                <h5>Tentang Stembayo Events</h5>
                <p class="mb-4">Platform event resmi SMKN 2 Depok Sleman yang menampilkan berbagai event </p>
                <div class="social-links">
                    <a href="https://www.instagram.com/event.stembayo/"><i class="bi bi-instagram"></i></a>
                    <a href="https://web.facebook.com/stembayolover/"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.youtube.com/@smkn2depoksleman/"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2 mb-4">
                <h5>Menu Utama</h5>
                <ul class="footer-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/events">Event</a></li>
                    <li><a href="/berita">Berita</a></li>
                    <li><a href="/galeri">Galeri</a></li>
                </ul>
            </div>

            <!-- Multisite Links -->
            <div class="col-md-3 mb-4">
                <h5>Situs Terkait</h5>
                <ul class="footer-links">
                    <li><a href="https://smkn2depoksleman.sch.id">Website Utama</a></li>
                    <li><a href="https://perpus.smkn2depoksleman.sch.id">Perpustakaan</a></li>
                    <li><a href="https://elearning.stembayo.sch.id/">E-Learning</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-3 mb-4">
                <h5>Hubungi Kami</h5>
                <div class="contact-info">
                    <p><i class="bi bi-geo-alt-fill"></i> Mrican, Caturtunggal, Depok, Sleman<br>Daerah Istimewa Yogyakarta 55281</p>
                    <p><i class="bi bi-telephone-fill"></i> +62 274 513515</p>
                    <p><i class="bi bi-envelope-fill"></i> info@smkn2depoksleman.sch.id</p>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Stembayo Events. All rights reserved.</p>
            <small>Developed with ❤️ by 3L Team</small>
        </div>
    </div>
</footer>