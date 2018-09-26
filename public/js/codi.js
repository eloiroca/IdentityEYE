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

    //CARRITO DE LA COMPRA
    actualitzarCarrito();

    //Botó Obrir Carrito
    $('#btn_carrito').click(function() {
       if ($('#div_carrito').css('display') == 'none'){
         $('#div_carrito').fadeIn(1500);
       }else{
         $('#div_carrito').fadeOut(1500);
       }
    });
    $('.img_tancar_carrito').click(function() {
       $('#div_carrito').fadeOut();
    });



    $("#btn_buidar_carrito").on("click", function (e) {

        var nom_usuari = 'cookie_carrito_'+$('#nom_usuari_ocult').text();
        document.cookie = nom_usuari + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        actualitzarCarrito();

    });

    $("#btn_comprar_carrito").on("click", function (e) {


        swal({
            title: "Listo! Vamos a proceder al último paso. Pagar.",
            text: "Gracias por confiar con IdentityEYE! ♥ ",
            icon: "warning",
            buttons: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $(location).attr('href',config.rutes[0].pagamentcarrito);

            }
        });

    });

    $('.btn_comprarRoba').click(function() {

        var id_producte = $(this).attr('data-id');
        //Silbings es germa i children fill
        var nom_producte = $(this).siblings('.titol-productes').text();
        var quant_producte = $(this).siblings('.count-input').children('.quantity').val();
        var foto_producte = $(this).siblings('.imatge-productes')[0].src;

        var dades = {
            "id_producte" : id_producte,
            "quant_producte" : quant_producte,
            "foto_producte" : foto_producte
        };

        var data = JSON.stringify(dades);

        swal({
            title: "Quieres añadir "+quant_producte+" "+nom_producte+" al carrito?",
            text: "• Se guardará la pieza en tu carrito personal!",
            icon: "warning",
            buttons: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                  data: data,
                  type: 'POST',
                  url: config.rutes[0].ajax_comprarRoba,
                  cache: false,
                  headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  datatype: 'JSON',
                  processData: false,
                  success: function (response) {
                      actualitzarCarrito();
                      swal("Pieza añadida al carrito!", "Gracias por confiar con IdentityEYE! ♥ ", "success");
                  },
                  error: function (response) {
                      actualitzarCarrito();
                      swal("Error!", "Ha ocurrido un error al añadir la pieza al carrito, intentalo de nuevo más tarde", "error");
                      console.log(response);
                  }
              });
            }
        });

    });



});

//Funcions Codi

function borrar_pesa_carrito(elmnt){
    var id_producte = elmnt.getAttribute("data-id");
    var quant_producte = elmnt.getAttribute("data-quant");

    if(quant_producte == 1){
      swal({
          title: "Quieres eliminar el producto del carrito?",
          text: "• Se eliminará del carrito!",
          icon: "warning",
          buttons: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            var dades = {
                "id_producte" : id_producte,
                "quant_producte" : quant_producte,
                "accio" : 'eliminar'
            };

            var data = JSON.stringify(dades);

            $.ajax({
              data: data,
              type: 'POST',
              url: config.rutes[0].ajax_eliminarPesaCarrito,
              cache: false,
              headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              datatype: 'JSON',
              processData: false,
              success: function (response) {
                  //console.log(response);
                  actualitzarCarrito();
                  swal("Pieza eliminada del carrito!", "Gracias por confiar con IdentityEYE! ♥ ", "success");
              },
              error: function (response) {
                  actualitzarCarrito();
                  swal("Error!", "Ha ocurrido un error al eliminar la pieza al carrito, intentalo de nuevo más tarde", "error");
                  //console.log(response);
              }
          });




          }
          });

    }else{

        swal("Cambiar cantidad del producto, '0' Si quieres eliminarla", {
          content: {
            element: "input",
            attributes: {
              type: "number",
            },
          },
        }).then((value) => {
          var nova_quant_producte = value;
          swal({
              title: "Quieres modificar la cantidad del producto a "+nova_quant_producte+" unidades?",
              text: "• Se actualizará la pieza en tu carrito personal!",
              icon: "warning",
              buttons: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                var dades = {
                    "id_producte" : id_producte,
                    "quant_producte" : nova_quant_producte,
                    "accio" : 'modificar'
                };

                var data = JSON.stringify(dades);


                  $.ajax({
                    data: data,
                    type: 'POST',
                    url: config.rutes[0].ajax_eliminarPesaCarrito,
                    cache: false,
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    datatype: 'JSON',
                    processData: false,
                    success: function (response) {
                        //console.log(response);
                        actualitzarCarrito();
                        swal("Pieza modifcada del carrito!", "Gracias por confiar con IdentityEYE! ♥ ", "success");
                    },
                    error: function (response) {
                        actualitzarCarrito();
                        swal("Error!", "Ha ocurrido un error al modificar la pieza del carrito, intentalo de nuevo más tarde", "error");
                        //console.log(response);
                    }
                });
              }
              });
        });
  }
}

//Funcio per actualitzar el carrito
function actualitzarCarrito(){

      $.ajax({
          data: 0,
          type: 'POST',
          url: config.rutes[0].ajax_actualitzarCarrito,
          cache: false,
          headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          datatype: 'JSON',
          processData: false,
          success: function (response) {

              var len = response.length;

              if (len == 1){
                  $('#contingut_carrito').html("<h3 class='h3_carrito'>No tienes ninguna pieza aún!</h3>");
                  $('#btn_buidar_carrito').css('display', 'none');
                  $('#btn_comprar_carrito').css('display', 'none');
                  $('#total').css('display', 'none');

              }else{
                  var resposta = JSON.parse(response);

                  var taula = "<table class='taula_carrito' border='1'><thead><tr><th colspan='2'>Pieza</th><th>Unidades</th><th>Precio</th><th></th></tr></thead>";

                  for (i in resposta){
                      taula += "<tr>"
                      for (var e=0; e<resposta[i].length-1; e++){
                              taula += "<td class='apartat_carrito'>"+resposta[i][e]+"</td>";
                      }
                      taula +="<td><button id='btn_eliminarPesaCarrito' class='btn btn-danger btn_borrar_pesa_carrito' data-id='"+resposta[i][4]+"' data-quant='"+resposta[i][2]+"' onclick='borrar_pesa_carrito(this);'><span class='glyphicon glyphicon-remove'></button></td></tr>"
                  }

                  $('#contingut_carrito').html(taula);


                  //Calcular total carrito
                  var total = 0;
                  $('.preu_producte').each(function(){
                      total += parseFloat($(this).text(), 10);
                  });
                  total = total.toFixed(2);

                  if ($('.apartat_carrito').length != 0){
                      $('#total').css('display', 'block');
                      $('.total_carrito').text(total).css('display', 'inline');
                  }else{$('#total').css('display', 'none');}

                  $('.total_carrito').text(total);

                  $('#btn_buidar_carrito').fadeIn(1000);
                  $('#btn_comprar_carrito').fadeIn(1000);

              }
              $('.num_productes').text('('+$('.taula_carrito').children('tbody').children('tr').length+')')
          },
          error: function (response) {
              console.log(response);
          }
      });

    }

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
