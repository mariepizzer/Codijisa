function ocultar_numeros() {

    $('.basic-addon1').toggle(function () {
        $(".basic-addon1").css({display: "inline"});
    }, function () {
        $(".basic-addon1").css({display: "none"});
    });
} 

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function actualizar_ingrediente(idIngrediente){
    var Cat = $("#Categoria_"+idIngrediente+" option:selected").text();
    url="semana/ingrediente/editar";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idIngrediente:idIngrediente,
            Categoria:Cat,
            Nombre:$("#Nombre_"+idIngrediente).val(),
            Comentario:$("#Comentario_"+idIngrediente).val(),
        },
    })
    .done(function(html) {

        if(html==1)
        {
            $("#boton_actualizar_"+idIngrediente).removeClass('boton_actualizar').addClass('boton_actualizado');
            
        }else{
            $("#boton_actualizar_"+idIngrediente).removeClass('boton_actualizar').addClass('boton_no_actualizado');
        }
        
    })
    .fail(function() {
        console.log("Error actualizar_ingrediente");
    });
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function borrar_ListaSemana(){
    $("#resultado").hide().fadeOut("Fast");
    $("#resultado").html("");
    $("#listalista").html("").fadeOut("Fast");
    $(".plato_o_ingrediente").html("").fadeOut("Fast");
    
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function ProcesarLista(){
    url="semana/procesar_lista";
    $.ajax({
        async:false,
        cache:false,
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {},
    })
    .done(function(html) {

        $("#resultado").hide().fadeIn("Fast");
        $("#resultado").html("");

        $("#listalista").html("").fadeOut("Fast");
        $("#listalista").html(html).fadeIn("Fast");
    })
    .fail(function() {
        console.log("Error mostrar_Lista_Procesada");
    }); 
    //$("#botonProcesarLista > span").removeClass('glyphicon-refresh-animate');   
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
 
function mostrar_Lista_Procesada()
{
    url="semana/cargar_Lista_Lista";
    $.ajax({
        async:false,
        cache:false,
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {},
    })
    .done(function(html) {

        $("#resultado").hide().fadeIn("Fast");
        $("#resultado").html("");

        $("#listalista").html("").fadeOut("Fast");
        $("#listalista").html(html).fadeIn("Fast");
        document.getElementById("listalista").scrollIntoView();
        $("#botonProcesarLista > span").removeClass("glyphicon-refresh-animate");
    })
    .fail(function() {

        console.log("Error mostrar_Lista_Procesada");
    }); 
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function guardar_item_semana(turno, dia, Tipo, Id){

    //console.log(Tipo+" "+Id +" "+ dia+" "+turno); 
            url="semana/guardar_item_semana";
            $.ajax({
                async:false,
                cache:false,
                
                url: VariablesPHP.base_url+url,
                type: 'POST',
                dataType: 'html',
                data: {
                    Dia:dia,
                    Turno:turno,
                    Tipo:Tipo,
                    Id:Id,
                },
            })
            .done(function(html) {

                if(html==1)
                {
                    //console.log("Item guardado en la semana. ID:"+ Id+" Dia:"+ dia+"  Tipo:"+ Tipo+" Turno:"+ turno);
                }else{
                    //console.log("Plato no guardado.");
                }
                
            })
            .fail(function() {
                //console.log("Error turno "+turno);
            });    
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function resetear_semana_y_lista(){

            url="semana/resetear_semana_y_lista";
            $.ajax({
                async:false,
                cache:false,
                url: VariablesPHP.base_url+url,
                type: 'POST',
                dataType: 'html',
                data: {
                },
            })
            .done(function(html) {
                //console.log("resetear_semana_y_lista: "+html);
            })
            .fail(function() {
                //console.log("Error fail resetear_semana_y_lista ");
            });    
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function guardarsemana_y_procesarLista(){
    console.log("PROCESANDO LISTA...");

    $("#botonProcesarLista > span").addClass('glyphicon-refresh-animate');
    semana = [];
    resetear_semana_y_lista();
    var dia = 0;
    var Tipo;
    var Id;

    $('#desayuno td').each(function() {
        dia++;
        Tipo = $(this).find("div p.Tipo").html();
        Id = $(this).find("div p.Id").html();
        
        $(this).find("div").each(function() {
          Id = $(this).find("p.Id").html();
          Tipo = $(this).find("p.Tipo").html();
          semana.push({Turno: 1, Dia: dia, Tipo: Tipo, Id: Id});
        });
    });

    dia = 0;
    $('#almuerzo td').each(function() {
        dia++;
        Tipo = $(this).find("div p.Tipo").html();
        Id = $(this).find("div p.Id").html();
        
        $(this).find("div").each(function() {
          Id = $(this).find("p.Id").html();
          Tipo = $(this).find("p.Tipo").html();
          semana.push({Turno: 2, Dia: dia, Tipo: Tipo, Id: Id});
        });
    });

    dia = 0;
    $('#cena td').each(function() {
        dia++;
        Tipo = $(this).find("div p.Tipo").html();
        Id = $(this).find("div p.Id").html();
        
        $(this).find("div").each(function() {
          Id = $(this).find("p.Id").html();
          Tipo = $(this).find("p.Tipo").html();
          semana.push({Turno: 3, Dia: dia, Tipo: Tipo, Id: Id});
        });
    });

    console.log(semana);
    semana.forEach(item => guardar_item_semana(item['Turno'], item['Dia'], item['Tipo'], item['Id']));  

    ProcesarLista();
    mostrar_Lista_Procesada();
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function agregar_ingrediente_plato(idPlato){

    var Ingrediente = $("#Frase_ingrediente").typeahead("getActive");
    
    if (Ingrediente) {
        // Some item from your model is active!
        if (Ingrediente.name == $("#Frase_ingrediente").val()) {
          
            url="semana/plato/agregar_ingrediente";
            $.ajax({
                url: VariablesPHP.base_url+url,
                type: 'POST',
                dataType: 'html',
                data: {
                    idPlato:idPlato,
                    idIngrediente:Ingrediente.idIngrediente,
                },
            })
            .done(function(html) {
                
                if(html==1)
                {
                    var $tr_original = $('tr[id="nueva_fila"]');
                    var $tr_nuevo = $tr_original.clone().prop('id', 'ingrediente_'+idPlato+'_'+Ingrediente.idIngrediente);
                    $tr_original.after($tr_nuevo);
                    $("#ingrediente_"+idPlato+"_"+Ingrediente.idIngrediente).css("display","table-row");
                    $("#ingrediente_"+idPlato+"_"+Ingrediente.idIngrediente +" td:nth-child(1) p").html(Ingrediente.name);
                    $("#ingrediente_"+idPlato+"_"+Ingrediente.idIngrediente+" td:nth-child(2) button").attr("onclick","retirar_ingrediente_plato("+Ingrediente.idIngrediente+","+idPlato+")");
                    $tr_original = $('tr[id="nueva_fila"]');
                    $("#Frase_ingrediente").val("");
                    $("#Frase_ingrediente").focus();

                }else{
                    alert("Ingrediente no agregado a " + $("#Nombre").val() );
                }
                
            })
            .fail(function() {
                //console.log("Error agregar_ingrediente_plato");
                alert("El ingrediente ya está agregado a " + $("#Nombre").val() );
            });
        } else {
            crear_ingrediente_desde_plato(idPlato);

        }
    } else {
    // Nothing is active so it is a new value (or maybe empty value)
    }
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function crear_ingrediente_desde_plato(idPlato){
    var Ingrediente = $("#Frase_ingrediente").typeahead("getActive");

    if (Ingrediente) {
        
        if (Ingrediente.name == $("#Frase_ingrediente").val()) {
              //console.log("COINCIDE");
            } else {
                //console.log("NO COINCIDE");
                    url="semana/crear_ingrediente_desde_plato";
                    $.ajax({
                        url: VariablesPHP.base_url+url,
                        type: 'POST',
                        dataType: 'html',
                        data: {
                            Nombre_ingrediente:$("#Frase_ingrediente").val(),
                        },
                    })
                    .done(function(nuevoIdIngrediente) {

                        if(nuevoIdIngrediente!=0)
                        {
                            //alert("Ingrediente creado." +nuevoIdIngrediente);
                        }else{
                            //console.log("Ingrediente no creado."+nuevoIdIngrediente);
                        }
                        
                    })
                    .fail(function() {
                        //console.log("Error crear_ingrediente_desde_plato");
                    });
            }
    } else {
        //console.log("NO HAY ACTIVO");
    }
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

// AUTOCOMPLETE CON AJAX

$('.typeahead').typeahead({
  autoSelect:false,   
  source: function(Frase_ingrediente, result)
  {
    var idPlato = $("#idPlato").val();
    $.ajax({
        url:VariablesPHP.base_url+"semana/buscar_ingredientes",
        method:"POST",
        data:{Frase_ingrediente:Frase_ingrediente, idPlato:idPlato},
        dataType:"JSON",
        success:function(data)
            {           
             result($.map(data, function(item){
                //console.log("item.name: " + item.name);
                //console.log("item.idIngrediente: "+ item.idIngrediente);
              return item;
             }));
            }
       })
  }
 });


$('.crear_plato').typeahead({
  autoSelect:false,   
  source: function(Nombre, result)
  {
    var idPlato = $("#idPlato").val();
    $.ajax({
        url:VariablesPHP.base_url+"semana/buscar_platos",
        method:"POST",
        data:{Nombre:Nombre},
        dataType:"JSON",
        success:function(data)
            {           
             result($.map(data, function(item){
                //console.log("item.name: " + item.name);
                //console.log("item.idIngrediente: "+ item.idIngrediente);
              return item;
             }));
            }
       })
  }
 });


//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function actualizar_plato(idPlato){
    var Cat = $("#Categoria  option:selected").text();

    url="semana/plato/editar";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idPlato:idPlato,
            Categoria:Cat,
            Nombre:$("#Nombre").val(),
            Comentario: $("#Comentario").val(),
        },
    })
    .done(function(html) {

        if(html==1)
        {
            alert("Plato actualizado." );
        }else{
            alert("Plato no actualizado.");
        }
        
    })
    .fail(function() {
        console.log("Error actualizar_plato");
    });
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function retirar_ingrediente_plato(idIngrediente, idPlato){

    url="semana/plato/retirar_ingrediente";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idIngrediente:idIngrediente,
            idPlato:idPlato,
        },
    })
    .done(function(html) {
        if(html==1){
            $("#ingrediente_"+idPlato+"_"+idIngrediente).hide().fadeOut("Fast");
            $("#ingrediente_"+idPlato+"_"+idIngrediente).remove();
        }
    })
    .fail(function(html) {
        //console.log("Error retirar_ingrediente_plato");

    });
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function borrar_plato(idPlato){

    url="semana/borrar_plato";
    alert("Borrando plato");
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idPlato:idPlato,
        },
    })
    .done(function(html) {
        if(html==1){
            location.href = VariablesPHP.base_url+'semana';
        }
    })
    .fail(function() {
        //console.log("Error borrar_plato");
    });
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function retirar_plato_o_ingrediente(idPlato){
    $("#"+idPlato).hide().fadeOut("Slow");
    $("#"+idPlato).remove();
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function buscar_plato_ingrediente(frase_a_buscar, origen)
{
    if(origen=='boton'){
        $("#frase_a_buscar").val(frase_a_buscar);        
    }

    if(frase_a_buscar==''){
        $("#botonBuscar > span").removeClass("glyphicon-refresh-animate");
        $("#resultado").hide().fadeIn("Fast");
        $("#resultado").html("");
        return;
    }

    $("#botonBuscar > span").addClass('glyphicon-refresh-animate');
    
    url="semana/buscar";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            VALfrase:frase_a_buscar
        },
    })
    .done(function(html) {
        
        $("#resultado").html("").fadeOut("Fast");
        $("#botonBuscar > span").removeClass("glyphicon-refresh-animate");
        $("#resultado").html(html).fadeIn("Fast");
    })
    .fail(function() {
        //console.log("Error buscar_plato");
    }); 
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

function limpiarBuscador()
{
    $("#frase_a_buscar").val("");
    $("#frase_a_buscar").focus();
    $("#resultado").html("").hide().fadeOut("Fast");
    //$("#ingredientes").hide().fadeIn("Fast");
}

//+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
