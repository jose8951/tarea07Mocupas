/*variables globales*/
var APIKEY = 'AIzaSyAWnnnTQb-zAgy46lJKtoo-1xwU4ZZVhws';
var destino;
var lat;
var lng;
var mapasArray = [];
var direccionRendererArray = [];
var direccionServiceArray = [];
var login = "";
var intentos = 0;
var arrayDestinos = [];
var arrayDesbloquear = [];
var colorFondo = "#ffffff";
var unclick = 0;
/*Cuando se carga la página*/
$(function() {

    inicio();
});




/*Función que se lanza al cargar la página.*/
function inicio() {

    rellenarTabla("");
    $('#botonLogin').click(function(e) {
        e.preventDefault();
        mostrarFormulario("login", "");
    });

    $("#botonCrearAnuncioInvitado").click(function(e) {
        e.preventDefault();
        mostrarFormulario("login", "");
    });
}


/*Función que se encarga de mostrar el formulario según el tipo que sea
 * basandonos en la opción que se pasa.
 * @param string tipo: Es el tipo de formulario a mostrar.
 * @param string codigo: Es el dato o datos que se pasan al formulairo.
 * */

function mostrarFormulario(tipo, codigo) {
    switch (tipo) {
        case 'login':
            datosaServidor("mostrarLogin", "", "");
            break;
        case "mostrarEliminarAnuncio":
            datosaServidor("mostrarEliminarAnuncio", codigo, "");
            break;
        case "agregarAnuncio":
            datosaServidor("mostrarAgregarAnuncio", "", "");
            break;
        case 'mostrarModificarAnuncio':
            datosaServidor("mostrarModificarAnuncio", codigo, "");
            break;

        case "mostrarPreferencias":
            datosaServidor("mostrarPreferencias", colorFondo, "");
            break;
        case "mostrarDesbloquear":
            break;
    }
}

/*Función que se encarga de enviar los datos al servidor mediante Ajax y procesar la respuesta.
 * @param string opcion: Es la opción a ejecutar.
 * @param string dato: Son los datos que se envian  al servidor.
 * @param string codigo: Es el código del del anuncio.
 * */

