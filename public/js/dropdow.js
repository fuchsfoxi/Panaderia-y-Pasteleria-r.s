document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.sidebar li').forEach(li => {
        const subMenu = li.querySelector('.sub-menu');
        if (!subMenu) return;

        let timer;

        li.addEventListener('mouseenter', function () {
            clearTimeout(timer);
            li.classList.add('open');
        });

        li.addEventListener('mouseleave', function () {
            timer = setTimeout(() => {
                li.classList.remove('open');
            }, 150);
        });

        subMenu.addEventListener('mouseenter', function () {
            clearTimeout(timer);
        });

        subMenu.addEventListener('mouseleave', function () {
            timer = setTimeout(() => {
                li.classList.remove('open');
            }, 150);
        });
    });
}); 