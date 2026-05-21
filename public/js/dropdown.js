document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.sidebar > ul > li.dropdown').forEach(li => {
        const subMenu = li.querySelector('.sub-menu');
        if (!subMenu) return;

        let timer;

        const openMenu = () => {
            clearTimeout(timer);
            li.classList.add('open');
        };

        const closeMenu = () => {
            timer = setTimeout(() => li.classList.remove('open'), 150);
        };

        li.addEventListener('mouseenter', openMenu);
        li.addEventListener('mouseleave', closeMenu);
        subMenu.addEventListener('mouseenter', openMenu);
        subMenu.addEventListener('mouseleave', closeMenu);
    });
    console.log('✅ dropdown.js cargado');
console.log('li.dropdown encontrados:', document.querySelectorAll('.sidebar > ul > li.dropdown').length);


// Toggle sidebar
const hamburger = document.querySelector('.hamburger');
const sidebar   = document.querySelector('.sidebar');
const overlay   = document.querySelector('.overlay');

if (hamburger) hamburger.addEventListener('click', () => {
    sidebar.classList.add('open');
    overlay.classList.add('show');
});

if (overlay) overlay.addEventListener('click', () => {
    sidebar.classList.remove('open');
    overlay.classList.remove('show');
});
});