export default (id, initialState) => ({
    id: id,
    isOpen: initialState,

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

    syncState() {
        fetch("/admin/sidebar-toggle", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                sidebarId: this.id,
                sidebarOpen: this.isOpen,
            }),
        }).catch((error) => console.error("Error toggling sidebar:", error));
    },

    linkClasses(isActive) {
        const base =
            "flex items-center gap-3 px-3 py-2 rounded-md font-semibold transition-all";
        const active = "bg-primary text-white";
        const inactive = "text-slate-400 hover:bg-primary hover:text-white";

        return `${base} ${isActive ? active : inactive}`;
    },

    navigateTo(url) {
        if (window.innerWidth < 1024) {
            this.toggle();
            setTimeout(() => (window.location.href = url), 300);
        } else {
            window.location.href = url;
        }
    },

    logoutClasses() {
        return "w-full flex items-center gap-3 font-semibold px-3 py-2 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition-all group";
    },
});
