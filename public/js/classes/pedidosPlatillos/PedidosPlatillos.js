"use strict";

import Urls from "../Urls.js";
import TablesDB from "../TablesDB.js";

let urls = new Urls();

class PedidosPlatillos extends TablesDB {
    constructor(objUrls) {
        super(objUrls);
        this.objUrls = objUrls;
    }

    delete(id) {
        return new Promise((resolve, reject) => {
            console.log("Eliminando el  id: " + id);

            //========================= Preparamos los datos a enviar
            let datos = new FormData();
            datos.append("id", id);
            datos.append("idTabla", "idPedidosPlatillos");
            datos.append("tabla", "pedidosPlatillos");

            const dataUrl = urls.delete;

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
                        reject("Error al eliminar el registro");
                    }
                })
                .catch((error) => {
                    reject(error);
                });
        });
    }
}

export default PedidosPlatillos;