function datosaServidor(opcion, dato, codigo) {

    switch (opcion) {

        case "mostrarAgregarAnuncio":
            //console.log($('#textoLogin').text());
            $.ajax({
                type: 'post',
                url: 'ajax.php',
                data: {
                    'opcion': 'mostrarAgregarAnuncio',
                    'login': $('#textoLogin').text()
                },
                dataType: 'text',
                statusCode: {
                    404: function() {
                        alert("Página no encontrada");
                    }
                },
                success: function(result) {

                    $('#formularioCrearAnuncio').html(result);
                    $('#formularioCrearAnuncio').removeClass('oculto');
                    $('#formularioCrearAnuncio').attr('id', 'formularioCrearAnuncio');
                    $('#botonGuardarAnuncio').click(function(e) {
                        //alert("estoy aqui");
                        e.preventDefault();
                        datosaServidor("validarAnuncio", {
                            'login': $('#textoLogin').text(),
                            'fecha': $('#inputFechaAnuncio').val(),
                            'moroso': $('#inputAnuncioMoroso').val(),
                            'localidad': $('#inputAnuncioLocalidad').val(),
                            'descripcion': $('#inputAnuncioDescripcion').val()
                        }, "");
                    });
                },
                error: function(result) {
                    alert("Resultado : " + result);
                }
            });
            break;

        case "mostrarModificarAnuncio":
            $.ajax({

                type: "POST",
                url: "ajax.php",
                data: {
                    "opcion": "mostrarAgregarAnuncio",
                    "login": $("#textoLogin").text(),
                    "id_anuncio": dato
                },
                dataType: 'text',
                statusCode: {
                    404: function() {
                        alert('Página no encontrada');
                    }
                },
                success: function(result) {
                    //  console.log(result);

                    $('#formularioCrearAnuncio').empty();
                    $('#formularioCrearAnuncio').html(result);
                    $("#formularioCrearAnuncio").removeClass("oculto");
                    $("#botonAgregarAnuncio").attr("id", "botonModificarAnuncio");
                    $("#botonModificarAnuncio").click(function(e) {
                        e.preventDefault();

                        datosaServidor("modificarAnuncio", {
                            "login": $("#textoLogin").text(),
                            "fecha": $("#inputFechaAnuncio").val(),
                            "moroso": $("#inputAnuncioMoroso").val(),
                            "localidad": $("#inputAnuncioLocalidad").val(),
                            "descripcion": $("#inputAnuncioDescripcion").val(),
                            "id_anuncio": dato
                        }, "");
                    });

                },
                error: function(result) {
                    alert("Resultado: " + result);
                }
            });


            break;
        case "mostrarEliminarAnuncio":
            //console.log(dato); //pasamoe el id
            //console.log($('#textoLogin').text()); //pasamos el usu1
            $.ajax({
                type: 'post',
                url: 'ajax.php',
                data: {
                    'opcion': 'mostrarAgregarAnuncio',
                    'login': $('#textoLogin').text(),
                    'id_anuncio': dato,
                    'eliminar': true
                },
                dataType: 'text',
                statusCode: {
                    404: function() {
                        alert("página no encontrada");
                    }
                },
                success: function(result) {
                    $('#formularioCrearAnuncio').empty();
                    $('#formularioCrearAnuncio').html(result);
                    $('#formularioCrearAnuncio').removeClass('oculto');
                    //cambia el valor de id por otro
                    $('#botonModificarAnuncio').attr('id', 'botonEliminarAnuncio');
                    $('#botonEliminarAnuncio').val('Eliminar');

                    //anulamos los campos
                    $('#inputFechaAnuncio').attr('disabled', 'disabled');
                    $('#inputAnuncioMoroso').attr('disabled', 'disable');
                    $('#inputAnuncioDescripcion').attr('disabled', 'disabled');
                    $('#inputAnuncioLocalidad').attr('disabled', 'disabled');

                    $('#botonEliminarAnuncio').click(function(e) {
                        e.preventDefault();
                        datosaServidor('eliminarAnuncio', {
                            'login': $('#textoLogin').text(),
                            'fecha': $('#inputFechaAnuncio').val(),
                            'moroso': $('#inputAnuncioMoroso').val(),
                            'localidad': $('#inputAnuncioLocalidad').val(),
                            'descripcion': $('#inputAnuncioDescripcion').val(),
                            'id_anuncio': dato,
                            'eliminar': true
                        }, "");
                    });
                },
                error: function(result) {
                    alert("resultado" + result);
                }
            });

            break;

        case "mostrarLogin":
            $.ajax({
                type: 'post',
                url: 'ajax.php',
                data: {
                    'opcion': 'mostrarLogin'
                },
                dataType: 'text',
                statusCode: {
                    404: function() {
                        alert('pagina no encontrada');
                    }
                },
                success: function(result) {
                    // console.log(result);
                    $('#capaLogin').html(result);
                    $('#invitado').click(function(e) {
                        e.preventDefault();
                        $('#textoLogin').val("invitado");
                    });
                    $('#gestionarmicuenta').click(function(e) {
                        e.preventDefault();
                        //  console.log({'login': $('#inputLogin').val(), "clave": $("#inputClave").val()});
                        //funcion que le pasamos un array con los valores de id
                        let login = $('#inputLogin').val();
                        let clave = $('#inputClave').val();

                        datosaServidor("validarLogin", {
                            'login': login,
                            "clave": clave
                        }, "");

                        //    datosaServidor("validarLogin", {
                        //         'login': $('#inputLogin').val(),
                        //         "clave": $("#inputClave").val()
                        //      }, "");
                    });
                    $("#registrarse").click(function(e) {
                        e.preventDefault();
                        datosaServidor("mostrarRegistrarse", "", "");

                    });
                    $("#formularioLogin").removeClass('oculto');
                },
                error: function(result) {
                    alert("Resulado " + result);
                }
            });
            break;

        case "mostrarRegistrarse":
            $.ajax({
                type: 'post',
                url: 'ajax.php',
                data: {
                    'opcion': 'mostrarRegistrarse'
                },
                dataType: 'text',
                statusCode: {
                    404: function() {
                        alert("Página no encontrada");
                    }
                },
                success: function(result) {
                    $('#capaLogin').empty();
                    $('#capaLogin').html(result);

                    $('#registrarse').click(function(e) {
                        e.preventDefault();
                        datosaServidor('validarRegistro', {
                            'login': $('#inputLoginRegistro').val(),
                            'clave': $('#inputPassword1Registro').val(),
                            'clave2': $('#inputPassword2Registro').val(),
                            'email': $('#inputEmailRegistro').val()
                        }, "");
                    })

                },
                error: function(result) {
                    alert("Resultado" + result);
                }
            });
            break;

        case "validarLogin":
            //muestra un array con los valores login y clave
            //console.log(dato);
            // console.log(validarDatos("password", dato["clave"]));
            if (validarDatos("login", dato["login"]) && validarDatos("password", dato["clave"])) {
                if (intentos === 0) {
                    login = dato["login"];
                }
                if (dato['login'] == login) {
                    intentos = intentos + 1;
                } else {
                    intentos = 1;
                }


                $.ajax({
                    type: 'post',
                    url: 'ajax.php',
                    dataType: 'text',
                    data: {
                        'opcion': 'validarLogin',
                        'login': dato['login'],
                        'clave': dato['clave'],
                        'intentos': intentos
                    },
                    statusCode: {
                        404: function() {
                            alert("página no encontrada");
                        }
                    },
                    success: function(result) {
                        $('#capaLogin').empty();
                        $('#capaLogin').html(result);
                        if ($('#errorGeneralLogin').val() == "Usuario Bloqueado" || $('#errorGeneralLogin').html() == "Usuario Bloqueado.<br>Debe esperar que un administrador desbloquee la cuenta.<br>") {
                            intentos = 0;
                        }
                        if ($("#errorGeneralLogin").text() == "") {
                            $('#textoLogin').text(dato['login']);
                            datosaServidor("mostrarCabeceraUsuario", {
                                "login": $("#inputLogin").val()
                            }, "");

                            rellenarTabla($("#inputLogin").val());
                            $("#capaLogin").empty();
                        }

                        if ($("errorGeneralLogin").text() == "admin") {
                            $("#textoLogin").text("dwes");
                            datosaServidor("mostrarCabeceraUsuario", {
                                "login": "dwes"
                            }, "");
                        }

                    },
                    error: function(result) {
                        alert("Resultado " + result);
                    }
                });

            } else {
                $('#errorGeneralLogin').text("Debe introducir un usurio y una clave valida");
            }
            break;

        case "validarRegistro":

            if (validarDatos('login', dato['login']) &&
                validarDatos('password', dato['clave']) &&
                validarDatos('password', dato['clave2']) &&
                validarDatos('email', dato['email'])) {

                $.ajax({
                    type: 'post',
                    url: 'ajax.php',
                    dataType: 'text',
                    data: {
                        'opcion': 'validarRegistro',
                        'login': dato['login'],
                        'clave': dato['clave'],
                        'clave2': dato['clave2'],
                        'email': dato['email']
                    },
                    statusCode: {
                        404: function() {
                            alert('Página no encontrada');
                        }
                    },
                    success: function(result) {
                        if (result != "correcto") {
                            $('#capaLogin').empty();
                            $('#capaLogin').html(result);
                            $('#registrarse').click(function(e) {
                                e.preventDefault();
                                datosaServidor("validarRegistro", {
                                    'login': $('#inputLoginRegistro').val(),
                                    'clave': $('#inputPassword1Registro').val(),
                                    'clave2': $('#inputPassword2Registro').val(),
                                    'email': $('#inputEmailRegistro').val()
                                }, '');
                            })
                        } else {
                            $('#capaLogin').empty();
                        }
                    },
                    error: function(result) {
                        alert("resultado " + result);
                    }
                });
            } else {
                // alert("dentro validar registros");
                $('#errorGeneralRegistro').text("Debe introducir los datos correctos");
            }



            break;
        case "validarAnuncio":
            // console.log(dato);
            if (validarDatos('fecha', dato['fecha']) && validarDatos('moroso', dato['moroso']) && validarDatos('localidad', dato['localidad']) && validarDatos('descripcion', dato['descripcion'])) {
                $.ajax({
                    type: 'post',
                    url: 'ajax.php',
                    dataType: 'text',
                    data: {
                        'opcion': 'crearAnuncio',
                        'login': dato['login'],
                        'fecha': dato['fecha'],
                        'moroso': dato['moroso'],
                        'localidad': dato['localidad'],
                        'descripcion': dato['descripcion']
                    },
                    statusCode: {
                        404: function() {
                            alert("Página no encontrada");
                        }
                    },
                    success: function(result) {
                        // console.log(result);
                        if (result === "correcto") {
                            //actualiza la lista
                            rellenarTabla(dato['login']);
                            $("#formularioAnuncio").addClass("oculto");
                        }
                    },
                    error: function(result) {
                        alert('Resultado ' + result);
                    }
                });
            }
            break;
        case "modificarAnuncio":
            // console.log(dato['login']);ok
            if (validarDatos('fecha', dato['fecha']) && validarDatos("moroso", dato['moroso']) && validarDatos('localidad', dato['localidad']) && validarDatos('descripcion', dato['descripcion'])) {
                $.ajax({
                    type: 'post',
                    url: 'ajax.php',
                    dataType: 'text',
                    data: {
                        'opcion': 'crearAnuncio',
                        'login': dato['login'],
                        'fecha': dato['fecha'],
                        'moroso': dato['moroso'],
                        'localidad': dato['localidad'],
                        'descripcion': dato['descripcion'],
                        'id_anuncio': dato['id_anuncio']
                    },

                    statusCode: {
                        404: function() {
                            alert("Página no encontrada");
                        }
                    },
                    success: function(result) {

                        if (result === "correcto") {
                            rellenarTabla(dato['login']);
                            $("#formularioAnuncio").addClass('oculto');
                        } else {
                            $('#formularioAnuncio').empty();
                            $('#formularioAnuncio').html(result);
                        }
                    },
                    error: function($result) {
                        alert("Resultado: " + result);
                    }
                });

            }
            break;
        case "eliminarAnuncio":
            $.ajax({
                type: 'post',
                url: 'ajax.php',
                dataType: 'text',
                data: {
                    'opcion': 'crearAnuncio',
                    'id_anuncio': dato['id_anuncio'],
                    'eliminar': 'eliminar'
                },
                statusCode: {
                    404: function() {
                        alert('Página no encontrada');
                    }
                },
                success: function(result) {
                    console.log(result);
                    if (result === "correcto") {
                        //console.log(dato['login']);
                        rellenarTabla(dato['login']);
                        $('#formularioAnuncio').addClass('oculto');
                    } else {
                        $('#formularioAnuncio').empty();
                        $('#formularioAnuncio').html(result);
                    }
                },
                error: function(result) {
                    alert("Resultado " + result);
                }
            });

            break;
        case "mostrarCabeceraUsuario":
            $.ajax({
                type: 'post',
                url: 'ajax.php',
                data: {
                    "opcion": "mostrarCabeceraUsuario",
                    "login": dato['login']
                },
                dataType: 'text',
                statusCode: {
                    404: function() {
                        alert("página no encontrada");
                    }
                },

                success: function(result) {
                    $('#navCabecera').empty();
                    $('#navCabecera').html(result);
                    $("#botonCrearAnuncionUsuario").click(function(e) {
                        e.preventDefault();
                        mostrarFormulario("agregarAnuncio");
                    });

                    $('#botonListadoDeAnuncios').click(function(e) {
                        e.preventDefault();
                        $('#formularioCrearAnuncio').empty();
                        $('#formularioCrearAnuncio').addClass('oculto');
                        rellenarTabla($("#textoLogin").text());
                    });

                    $('#botonPreferencias').click(function(e) {
                        e.preventDefault();
                        mostrarFormulario('mostrarPreferencias');
                    });
                    console.log($('#textoLogin').text());

                    if ($("#textoLogin").text() == "dwes") {
                        $('#botonDesbloquear').click(function(e) {
                            e.preventDefault();
                            mostrarFormulario("mostrarDesbloquear");
                        });
                    }
                },
                error: function(result) {
                    alert("Resultado: " + result);
                }
            });
            break;
        case "mostrarPreferencias":
            $.ajax({
                type: 'post',
                url: 'ajax.php',
                data: {
                    'opcion': 'mostrarPreferencias',
                    'colorFondo': colorFondo
                },
                dataType: 'text',
                statusCode: {
                    404: function() {
                        alert("página no encontrada");
                    }
                },
                success: function(result) {

                    $('#formularioCrearAnuncio').html(result);
                    $('#formularioCrearAnuncio').removeClass('oculto');
                    $('#botonGuardarPreferencias').click(function(e) {
                        e.preventDefault();
                        $('body').css('background-color', $('#colorFondo').val());
                        $('html').css('background-color', $('#colorFondo').val());
                        colorFondo = $('#colorFondo').val();
                    });
                    $('#botonRestablecerPreferencias').click(function(e) {
                        e.preventDefault();
                        $('body').css('background-color', "#ffffff");
                        $('html').css('background-color', "#ffffff");
                        $('#colorFondo').val("#ffffff");
                    });

                }
            });
            break;
        case "mostrarDesbloquear":
            break;
        case "desbloquear":
            break;

    }
}


