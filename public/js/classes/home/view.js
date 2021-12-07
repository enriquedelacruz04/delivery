"use strict";

import Urls from "../Urls.js";

//========================= Objetos de la clase
let urls = new Urls();

//========================= Html del dashboard
let dashboard = urls.home.dashboard;

//========================= Div donde ira el contenido
let divApp = urls.divApp;

export function loadHome() {
    return new Promise(function (resolve) {
        fetch(dashboard)
            .then((response) => {
                return response.text();
            })
            .then((data) => {
                limpiarHTML();
                let div = document.createElement("div");
                div.innerHTML = data;
                divApp.appendChild(div);
                resolve("ok");
            })
            .catch(function (error) {
                console.log(error);
            });
    });
}

function limpiarHTML() {
    while (divApp.firstChild) {
        divApp.removeChild(divApp.firstChild);
    }
}
