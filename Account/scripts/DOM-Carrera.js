const colores = ['#f8bbd0', '#e1bee7', '#c5cae9', '#bbdefb', '#c8e6c9', '#f0f4c3', '#ffe0b2', '#ffccbc', '#b2dfdb'];
const border = ['#ec407a', '#ab47bc', '#5c6bc0', '#42a5f5', '#66bb6a', '#d4e157', '#ffa726', '#ff7043', '#26a69a'];
let areasConocimiento = {
    data: []
};
cont = 0

// ********************** FUNCIONES Y EVENTOS DE GUARDAR CARRERA
const ui = new UI();
const main = new Main();
// Funciones del documento

const mostrarDivisiones = function (resp) {
    ui.opcionesSelect('#divisiones', resp, 'División Académica ');
};

// Informacion de la carrera

$('#nomCarrera').change(function () {
    let nomCarrera = $(this).val();

    let array = nomCarrera.split(" ");
    resultado = '';

    for (let x = 0; x < array.length; x++) {
        if (array[x][0].charAt(0) === array[x][0].charAt(0).toUpperCase()) {
            resultado += array[x][0];
        }
    }
    $('#acronimo').val(resultado);
});

// funciones del DOM
$('#guardar-carrera').click(function (e) {
    e.preventDefault();
    $('#guardar-carrera').attr('disabled', 'disabled');
    const info = {
        nombre: $('#nomCarrera').val(),
        acronimo: $('#acronimo').val(),
        creditos: $('#creditos').val(),
        academica: $('#divisiones option:selected').val(),
        conocimiento: areasConocimiento
    }

    if (info.nombre == null || info.academica == 0) {
        ui.mostrarAlerta('Es necesario llenar todos los campos', '#ef9a9a', '#f44336');
        $('#guardar-carrera').removeAttr('disabled');
        return 0;
    }

    if (info.creditos < 300 || info.creditos > 450) {
        ui.mostrarAlerta('Créditos invalidos', '#ef9a9a', '#f44336');
        $('#guardar-carrera').removeAttr('disabled');
        return;
    }

    $.ajax({
        url: '../../../php/Servicios/setCarrera.php', type: 'POST', data: info , success: function(resp){
            switch (resp) {
                case 'error':
                    ui.mostrarAlerta('Error al guardar la información', '#ef9a9a', '#f44336');
                    break;
                case 'ok':
                    ui.mostrarAlerta('Informacion guardada correctamente', '#a5d6a7', '#4caf50');
                    setTimeout(function () { location.href = './index.php' }, 3000);
                    break;
            }
        }
    });
});

$('#areaConocimiento').change(function (e) {
    
    let area = $(this).val();

    if (area != null && area.length != 0) {
        let info = { id: cont + 1, nombre: area };
        areasConocimiento.data.push(info);

        const div = $('<div/>', { text: area });
        div.css('background-color', colores[cont]);
        div.css('border', '2px solid ' + border[cont]);

        cont++;
        $('.areas-conocimiento').append(div);
        $('#areaConocimiento').val('').focus();
    }

    if (cont == 8) { $('#guardar-carrera').removeAttr('disabled'); }
})

// Funciones para inciar el documento
main.consultarDivisiones(mostrarDivisiones);