/*Función que se encarga de crear los anuncios recibidos por Ajax.
 * @param string texto: Es el login del usuario.
 * */

function rellenarTabla(texto) {
    $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: {
            'opcion': 'mostrar',
            'texto': texto
        },
        dataType: 'text',
        statusCode: {
            404: function() {
                alert("página no encontrada");
            }
        },
        success: function(result) {
            $('#capaAnuncios').empty(result);
            $('#capaAnuncios').html(result);
            $('.mapa').each(function(index, elemento) {
                let destino = elemento.innerHTML;
                //recupeamos la dirección
                //  console.log(destino);
                let id = elemento.id.substring(5, elemento.id.length);
                //console.log(id);
                arrayDestinos[id] = destino;
                //cuando pulsamos el boton mapa + id
                $('#mapa' + id).click(function(e) {
                    e.preventDefault();
                    if (unclick === 0) {
                        if ("geolocation" in navigator) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                let lat = position.coords.latitude;
                                let lang = position.coords.longitude;
                                iniciar(elemento, position.coords.latitude, position.coords.longitude, destino);

                                $('#formNuevoOrigen' + id).removeClass("oculto");
                                // console.log($("#mapid" + id));
                                $('#mapid' + id).css("height", "30vh");
                                $("#mapid" + id).css("width", "92vw");
                                $("#mapid" + id).css("display", "flex");
                                $("#mapid" + id).css("flex-flow", "column nowrap");
                                unclick = 1;
                            });
                        } else {
                            console.log("El navegador no soporta geolocalización");
                        }
                    } else {
                        $("#mapid" + id).css("height", "");
                        $("#mapid" + id).css("width", "");
                        $("#mapid" + id).css("display", "");
                        $("#mapid" + id).css("flex-flow", "");
                        unclick = 0;
                        $("#formNuevoOrigen" + id).addClass("oculto");
                    }
                })
            });

            $('.botonNuevoOrigen').each(function(index, elemento) {
                let id = elemento.id.substring(16, elemento.id.length);
                $('#botonNuevoOrigen' + id).click(function(e) {
                    e.preventDefault();
                    direccionRendererArray["mapid" + id].setMap(null);
                    direccionRendererArray["mapid" + id].setMap(mapasArray["mapid" + id]);
                    calculateAndDisplayRoute(direccionServiceArray["mapid" + id], direccionRendererArray["mapid" + id], $("#nuevoOrigen" + id).val(), id);
                    $("#formNuevoOrigen" + id).removeClass("oculto");
                });
            });

            $(".botonModificar").each(function(index, elemento) {
                let id = elemento.id.substring(14, elemento.id.length);
                $("#botonModificar" + id).click(function(e) {
                    e.preventDefault();
                    mostrarFormulario("mostrarModificarAnuncio", id);
                    // console.log("dentro modi");
                });
            });

            $('.botonEliminar').each(function(index, elemento) {
                // console.log(elemento.id);
                let id = elemento.id.substring(13, elemento.id.length);
                $("#botonEliminar" + id).click(function(e) {
                    e.preventDefault();
                    //console.log('abajo'+id);
                    mostrarFormulario("mostrarEliminarAnuncio", id);
                });
            });
        },
        error: function(result) {
            alert("Resultado: " + result);
        }
    });
}


