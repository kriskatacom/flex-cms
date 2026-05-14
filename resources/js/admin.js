import "@fortawesome/fontawesome-free/css/all.min.css";

import "../css/app.css";
import Alpine from "alpinejs";

import sidebar from "./admin/components/sidebar.js";

window.Alpine = Alpine;

Alpine.data("sidebar", sidebar);

Alpine.start();