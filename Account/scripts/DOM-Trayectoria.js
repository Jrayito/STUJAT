const colores = ['#f8bbd0', '#e1bee7', '#c5cae9', '#bbdefb', '#c8e6c9', '#f0f4c3', '#ffe0b2', '#ffccbc', '#b2dfdb'];
const border = ['#ec407a', '#ab47bc', '#5c6bc0', '#42a5f5', '#66bb6a', '#d4e157', '#ffa726', '#ff7043', '#26a69a'];

const creditosMaximosLargo = 50;
const creditosMaximosCorto = 16;
let update = 0;
let creditosAsignados = 0;
let parametros = [];
let contadorCiclo = 0;
let cicloAsignar = 0;
let btnClick;
let response = [];
let sugeridas = [];
let asignaturasCargadas = ["'FFFFF'"];
let ciclosRespaldo = [];

let trayectoria = { "ciclos": [], "creditosAcumulados": 0, "avisos": [0], "reprobadas": [0] };

const main = new Main();
const ui = new UI();


// ***************** FUNCIONES DEL DOM
const addCiclo = (elemento) => {
    const div = $('<div/>', {
        id: contadorCiclo,
    }).addClass('ciclo');

    const select = $('<select/>').addClass('input-full').append('<option value="1" >Ciclo Largo</option>');
    if ((contadorCiclo % 3) == 2) {
        select.append('<option value="2">Ciclo Corto</option>');
    }

    const btnAdd = $('<button>', {
        title: 'Añadir asignatura',
        class: 'add-asignatura'
    }).append('<i class="material-icons">add<i/>');

    const ContenedorAsignaturas = $('<div/>');

    const span = $('<span/>', { text: `Créditos disponibles: ${trayectoria.ciclos[contadorCiclo].creditos}` });

    elemento.before(div.append(select, span, ContenedorAsignaturas, btnAdd));
}

const consultarAsignatura = (nombre, callback, filtro) => {
    $.ajax({
        url: '../../php/Servicios/pruebaAsignaturas.php', type: 'POST',
        data: { nombre: nombre, asignaturas: filtro },
        success: function (resp) {
            console.log(JSON.parse(resp))
            callback(JSON.parse(resp));
        }
    });
}
const consultarAreaConocimiento = (callback, filtro, index, option) => {
    $.ajax({
        url: '../../php/Servicios/consultarAsignaturasArea.php', type: 'POST',
        data: { index: index, filtro: filtro, option: option},
        success: function (resp) {
            callback(JSON.parse(resp));
        }
    });
}

const pintarAsignaturas = (info, elemento) => {
    for (let x = 0; x < info.length; x++) {

        const p = $('<p/>', { html: `${info[x].nombre}` });
        const icon = $('<i/>', { class: 'material-icons', html: 'arrow_forward' });
        const div = $('<div/>', {
            class: 'asignaturas animate__animated animate__fadeIn',
            "data-id": x,
        }).append(p, icon);
        div.css(
            {
                'background-color': `${colores[info[x].areaConocimiento - 1]}`,
                'border': `2px solid ${border[info[x].areaConocimiento - 1]}`
            });

        $('.' + elemento + '').append(div);

        addFunciones();
    }
}
const createAsignatura = (css, text, clave, status, creditos, rep = 0) => {
    const span = $('<span/>', { html: text });
    let html = (rep == 0) 
                    ? `Créditos : ${creditos}` 
                    : `Créditos : ${creditos}  -  Repro: ${rep}`;
    
    html = (status) ? "Aprobada" : html;
    
    const tooltip = $('<p/>', { html: html });

    const div = $('<div/>', {
        class: 'animate__animated animate__fadeInDown',
        'data-id': clave
    }).append(span, tooltip);

    if (status) {
        div.addClass('asig-aprobada');
        div.attr('title', 'Aprobada');
    } else {
        div.css(
            {
                'background-color': `${colores[css - 1]}`,
                'border': `2px solid ${border[css - 1]}`
            });
    }
    return div;
}

const addAsignatura = (clave, text, css, creditos, ciclo, parent) => {

    // btnClick.before(createAsignatura(css, text, clave))
    let reprobadas = 0, status = 0;

    if (ciclosRespaldo.length) {
        for (const key in ciclosRespaldo) {
            ciclosRespaldo[key].asignaturas.forEach(asignatura => {
                if (asignatura.clave == clave) {

                    reprobadas = asignatura.reprobadas;
                    status = asignatura.status;
                }
            });
        }
    }
    btnClick.prev().append(createAsignatura(css, text, clave, 0, creditos, reprobadas));

    const asignatura = {
        clave: clave,
        nombre: text,
        ciclo: ciclo,
        creditos: creditos,
        status: status,
        reprobadas: reprobadas,
        color: css
    };

    trayectoria.ciclos[parent].asignaturas.push(asignatura);
    console.log(trayectoria.ciclos)
}

