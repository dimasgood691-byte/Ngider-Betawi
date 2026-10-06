import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Swal from 'sweetalert2';

// Register SweetAlert2 globally window object
window.Swal = Swal;

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Initialize AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 400,
        once: true,
        easing: 'ease-in-out',
    });
});

// resources/js/app.js

window.addEventListener('load', () => {
    const loader = document.getElementById('loading-screen');
    if (loader) {
        loader.classList.add('hidden');
    }
});
