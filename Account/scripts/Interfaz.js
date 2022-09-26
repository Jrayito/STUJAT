
class UI {

    meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    constructor() { }

    cambiarOpcion(elemento, opciones, placeholder, link, text) {
        $('main h3').text(placeholder.toUpperCase() + 'S');
        $('.buscador input[type="text"]').val('');
        $('.buscador input[type="text"]').attr('placeholder', 'Buscar ' + placeholder.toLowerCase());

        $('.opciones a').attr('href', link);
        $('.opciones a').html('<i class="material-icons">add</i> Agregar ' + placeholder);

        this.opcionesSelect(elemento, opciones, text);
    }

    opcionesSelect(elemento, opciones, text) {
        // se valida que las opciones tengan algo
        // caso contrario el elemento se oculta
        if (opciones.length == 0) {
            return $(elemento).hide();
        }

        // Si las opciones contienen algo se muestra en caso de haber estado oculto
        $(elemento).show();
        // se resetea el elemento
        $(elemento).empty();
        // Se agrega primero opcion por default
        $(elemento).append($('<option/>', { html: 'Seleccionar', value: 0 }));

        // Se iterann al opciones para ser agregadas
        for (let x = 0; x < opciones.data.length; x++) {
            $(elemento).append(
                $('<option/>', {
                    html: text + ' ' + opciones.data[x].nombre,
                    value: opciones.data[x].id
                }).attr('data-id', opciones.data[x].id));
        }
    }

    cambiarTabla(elemento, opciones) {
        const tr = $('<tr/>');
        for (let x = 0; x < opciones.length; x++) {
            tr.append(`<th>${opciones[x]}</th>`);
        }
        $(elemento + ' table thead').html(tr);
    }

    mostrarAlerta(mensaje, back, color) {
        $('.alerta').show()
            .css({ 'background': back, 'color': 'white', 'border-left': '5px solid ' + color })
            .text(mensaje).delay(5000).slideUp(5);
    }

    pintarTablaUsuarios(data) {
        $('.tabla-buscador table tbody').html('<tr></tr>');
        let html = '';
        if(screen.width <= 576){
            for (let x = 0; x < data.data.length; x++) {
                html += `<tr data-id="${data.data[x].usuario}" class="title-table">
                                <td colspan="2">${data.data[x].nombre} ${data.data[x].apellidos}</td>
                            </tr>
                            <tr data-id="${data.data[x].usuario}">
                                <td>Matricula</td>
                                <td>${data.data[x].usuario}</td>
                            </tr>
                            <tr data-id="${data.data[x].usuario}">
                                <td>Correo</td>
                                <td>${data.data[x].correo}</td>
                            </tr>
                            <tr data-id="${data.data[x].usuario}">
                                <td>División Académica</td>
                                <td>División Académica de ${data.data[x].acedemica}</td>
                            </tr>`;
            }

            $('.tabla-buscador table tbody').html(html);

        }else if(screen.width > 576){
            for (let x = 0; x < data.data.length; x++) {
                const tr = $('<tr/>').attr('data-id', data.data[x].usuario);
                tr.append(`<td>${data.data[x].nombre}</td>`);
                tr.append(`<td>${data.data[x].apellidos}</td>`);
                tr.append(`<td>${data.data[x].correo}</td>`);
                tr.append(`<td>División Académica ${data.data[x].acedemica}</td>`);
    
                $('.tabla-buscador table tbody').append(tr);
            }
        }
    }
    pintarTablaCarreras(data) {
        $('.tabla-buscador table tbody').html('<tr></tr>');
        let html = '';
        if(screen.width <= 576){
            for (let x = 0; x < data.data.length; x++) {
                html += `<tr data-id="${data.data[x].id}" class="title-table">
                            <td colspan="2">${data.data[x].nombre}</td>
                        </tr>
                        <tr data-id="${data.data[x].id}">
                            <td>División Académica</td>
                            <td>División Académica ${data.data[x].academica}</td>
                        </tr>
                        <tr data-id="${data.data[x].id}">
                            <td>Créditos</td>
                            <td>${data.data[x].creditos}</td>
                        </tr>`;
            }
            $('.tabla-buscador table tbody').html(html);
        }else if(screen.width > 576){
            for (let x = 0; x < data.data.length; x++) {
                const tr = $('<tr/>');
    
                tr.attr('data-id', data.data[x].id);
    
                tr.append(`<td>${data.data[x].nombre}</td>`);
                tr.append(`<td>División Académica ${data.data[x].academica}</td>`);
                tr.append(`<td>${data.data[x].creditos}</td>`);
    
                $('.tabla-buscador table tbody').append(tr);
            }
        }
    }
    pintarTablaAsignaturas(data) {
        $('.tabla-buscador table tbody').html('<tr></tr>');
        let html = '';
        if(screen.width <= 576){
            for (let x = 0; x < data.data.length; x++) {
               html += `<tr data-id="${data.data[x].clave}" class="title-table">
                            <td colspan="2">${data.data[x].nombre}</td>
                        </tr>
                        <tr data-id="${data.data[x].clave}">
                            <td>Clave</td>
                            <td>${data.data[x].clave}</td>
                        </tr>
                        <tr data-id="${data.data[x].clave}">
                            <td>Carrera</td>
                            <td>${data.data[x].carrera}</td>
                        </tr>
                        <tr data-id="${data.data[x].clave}">
                            <td>Tipo</td>
                            <td>${data.data[x].tipo}</td>
                        </tr>
                        <tr data-id="${data.data[x].clave}">
                            <td>Créditos</td>
                            <td>${data.data[x].creditos}</td>
                        </tr>`;
            }
            $('.tabla-buscador table tbody').html(html);
        }else if(screen.width > 576){
            for (let x = 0; x < data.data.length; x++) {
                const tr = $('<tr/>');
    
                tr.attr('data-id', data.data[x].clave);
    
                tr.append(`<td>${data.data[x].clave}</td>`);
                tr.append(`<td>${data.data[x].nombre}</td>`);
                tr.append(`<td>${data.data[x].carrera}</td>`);
                tr.append(`<td>${data.data[x].tipo}</td>`);
                tr.append(`<td>${data.data[x].creditos}</td>`);
    
                $('.tabla-buscador table tbody').append(tr);
    
            }
        }
    }

