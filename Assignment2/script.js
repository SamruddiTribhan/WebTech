let currentSlide = 0;
const slides = document.querySelector('.slides');
const totalSlides = document.querySelectorAll('.slide').length;

function changeSlide() {
    currentSlide++;
    if (currentSlide >= totalSlides) {
        currentSlide = 0;
    }
    slides.style.transform = 'translateX(' + (-currentSlide * 100) + '%)';
}

// Automatically change slide every 3 seconds
setInterval(changeSlide, 3000);
