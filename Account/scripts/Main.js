
class Main {

    constructor() { }

    validarUsuario(usuario, contrasena, tabla, callback) {
        const info = { usuario: usuario, contrasena: contrasena, tabla: tabla };

        $.ajax({
            url: '../../php/Servicios/Validar.php',
            type: 'POST',
            data: info,
            success: function (resp) {
                callback(resp);
            }
        })
    }

    consultarDivisiones(callback) {
        $.ajax({
            url: '../../../php/Servicios/getDivisiones.php', type: 'POST',
            success: function (resp) { callback(JSON.parse(resp)); }
        });
    }

    consultarCarrera(division, callback) {
        $.ajax({
            url: '../../../php/Servicios/buscarCarreras.php', type: 'POST', data: { nombre: division },
            success: function (resp) { callback(JSON.parse(resp)); }
        });
    }

    parametros(uri) {
        const loc = uri;

        if (loc.indexOf('?') > 0) {
            let getString = loc.split('?')[1];
            let GET = getString.split('&');
            var get = {};
            for (let i = 0, l = GET.length; i < l; i++) {
                var tmp = GET[i].split('=');
                get[tmp[0]] = unescape(decodeURI(tmp[1]));
            }
            return get;
        }
        return 0;
    }

    ajaxBuscar(nombre, type, buscar, callback) {
        $.ajax({
            url: 'http://localhost/proyecto/php/Servicios/buscar' + buscar + '.php',
            type: 'POST',
            data: { nombre: nombre, type: type },
            success: function (resp) {
                callback(JSON.parse(resp));
            }
        })
    }


}