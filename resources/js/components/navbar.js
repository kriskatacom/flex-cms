export default () => ({
    darkMode: localStorage.getItem("dark-mode") === "true",
    profileOpen: false,

    init() {
        this.applyTheme();
    },

    toggleTheme() {
        this.darkMode = !this.darkMode;
        localStorage.setItem("dark-mode", this.darkMode);
        this.applyTheme();
    },

    applyTheme() {
        if (this.darkMode) document.documentElement.classList.add("dark");
        else document.documentElement.classList.remove("dark");
    },
});
