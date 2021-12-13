"use strict";



class Urls {
    // #server = "https://deliveryadminapp.000webhostapp.com/apis/";
    // #serverHtml = "https://deliveryadminapp.000webhostapp.com/pages/";
    #server = "http://localhost:3000/delivery/apis/";
    #serverHtml = "http://localhost:3000/delivery/public/pages/";

    divApp = document.querySelector("#app");
    delete = this.#server + "includes/eliminar.php";

    clientes = {
        getAll: this.#server + "clientes/getAll.php",
        getOne: this.#server + "clientes/getOne.php",
        setOne: this.#server + "clientes/setOne.php",
        table: this.#serverHtml + "clientes/table.html",
        form: this.#serverHtml + "clientes/form.html",
    };

    rutas = {
        getAll: this.#server + "rutas/getAll.php",
        getOne: this.#server + "rutas/getOne.php",
        setOne: this.#server + "rutas/setOne.php",
        table: this.#serverHtml + "rutas/table.html",
        form: this.#serverHtml + "rutas/form.html",
    };

    repartidores = {
        getAll: this.#server + "repartidores/getAll.php",
        getOne: this.#server + "repartidores/getOne.php",
        setOne: this.#server + "repartidores/setOne.php",
        table: this.#serverHtml + "repartidores/table.html",
        form: this.#serverHtml + "repartidores/form.html",
    };

    colonias = {
        getAll: this.#server + "colonias/getAll.php",
        getOne: this.#server + "colonias/getOne.php",
        setOne: this.#server + "colonias/setOne.php",
        table: this.#serverHtml + "colonias/table.html",
        form: this.#serverHtml + "colonias/form.html",
    };

    platillos = {
        getAll: this.#server + "platillos/getAll.php",
        getOne: this.#server + "platillos/getOne.php",
        setOne: this.#server + "platillos/setOne.php",
        table: this.#serverHtml + "platillos/table.html",
        form: this.#serverHtml + "platillos/form.html",
    };

    pedidos = {
        getAll: this.#server + "pedidos/getAll.php",
        getOne: this.#server + "pedidos/getOne.php",
        setOne: this.#server + "pedidos/setOne.php",
        table: this.#serverHtml + "pedidos/table.html",
        form: this.#serverHtml + "pedidos/form.html",
    };

    pedidosPlatillos = {
        getAll: this.#server + "pedidosPlatillos/getAll.php",
        getOne: this.#server + "pedidosPlatillos/getOne.php",
        setOne: this.#server + "pedidosPlatillos/setOne.php",
        table: this.#serverHtml + "pedidosPlatillos/table.html",
        form: this.#serverHtml + "pedidosPlatillos/form.html",
    };

    home = {
        dashboard: this.#serverHtml + "home/dashboard.html",
    };
}

export default Urls;
