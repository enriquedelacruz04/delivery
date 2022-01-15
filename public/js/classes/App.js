"use strict";

import "./home/view.js";

import Routes from "./Routes.js";

let routes = new Routes();

class App {
    constructor() {
        loadApp();
    }
}
export default App;

//============================================

async function loadApp() {
    loadMenu();
    loadSidebarAnimate();
    routes.get(routes.paths.home.path);
}

function loadMenu() {
    document.querySelector(".nav-pills .nav-item--home").addEventListener("click", async function () {
        routes.get(routes.paths.home.path);
    });

    document.querySelector(".nav-pills .nav-item--clientes").addEventListener("click", function () {
        routes.get(routes.paths.clientes.path);
    });

    document.querySelector(".nav-pills .nav-item--rutas").addEventListener("click", function () {
        routes.get(routes.paths.rutas.path);
    });

    document.querySelector(".nav-pills .nav-item--repartidores").addEventListener("click", function () {
        routes.get(routes.paths.repartidores.path);
    });

    document.querySelector(".nav-pills .nav-item--colonias").addEventListener("click", function () {
        routes.get(routes.paths.colonias.path);
    });

    document.querySelector(".nav-pills .nav-item--platillos").addEventListener("click", function () {
        routes.get(routes.paths.platillos.path);
    });

    document.querySelector(".nav-pills .nav-item--pedidos-platillos").addEventListener("click", function () {
        routes.get(routes.paths.pedidosPlatillos.path);
    });
}

function loadSidebarAnimate() {
    document.querySelectorAll(".nav-pills a").forEach((element) => {
        element.addEventListener("click", function () {
            document.querySelectorAll(".nav-pills a").forEach((element) => {
                element.classList.remove("active");
            });
            this.classList.add("active");
        });
    });
}
