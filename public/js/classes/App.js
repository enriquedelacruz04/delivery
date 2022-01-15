"use strict";

import { loadClientes } from "./clientes/view.js";
import { loadRutas } from "./rutas/view.js";
import { loadColonias } from "./colonias/view.js";
import { loadRepartidores } from "./repartidores/view.js";
import { loadPlatillos } from "./platillos/view.js";
import { loadPedidos } from "./pedidos/view.js";
import { loadPedidosPlatillos } from "./pedidosPlatillos/view.js";
import { loadHome } from "./home/view.js";

class App {
    constructor() {
        loadApp();
    }
}

export default App;

function loadApp() {
    loadMenu();
    loadSidebarAnimate();

    let promise = loadHome();
    promise.then((data) => {
        loadMenuCards();
    });
}

function loadMenuCards() {
    //=========================
    document.querySelector(".card--clientes").addEventListener("click", function () {
        loadClientes();
    });

    document.querySelector(".card--repartidores").addEventListener("click", function () {
        loadRepartidores();
    });

    document.querySelector(".card--pedidos").addEventListener("click", function () {
        loadPedidos();
    });
}

function loadMenu() {
    document.querySelector(".nav-pills .nav-item--home").addEventListener("click", function () {
        loadHome().then((data) => {
            loadMenuCards();
        });
    });

    document.querySelector(".nav-pills .nav-item--clientes").addEventListener("click", function () {
        loadClientes();
    });

    document.querySelector(".nav-pills .nav-item--rutas").addEventListener("click", function () {
        loadRutas();
    });

    document.querySelector(".nav-pills .nav-item--repartidores").addEventListener("click", function () {
        loadRepartidores();
    });

    document.querySelector(".nav-pills .nav-item--colonias").addEventListener("click", function () {
        loadColonias();
    });

    document.querySelector(".nav-pills .nav-item--platillos").addEventListener("click", function () {
        loadPlatillos();
    });
    document.querySelector(".nav-pills .nav-item--pedidos-platillos").addEventListener("click", function () {
        loadPedidosPlatillos();
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
