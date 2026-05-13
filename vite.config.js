import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(),
    ],
    build: {
        outDir: "public/dist",
        emptyOutDir: true,
        manifest: true,
        rollupOptions: {
            input: {
                main: "resources/js/main.js",
                admin: "resources/js/admin.js",
            },
        },
    },
    server: {
        origin: "http://localhost:5173",
        strictPort: true,
    },
});