    consultarURI(url) {
        // let loc = document.location.href;
        const loc = url;

        if (loc.indexOf('?') > 0) {
            let getString = loc.split('?')[1];
            let GET = getString.split('&');
            var get = {};
            for (var i = 0, l = GET.length; i < l; i++) {
                var tmp = GET[i].split('=');
                get[tmp[0]] = unescape(decodeURI(tmp[1]));
            }
            return get;
        }
        return 0;
    }

    setInformacion(opcion, asignatura) {
        var mensaje;
        switch (opcion) {
            case '0':
                mensaje = `Asignatura reprodaba&
                            <p>La asignatura ${asignatura} 
                            fue repordaba en 1 ocación(es), se sugiere reasignarla al siguiente ciclo</p>`;
                break;
            case '1':
                mensaje = ` Asignatura reprobada y riesgo de baja&
                            <p>La asignatura ${asignatura} 
                            fue repordaba en 2 ocación(es), se sugiere reasignarla al siguiente ciclo</p>
                            <p>Y de acuerdo con el Reglamento Escolar vigente en el <b>Artículo 67, fracción II, inciso b), numeral 2;
                           </b> el alumno no puede reprobar tres veces la misma asignatura; en dado caso podría causar baja en las actividades 
                            escolares del estudiante.</p> 
                            <p>Le pedimos al Tutor estar al pendiente de esta situación</p>`;
                break;
            case '2':
                mensaje = ` Riesgo de baja por reglamento&
                            <p>La asignatura ${asignatura} 
                            fue repordaba en 3 ocación(es)</p>
                            <p>Y de acuerdo con el Reglamento Escolar en el <b>Artículo 67, fracción II, inciso b), numeral 2;
                            </b> el alumno no puede reprobar tres veces la misma asignatura.
                            <p>Acude a la Coordinacion de Docencia de tu división académica</p>`;
                break;
            case '3':
                mensaje = ` Riesgo de baja por acumulacion de asignaturas reprobadas&
                            <p>El alumno tiene acumuladas más de nueve asignaturas con calificación no aprobatoria
                            y no ha acreditado el 50% de avance total de los créditos del Plan de Estudios correspondiente; y de acuerdo con el
                            Reglamento Escolar vigente en el <b>Artículo 67, fracción II, inciso b), numeral 1</b> podría causar baja de las actividades 
                            escolares del estudiante.</p>`;
                break;
        }

        return mensaje;
    }

    notificaciones(informacion) {
        for (let index = 1; index < informacion.length; index++) {
            const datos = informacion[index].split('&');
            let msm = this.setInformacion(datos[3], datos[0])
            msm = msm.split('&');
            const notify = $('<div/>', {
                class: 'notificaciones', html: `<p>${msm[0]}</p>
                                                                        <i class="material-icons">arrow_drop_down</i>`}).

                attr('index', index);

            const btn = $('<button/>', { html: '<i class="material-icons">check</i>Leido', class: 'btn btn-success' })
            const fecha = new Date(datos[4])
            const mensaje = $('<div/>', {
                class: 'mensaje-comple',
                html: `<p>${fecha.getDate() + ' de ' + this.meses[fecha.getMonth()] + ' de ' + fecha.getFullYear()}</p>
                        <p>Estimado Tutor y Tutorado</p>
                        ${msm[1]}
            `})

            if (rolUsuario == 'docente') {
                if (!parseInt(datos[1])) { mensaje.append(btn); }


                if (parseInt(datos[2]))
                    mensaje.append('<div class="checking-msm" check><i class="material-icons">done_all</i><p><b> Tutorado</b></p></div>');
                else{
                    mensaje.append('<div class="checking-msm"><i class="material-icons">done_all</i><p><b> Tutorado</b></p></div>')
                }
            }

            if (rolUsuario == 'alumno') {
                if (!parseInt(datos[2])) { mensaje.append(btn); }


                if (parseInt(datos[1]))
                    mensaje.append('<div class="checking-msm" check><i class="material-icons">done_all</i><p><b> Tutor</b></p></div>');
                else
                    mensaje.append('<div class="checking-msm"><i class="material-icons">done_all</i><p><b> Tutor</b></p><div>');
            }

            $('.info-avisos').append(notify, mensaje);
            
        }
        // for (const anuncio in informacion) {
            
        // }
    }
}