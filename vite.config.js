import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";
// import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel(["resources/css/app.css", "resources/js/app.jsx"]),

        react(),
        // vue({
        //     template: {
        //         transformAssetUrls: {
        //             base: null,
        //             includeAbsolute: false,
        //         },
        //     },
        // }),
    ],

    // migrating aliases from webpack.mix.js to vite.config.js
    resolve: {
        alias: {
            "@": "/resources/js",
        },
    },
});
