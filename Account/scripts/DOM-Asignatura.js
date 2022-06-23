const areasFormacion = {
    data: [{ id: 1, nombre: 'General' }, { id: 2, nombre: 'Sustantiva Profesional' }, { id: 3, nombre: 'Integral Profesional' },
    { id: 4, nombre: 'Transversal' }]
}

const optativas = {
    data: [
        { id: 1, nombre: 'Área de Entorno Social' }, { id: 2, nombre: 'Área de matemáticas' }, { id: 3, nombre: 'Área de Redes' },
        { id: 4, nombre: 'Área de Software Base' }, { id: 5, nombre: 'Programación e Ingeniería de Software' }]
}

const ui = new UI();
const main = new Main();

let update = 0;
let asignaturaEspecial = 0;

// ************************** FUNCIONES DE USO
const bloquearFormulario = () => {
    $('.form-nueva-asignatura input').attr('disabled', true);
    $('.form-nueva-asignatura select').attr('disabled', true);
}

const editarInformacion = (resp) => {

    console.log(resp)
    resp.data[0].tipo == 'obligatoria'
        ? $('#obligatoria').attr('checked', 'checked')
        : resp.data[0].tipo == 'optativa'
            ? $('#optativa').attr('checked', 'checked')
            : $('#especial').attr('checked', 'checked')

    $('#clave').val(resp.data[0].clave);
    $('#nombre').val(resp.data[0].nombre);
    $('#teoricas').val(resp.data[0].teoricas);
    $('#practicas').val(resp.data[0].practicas);
    $('#creditos').val(resp.data[0].creditos);
    if (resp.data[0].optativa != 0) { $(`#optativa option[value="${resp.data[0].optativa}"]`).attr('selected', true); }
    $('#carrera').append($('<option/>', { html: resp.data[0].carrera, value: resp.data[0].acro }));
    $(`#carrera option[value="${resp.data[0].acro}"]`).attr('selected', true);
    $(`#areaFormacion option[value="${resp.data[0].areaFormacion}"]`).attr('selected', true);
    $('#ver-pdf').attr('value', resp.data[0].pdf)

    const impartir = resp.data[0].ciclo == 1 ? $('#impartir').attr('checked', 'checked') : 0;
}
const documentOpciones = (uri) => {

    //Ocultar la barra de opciones
    if (uri['up'] == '0') {
        $('.opciones').hide();
    }

    // Agregar los valores al area de formación
    if ($('#areaFormacion').length > 0) {
        ui.opcionesSelect('#areaFormacion', areasFormacion, '');
    }

    // Para editar una asignatura
    if (uri['asignatura']) {
        $.ajax({
            url: '../../../php/Servicios/consultarAsignatura.php', type: 'POST', data: { clave: uri['asignatura'] },
            success: function (resp) {
                const info = JSON.parse(resp);
                console.log(info);
                $('#guardar-asignatura, #file, #subsecuente').hide();
                $('input[type="radio"], input[type="checkbox"]').prop('disabled', true);

                $(`#${info.data[0].asignatura[0].tipo}`).prop('checked', 'checked');
                $('#clave').val(info.data[0].asignatura[0].clave);
                $('#nombre').val(info.data[0].asignatura[0].nombre);
                $('#teoricas').val(info.data[0].asignatura[0].teoricas);
                $('#practicas').val(info.data[0].asignatura[0].practicas);
                $('#creditos').val(info.data[0].asignatura[0].creditos);

                parseInt(info.data[0].asignatura[0].ciclo) == 1
                    ? $('#impartir').prop('checked', 'checked').next().text('Esta asignatura se imparte en ciclo corto')
                    : 0;

                parseInt(info.data[0].asignatura[0].optativa) == 0
                    ? $('#optativas').empty().append($('<option/>', { html: 'Sin optativa' }))
                    : $('#optativas').empty().append($('<option/>', { html: "OP: "+optativas.data[info.data[0].asignatura[0].optativa-1].nombre }));

                $('#carrera').empty().append($('<option/>', { html: info.data[0].carrera[0] }));
                $('#areaConocimiento').empty().append($('<option/>', { html: "AC: " + info.data[0].carrera[1] }));
                $('#academica').empty().append($('<option/>', { html: "División Académica " + info.data[0].carrera[2] }))

                $('#areaFormacion').empty().append($('<option/>', { html: "AF: " + areasFormacion.data[info.data[0].asignatura[0].areaFormacion - 1].nombre }));

                let sms = info.data[0].antecedente.hasOwnProperty('nombre') || info.data[0].subsecuente.hasOwnProperty('nombre')
                    ? (function () {
                        let text = info.data[0].antecedente.hasOwnProperty('nombre')
                            ? '<b>Asignatura antecedente: </b> ' + info.data[0].antecedente.nombre
                            : 'Sin antecedente'
                        text += info.data[0].subsecuente.hasOwnProperty('nombre')
                            ? ' - <b>Asignatura subsecuente: </b> ' + info.data[0].subsecuente.nombre
                            : 'Sin subsecuente'
                        return text;
                    })() : '<b>Asignatura sin seriación</b>'

                $('#asignatura-asignada').html(sms);
            }
        });
    } else {
        main.consultarDivisiones(getDivisiones);
    }
}

