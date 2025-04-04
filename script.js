let menuBar = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');

menuBar.onclick = () => {
    menuBar.classList.toggle("fa-xmark");
    navbar.classList.toggle("active");
}

let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');

window.onscroll = () => {
    sections.forEach(sec => {
        let top = window.scrollY;
        let offset = sec.offsetTop - 150;
        let height = sec.offsetHeight;
        let id = sec.getAttribute('id');

        if (top >= offset && top < offset + height) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                document.querySelector('header nav a[href*="' + id + '"]').classList.add('active');
            });
        }
    });

    let header = document.querySelector('header');
    header.classList.toggle('sticky', window.scrollY > 100);

    menuBar.classList.remove('fa-xmark');
    navbar.classList.remove('active');
}

ScrollReveal({
    distance:'80px',
    duration:2000,
    delay:200
});

ScrollReveal().reveal('.home-items, heading', { origin:'top' });
ScrollReveal().reveal('.home-img, .skill-set ,  .contact form', { origin:'button' });
ScrollReveal().reveal('.home-items h2, .project-box,.about-img', { origin:'left' });
ScrollReveal().reveal('.home-items h3, .about-items', { origin:'right' });


