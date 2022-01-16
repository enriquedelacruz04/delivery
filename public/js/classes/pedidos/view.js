"use strict";

import Urls from "../Urls.js";
import Routes from "../Routes.js";
let routes;
console.log("pedidos");

import Pedidos from "./Pedidos.js";
import UI from "../UI.js";

//========================= Objetos de la clase
let urls = new Urls();
let ui = new UI();
let urlsPedidos = urls.pedidos;
let pedidos = new Pedidos(urlsPedidos);

//========================= Html
let tableHTML = urls.pedidos.table;
let formHtml = urls.pedidos.form;

export function loadPedidos() {
    routes = new Routes();

    console.log("fn pedidos");
    let html = "";

    //========================= Cargamos la tabla y los datos de la tabla
    Promise.all([ui.loadTable(tableHTML), pedidos.getData()])
        .then((response) => {
            let dataJSON = response[1];
            let tbody = document.querySelector(".table tbody");

            if (dataJSON.data) {
                dataJSON.data.forEach((item) => {
                    html += loadDataRows(item);
                });
                tbody.innerHTML = html;
            } else {
                tbody.innerHTML = "Sin datos";
            }

            //========================= Cargamos los botones
            buttonDelete();
            buttonNew();
            buttonEdit();
            buttonPlatillos();
        })
        .catch((error) => console.log(error));
}

function loadDataRows(data) {
    let { id, fecha, hora, importe } = data;

    let html = `
    <tr>
        <th scope="row">${id}</th>
        <td>${fecha}</td>
        <td>${hora}</td>
        <td>${importe}</td>
        <td class="table-acciones" >
            <button data-id="${id}" type="button" class="btn btn-primary btn-edit"><i class="fas fa-eye"></i></button>
            <button data-id="${id}" type="button" class="btn btn-primary btn-platillos"><i class="fas fa-edit"></i></button>
            <button data-id="${id}"type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    `;

    return html;
}

//===========================================================
// Botones
//===========================================================

function buttonDelete() {
    document.querySelectorAll(".btn-danger").forEach(function (item) {
        item.addEventListener("click", function () {
            let id = this.dataset.id;

            if (confirm("Desea eliminar este registro")) {
                let promise = pedidos.delete(id);
                promise
                    .then(() => {
                        loadPedidos();
                    })
                    .catch((error) => console.log(error));
            }
        });
    });
}

function buttonNew() {
    document.querySelector(".btn-new").addEventListener("click", function () {
        let id = this.dataset.id;
        loadEdit(id);
    });
}

function buttonEdit() {
    document.querySelectorAll(".btn-edit").forEach(function (item) {
        item.addEventListener("click", function () {
            let id = this.dataset.id;
            loadEdit(id);
        });
    });
}

function buttonPlatillos() {
    document.querySelectorAll(".btn-platillos").forEach(function (item) {
        item.addEventListener("click", function () {
            let id = this.dataset.id;
            console.log("agregando platillos al pedido");
            routes.go(routes.paths.clientes.path + id, loadPedidosPlatillos);
        });
    });
}

//===========================================================
// Edit
//===========================================================

function loadEdit(id) {
    //========================= Cargamos el formulario
    let promise = ui.loadForm(formHtml);
    promise
        .then(() => {
            edit(id);
        })
        .catch((error) => console.log(error));
}

function edit(id) {
    //========================= Si esta editando o creando
    let editar = id !== "0" ? true : false;

    //========================= Form
    let form = document.querySelector("#form-pedidos");

    //========================= Cargamos todos los select si los hay
    let promiseSelect1 = ui.loadSelect(urls.repartidores.getAll, "idRepartidores");
    let promiseSelect2 = ui.loadSelect(urls.clientes.getAll, "idClientes");

    //========================= Si esta editando cargamos la info de la DB
    if (editar) {
        Promise.all([promiseSelect1, promiseSelect2])
            .then(() => {
                return pedidos.getOne(id);
            })
            .then((data) => {
                ui.loadFormData(form, data.data);
            })
            .catch((error) => console.log(error));
    }

    //========================= Input bandera editar o crear
    document.querySelector("#edit").value = id;

    //========================= Accion al guardar form
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        let texto = editar ? "Desea actualizar este registro" : "Desea guardar este registro";

        if (confirm(texto)) {
            let promise = pedidos.setOne(form);
            promise
                .then(() => {
                    loadPedidos();
                })
                .catch((error) => console.log(error));
        }
    });
}
