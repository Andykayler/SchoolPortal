document.addEventListener('DOMContentLoaded', function() {
    const heroContent = document.querySelector('.hero-content');

    let carousel = document.querySelector('#heroCarousel');
    carousel.addEventListener('slid.bs.carousel', function (e) {
        if (e.relatedTarget === document.querySelector('.carousel-item.active')) {
            heroContent.style.animation = 'fadeIn 2s';
        } else {
            heroContent.style.animation = '';
        }
    });
});
document.getElementById('readMoreBtn').addEventListener('click', function () {
    const universityInfo = document.getElementById('universityInfo');
    const btn = document.getElementById('readMoreBtn');

    
    if (universityInfo.style.display === "none" || universityInfo.style.display === "") {
        universityInfo.style.display = "block"; 
        btn.textContent = "Show Less"; 
    } else {
        universityInfo.style.display = "none"; 
        btn.textContent = "Read More"; 
    }
});