const asignarAsignatura = (clave, text, css, antecedente, creditos, ciclo, subsecuente, parent) => {
    if (antecedente.clave != '' || subsecuente != null) {
        if (validarSeriacion(antecedente, subsecuente, parent)) {
            addAsignatura(clave, text, css, creditos, ciclo, parent);
            return 1;
        } else {
            return 0;
        }
    } else {
        addAsignatura(clave, text, css, creditos, ciclo, parent);
        return 1;
    }
}

// Remover el boton para añadir nuevas asignaturas
const validarCiclo = (parent) => {
    if (trayectoria.ciclos[parent].creditos < 4) {
        $(`#${parent}`).find('button').hide();
    } else {
        $(`#${parent}`).find('button').show();
    }
}

const validarAntecedente = (antecedente, parent) => {
    if (antecedente.clave != '') {
        if ($(`div[data-id="${antecedente.clave}"]`).length > 0) {
            if ($(`div[data-id="${antecedente.clave}"]`).parent().parent().attr('id') < parent) {
                return 1;
            }
        }
        ui.mostrarAlerta('Selección invalida. Asignatura antecedente "' + antecedente.nombre + '"', '#ef9a9a', '#f44336');
        return 0;
    } return 1;
}

const validarSubsecuente = (subsecuente, parent) => {
    if (subsecuente != null) {
        if ($(`div[data-id="${subsecuente.clave}"]`).length > 0) {
            if ($(`div[data-id="${subsecuente.clave}"]`).parent().parent().attr('id') > parent) {
                return 1;
            }
            ui.mostrarAlerta('Selección invalida. Asignatura subsecuente "' + subsecuente.nombre + '"', '#ef9a9a', '#f44336');
            return 0;
        }
    }
    return 1;
}

const validarSeriacion = (antecedente, subsecuente, parent) => {
    if (validarAntecedente(antecedente, parent)) {
        if (validarSubsecuente(subsecuente, parent)) {
            return 1;
        } else return 0;
    } else { return 0; }
}
const mostrarAnuncios = (anuncios) => {
    // Desde sesión de administrador envie error porque no existe la pripiedad anuncion
    $('.notify').text(anuncios.length - 1);
    if (anuncios.length) {
        ui.notificaciones(anuncios);
    } else {
        $('.info-avisos').append('<p><b>Bandera de avisos vacía</b></p>')
    }

    //ejecuta el evento de la notificación
    $('.notificaciones').click(function (e) {
        e.stopImmediatePropagation();

        if ($(this).next().hasClass('view-act')) {
            $('.view-act').slideUp('normal').removeClass('view-act');
            $(this).css({ 'background-color': 'white', 'color': 'black' });
        } else {
            $('.view-act').prev().css({ 'background-color': 'white', 'color': 'black' });
            $('.view-act').slideUp('normal').removeClass('view-act');
            $(this).next().addClass('view-act').slideDown('normal');
            $(this).css({ 'background-color': '#2196f3', 'color': 'white' });
        }
    });

    $('.mensaje-comple > button').click(function (e) {
        e.stopImmediatePropagation();

        index = $(this).parent().prev().attr('index');
        usuario = parametros['alumno'];

        $.ajax({
            url: '../../php/Servicios/msmLeido.php', type: 'POST', data: { index: index, usuario: usuario }, success: function (resp) {
                window.location.reload();
                console.log(resp);
            }
        })
    });
}

