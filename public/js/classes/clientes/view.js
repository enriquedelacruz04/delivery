"use strict";

import Clientes from "./Clientes.js";
import Urls from "../Urls.js";
import UI from "../UI.js";

//========================= Objetos de la clase
let urls = new Urls();
let ui = new UI();
let urlsClientes = urls.clientes;
let clientes = new Clientes(urlsClientes);

//========================= Html
let tableHTML = urls.clientes.table;
let formHtml = urls.clientes.form;

export function loadClientes() {
    let promise = clientes.getData();
    promise
        .then((data) => {
            return data;
        })
        .then((data) => {
            loadData(data);
        })
        .catch((error) => console.log(error));
}

function loadData(dataTable) {
    let html = "";

    let promise = ui.loadTable(tableHTML);
    promise
        .then(() => {
            let tbody = document.querySelector(".table tbody");

            if (dataTable.data) {
                dataTable.data.forEach((item) => {
                    html += loadDataRows(item);
                });
                tbody.innerHTML = html;
            } else {
                tbody.innerHTML = "Sin datos";
            }

            buttonDelete();
            buttonNew();
            buttonEdit();
        })
        .catch((error) => console.log(error));
}

function loadDataRows(data) {
    let { id, nombre, direccion, telefono } = data;

    let html = `
    <tr>
        <th scope="row">${id}</th>
        <td>${nombre}</td>
        <td class="table-acciones" >
            <button data-id="${id}" type="button" class="btn btn-primary"><i class="fas fa-eye"></i></button>
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
                let promise = clientes.delete(id);
                promise
                    .then(() => {
                        loadClientes();
                    })
                    .catch((error) => console.log(error));
            }
        });
    });
}

function buttonNew() {
    document.querySelector(".btn-new").addEventListener("click", function () {
        let id = this.dataset.id;
        let promise = ui.loadForm(formHtml);
        promise
            .then(() => {
                edit(id);
            })
            .catch((error) => console.log(error));
    });
}

function buttonEdit() {
    document.querySelectorAll(".btn-primary").forEach(function (item) {
        item.addEventListener("click", function () {
            let id = this.dataset.id;
            let promise = ui.loadForm(formHtml);
            promise
                .then(() => {
                    edit(id);
                })
                .catch((error) => console.log(error));
        });
    });
}

//===========================================================
// Edit
//===========================================================

function edit(id) {
    //========================= Si esta editando o creando
    let editar = id !== "0" ? true : false;

    //========================= Form
    let form = document.querySelector("#form-clientes");

    if (editar) {
        let promise = clientes.getOne(id);
        promise
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
            let promise = clientes.setOne(form);
            promise
                .then(() => {
                    loadClientes();
                })
                .catch((error) => console.log(error));
        }
    });
}
