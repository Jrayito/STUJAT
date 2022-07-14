const buscarAsignatura = (clave, parent) => {
    for (const asignatura of trayectoria.ciclos[parent].asignaturas) {
        if (clave == asignatura.clave) {
            return asignatura
        }
    }
}
const removerAsignatura = (clave, parent) => {
    for (const asignatura in trayectoria.ciclos[parent].asignaturas) {
        if (clave == trayectoria.ciclos[parent].asignaturas[asignatura].clave) {
            trayectoria.ciclos[parent].asignaturas.splice(asignatura, 1);
        }
    }
}
const moverAsignatura = (newCiclo, creditos, clave, oldCiclo, clonAsignatura) => {
    trayectoria.ciclos[newCiclo].creditos -= Number(creditos);
    trayectoria.ciclos[oldCiclo].creditos = Number(trayectoria.ciclos[oldCiclo].creditos) + Number(creditos);
    $(`#${newCiclo} > span`).text(`Créditos disponibles: ${trayectoria.ciclos[newCiclo].creditos}`);
    $(`#${oldCiclo} > span`).text(`Créditos disponibles: ${trayectoria.ciclos[oldCiclo].creditos}`);
    // Se remueve la asignatura 
    removerAsignatura(clave, oldCiclo)
    // Se agrega la asignatura al nuevo ciclo
    trayectoria.ciclos[newCiclo].asignaturas.push(clonAsignatura);
}
const activeDrop = (noCiclo) => {
    const newCiclo = document.getElementById(noCiclo).querySelector('div');

    Sortable.create(newCiclo, {
        group: {
            name: 'ciclos',
            pull: true , //(noCiclo == 0) ? false : true, // Permitir sacar elementos de la lista
            put: (noCiclo == 0) ? false : true, // Permitir poner elementos dentro de a lista
        },
        animation: 350,
        easing: 'cubic-bezier(0.895, 0.03, 0.685, 0.22)',
        filter: '.asig-aprobada',
        onAdd: (evt) => {
            const item = evt.item;
            const text = $(evt.item).find('span').text();
            const clave = $(evt.item).attr('data-id')
            const newCiclo = $(evt.to).parent().attr('id');
            const oldCiclo = $(evt.from).parent().attr('id');

            const informacion = function (resp) {
                const ciclo = resp.data[0].ciclo
                if (trayectoria.ciclos[newCiclo].type == 'corto' && ciclo == 0) {
                    console.log(text + ' no puede ser llevada en ciclo corto');
                } else {
                    const creditos = resp.data[0].creditos;
                    if (trayectoria.ciclos[newCiclo].creditos >= Number(creditos)) {
                        const antecedente = resp.data[0].antecedente;
                        const subsecuente = resp.data[0].hasOwnProperty('subsecuente') ?
                            resp.data[0].subsecuente :
                            null;
                        if (antecedente.clave != '' || subsecuente != null) {
                            if (validarSeriacion(antecedente, subsecuente, newCiclo)) {
                                moverAsignatura(newCiclo, creditos, clave, oldCiclo, buscarAsignatura(clave, oldCiclo));
                                validarCiclo(newCiclo); validarCiclo(oldCiclo);
                            } else {
                                $('html, body').animate({ scrollTop: 0 }, 300);
                                // ui.mostrarAlerta('Seriación de la asignatura invalida', '#ef9a9a', '#f44336');
                                $(evt.item).remove();
                                $(`#${oldCiclo} > div`).append(item);
                                return 0;
                            }
                        } else {
                            moverAsignatura(newCiclo, creditos, clave, oldCiclo, buscarAsignatura(clave, oldCiclo));
                            validarCiclo(newCiclo); validarCiclo(oldCiclo);
                        }
                    } else {
                        $('html, body').animate({ scrollTop: 0 }, 300);
                        ui.mostrarAlerta('La asignatura seleccionada excede los crétidos disponibles', '#ef9a9a', '#f44336');
                        $(evt.item).remove();
                        $(`#${oldCiclo} > div`).append(item);
                    }

                }

            }
            consultarAsignatura(text, informacion, '"NA"');
        },
        onStart: (evt) => {$('#remover-asignaturas').css('display', 'flex');},
        onEnd: (evt) => {$('#remover-asignaturas').css('display', 'none');},
        onUpdate: (evt) => {
            const asignaturas = [];
            const children = $(evt.target).children();
            const idCiclo = $(evt.target).parent().attr('id')

            for (const div of children) {
                const clave = div.getAttribute('data-id')
                for (const asignatura of trayectoria.ciclos[idCiclo].asignaturas) {
                    if (clave == asignatura.clave) {
                        asignaturas.push(asignatura)
                    }
                }
            }
            trayectoria.ciclos[idCiclo].asignaturas = asignaturas;
        }
    });
}
const activeRemover = () => {
    const btnRemover = document.getElementById('remover-asignaturas');

    Sortable.create(btnRemover, {
        group: {
            name: 'ciclos',
        },
        onAdd: (evt) => {
            const clave = $(evt.item).attr('data-id')
            const text = $(evt.item).find('span').text();
            const oldCiclo = $(evt.from).parent().attr('id');
            const inforAsignatura = buscarAsignatura(clave, oldCiclo);
            $(evt.item).remove();

            console.log(asignaturasCargadas)
            const indexRemover = asignaturasCargadas.indexOf("'" + clave + "'");
            asignaturasCargadas.splice(indexRemover, 1);
            console.log(asignaturasCargadas)
            removerAsignatura(clave, oldCiclo);
            trayectoria.ciclos[oldCiclo].creditos = Number(trayectoria.ciclos[oldCiclo].creditos) + Number(inforAsignatura.creditos);
            creditosAsignados -=  Number(inforAsignatura.creditos);
            $(`#${oldCiclo} > span`).text(`Créditos disponibles: ${trayectoria.ciclos[oldCiclo].creditos}`);
            validarCiclo(oldCiclo);
            const mostrarRemovia = function (resp) {
                sugeridas.push(resp.data[0]);

                pintarAsignaturas(sugeridas, 'asignaturas-sugerencia');
                asignaturasCargadas.push('"' + resp.data[0].clave + '"');
                $('#search-asignatura').change();
            }
            console.log(text);
            consultarAsignatura(text, mostrarRemovia, asignaturasCargadas.toString())
        }
    });
}
$('#update-trayectoria').click(function (e) {
    update = 1;
    $(this).hide().next().hide();
    e.stopImmediatePropagation();
    $('.ciclo > div > div').removeClass('animate__animated animate__fadeInDown');
    for (let x = 0; x < trayectoria.ciclos.length; x++) { activeDrop(x); }
    activeRemover();
    $('.ciclo > div > div').css('cursor', 'all-scroll');
    $('.ciclo > div > div.asig-aprobada').css('cursor', 'no-drop');
});