const displayOpciones = parametros => {

    if (parametros['trayectoria']) {
        $('#update-trayectoria').hide();
        $('#nueva-trayectoria').hide();
    } else {
        $.ajax({
            url: '../../php/Servicios/getTrayectoria.php', type: 'POST',
            data: { trayectoria: parametros['alumno'] ? parametros['alumno'] : parametros['carrera'] },
            success: function (resp) {
                const info = JSON.parse(resp)
                trayectoria = info.data.json;
                console.log(trayectoria)
                trayectoria.ciclos.forEach(element => {
                    addCiclo($('#add-ciclo'));

                    const parent = contadorCiclo;
                    
                    element.type == 'largo' 
                        ? $(`#${parent} > select > option[value="1"]`).attr('selected', true)
                        :$(`#${parent} > select > option[value="2"]`).attr('selected', true)
                    
                    for (const key in element.asignaturas) {

                        const clave = element.asignaturas[key].clave;
                        const text = element.asignaturas[key].nombre;
                        const css = element.asignaturas[key].color;
                        const creditos = element.asignaturas[key].creditos;
                        const status = Number(element.asignaturas[key].status);
                        const rep = Number(element.asignaturas[key].reprobadas);

                        creditosAsignados += Number(creditos);
                        asignaturasCargadas.push("'" + clave + "'");

                        $('#' + parent + ' > div').append(createAsignatura(css, text, clave, status, creditos, rep));
                        validarCiclo(parent);

                    }
                    contadorCiclo++;
                    addFunciones();
                });

                mostrarAnuncios(trayectoria.avisos);
            }
        });

    }

}
// ******************** EVENTOS DEL DOM
const addFunciones = () => {

    $('.add-asignatura').click(function (e) {
        e.stopImmediatePropagation();
        $('body').addClass('open-modal');
        $('html, body').animate({ scrollTop: 0 }, 300);
        $('.modal').css({ 'opacity': '1', 'visibility': 'visible' });
        $('.modal-content').addClass('animate__animated animate__bounceIn');
        btnClick = $(this);
    });

    $('.resultado-asignaturas .asignaturas').click(function (e) {
        e.stopImmediatePropagation();

        parent = btnClick.parent().attr('id');

        // informacion asignatura
        const idInfor = $(this).attr('data-id');
        const clave = response.data[idInfor].clave;
        const text = response.data[idInfor].nombre;
        const css = response.data[idInfor].areaConocimiento;
        const antecedente = response.data[idInfor].antecedente;
        const creditos = Number(response.data[idInfor].creditos);
        const subsecuente = response.data[idInfor].hasOwnProperty('subsecuente') ?
            response.data[idInfor].subsecuente :
            null;
        const ciclo = response.data[idInfor].ciclo;

        if (trayectoria.ciclos[parent].type == 'corto' && ciclo == 0) {
            ui.mostrarAlerta(text + ' no puede ser llevada en ciclo corto', '#ef9a9a', '#f44336');
            // console.log('La asignatura no puede llevarse en ciclo corto');
        } else {
            if (trayectoria.ciclos[parent].creditos >= creditos) {
                if (asignarAsignatura(clave, text, css, antecedente, creditos, ciclo, subsecuente, parent)) {
                    creditosAsignados += creditos;
                    trayectoria.ciclos[parent].creditos -= creditos;
                    $(`#${parent} > span`).text(`Créditos disponibles: ${trayectoria.ciclos[parent].creditos}`);
                    asignaturasCargadas.push("'" + clave + "'");
                    $(this).remove();
                    consultarSubsecuente(subsecuente);
                }
            } else { ui.mostrarAlerta('Lo créditos seleccionados exceden los disponibles', '#ef9a9a', '#f44336'); }

            validarCiclo(parent);
        }
        $('body').removeClass('open-modal');
        $('.modal-content').removeClass('animate__animated animate__bounceIn');
        $('.modal').css({ 'opacity': '0', 'visibility': 'hidden' });
    });

    $('.asignaturas-sugerencia .asignaturas').click(function (e) {
        e.stopImmediatePropagation();

        parent = btnClick.parent().attr('id');

        // informacion asignatura
        const idInfor = $(this).attr('data-id');
        const clave = sugeridas[idInfor].clave;
        const text = sugeridas[idInfor].nombre;
        const css = sugeridas[idInfor].areaConocimiento;
        const antecedente = sugeridas[idInfor].antecedente;
        const creditos = sugeridas[idInfor].creditos;
        const subsecuente = sugeridas[idInfor].hasOwnProperty('subsecuente') ?
            sugeridas[idInfor].subsecuente :
            null;
        const ciclo = sugeridas[idInfor].ciclo;

        if (trayectoria.ciclos[parent].type == 'corto' && ciclo == 0) {
            ui.mostrarAlerta(text + ' no puede ser llevada en ciclo corto', '#ef9a9a', '#f44336');
        } else {
            if (trayectoria.ciclos[parent].creditos >= creditos) {
                if (asignarAsignatura(clave, text, css, antecedente, creditos, ciclo, subsecuente, parent)) {
                    creditosAsignados += Number(creditos);
                    trayectoria.ciclos[parent].creditos -= creditos;
                    $(`#${parent} > span`).text(`Créditos disponibles: ${trayectoria.ciclos[parent].creditos}`);
                    sugeridas.splice(idInfor, 1);
                    consultarSubsecuente(subsecuente);
                }
            } else { ui.mostrarAlerta('Lo créditos seleccionados exceden los disponibles', '#ef9a9a', '#f44336'); }

            validarCiclo(parent);
        }
        $('body').removeClass('open-modal');
        $('.modal-content').removeClass('animate__animated animate__bounceIn');
        $('.modal').css({ 'opacity': '0', 'visibility': 'hidden' });
    });

    $('.ciclo > div > div').click(function (e) {
        e.stopImmediatePropagation();

        const parent = $(this).parent().parent().attr('id');
        const text = $(this).find('span').text();
        const usuario = (parametros['alumno']) ? 'u=' + parametros['alumno'] : 'u=' + parametros['carrera'];
        window.open('./asignatura.php?c=' + parent + '&' + usuario + '&asignatura=' + text, '_blank').focus();
    });

    $('.ciclo select').change(function (e) {
        //Comprobar si el ciclo ya tiene asignaturas registradas
        e.stopImmediatePropagation();

        const parent = $(this).parent().attr('id');
        const val = $(this).val()
        const cambio = val == 1 ? 'largo' : 'corto';

        if (trayectoria.ciclos[parent].asignaturas.length > 0) {
            switch (val) {
                case '1':
                    // 13 = 16 - 3;
                    creditosOcupados = (creditosMaximosCorto - trayectoria.ciclos[parent].creditos);

                    trayectoria.ciclos[parent].type = cambio;
                    trayectoria.ciclos[parent].creditos = creditosMaximosLargo - Math.abs(creditosOcupados);


                    $(`#${parent} > span`).text(`Créditos disponibles: ${trayectoria.ciclos[parent].creditos}`);
                    break;
                case '2':
                    creditosOcupados = creditosMaximosLargo - trayectoria.ciclos[parent].creditos;
                    if (creditosOcupados > creditosMaximosCorto) {

                        $(`#${parent} select option[value="1"]`).prop({ selected: true });

                        ui.mostrarAlerta('Error de cambio, limite de créditos excedidos', '#ef9a9a', '#f44336');
                        // console.log('No se puede hacer el cambio, exceso de créditos');
                        break;
                    } else {
                        let bandera = true;
                        trayectoria.ciclos[parent].asignaturas.forEach(asignatura => {
                            if (asignatura.ciclo == '0') {
                                $(`#${parent} select option[value="1"]`).prop({ selected: true });
                                ui.mostrarAlerta('Una o más asignaturas no se pueden llevar en ciclo corto', '#ef9a9a', '#f44336');
                                bandera = false;
                            }
                        });
                        if (bandera) {
                            trayectoria.ciclos[parent].type = cambio;
                            trayectoria.ciclos[parent].creditos = creditosMaximosCorto - creditosOcupados;

                            $(`#${parent} > span`).text(`Créditos disponibles: ${trayectoria.ciclos[parent].creditos}`);
                            break;
                        }
                    }
                    break;
            }
        } else {
            trayectoria.ciclos[parent].type = cambio;
            trayectoria.ciclos[parent].creditos = (val == 1) ? creditosMaximosLargo : creditosMaximosCorto;
            $(`#${parent} > span`).text(`Créditos disponibles: ${trayectoria.ciclos[parent].creditos}`);
        }

        validarCiclo(parent);
    });
}
const consultarSubsecuente = subsecuente => {
    $('.asignaturas-sugerencia').html('');
    console.log(subsecuente)
    if (subsecuente != null) {
        const asignaturasSubsecuentes = function (resp) {
            sugeridas.push(resp.data[0]);
            pintarAsignaturas(sugeridas, 'asignaturas-sugerencia');
            asignaturasCargadas.push("'" + resp.data[0].clave + "'");
            $('#search-asignatura').change();
        }
        consultarAsignatura(subsecuente.clave, asignaturasSubsecuentes, asignaturasCargadas.toString());
    } else { pintarAsignaturas(sugeridas, 'asignaturas-sugerencia'); }
};


