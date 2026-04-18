<footer class="bg-gray-900 text-gray-400 pt-12 pb-6 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- About -->
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Bogorior KitchenSet</h3>
                <p class="text-sm leading-relaxed mb-4">Spesialis kitchen set di Bogor dengan pengalaman lebih dari 10 tahun. Telah melayani 500+ klien dengan kualitas terbaik.</p>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-400 hover:text-green-500 transition text-xl"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-green-500 transition text-xl"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-400 hover:text-green-500 transition text-xl"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="text-gray-400 hover:text-green-500 transition text-xl"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-green-500 transition">Beranda</a></li>
                    <li><a href="{{ route('portfolio.index') }}" class="hover:text-green-500 transition">Portfolio</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-green-500 transition">Layanan</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-green-500 transition">Artikel</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-green-500 transition">Tentang Kami</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-green-500 transition">Kontak</a></li>
                </ul>
            </div>
            
            <!-- Services -->
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Layanan</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('services.index') }}" class="hover:text-green-500 transition">Kitchen Set Custom</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-green-500 transition">Kitchen Set Premium</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-green-500 transition">Renovasi Dapur</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-green-500 transition">Interior Design</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Kontak Kami</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-3"><i class="fab fa-whatsapp text-green-500 w-5"></i> <a href="https://wa.me/628977288600" class="hover:text-green-500 transition">+62 897 7288 600</a></li>
                    <li class="flex items-center gap-3"><i class="fas fa-phone w-5"></i> <a href="tel:628977288600" class="hover:text-green-500 transition">+62 897 7288 600</a></li>
                    <li class="flex items-center gap-3"><i class="fas fa-envelope w-5"></i> <a href="mailto:info@bogorior.com" class="hover:text-green-500 transition">info@bogorior.com</a></li>
                    <li class="flex items-center gap-3"><i class="fas fa-map-marker-alt w-5"></i> <span>Bogor, Indonesia</span></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 pt-6 text-center text-sm">
            <p>&copy; {{ date('Y') }} Bogorior KitchenSet. All rights reserved.</p>
        </div>
    </div>
</footer>