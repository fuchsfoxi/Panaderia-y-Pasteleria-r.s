// Menú desplegable del sidebar
document.querySelectorAll('.dropdown-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        // El padre es el <li class="dropdown">
        const dropdown = this.closest('.dropdown');
        dropdown.classList.toggle('active');

        // Giramos la flecha
        const flecha = this.querySelector('.flecha');
        if (flecha) {
            flecha.style.transform = dropdown.classList.contains('active') 
                ? 'rotate(180deg)' 
                : 'rotate(0deg)';
            flecha.style.transition = 'transform 0.3s';
        }
    });
});

// Menú hamburguesa (móvil)
const hamburger = document.querySelector('.hamburger');
const overlay   = document.querySelector('.overlay');
const sidebar   = document.querySelector('.sidebar');

if (hamburger) {
    hamburger.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
    });
}

if (overlay) {
    overlay.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    });
}