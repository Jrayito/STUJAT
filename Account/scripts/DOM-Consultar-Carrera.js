const colores = ['#f8bbd0', '#e1bee7', '#c5cae9', '#bbdefb', '#c8e6c9', '#f0f4c3', '#ffe0b2', '#ffccbc', '#b2dfdb'];
const border = ['#ec407a', '#ab47bc', '#5c6bc0', '#42a5f5', '#66bb6a', '#d4e157', '#ffa726', '#ff7043', '#26a69a'];
const maxAsignaturas = 13;
let asignaturas = [];

const main = new Main();

// ******************* FUNCIONES DE DOM
$('#guardar-carrera').click(function () { })


const consultarCarrera = function(nombre, callback){
    $.ajax({
        url: 'http://localhost/proyecto/php/Servicios/getCarrera.php', type: 'POST', data: {nombre, nombre},
        success: function(resp){
            callback(JSON.parse(resp));
        } 
    });
};

const pintarAsignaturas = (resp) => {
    const div = $('<div/>', { html: resp.nombre });
    div.css({
        'background-color': colores[resp.areaConocimiento - 1],
        'border': `2px solid ${border[resp.areaConocimiento - 1]}`
    })

    if (resp.tipo != 'optativa') {
        $('.listado-asignaturas').append(div);
    }
    // } else if (resp.data[0].tipo == 'optativa') {
    //     $('.listado-optativas').append(div);
    // }
}

const pintarAreasConocimiento = resp => {

    for (let x = 0; x < resp.data.length; x++) {
        const div = $('<div/>', { html: resp.data[x].nombre });

        div.css({ 'background-color': colores[x], 'border': `2px solid ${border[x]}` });
        $('.areas-conocimiento').append(div);

    }
}

const consultarInformacion = function (resp) {
    $('.info-tabla-carrera table tbody tr:nth-child(1) td:nth-child(2) input').val(resp.data[0].nombre);
    $('.info-tabla-carrera table tbody tr:nth-child(2) td:nth-child(2) input').val(`División Académica ${resp.data[0].academica}`);
    $('.info-tabla-carrera table tbody tr:nth-child(3) td:nth-child(2) input').val(resp.data[0].creditos);
    pintarAreasConocimiento(resp.data[0].json);
}

const consultarAsignaturas = function (resp) {
    asignaturas = resp;
    for (let x = 0; x < maxAsignaturas; x++) {
        pintarAsignaturas(resp.data[x]);
    }

    const mostrarMas = $('<div/>', { 
        html: `+${resp.data.length - maxAsignaturas} asignaturas`});
    mostrarMas.addClass('mostrar-mas');

    $('.listado-asignaturas').append(mostrarMas);
}


// ***************** FUNCIONES DEL DOM
$('.listado-asignaturas').click(function (e) {
    if($(e.target) && e.target.tagName == 'DIV' && $(e.target).hasClass('mostrar-mas')){
        $('.mostrar-mas').remove();
        for (let x = maxAsignaturas; x < asignaturas.data.length; x++) {
            pintarAsignaturas(asignaturas.data[x]);
        }

        const mostrarMenos = $('<div/>', { 
            html: 'Mostrar menos' });
        mostrarMenos.addClass('mostrar-menos');
    
        $('.listado-asignaturas').append(mostrarMenos);
    }

    if($(e.target) && e.target.tagName == 'DIV' && $(e.target).hasClass('mostrar-menos')){
        $('.listado-asignaturas').html('');
        $('.mostrar-menos').remove();
        consultarAsignaturas(asignaturas);
    }
});

$('.btn-edit').click(function(){
    $('#guardar-carrera').show();
    $('.info-tabla-carrera input').attr('disabled', false);
});


// ****************** FUNCIONES PARA INICIAR EL DOCUMENTO

$('.alerta').hide();
$('#guardar-carrera').hide();

parametros = main.parametros(document.location.href);
// main.ajaxBuscar(parametros['carrera'], '', 'Carreras', consultarInformacion);
consultarCarrera(parametros['carrera'], consultarInformacion);
main.ajaxBuscar(parametros['carrera'], '', 'Asignaturas', consultarAsignaturas);
