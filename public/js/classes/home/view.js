"use strict";

import Urls from "../Urls.js";
import Routes from "../Routes.js";

//========================= Objetos de la clase
let urls = new Urls();
let routes;

//========================= Html del dashboard
let dashboard = urls.home.dashboard;

//========================= Div donde ira el contenido
let divApp = urls.divApp;

export async function loadHome() {
    routes = new Routes();
    try {
        let response = await fetch(dashboard);
        let data = await response.text();
        limpiarHTML();
        let div = document.createElement("div");
        div.innerHTML = data;
        divApp.appendChild(div);
        loadMenuCards();
    } catch (error) {
        console.log(error);
    }
}

function loadMenuCards() {
    //=========================
    document.querySelector(".card--clientes").addEventListener("click", function () {
        routes.go(routes.paths.clientes.path);
    });

    document.querySelector(".card--repartidores").addEventListener("click", function () {
        routes.go(routes.paths.repartidores.path);
    });

    document.querySelector(".card--pedidos").addEventListener("click", function () {
        routes.go(routes.paths.pedidos.path);
    });
}

function limpiarHTML() {
    while (divApp.firstChild) {
        divApp.removeChild(divApp.firstChild);
    }
}
