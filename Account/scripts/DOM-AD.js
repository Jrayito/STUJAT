let opcion = $('.active'), buscador, iniciar = 0;

const usuarios = {
    data: [{ id: 'docentes', nombre: 'Docente' }, { id: 'alumnos', nombre: 'Alumno' }]
}

let divisiones = [];

const tablaUsuarios = ['Nombre(s)', 'Apellidos', 'Correo', 'División Academica'];
const tablaCarreras = ['Carrera', 'Division Academica', 'Crédidos'];
const tablaAsignaturas = ['Clave', 'Nombre', 'Carrera', 'Tipo', 'Créditos'];

const ui = new UI();
const main = new Main();

const loadApp = () => {
    $('main div').hide();
    $('main h3').text('BIENVENIDO');
}

const getDivisiones = function (div) {
    ui.opcionesSelect('#academica', div, 'División Académica');
}

const buscar = (nombre, type) => {
    if (nombre.length > 0) {
        switch (buscador) {
            case '#usuarios':
                if (type != 0) {
                    const buscarUsuario = function (resp) {
                        if (resp.data.length != 0)
                            ui.pintarTablaUsuarios(resp);
                        else
                            ui.mostrarAlerta('No hay resultado de la siguiente busqueda "'+nombre+'"', '#ef9a9a', '#f44336');
                    }
                    main.ajaxBuscar(nombre, type, 'Usuarios', buscarUsuario);
                }
                break;
            case '#carreras':
                const buscarCarrera = function (resp) {
                    if (resp.data.length != 0)
                        ui.pintarTablaCarreras(resp);
                    else
                        ui.mostrarAlerta('No hay resultado de la siguiente busqueda "'+nombre+'"', '#ef9a9a', '#f44336');
                }
                main.ajaxBuscar(nombre, type, 'Carreras', buscarCarrera);
                break;
            case '#asignaturas':
                const buscarAsignatura = function (resp) {
                    if (resp.data.length != 0)
                        ui.pintarTablaAsignaturas(resp);
                    else
                        ui.mostrarAlerta('No hay resultado de la siguiente busqueda "'+nombre+'"', '#ef9a9a', '#f44336');
                }
                main.ajaxBuscar(nombre, type, 'Asignaturas', buscarAsignatura);
                break;
        }
    }
}

// ******************************   FUNCIONES DEL DOM

// Cambiar la seleccion del servicio 
$('.servicios ul li').click(function (event) {
    event.preventDefault();

    opcion.removeClass('active');
    opcion = $(this).addClass('active');

    buscador = opcion.children().attr('href');

    if (!iniciar) {
        $('main div').show();
        $('.form-nueva-carrera').hide();
        iniciar = 1;
    }
    // Se resetea el cuerpo de la tabla por si hay resultaddos
    $('.tabla-buscador table thead').html('');
    $('.tabla-buscador table tbody').html('<tr><tr/>');

    switch (buscador) {
        case '#inicio':
            loadApp();
            iniciar = 0;
            break;
        case '#usuarios':
            ui.cambiarOpcion('.buscador select', usuarios, 'Usuario', './nuevoUsuario.php', '');
            if(screen.width > 576){
                ui.cambiarTabla('.tabla-buscador', tablaUsuarios);
            }
            break;
        case '#carreras':
            ui.cambiarOpcion('.buscador select', divisiones, 'Carrera', './nuevaCarrera.php', 'División Academica ');
            // $('.opciones a').attr('id', 'form-carrera');
            if(screen.width > 576){
                ui.cambiarTabla('.tabla-buscador', tablaCarreras);
            }
            break;
        case '#asignaturas':
            ui.cambiarOpcion('.buscador select', [], 'Asignatura', './nuevaAsignatura.php?up=0', '');
            if(screen.width > 576){
                ui.cambiarTabla('.tabla-buscador', tablaAsignaturas);
            }
            
            break;
    }

    $('#check-menu').prop('checked', false);
    $('#check-menu').change();
});

$('.tabla-buscador table').click(function (e) {
    if ($(e.target) && e.target.tagName === 'TD') {
        let id = $(e.target).parent().attr('data-id');
        switch (buscador) {
            case '#usuarios':
                const type = $('.buscador select').val() == 'docentes' ? 0 : 1;
                location.href = './nuevoUsuario.php?usuario=' + id+'&t='+type;
                break;
            case '#carreras':
                location.href = './carrera.php?carrera=' + id;
                break;
            case '#asignaturas':
                location.href = './nuevaAsignatura.php?asignatura=' + id;
                break;
        }
    }
});


$('.buscador input').change(function () {
    buscar($(this).val(), $('.buscador select').val());
});

$('.buscador select').change(function () {
    if (buscador == '#usuarios')
        buscar($('.buscador input').val(), $(this).val());
    else
        buscar($(this).val());
});


// FUNCIOONES PARA CARGAR EL DOCUMENTO
loadApp();
main.consultarDivisiones(getDivisiones);
