import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import "../css/app.css";
const appName = import.meta.env.VITE_APP_NAME || "Laravel";

// Initialize the Inertia app
createInertiaApp({
    title: (title) => `${title} - ${appName}`,

    // resolve : fungsi memetakan nama halaman ke React Component

    // Vite
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.jsx`,
            // Import semua file yang ada dlm folder Pages
            import.meta.glob("./Pages/**/*.jsx")
        ),

    // setup : fungsi yang dijalankan setelah aplikasi Inertia siap
    /*
        el : elemen HTML tempat aplikasi akan dirender
        App : komponen utama applikasi yg akan dirender
        props : properti yg diteruskan ke komponen utama
    */
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
});