const cargarPDF = (file) => {
    let tamanio = file.val();
    $('html, body').animate({ scrollTop: 0 }, 300);
    if (tamanio == 0) {
        ui.mostrarAlerta('No se selecciono un archivo', '#ef9a9a', '#f44336')
        return 0;
    } else {
        if (file[0].files[0].type != 'application/pdf') {
            ui.mostrarAlerta('Archivo seleccionado no valido', '#ef9a9a', '#f44336');
            $('#file').val('');
            return 0;
        } else {
            ui.mostrarAlerta('Archivo se cargo correctamente', '#a5d6a7', '#4caf50')
            return 1;
        }
    }
}

const guardarInformacion = (url, data) => {
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        contentType: false,
        processData: false,
        success: function (resp) {
            $('html, body').animate({ scrollTop: 0 }, 300);
            switch (resp) {
                case 'exist':
                    ui.mostrarAlerta('La asignatura registrada ya existe', '#ef9a9a', '#f44336');
                    break;
                case 'error':
                    ui.mostrarAlerta('Error al guardar la información', '#ef9a9a', '#f44336');
                    break;
                case 'ok':
                    $(this).attr('disabled', 'disabled');
                    ui.mostrarAlerta('Asignatura registrada correctamente', '#a5d6a7', '#4caf50')
                    setTimeout(function () { location.href = './index.php' }, 3500);
                    break;
            }
        }
    });
}

const getDivisiones = function (divisiones) {
    ui.opcionesSelect('#academica', divisiones, 'División Académica ');
};

// ********************** FUNCIONES DEL DOM

$('input[name="tipo-asignatura"]').change(function () {
    switch ($(this).attr('id')) {
        case 'optativa':
            ui.opcionesSelect('#optativas', optativas, '');
            $('#optativas').prop('disabled', false);
            $('#subsecuente').prop('disabled', false);
            $('#file').prop('disabled', false);
            break;
        case 'obligatoria':
            $('#optativas').html($('<option/>', { html: 'Seleccionar', value: 1 }));
            $('#optativas').prop('disabled', true);
            $('#subsecuente').prop('disabled', false);
            $('#file').prop('disabled', false);
            break;
        case 'especial':
            asignaturaEspecial = 1;
            $('#optativas').prop('disabled', true);
            $('#subsecuente').prop('disabled', true);
            $('#file').prop('disabled', true);
            break;
    }
})

let informacionCarreras;
$('#academica').change(function () {
    let division = $('#academica option:selected').val();
    if (division != 0) {
        const mostrarCarreras = function (resp) {
            ui.opcionesSelect('#carrera', resp, '');
            informacionCarreras = resp.data;
        }
        main.consultarCarrera(division, mostrarCarreras);
    }
});

$('#carrera').change(function () {
    informacionCarreras.forEach(element => {
        console.log(element)
        if ($(this).val() == element.id) {
            ui.opcionesSelect('#areaConocimiento', element.json, '');
        }
    });
});

$('#subsecuente').change(function () {
    let clave = $(this).val();
    if (clave != '') {
        const subsecuente = function (data) {
            if (data.data.length != 0)
                $('#asignatura-asignada').html('<b>Asignatura antecedente: </b>' + data.data[0].nombre);
            else {
                $('#asignatura-asignada').html('<b>No hay asignatura registrada con la clave: </b>' + clave.toUpperCase());
                $(this).val('');
            }
        }
        main.ajaxBuscar(clave, 0, 'Asignaturas', subsecuente);
    }else{
        $('#asignatura-asignada').html('');
    }
});

$('#guardar-asignatura').click(function (e) {

    $(this).attr('disabled', 'disabled');
    const ciclo = $('#impartir').prop('checked') ? 1 : 0
    e.preventDefault()

    // Agregar toda la informacion a un objeto para validar la informacion
    const asignatura = {
        type: $('input[name="tipo-asignatura"]:checked').attr('id'),
        clave: $('#clave').val(),
        nombre: $('#nombre').val(),
        practicas: $('#practicas').val(),
        creditos: $('#creditos').val(),
        academica: $('#academica option:selected').val(),
        carrera: $('#carrera option:selected').val(),
        areaFormacion: $('#areaFormacion option:selected').val(),
        areaConocimiento: $('#areaConocimiento option:selected').val()
    }

    // Validar todos los campos necesarios 
    for (const key in asignatura) {
        if ((asignatura[key] == null || asignatura[key] == 0)) {
            $('html, body').animate({ scrollTop: 0 }, 300);
            ui.mostrarAlerta('Es necesario llenar todos los campos', '#ef9a9a', '#f44336');
            $(this).removeAttr('disabled');
            return 0;
        }
    }
    // Validar el tipo de asignatura
    if (asignaturaEspecial == 0) {
        let optativa = $('#optativas option:selected').val();
        if (optativa == null || optativa == 0) {
            $('html, body').animate({ scrollTop: 0 }, 300);
            ui.mostrarAlerta('Es necesario llenar todos los campos', '#ef9a9a', '#f44336');
            $(this).removeAttr('disabled');
            return 0;
        }
    }

    if (cargarPDF($('#file')) || asignaturaEspecial == 1) {
        let url = '../../../php/Servicios/setAsignatura.php';
        $('#impartir').val(ciclo)
        let formData = new FormData($('#form-re-asignatura')[0]);
        guardarInformacion(url, formData);
    } else
        $(this).removeAttr('disabled');

});

$('#impartir').change(function(){
    $(this).prop('checked')
        ? $(this).next().text('Esta asignatura se impartirá en ciclo corto')
        : $(this).next().text('¿Impartir en ciclo corto?')
});

// ************** FUNCIONES PARA CARGAR EL DOCUMENTO

documentOpciones(main.parametros(document.location.href));