// Agregar un nuevo ciclo

$('#add-ciclo').click(function () {
    // console.log(ciclo)
    const ciclo = { "type": "largo", "creditos": creditosMaximosLargo, "asignaturas": [] };
    trayectoria.ciclos.push(ciclo);
    addCiclo($(this));
    addFunciones();
    if (update) { $('#update-trayectoria').click() }
    contadorCiclo++;
});

$('.modal-content > button').click(function () {
    $('body').removeClass('open-modal');
    $('.modal-content').removeClass('animate__animated animate__bounceIn');
    $(this).parent().parent().css({ 'opacity': '0', 'visibility': 'hidden' });
})

$('#search-asignatura').change(function () {
    const text = $(this).val();
    if ($(this).val().length > 0) {
        const mostrarAsignaturas = function (resp) {
            $('.resultado-asignaturas').html('');
            if (resp.data.length != 0) {
                response = resp;
                pintarAsignaturas(resp.data, 'resultado-asignaturas');
            } else {
                $('.resultado-asignaturas').html('<div>No se han encontrado resultados con la siguiente busqueda <b>"' + text + '"</b></div>');
            }
        };
        consultarAsignatura($(this).val(), mostrarAsignaturas, asignaturasCargadas.toString());
    }
});

$('#nueva-trayectoria').click(function () {
    const primerCiclo = $('#0');
    ciclosRespaldo = trayectoria.ciclos.slice();

    $(this).hide().prev().hide();

    if ($('.asig-aprobada').length) {
        $('.ciclo > div').each((index, elemento) => {
            if (!$(elemento).children().hasClass('asig-aprobada')) {
                $(elemento).parent().remove();
            }
        });

        contadorCiclo = parseInt($('#add-ciclo').prev().attr('id')) + 1;

    } else {
        $('.ciclo').remove();
        $('#add-ciclo').before(primerCiclo);
        contadorCiclo = 1;
    }
    trayectoria.ciclos.splice(contadorCiclo);

    asignaturasCargadas = ["'FFFFF'"];

    creditosAsignados = 0;
    trayectoria.ciclos.forEach(ciclo => {
        ciclo.asignaturas.forEach(asignatura => {
            asignaturasCargadas.push('"' + asignatura.clave + '"');
            creditosAsignados += Number(asignatura.creditos);
        });
    })

    addFunciones();
});

