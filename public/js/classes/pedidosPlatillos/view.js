"use strict";

import PedidosPlatillos from "./PedidosPlatillos.js";
import Urls from "../Urls.js";
import UI from "../UI.js";

//========================= Objetos de la clase
let urls = new Urls();
let ui = new UI();
let urlsPedidosPlatillos = urls.pedidosPlatillos;
let pedidosPlatillos = new PedidosPlatillos(urlsPedidosPlatillos);

//========================= Html
let tableHTML = urls.pedidosPlatillos.table;
let formHtml = urls.pedidosPlatillos.form;

export function loadPedidosPlatillos() {
    let html = "";

    //========================= Cargamos la tabla y los datos de la tabla
    Promise.all([ui.loadTable(tableHTML), pedidosPlatillos.getData()])
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
        })
        .catch((error) => console.log(error));
}

function loadDataRows(data) {
    let { id, idPedidos, idPlatillos } = data;

    let html = `
    <tr>
        <th scope="row">${id}</th>
        <td>${idPedidos}</td>
        <td>${idPlatillos}</td>
        <td class="table-acciones" >
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
                let promise = pedidosPlatillos.delete(id);
                promise
                    .then(() => {
                        loadPedidosPlatillos();
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
    document.querySelectorAll(".btn-primary").forEach(function (item) {
        item.addEventListener("click", function () {
            let id = this.dataset.id;
            loadEdit(id);
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
    let form = document.querySelector("#form-pedidosPlatillos");

    //========================= Cargamos todos los select si los hay
    let promiseSelect1 = ui.loadSelect(urls.pedidos.getAll, "idPedidos", "idPedidos");
    let promiseSelect2 = ui.loadSelect(urls.platillos.getAll, "idPlatillos");

    //========================= Si esta editando cargamos la info de la DB
    if (editar) {
        Promise.all([promiseSelect1, promiseSelect2])
            .then(() => {
                return pedidosPlatillos.getOne(id);
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
            let promise = pedidosPlatillos.setOne(form);
            promise
                .then(() => {
                    loadPedidosPlatillos();
                })
                .catch((error) => console.log(error));
        }
    });
}
