/*CODI JS IDENTITY EYE*/
var estacio;

$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('content_sidebar');
    });

    $('#sidebarCollapse2').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('content_sidebar');
    });

    $('#logout').on('click', function () {
        document.getElementById('logout-form').submit();
    });

    //Panell de Login Visible
    $('#panell_login').fadeIn(1500);
    $('#panell_registre').fadeIn(1500);

    //Alertes de no loguejat
    $( ".no_loguejat" ).click(function() {
        swal("La curiosidad mató al gato!", "Inicia Sesión Primero 😀", "error");
    });

    //Botó de tornar Login i Registrar
    $('#btn_tornar').on('click', function () {
       $(location).attr('href',config.rutes[0].inici);
    });
    //Botó Editar Perfil i Eliminar Perfil
    $('#btn_editarPerfil').on('click', function () {
       $(location).attr('href',config.rutes[0].editarPerfil);
    });
    $('#btn_eliminarPerfil').click(function() {
        //Llancem el missatge de confirmacio
        swal({
            title: "Seguro que quieres eliminarlo?",
            text: "• Se eliminarán todos los datos del usuario!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                var id = $(this).attr('data-id');
                eliminar_perfil(id);
            } else {
              swal("Todos nos merecemos una segunda oportunidad!");
            }
        });

    });

   //Event al text-box del buscador d'usuaris
    $('#filtrar').keyup(function () {

        var rex = new RegExp($(this).val(), 'i');

        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    });

    //Si existeix el cercador a la pagina apliquem l'ajax per mostrar usuaris
    if ($( "#filtrar" ).length) {
        id = config.rutes[0].id_usuari;
        var dades = {
        "id" : id
        };

        var data = JSON.stringify(dades);
            $.ajax({
                data: data,
                type: 'POST',
                url: config.rutes[0].ajax_buscador,
                cache: false,
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                datatype: 'JSON',
                processData: false,
                success: function (response) {
                    $('.buscar').html(response);

                    $('.buscar #btn_eliminarPerfil').click(function() {
                        //Llancem el missatge de confirmacio
                        swal({
                            title: "Seguro que quieres eliminarlo?",
                            text: "• Se eliminarán todos los datos del usuario!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                          })
                          .then((willDelete) => {
                            if (willDelete) {
                                var id = $(this).attr('data-id');
                                $(this).parents('tr:first').remove();
                                eliminar_perfil(id);
                            } else {
                              swal("Todos nos merecemos una segunda oportunidad!");
                            }
                        });
                    });
                },
                error: function (response) {
                    console.log(response);
                }
            });
    }

    //Marcar el dia del calendari
    var f = new Date();
    var dia = ".dia"+f.getDate();
    console.log(dia);
    if ( $( "td" ).length ) {$(dia)[0].style.backgroundColor = "#C70039";}
    if ( $( "td" ).length ) {$(dia)[0].style.color = "white";}

    //Marcar el checkbox de tots els colors
    if ( $('.colors').length) { $(".col-sm-2 input[type=checkbox]").prop('checked', true); }

    //Marcar el maxlength dels inputs
    $("input").attr('maxlength','16');
    $("#input_titular").attr('maxlength','255');
    $("#email").attr('maxlength','35');
    $("#cognoms").attr('maxlength','30');
    $("#poblacion").attr('maxlength','19');
    $("#ofici").attr('maxlength','19');

    //Marcar que els inputs de tipus number no siguin editables
    if( $("[type='number']").length) {
        $("[type='number']").keypress(function (evt) {
            evt.preventDefault();
        });
    }

    $('.btn_comprarCombinacio').click(function() {
        swal({
            title: "Quieres añadir estas piezas al carrito?",
            text: "• Se guardara las dos piezas en tu carrito personal!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                swal("Combinación añadida al Carrito!", "Te quedará genial ◕‿◕", "success");
            }
        });
    });

    $('.btn_eliminarCombinacio').click(function() {

        swal({
            title: "Quieres eliminar la combinación?",
            text: "• Se eliminarán de tu colección personal!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                //Seleccionem els id de les peses per passaro al controlador, els id estan als botons de cada apartat
                var id_pesa1 = $(this).parent().children('.col-sm-3').children('.comprar-bto:eq(0)').attr('data-id');
                var id_pesa2 = $(this).parent().children('.col-sm-3').children('.comprar-bto:eq(1)').attr('data-id');

                var dades = {
                    "id1" : id_pesa1,
                    "id2" : id_pesa2
                };

                var data = JSON.stringify(dades);
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: config.rutes[0].ajax_eliminarCombinacio,
                    cache: false,
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    datatype: 'JSON',
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        swal("Combinación Eliminada!", "A mí tampoco me gustaba", "success");
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });

                $(this).parent().fadeOut('slow');
            }
        });

    });

    //Opcio de triar la quantitat de roba
    $(".incr-btn").on("click", function (e) {
        var $button = $(this);
        var oldValue = $button.parent().find('.quantity').val();
        $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
        if ($button.data('action') == "increase") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below 1
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
                $button.addClass('inactive');
            }
        }
        $button.parent().find('.quantity').val(newVal);
        e.preventDefault();
    });

    $('.btn_comprarRoba').click(function() {

        var id_producte = $(this).attr('data-id');
        //Silbings es germa i children fill
        var nom_producte = $(this).siblings('.titol-productes').text();
        var quant_producte = $(this).siblings('.count-input').children('.quantity').val();

        swal({
            title: "Quieres añadir "+quant_producte+" "+nom_producte+" al carrito?",
            text: "• Se guardará la pieza en tu carrito personal!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                swal("Pieza añadida al carrito!", "Gracias por confiar con IdentityEYE! ♥ ", "success");
            }
        });

    });


});

