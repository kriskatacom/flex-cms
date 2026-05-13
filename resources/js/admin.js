import "../css/app.css";
import Alpine from "alpinejs";

import navbar from "./components/navbar.js";

window.Alpine = Alpine;

Alpine.data("navbar", navbar);

Alpine.start();