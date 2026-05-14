import axios from "axios";

export default (id, initialState, initialStateDarkMode) => ({
    id: id,
    isOpen: initialState,
    darkMode: initialStateDarkMode,

    init() {
        window.addEventListener("toggle-sidebar", (e) => {
            if (!e.detail || !e.detail.id || e.detail.id === this.id) {
                this.toggle();
            }
        });

        window.addEventListener("resize", () => {
            if (window.innerWidth >= 1024 && !this.isOpen) {
                this.isOpen = true;
            }
        });
    },

    toggle() {
        this.isOpen = !this.isOpen;
        this.syncState();
    },

    toggleTheme() {
        this.darkMode = !this.darkMode;

        axios
            .post("/admin/theme-toggle", {
                darkMode: this.darkMode,
            })
            .then((response) => {
                console.log("Server response:", response.data);
            })
            .catch((err) => {
                console.error(
                    "Theme sync error:",
                    err.response ? err.response.data : err.message,
                );
            });
    },

    syncState() {
        axios
            .post("/admin/sidebar-toggle", {
                sidebarId: this.id,
                sidebarOpen: this.isOpen,
            })
            .catch((err) => {
                console.error(
                    "Error toggling sidebar:",
                    err.response ? err.response.data : err.message,
                );
            });
    },

    linkClasses(isActive) {
        const base =
            "flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition-all";
        const active = "bg-primary text-white";
        const inactive = "text-slate-400 hover:bg-primary hover:text-white";
        return `${base} ${isActive ? active : inactive}`;
    },

    logoutClasses() {
        return "w-full flex items-center gap-3 font-semibold px-3 py-2 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition-all group";
    },

    navigateTo(url) {
        if (window.innerWidth < 1024) {
            this.toggle();
            setTimeout(() => (window.location.href = url), 300);
        } else {
            window.location.href = url;
        }
    },
});
