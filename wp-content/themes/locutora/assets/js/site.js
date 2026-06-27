(function () {
    var toggle = document.querySelector('.menu-toggle');
    var nav = document.querySelector('.main-navigation');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var isOpen = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }
})();

(function () {
    var videos = Array.prototype.slice.call(document.querySelectorAll('.vitrine-video'));
    var dots = Array.prototype.slice.call(document.querySelectorAll('.vitrine-dots button'));
    var current = 0;
    var timer;

    if (videos.length < 2 || dots.length !== videos.length) {
        return;
    }

    function show(index) {
        videos[current].classList.remove('is-active');
        dots[current].classList.remove('is-active');
        videos[current].pause();

        current = index;
        videos[current].classList.add('is-active');
        dots[current].classList.add('is-active');
        videos[current].play().catch(function () {});
    }

    function next() {
        show((current + 1) % videos.length);
    }

    dots.forEach(function (dot, index) {
        dot.addEventListener('click', function () {
            window.clearInterval(timer);
            show(index);
            timer = window.setInterval(next, 7000);
        });
    });

    videos[0].play().catch(function () {});
    timer = window.setInterval(next, 7000);
})();
