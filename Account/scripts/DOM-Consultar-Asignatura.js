let parametros;


const main = new Main();

$('.asignaturas').click(function (e) {
    e.stopImmediatePropagation();
    const text = $(this).children().eq(0).text();
    location.href = `./asignatura.php?c=${parametros['c']}&u=${parametros['u']}&asignatura=${text}`;
    // location.href = './asignatura.php?casignatura=' + text
})


const modalConfirmar = (type, conf, cancel, informacion, carrera) => {
    $.confirm({
        title: 'Confirmación',
        content: 'Una vez confirmada la opción no se podra revertir ¿Continuar?',
        columnClass: 'modal-confirmacion',
        type: type,
        buttons: {
            confirm: {
                text: 'Confirmar',
                btnClass: conf,
                action: function () {
                    $.ajax({
                        url: '../../php/Servicios/updateEstadoAsignatura.php', type: 'POST', 
                        data: informacion, 
                        success: function(resp){
                            console.log(resp);
                            window.location.reload();
                            window.opener.document.location= "http://localhost/proyecto/Account/Usuarios/trayectoria.php?alumno="+parametros['u']+"&carrera="+carrera;
                        }
                    });
                }
            },
            cancel: {
                text: 'Cancelar',
                btnClass: cancel,
                action: function () { }
            },
        }
    });
}

$('#btn-aprobar').click(function () {
    const clave = $(this).val();
    const carrera = $(this).parent().attr('data-carrera');
    const informacion = {
        usuario: parametros['u'], 
        ciclo: parametros['c'], 
        clave: clave, 
        accion: 0
    }

    modalConfirmar('blue', 'btn-success', '', informacion, carrera);
});

$('#btn-reprobar').click(function () {
    const clave = $(this).val();
    const carrera = $(this).parent().attr('data-carrera');
    const informacion = {
        usuario: parametros['u'], 
        ciclo: parametros['c'], 
        clave: clave, 
        accion: 1
    }

    modalConfirmar('red', '', 'btn-delete', informacion, carrera);
});


parametros = main.parametros(document.location.href);