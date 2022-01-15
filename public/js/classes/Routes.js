import { loadClientes } from "./clientes/view.js";
import { loadRutas } from "./rutas/view.js";
import { loadColonias } from "./colonias/view.js";
import { loadRepartidores } from "./repartidores/view.js";
import { loadPlatillos } from "./platillos/view.js";
import { loadPedidos } from "./pedidos/view.js";
import { loadHome } from "./home/view.js";
import { loadPedidosPlatillos } from "./pedidosPlatillos/view.js";

class Routes {
    paths = {
        pedidos: {
            path: "/pedidos",
            template: loadPedidos,
        },
        clientes: {
            path: "/clientes",
            template: loadClientes,
        },
        repartidores: {
            path: "/repartidores",
            template: loadRepartidores,
        },
        rutas: {
            path: "/rutas",
            template: loadRutas,
        },
        repartidores: {
            path: "/repartidores",
            template: loadRepartidores,
        },
        colonias: {
            path: "/colonias",
            template: loadColonias,
        },
        platillos: {
            path: "/platillos",
            template: loadPlatillos,
        },
        pedidosPlatillos: {
            path: "/pedidosPlatillos",
            template: loadPedidosPlatillos,
        },
        home: {
            path: "/home",
            template: loadHome,
        },
    };

    getPath() {
        let {
            location: { pathname },
        } = window;

        pathname = pathname == "/delivery/public/" ? "/" : pathname;
        return pathname;
    }

    get(path) {
        window.history.pushState({}, "", "/delivery/public" + path);
        console.log(this.getPath());

        if (this.getPath() == "/delivery/public" + path) {
            // console.log(this.paths[path].template);
            path = path.replace("/", "");
            this.paths[path].template();
        }
    }
}

export default Routes;
