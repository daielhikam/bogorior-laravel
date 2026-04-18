<header class="fixed top-0 left-0 w-full bg-white shadow-md z-50 transition-all duration-300" id="siteHeader">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="font-bold text-xl text-green-600">Bogorior</span>
                <span class="text-gray-600 hidden sm:inline">KitchenSet</span>
            </a>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600 transition font-medium {{ request()->routeIs('home') ? 'text-green-600 border-b-2 border-green-600' : '' }}">Beranda</a>
                <a href="{{ route('portfolio.index') }}" class="text-gray-600 hover:text-green-600 transition font-medium {{ request()->routeIs('portfolio*') ? 'text-green-600 border-b-2 border-green-600' : '' }}">Portfolio</a>
                <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-green-600 transition font-medium {{ request()->routeIs('services*') ? 'text-green-600 border-b-2 border-green-600' : '' }}">Layanan</a>
                <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-green-600 transition font-medium {{ request()->routeIs('blog*') ? 'text-green-600 border-b-2 border-green-600' : '' }}">Artikel</a>
                <a href="{{ route('about') }}" class="text-gray-600 hover:text-green-600 transition font-medium {{ request()->routeIs('about') ? 'text-green-600 border-b-2 border-green-600' : '' }}">Tentang</a>
                <a href="{{ route('contact') }}" class="text-gray-600 hover:text-green-600 transition font-medium {{ request()->routeIs('contact') ? 'text-green-600 border-b-2 border-green-600' : '' }}">Kontak</a>
            </nav>
            
            <!-- CTA Button Desktop -->
            <div class="hidden md:block">
                <a href="https://wa.me/628977288600" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-full text-sm font-semibold transition flex items-center gap-2" target="_blank">
                    <i class="fab fa-whatsapp"></i> Konsultasi
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuToggle" class="md:hidden text-gray-600 text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobileNav" class="hidden md:hidden flex-col bg-white border-t py-4 space-y-3">
            <a href="{{ route('home') }}" class="block text-gray-600 hover:text-green-600 transition py-2 {{ request()->routeIs('home') ? 'text-green-600' : '' }}">Beranda</a>
            <a href="{{ route('portfolio.index') }}" class="block text-gray-600 hover:text-green-600 transition py-2 {{ request()->routeIs('portfolio*') ? 'text-green-600' : '' }}">Portfolio</a>
            <a href="{{ route('services.index') }}" class="block text-gray-600 hover:text-green-600 transition py-2 {{ request()->routeIs('services*') ? 'text-green-600' : '' }}">Layanan</a>
            <a href="{{ route('blog.index') }}" class="block text-gray-600 hover:text-green-600 transition py-2 {{ request()->routeIs('blog*') ? 'text-green-600' : '' }}">Artikel</a>
            <a href="{{ route('about') }}" class="block text-gray-600 hover:text-green-600 transition py-2 {{ request()->routeIs('about') ? 'text-green-600' : '' }}">Tentang</a>
            <a href="{{ route('contact') }}" class="block text-gray-600 hover:text-green-600 transition py-2 {{ request()->routeIs('contact') ? 'text-green-600' : '' }}">Kontak</a>
            <a href="https://wa.me/628977288600" class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-full text-sm font-semibold transition text-center" target="_blank">
                <i class="fab fa-whatsapp"></i> Konsultasi Gratis
            </a>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('siteHeader');
    const mobileToggle = document.getElementById('mobileMenuToggle');
    const mobileNav = document.getElementById('mobileNav');
    
    // Scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('shadow-lg');
            header.classList.remove('shadow-md');
        } else {
            header.classList.remove('shadow-lg');
            header.classList.add('shadow-md');
        }
    });
    
    // Mobile menu toggle
    if (mobileToggle && mobileNav) {
        mobileToggle.addEventListener('click', function() {
            if (mobileNav.classList.contains('hidden')) {
                mobileNav.classList.remove('hidden');
                mobileNav.classList.add('flex');
                mobileToggle.querySelector('i').classList.remove('fa-bars');
                mobileToggle.querySelector('i').classList.add('fa-times');
            } else {
                mobileNav.classList.add('hidden');
                mobileNav.classList.remove('flex');
                mobileToggle.querySelector('i').classList.remove('fa-times');
                mobileToggle.querySelector('i').classList.add('fa-bars');
            }
        });
    }
});
</script>