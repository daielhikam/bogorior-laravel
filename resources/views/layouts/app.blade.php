<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>@yield('title', config('app.name', 'Bogorior KitchenSet'))</title>
    <meta name="description" content="@yield('description', '500+ kitchen set telah terwujud dengan kualitas terbaik. Garansi 5 tahun, cicilan 0% 36x, free konsultasi desain.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Vite (Tailwind CSS + JS) - PASTIKAN INI ADA -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased pt-20">
    @include('layouts.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('layouts.footer')
    
    <!-- Floating WhatsApp Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/628977288600" class="flex items-center justify-center w-14 h-14 bg-green-600 rounded-full shadow-lg hover:bg-green-700 transition-all hover:scale-110" target="_blank" rel="noopener">
            <i class="fab fa-whatsapp text-white text-2xl"></i>
        </a>
    </div>
    
    <!-- Scroll Top Button -->
    <button id="scrollTop" class="fixed bottom-6 right-24 z-50 hidden w-10 h-10 bg-gray-800 rounded-full shadow-lg hover:bg-gray-900 transition-all items-center justify-center cursor-pointer">
        <i class="fas fa-arrow-up text-white text-sm"></i>
    </button>
    
    <!-- Video Modal -->
    <div id="videoModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90">
        <div class="relative w-full max-w-4xl mx-4">
            <button id="videoModalClose" class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300 transition">
                <i class="fas fa-times"></i>
            </button>
            <div id="videoWrapper" class="relative pb-[56.25%] h-0"></div>
        </div>
    </div>
    
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 z-50 hidden items-center justify-center bg-white/90">
        <div class="w-10 h-10 border-4 border-gray-200 border-t-green-600 rounded-full animate-spin"></div>
    </div>
    
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            apiBaseUrl: '{{ url("/api/public") }}',
            baseUrl: '{{ url("/") }}'
        };
        
        // Scroll to top
        const scrollTop = document.getElementById('scrollTop');
        if (scrollTop) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 500) {
                    scrollTop.classList.remove('hidden');
                    scrollTop.classList.add('flex');
                } else {
                    scrollTop.classList.add('hidden');
                    scrollTop.classList.remove('flex');
                }
            });
            scrollTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
        }
        
        // Video Modal
        const videoModal = document.getElementById('videoModal');
        const videoModalClose = document.getElementById('videoModalClose');
        const videoWrapper = document.getElementById('videoWrapper');
        
        const closeVideoModal = () => {
            if (videoModal) {
                videoModal.classList.add('hidden');
                videoModal.classList.remove('flex');
                if (videoWrapper) videoWrapper.innerHTML = '';
                document.body.style.overflow = '';
            }
        };
        
        if (videoModalClose) videoModalClose.addEventListener('click', closeVideoModal);
        if (videoModal) videoModal.addEventListener('click', (e) => { if (e.target === videoModal) closeVideoModal(); });
        
        window.openVideoModal = (url, platform, videoId) => {
            if (!videoModal || !videoWrapper) return;
            let videoHtml = '';
            if (platform === 'youtube' && videoId) {
                videoHtml = `<iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>`;
            } else if (platform === 'vimeo' && videoId) {
                videoHtml = `<iframe class="absolute top-0 left-0 w-full h-full" src="https://player.vimeo.com/video/${videoId}?autoplay=1" frameborder="0" allowfullscreen></iframe>`;
            } else if (url) {
                videoHtml = `<video class="absolute top-0 left-0 w-full h-full" src="${url}" controls autoplay></video>`;
            } else {
                videoHtml = `<div class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-white"><i class="fas fa-video-slash text-4xl"></i><p class="ml-2">Video tidak tersedia</p></div>`;
            }
            videoWrapper.innerHTML = videoHtml;
            videoModal.classList.remove('hidden');
            videoModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        };
        
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeVideoModal(); });
    </script>
    
    @stack('scripts')
</body>
</html>