$('.info-asignaturas').click(function () {
    $('.modal-informacion').css({ 'opacity': '1', 'visibility': 'visible' });
    $('.modal-content').addClass('animate__animated animate__bounceIn');
});

$('#opciones-busqueda').change(function (e) {
    e.stopImmediatePropagation();
    const index = $(this).val();
    if (index) {
        $('.resultado-asignaturas').html('');
        const mostrarAsignaturas = function (resp) {
            if (resp.data.length != 0) {
                response = resp;
                pintarAsignaturas(resp.data, 'resultado-asignaturas');
            } else {
                $('.resultado-asignaturas').html('<div>No hay asignaturas disponibles</div>');
            }
        };

        switch (index) {
            case '9':
                consultarAsignatura(null, mostrarAsignaturas, asignaturasCargadas.toString());
                break;
            case '10':
                consultarAreaConocimiento(mostrarAsignaturas, asignaturasCargadas.toString(), index, 1);
                break;
            default:
                consultarAreaConocimiento(mostrarAsignaturas, asignaturasCargadas.toString(), index, 0);
                break;
        }
    }
});

$('#guardar-trayectoria').click(function () {
    if(trayectoria.ciclos.length == 0){
        ui.mostrarAlerta('Trayectoria invalida. Ingresar datos de asignaturas.', '#ef9a9a', '#f44336');
        return 0;
    }
    let index = trayectoria.ciclos.length - 1;
    while (trayectoria.ciclos[index].asignaturas.length == 0) {
        trayectoria.ciclos.splice(index, 1);
        index--;
    }

    console.log(trayectoria);
    $.ajax({
        url: '../../php/Servicios/setTrayectoria.php', type: 'POST',
        data: {
            user: parametros['alumno'] ? parametros['alumno'] : parametros['carrera'],
            carrera: parametros['carrera'],
            json: trayectoria,
            creditos: creditosAsignados
        },
        success: function (resp) {
            const res = resp.split('=');
            $('html, body').animate({ scrollTop: 0 }, 1000);
            switch (res[0]) {
                case 'error':
                    ui.mostrarAlerta(res[1], '#ef9a9a', '#f44336');
                    break;
                case 'ok':
                    ui.mostrarAlerta(res[1], '#a5d6a7', '#4caf50');
                    setTimeout(function () {
                        const url = (parametros['alumno']) ? 'Alumno' : './' + parametros['returnUrl'] + '?carrera=' + parametros['carrera'];
                        location.href = url;
                    }, 1500)
                    break;
            }
        }
    });

});

// *************** FUNCIONES PARA INICIAR EL DOCUMENTO
$('.alerta').hide();
parametros = main.parametros(document.location.href)
displayOpciones(parametros);


