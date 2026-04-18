<!-- Popular Articles -->
@if(isset($popularArticles) && $popularArticles->count() > 0)
<div class="bg-white rounded-xl p-6 mb-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
        <i class="fas fa-fire text-orange-500 mr-2"></i> Paling Populer
    </h3>
    <div class="space-y-3">
        @foreach($popularArticles as $popular)
        <div>
            <a href="{{ route('blog.show', $popular->slug) }}" class="text-gray-700 hover:text-green-600 transition font-medium line-clamp-2">
                {{ $popular->judul_artikel }}
            </a>
            <p class="text-gray-400 text-xs mt-1">{{ $popular->formatted_date }} • {{ number_format($popular->views) }}x dibaca</p>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Categories -->
@if(isset($categories) && $categories->count() > 0)
<div class="bg-white rounded-xl p-6 mb-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
        <i class="fas fa-folder mr-2"></i> Kategori
    </h3>
    <div class="space-y-2">
        @foreach($categories as $cat)
        <a href="{{ route('blog.index', ['category' => $cat->kategori]) }}" class="flex justify-between items-center py-2 hover:bg-gray-50 px-2 rounded-lg transition">
            <span class="text-gray-600">{{ $cat->kategori_label ?? $cat->kategori }}</span>
            <span class="text-gray-400 text-sm">{{ $cat->total }}</span>
        </a>
        @endforeach
    </div>
</div>
@endif

<!-- Newsletter -->
<div class="bg-gradient-to-r from-green-600 to-green-700 rounded-xl p-6 text-white text-center">
    <i class="fas fa-envelope text-3xl mb-3"></i>
    <h3 class="text-lg font-bold mb-2">Newsletter</h3>
    <p class="text-sm opacity-90 mb-4">Dapatkan artikel terbaru langsung ke email Anda</p>
    <form id="sidebarNewsletter" class="flex flex-col gap-2">
        <input type="email" id="sidebarEmail" placeholder="Email Anda" 
               class="px-3 py-2 rounded-lg text-gray-800 focus:outline-none">
        <button type="submit" class="bg-white text-green-600 hover:bg-gray-100 font-semibold px-4 py-2 rounded-lg transition text-sm">
            Berlangganan
        </button>
    </form>
    <p id="sidebarMessage" class="text-xs mt-2 opacity-90"></p>
</div>

<script>
document.getElementById('sidebarNewsletter')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = document.getElementById('sidebarEmail').value;
    const messageEl = document.getElementById('sidebarMessage');
    
    try {
        const response = await fetch('/api/public/subscribe', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content },
            body: JSON.stringify({ email })
        });
        const data = await response.json();
        if (data.success) {
            messageEl.innerHTML = '<i class="fas fa-check-circle"></i> Berhasil!';
            document.getElementById('sidebarEmail').value = '';
        } else {
            messageEl.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + data.message;
        }
    } catch (error) {
        messageEl.innerHTML = '<i class="fas fa-exclamation-circle"></i> Gagal.';
    }
});
</script>