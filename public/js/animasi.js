const cairan = document.getElementById('cairan');
const kurangiGerak = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// Tampilkan cairan menutupi layar, lalu jalankan perpindahan halaman
function pindahHalaman(lanjut) {
    if (kurangiGerak) {
        lanjut();
        return;
    }

    cairan.classList.add('masuk');
    setTimeout(lanjut, 600);
}

// Semua link memakai transisi cairan
document.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function (event) {
        if (event.ctrlKey || event.metaKey) {
            return;
        }

        event.preventDefault();
        pindahHalaman(function () {
            window.location.href = link.href;
        });
    });
});

// Form login juga memakai transisi cairan
const form = document.querySelector('form');

if (form) {
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        pindahHalaman(function () {
            form.submit();
        });
    });
}

// Kalau pengguna menekan tombol back, cairan dibuka lagi
window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
        cairan.classList.remove('masuk');
    }
});

// Beri class "terlihat" saat elemen masuk ke layar
const pengamat = new IntersectionObserver(function (daftar) {
    daftar.forEach(function (item) {
        if (item.isIntersecting) {
            item.target.classList.add('terlihat');
            pengamat.unobserve(item.target);
        }
    });
}, { threshold: 0.15 });

// Ditunda sebentar supaya dimulai saat cairan mulai terbuka
setTimeout(function () {
    document.querySelectorAll('.muncul, .batang').forEach(function (elemen) {
        pengamat.observe(elemen);
    });
}, 300);
