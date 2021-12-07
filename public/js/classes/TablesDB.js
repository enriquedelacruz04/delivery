"use strict";

import { obtenerDatos } from "../functions.js";

class TablesDB {
    constructor(objUrls) {
        this.objUrls = objUrls;
    }
    getData() {
        return new Promise((resolve, reject) => {
            let dataUrl = this.objUrls.getAll;

            //========================= Consultamos el API
            fetch(dataUrl)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.ok) {
                        resolve(data);
                    } else {
                        reject("Error el consultar la DB");
                    }
                })
                .catch((error) => {
                    reject(error);
                });
        });
    }

    getOne(id) {
        return new Promise((resolve, reject) => {
            let dataUrl = this.objUrls.getOne;

            //========================= Preparamos los datos a enviar
            let datos = new FormData();
            datos.append("id", id);

            //========================= Enviamos los datos al API
            fetch(dataUrl, {
                method: "POST",
                body: datos,
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.ok) {
                        resolve(data);
                    } else {
                        reject("Error el consultar la DB");
                    }
                })
                .catch((error) => {
                    reject(error);
                });
        });
    }

    setOne(form) {
        return new Promise((resolve, reject) => {
            let dataUrl = this.objUrls.setOne;

            //========================= Preparamos los datos a enviar
            let datos = obtenerDatos(form);
            console.log(...datos);

            //========================= Enviamos los datos al API
            fetch(dataUrl, {
                method: "POST",
                body: datos,
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.ok) {
                        resolve(true);
                    } else {
                        reject("Error al insertar registro");
                    }
                })
                .catch((error) => {
                    reject(error);
                });
        });
    }
}

export default TablesDB;
