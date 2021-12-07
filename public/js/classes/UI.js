import Urls from "./Urls.js";

class UI {
    //========================= Objetos de la clase
    urls = new Urls();

    //========================= Div donde ira el contenido
    divApp = this.urls.divApp;

    loadTable(dataUrl) {
        return new Promise((resolve, reject) => {
            fetch(dataUrl)
                .then((response) => {
                    return response.text();
                })
                .then((data) => {
                    this.limpiarHTML();
                    let div = document.createElement("div");
                    div.innerHTML = data;
                    this.divApp.appendChild(div);
                    resolve(true);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    }

    loadForm(dataUrl) {
        return new Promise((resolve, reject) => {
            fetch(dataUrl)
                .then((response) => {
                    return response.text();
                })
                .then((data) => {
                    this.limpiarHTML();
                    let div = document.createElement("div");
                    div.innerHTML = data;
                    this.divApp.appendChild(div);
                    resolve(true);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    }

    loadSelect(dataUrl, id, value = "") {
        return new Promise((resolve, reject) => {
            fetch(dataUrl)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    let select = document.querySelector("#" + id);
                    this.loadOptions(data.data, select, value);
                    resolve(true);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    }

    loadOptions(data, select, value) {
        if (value == "") {
            data.forEach((element) => {
                let option = document.createElement("option");
                option.value = element.id;
                option.text = element.nombre;
                select.appendChild(option);
            });
        } else {
            data.forEach((element) => {
                let option = document.createElement("option");
                option.value = element.id;
                option.text = element.id;
                select.appendChild(option);
            });
        }
    }

    loadFormData(form, data) {
        //========================= Obtenemos array de los datos
        let arrayData = Object.values(data);

        //========================= Iteramos el form
        for (let index = 0; index < form.length; index++) {
            let elementForm = form[index];
            let valueData = arrayData[index + 1];

            //========================= Asignamos el dato en el value de cada input
            if (elementForm.tagName == "INPUT" && elementForm.type !== "hidden") {
                elementForm.value = valueData;
            }

            //========================= Asignamos el option seleccionado
            if (elementForm.tagName == "SELECT") {
                for (let index = 0; index < elementForm.length; index++) {
                    var elementOption = elementForm[index];

                    if (elementOption.value == valueData) {
                        elementOption.selected = true;
                    }
                }
            }
        }
    }

    limpiarHTML() {
        while (this.divApp.firstChild) {
            this.divApp.removeChild(this.divApp.firstChild);
        }
    }
}

export default UI;
