import "./bootstrap";
import Alpine from "alpinejs";

// Pasang Alpine ke window jika belum ada
if (!window.Alpine) {
    window.Alpine = Alpine;
}

// Guard kecil agar `Alpine.start()` tidak dipanggil lebih dari sekali
if (!window._alpineStarted) {
    Alpine.start();
    window._alpineStarted = true;
}
