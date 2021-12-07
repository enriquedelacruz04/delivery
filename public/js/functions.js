export function obtenerDatos(form) {
    let formulario = form;
    let datos = new FormData();

    for (var elemento of formulario) {
        if (elemento.tagName == "INPUT" || elemento.tagName == "TEXTAREA" || elemento.tagName == "SELECT") {
            datos.append(elemento.name, elemento.value);
        }
    }
    return datos;
}