//Funcions Codi

//Funcio del primerPerfil input tonalitat_pell
function tonalitat_pell(){
    $("#select_pel").val('0');
    var color_pell = $("#select_pell")[0].value;
    if (color_pell == "Cálida"){
        $("#color_1").css('backgroundColor', '#F4CCCC');
        $("#color_1").css('height', '25px');
        $(".opcio3").css('backgroundColor', '#FCE5CD');
        $(".opcio4").css('backgroundColor', '#E6B8AF');
        $("#div_pel").fadeIn(1500);
    }else if (color_pell == "Fría"){
        $("#color_1").css('backgroundColor', '#CFE2F3');
        $("#color_1").css('height', '25px');
        $(".opcio3").css('backgroundColor', '#D9EAD3');
        $(".opcio4").css('backgroundColor', '#D0E0E3');
        $("#div_pel").fadeIn(1500);
    }
}

//Funcio del primerPerfil input tonalitat_pel
function tonalitat_pel(){
    var color_pell = $("#select_pell")[0].value;
    var color_pel = $("#select_pel")[0].value;
    $("#color_2").css('height', '25px');
    if (color_pell == "Cálida" && color_pel == "Claro"){
        //Primavera
        estacio = "primavera";
        $("#color_2").css('backgroundColor', '#FCE5CD');
    }else if(color_pell == "Cálida" && color_pel == "Oscuro"){
        //Otoño
        estacio = "otoño";
        $("#color_2").css('backgroundColor', '#E6B8AF');
    }else if(color_pell == "Fría" && color_pel == "Claro"){
        //Verano
        estacio = "verano";
        $("#color_2").css('backgroundColor', '#D9EAD3');
    }else if(color_pell == "Fría" && color_pel == "Oscuro"){
        //Invierno
        estacio = "invierno";
        $("#color_2").css('backgroundColor', '#D0E0E3');
    }
    $("#boto").fadeIn(1500);
}


function triar_subestacio(){
    var dades = {
        "estacio" : estacio
    };
    var data = JSON.stringify(dades);
    $.ajax({
        data: data,
        type: 'POST',
        url: config.rutes[0].ajax_subestacio,
        cache: false,
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        datatype: 'JSON',
        processData: false,
        success: function (response) {
            $('#div_subestacio').html(response);
            $('#div_subestacio').fadeIn(1500);
            $('#boto_enviar_primer_perfil').fadeIn(1500);
        },
        error: function (response) {
            console.log(response);
        }
    });
}
function eliminar_perfil(id){

    var dades = {
        "id" : id
    };
    var data = JSON.stringify(dades);
    $.ajax({
        data: data,
        type: 'POST',
        url: config.rutes[0].ajax_eliminar,
        cache: false,
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        datatype: 'JSON',
        processData: false,
        success: function (response) {
            swal("Usuario Eliminado!", "Uno menos!", "success");

        },
        error: function (response) {
            console.log(response);
        }
    });
}
