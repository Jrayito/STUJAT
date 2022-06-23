const ui = new UI();
const main = new Main();

$('#iniciar-sesion').click(function () {

    const usuario = $('#form-login input[type="text"]').val();
    const contrasena = $('#form-login input[type="password"]').val();
    const type = $('#form-login input[name="usuario"]:checked').val();

    if (usuario != null && contrasena != null && type != null) {
        const resp = function (resp) {
            switch (resp) {
                case 'admin':
                    location.href = "../../Account/Usuarios/Administrador/";
                    break;
                case 'docente':
                    location.href = "../../Account/Usuarios/Docente/";
                    break;
                case 'alumno':
                    location.href = "../../Account/Usuarios/Alumno/";
                    break;
                default:
                    ui.mostrarAlerta('Error de usuario y/o contrasena', '#ef9a9a', '#f44336')
                    break;
            }
        };

        main.validarUsuario(usuario, contrasena, type, resp);
    } else {
        ui.mostrarAlerta('Es necesario llenar todos los campos', '#ef9a9a', '#f44336');
    }

})