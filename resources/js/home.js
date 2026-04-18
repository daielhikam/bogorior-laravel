// ============================================================
// HOMEPAGE - Hanya untuk interaksi, data dari server
// ============================================================

class HomePage {
    constructor() {
        this.autoSlideInterval = null;
    }

    init() {
        // Hanya inisialisasi komponen interaktif
        this.initSlider();
        this.initFaqAccordion();
        this.initTestimonialFilter();
        this.initDividerDrag();
        this.initScrollTop();
        
        console.log('✅ Home page initialized');
    }

    initFaqAccordion() {
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const icon = question.querySelector('i');
                const isOpen = answer.classList.contains('block');
                
                document.querySelectorAll('.faq-answer').forEach(a => {
                    a.classList.remove('block');
                    a.classList.add('hidden');
                });
                document.querySelectorAll('.faq-question i').forEach(i => {
                    i.classList.remove('fa-chevron-up');
                    i.classList.add('fa-chevron-down');
                });
                
                if (!isOpen) {
                    answer.classList.remove('hidden');
                    answer.classList.add('block');
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            });
        });
    }

    initTestimonialFilter() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        
        if (filterBtns.length === 0) return;
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('bg-green-600', 'text-white');
                    b.classList.add('bg-gray-200', 'text-gray-700');
                });
                btn.classList.remove('bg-gray-200', 'text-gray-700');
                btn.classList.add('bg-green-600', 'text-white');
                
                const filter = btn.dataset.filter;
                testimonialCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = '';
                    } else if (filter === 'teks' && !card.classList.contains('video-card')) {
                        card.style.display = '';
                    } else if (filter === 'video' && card.classList.contains('video-card')) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    initSlider() {
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.nav-dot');
        const progressBar = document.getElementById('progressBarTop');
        let currentSlide = 0;
        
        if (slides.length === 0) return;
        
        const showSlide = (index) => {
            slides.forEach((slide, i) => {
                slide.classList.toggle('hidden', i !== index);
                slide.classList.toggle('block', i === index);
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle('bg-white', i === index);
                dot.classList.toggle('bg-white/50', i !== index);
            });
            currentSlide = index;
            if (progressBar) {
                progressBar.style.width = `${((index + 1) / slides.length) * 100}%`;
            }
        };
        
        const nextSlide = () => showSlide((currentSlide + 1) % slides.length);
        
        dots.forEach((dot, index) => dot.addEventListener('click', () => showSlide(index)));
        
        const startAutoSlide = () => {
            if (this.autoSlideInterval) clearInterval(this.autoSlideInterval);
            this.autoSlideInterval = setInterval(nextSlide, 5000);
        };
        
        startAutoSlide();
        
        const sliderContainer = document.getElementById('sliderContainer');
        if (sliderContainer) {
            sliderContainer.addEventListener('mouseenter', () => clearInterval(this.autoSlideInterval));
            sliderContainer.addEventListener('mouseleave', startAutoSlide);
        }
    }

    initDividerDrag() {
        const dividerHandle = document.getElementById('dividerHandle');
        if (!dividerHandle) return;
        
        let isDragging = false;
        
        dividerHandle.addEventListener('mousedown', (e) => {
            e.preventDefault();
            isDragging = true;
            dividerHandle.style.cursor = 'grabbing';
        });
        
        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            
            const container = document.getElementById('sliderContainer');
            const rect = container.getBoundingClientRect();
            let x = e.clientX - rect.left;
            x = Math.max(0, Math.min(x, rect.width));
            const percent = (x / rect.width) * 100;
            
            const activeSlide = document.querySelector('.slide:not(.hidden)');
            if (activeSlide) {
                const before = activeSlide.querySelector('.slide-before');
                const after = activeSlide.querySelector('.slide-after');
                if (before) before.style.width = `${percent}%`;
                if (after) after.style.left = `${percent}%`;
            }
        });
        
        document.addEventListener('mouseup', () => {
            isDragging = false;
            dividerHandle.style.cursor = 'grab';
        });
    }

    initScrollTop() {
        const scrollTop = document.getElementById('scrollTop');
        if (!scrollTop) return;
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                scrollTop.classList.remove('hidden');
                scrollTop.classList.add('flex');
            } else {
                scrollTop.classList.add('hidden');
                scrollTop.classList.remove('flex');
            }
        });
        
        scrollTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const homePage = new HomePage();
    homePage.init();
});