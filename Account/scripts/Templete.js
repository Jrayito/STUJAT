const cargarTemplete = texto => {
    cargarHead();
    cargarHeader(texto);
}

const cargarHead = () => {
    
    const icons = $('<link/>', {rel: 'stylesheet', href: 'https://fonts.googleapis.com/icon?family=Material+Icons'} )
    const google = $('<link/>', {rel: 'preconnect', href: 'https://fonts.googleapis.com'});
    const font = $('<link/>', {rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: ''});
    const roboto = $('<link/>', {rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap'});
    const css = $('<link/>', {rel: 'stylesheet', href: 'http://localhost/proyecto/Account/estilos/main.css'});
    const animate = $('<link/>', {rel: 'stylesheet', href: 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css'});

    $('head').append(css, google, font, roboto, icons, animate);
}

const cargarHeader = (texto) => {
    const divLogo = $('<div/>}', {class: 'contenedor'});
    const a = $('<a/>', {href: '../../index.html'});

    divLogo.append(a.append($('<img/>', {src: 'http://localhost/proyecto/Account/recursos/escudo.png', class: 'logo'})));

    const divTexto = $('<div/>}', {class: 'contenedor'});
    const h6 = $('<h6/>', {text: texto})
    
    $('header').append(divLogo, $('<div/>').append(divTexto.append(h6)));
}
