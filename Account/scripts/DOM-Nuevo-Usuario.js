let parametros;

const main = new Main();
const ui = new UI()

const getDivisiones = function (divisiones) {
    ui.opcionesSelect('#academica', divisiones, 'División Académica ');
};

const usuarioDocente = (nombre, apellidos) => {

    const inicial = nombre.charAt(0);
    const apellido = apellidos.split(' ');
    return (inicial + '.' + apellido[0]).toLowerCase();
}

const mostrarInformacion = (parametros) =>{

    if(parametros['usuario']){
        $.ajax({
            url: '../../../php/Servicios/consultarUsuario.php', type: 'POST', 
            data: {usuario: parametros['usuario'], tipo: parametros['t']},
            success: function (resp){
                const info = JSON.parse(resp);
                
                $('input[name="usuario"').prop('disabled', true);
                $(`#${info.data[0].tipo}`).prop('checked', true);
                $('#nombre').val(info.data[0].nombre);
                $('#apellidos').val(info.data[0].apellidos);
                $('#usuario').val(info.data[0].usuario);
                $('#academica').empty().append($('<option/>', {html : info.data[0].academica}));

                info.data[0].hasOwnProperty('carrera') 
                        ? (function(){
                            $('#carrera').empty().append($('<option/>', {html : info.data[0].carrera}));
                            $('.asignar-tutor').show();
                            $('#tutor').val(info.data[0].tutor);
                            })()
                        : $('#carrera').hide();

                $('#correo').val(info.data[0].correo);
                $('#contrasena').prop('type', 'password');
                $('#contrasena').val(info.data[0].contrasena);

                $('#guardar').hide();
            }
        })
    }else{
        main.consultarDivisiones(getDivisiones);
    }
}

// EVENTOS DEL DOCUMENTO
$('input[name="usuario"]').change(function (e) {
    switch ($(this).prop('id')) {
        case 'alumno':
            $('#carrera').show();
            $('.asignar-tutor').css('display', 'block');
            break;
        case 'docente':
            $('#carrera').hide();
            $('.asignar-tutor').css('display', 'none');
            break;
    }
});
$('#nombre, #apellidos, #usuario').change(function(){
    $(this).val($(this).val().toUpperCase());
});

$('#usuario').change(function (e) {
    const rol = $('input[name="usuario"]:checked').prop('id');

    const usuario = rol == 'alumno' ?
        $(this).val() :
        usuarioDocente($('#nombre').val(), $('#apellidos').val());

    $('#correo').val(usuario + '@' + rol + '.ujat.mx');
});

$('#guardar').click(function (e) {
    $('html, body').animate({ scrollTop: 0 }, 300);
    const rol = $('input[name="usuario"]:checked').val();
    const informacion = {
        rol: rol,
        nombre: $('#nombre').val(),
        apellidos: $('#apellidos').val(),
        usuario: $('#usuario').val(),
        division: $('#academica option:selected').val(),
        correo: $('#correo').val(),
        password: $('#contrasena').val()
    };

    if (rol == 'alumno') {
        informacion['carrera'] = $('#carrera option:selected').val()
        informacion['tutor'] = $('#tutor').attr('data-tutor');
    }
    console.table(informacion);
    for (const dato in informacion) {
        if (informacion[dato] == null || informacion[dato] == 0) {
            ui.mostrarAlerta('Todos los campos son requeridos', '#ef9a9a', '#f44336');
            return 0;
        }
    }

    $.ajax({
        url: '../../../php/Servicios/setUsuario.php', type: 'POST', data: informacion,
        success: function (resp) {
            console.log(resp);
            switch (resp) {
                case 'duplicado':
                    ui.mostrarAlerta('La información ya se encuentra registrada', '#ef9a9a', '#f44336');
                    break;
                case 'error':
                    ui.mostrarAlerta('Error al guardar la información', '#ef9a9a', '#f44336');
                    break;
                case 'ok':
                    ui.mostrarAlerta('Informacion guardada correctamente', '#a5d6a7', '#4caf50');
                    setTimeout(function () { location.href = './index.php' }, 3000);
                    break;
            }
        }
    })
});

$('#academica').change(function () {
    let division = $('#academica option:selected').val();
    if (division != 0) {
        const mostrarCarreras = function (resp) {
            ui.opcionesSelect('#carrera', resp, '');
            ($('input[name="usuario"]:checked').val() == 'alumno') ? $('#carrera').show() : $('#carrera').hide();
        }
        main.consultarCarrera(division, mostrarCarreras);
    }
});

$('#tutor').change(function (e) {
    const numEmpleado = $(this).val();
    const informacion = function (resp) {
        if (resp.data.length) {
            $('#tutor').attr('data-tutor', resp.data[0].usuario);
            $('.asignar-tutor > p').html('Tutor asignado: ' + resp.data[0].nombre + ' ' + resp.data[0].apellidos);
        } else {
            $('#tutor').removeAttr('data-tutor');
            $('.asignar-tutor > p').text('Número de empleado invalido');
        }

    }
    if ($(this).val())
        main.ajaxBuscar(numEmpleado, 'docentes', 'Usuarios', informacion);
});

// FUNCIONES PARA INICIAR EL DOCUMENTO
mostrarInformacion(main.parametros(document.location.href));