/*Función que se encarga de validar los datos.
 * @param string tipo: Es el tipo de dato a validar.
 * @param string valor: Es el valor a validar.
 */
function validarDatos(tipo, valor) {
    let correcto = false;
    switch (tipo) {
        case "login":
            if (valor.match(/^[a-zA-Z0-9 _-]{1,20}$/)) {
                correcto = true;
            }
            break;
        case "password":
            if (valor.match(/^[a-zA-Z0-9._-]{1,128}$/)) {
                correcto = true;
            }
            break;
        case "fecha":
            if (valor.match(/^(([0-9]{4})([-]{1})([0-9]{2})([-]{1})([0-9]{2}))$/)) {
                correcto = true;
            }
            break;
        case "moroso":
            if (valor.match(/^[a-zA-Z0-9ÁÉÍÓÚáéíóú _-]{1,60}$/)) {
                correcto = true;
            }
            break;
        case "localidad":
            if (valor.match(/^[a-zA-Z0-9ñÑÁÉÍÓÚáéíóú, ]{1,60}$/)) {
                correcto = true;
            }
            break;
        case "descripcion":
            if (valor.match(/^[a-zA-ZáéíóúÁÉÍÓÚ0-9€ ,.\"_-]{1,500}$/)) {
                correcto = true;
            }
            break;
        case "email":
            if (valor.match(/^[A-z0-9\._-]+@[A-z0-9][A-z0-9-]*(\.[A-z0-9_-]+)*\.([A-z]{2,6})$/)) {
                correcto = true;
            }
            break;
    }
    return correcto;
}

/*Función que se encarga de generar los mapas 
 * de los anuncios.
 * @param string elemento: Elemento donde es va a mostrar.
 * @param string lat: Latitud de la posición actual del usuario.
 * @param string lng: Longitud de la posición actual del usuario.
 * @param string destino: Destino del anuncio.
 */
function iniciar(elemento, lat, lng, destino) {
    let geocoder = new google.maps.Geocoder();
    let directionsService = new google.maps.DirectionsService();
    let directionsRenderer = new google.maps.DirectionsRenderer();
    let map = new google.maps.Map(elemento, {
        zoom: 7,
        center: {
            lat: lat,
            lng: lng
        }
    });
    mapasArray[elemento.id] = map;
    direccionRendererArray[elemento.id] = directionsRenderer;
    direccionRendererArray[elemento.id].setMap(map);
    direccionServiceArray[elemento.id] = directionsService;
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({
        'location': latlng
    }, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
                map.setZoom(11);
                let origen = results[0].formatted_address;
                directionsService.route({
                    origin: origen,
                    destination: destino,
                    optimizeWaypoints: true,
                    travelMode: 'DRIVING'
                }, function(response, status) {
                    if (status === 'OK') {
                        var route = response.routes[0];
                        directionsRenderer[elemento.id] = directionsRenderer.setDirections(response);
                        directionsRenderer.setDirections(response);
                    } else {
                        window.alert('No existe la dirección');
                    }
                });
            } else {
                window.alert('No results found');
            }
        } else {
            window.alert('Geocoder failed due to: ' + status);
        }
    });
    $("#" + elemento.id).toggleClass("oculto");
}

/*Función que se encarga de recalcular las rutas de los mapas 
 * de los anuncios.
 * @param string directionsService: Servicio de dirección de google usadado.
 * @param string directionsRenderer: Servicio de renderizado de google.
 * @param string nuevoOrigen: Nueva ruta de inicio
 * @param string indice: Es el id del anuncio  .
 */

function calculateAndDisplayRoute(directionsService, directionsRenderer, nuevoOrigen, indice) {
    directionsService.route({
            origin: nuevoOrigen,
            destination: arrayDestinos[indice],
            travelMode: 'DRIVING'
        },
        function(response, status) {
            if (status === 'OK') {
                directionsRenderer[indice] = directionsRenderer.setDirections(response);
                directionsRenderer.setDirections(response);
            } else {
                window.alert("Debe introducir una dirección");
            }
        });
}