

function importar_productos(){

    url="importar_productos";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
        },
    })
    .done(function(resultado) {
        $("#resultado").html(resultado);
        
    })
    .fail(function() {
        alert("Error importar_productos");
    });
}

function importar_clientes(){

    url="importar_clientes";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
        },
    })
    .done(function(resultado) {
        $("#resultado").html(resultado);

    })
    .fail(function() {
        alert("Error importar_clientes");
    });
}


function guardar_celular(idCLIENTE){
    url="cliente/guardar_celular";
    Celular = $("#Celular").val();
    
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idCLIENTE:idCLIENTE,
            Celular: Celular,
        },
    })
    .done(function(html) {
        $("#Celular").val(Celular);
        $("#botonCelular").removeClass('btn-info');
        $("#botonCelular").removeClass('btn-warning');
        $("#botonCelular").addClass('btn-success');
        $("#cliente_a_buscar2").focus();
    })
    .fail(function() {
        alert("No se pudo guardar el número de celular " +Celular+".");
        $("#botonCelular").removeClass('btn-info');
        $("#botonCelular").removeClass('btn-warning');
        $("#botonCelular").addClass('btn-danger');
    });
}



function cargar_sincro(){

    url="usuario/cargar_sincro";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            Archivo: $('#archivo_sincro').val(),
        },
    })
    .done(function(html) {
        alert(html);
        if(html==1){
            alert("YES!");

        }
    })
    .fail(function() {
        alert("Error cargar_sincro");
    });
}

function pagarPremio(idMETA, Mes, idUsuario){

    url="meta/pagar_premio";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idMETA:idMETA,
            Mes:Mes,
            idUsuario:idUsuario,
        },
    })
    .done(function(html) {
        console.log(html);
        if(html==1){
            $("#META_"+idMETA).hide().fadeOut("Fast");
            $("#META_"+idMETA+" td:nth-child(5)").html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
            $("#META_"+idMETA).hide().fadeIn("Fast");

        }
    })
    .fail(function() {
        console.log("Error pagarPremio");
    });
}


function ventas_por_meta(idMETA){
    url="meta/ventas_por_meta";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idMETA:idMETA
        },
    })
    .done(function(html) {
        $("#ventas").html(html);
        
    })
    .fail(function() {
        console.log("Error ventas_por_meta");
    });
}

function actualizar_meta(idMETA){

    tipo_meta = $('#tipo_meta').find(":selected");
    Mostrar = $("#Mostrar").is(':checked');
    Prioridad = $("#Prioridad").is(':checked');
    url="meta/actualizar";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idMETA:idMETA,
            Tipo_Meta:$("#Tipo_Meta").val(),
            Nombre_Meta:$("#Nombre_Meta").val(),
            Incentivo:$("#Incentivo").val(),
            Cobertura:$("#Cobertura").val(),
            Volumen:$("#Volumen").val(),
            Fecha_inicio:$("#Fecha_inicio").val(),
            Fecha_fin:$("#Fecha_fin").val(),
            Mostrar:Mostrar,
            Prioridad:Prioridad,
        },
    })
    .done(function(html) {
        if(html==1)
        {
            alert("Meta actualizada.");
        }else{
            alert("Meta no actualizada.");
        }
        
    })
    .fail(function() {
        console.log("Error actualizar_meta");
    });
}

function cargar_campos_agregar_detalle_meta(idMETA, Marca){
    url="producto/listar_por_marca";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idMETA:idMETA,
            Marca:Marca,
        },
    })
    .done(function(html) {
        $("#productos_a_agregar").html(html);
        
    })
    .fail(function() {
        console.log("Error cargar_campos_agregar_detalle_meta");
    });
}


function agregar_todos_producto_meta(idMETA, MARCA){
    url="producto/agregar_todos_producto_meta";
    
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idMETA:idMETA,
            MARCA:MARCA,
        },
    })
    .done(function(html) {
        if(html==1)
        {
            alert("Todos los productos de la marca " + MARCA+ " fueron agregados a la meta.");
        }
        else{
            alert("No se pude agregar todos los productos de la marca " + MARCA+ " a la meta.");
        }
    })
    .fail(function() {
        alert("No se pudo agregar el producto, es posible que ya sea parte de la meta.");
    });
}

function agregar_producto_meta(idMETA){
    url="producto/agregar_producto_meta";
    idPRODUCTO = $('#idPRODUCTO_a_agregar').find(":selected");
    Pedido_minimo = $("#Pedido_minimo_a_agregar").val();
    Marca = $("#Marca").html();

    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idMETA:idMETA,
            idPRODUCTO: idPRODUCTO.val(),
            Pedido_minimo:Pedido_minimo,
            Marca:Marca,
        },
    })
    .done(function(html) {
        var $tr_original = $('tr[id="nueva_fila"]');
        var $tr_nuevo = $tr_original.clone().prop('id', 'detalle_'+idMETA+'_'+idPRODUCTO.val());
        $tr_original.after($tr_nuevo);
        $("#detalle_"+idMETA+"_"+idPRODUCTO.val()).css("display","table-row");
        $("#detalle_"+idMETA+"_"+idPRODUCTO.val()+" td:nth-child(1) p").html(idPRODUCTO.val());
        $("#detalle_"+idMETA+"_"+idPRODUCTO.val()+" td:nth-child(2) p").html(idPRODUCTO.text());
        $("#detalle_"+idMETA+"_"+idPRODUCTO.val()+" td:nth-child(3) p").html(Pedido_minimo);
        $("#detalle_"+idMETA+"_"+idPRODUCTO.val()+" td:nth-child(4) button").attr("onclick","retirar_detalle_meta("+idPRODUCTO.val()+","+idMETA+")");
        
    })
    .fail(function() {
        alert("No se pudo agregar el producto, es posible que ya sea parte de la meta.");
    });
}

function ir_a_vender(idCLIENTE){
    location.href=VariablesPHP.base_url+'vender/'+idCLIENTE; 
}
function retirar_meta(idMETA){

    url="meta/retirar";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idMETA:idMETA,
        },
    })
    .done(function(html) {
        if(html==1){
            location.href = VariablesPHP.base_url+'meta';
        }
    })
    .fail(function() {
        console.log("Error retirar_meta");
    });
}

function retirar_detalle_meta(idPRODUCTO, idMETA){

    url="meta/detalles/retirar";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idPRODUCTO:idPRODUCTO,
            idMETA:idMETA,
        },
    })
    .done(function(html) {
        if(html==1){
            $("#detalle_"+idMETA+"_"+idPRODUCTO).hide().fadeOut("Fast");
        }
    })
    .fail(function() {
        console.log("Error retirar_detalle_meta");
    });
}

function anularVenta(idVenta){

    url="devolver";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            idVenta:idVenta,
        },
    })
    .done(function(html) {
        if(html==1){
            $("#venta"+idVenta).hide().fadeOut("Fast");
        }
    })
    .fail(function() {
        console.log("Error anularVenta");
    });
}

function limpiarBuscador()
{
    $("#producto_a_buscar").val("");
    $("#cliente_a_buscar2").val("");
    $("#resultado").html("").hide().fadeOut("Fast");
    $("#metas").hide().fadeIn("Fast");
}

function buscar_producto_por_cliente(idCLIENTE, frase)
{
    
    if(frase==''){
        $("#botonbuscarProducto > span").removeClass("glyphicon-refresh-animate");
        $("#metas").hide().fadeIn("Fast");
        $("#resultado").html("").hide().fadeOut("Fast");
        return;
    }
    else{
        $("#metas").hide().fadeOut("Fast");
    }

    $("#botonbuscarProducto > span").addClass('glyphicon-refresh-animate');
        
    url="cliente/buscar_producto_metas";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            id_cliente:idCLIENTE,
            frase_producto:frase
        },
    })
    .done(function(html) {
        $("#botonbuscarProducto > span").removeClass("glyphicon-refresh-animate");
        $("#resultado").html(html).hide().fadeIn("Fast");
        
    })
    .fail(function() {
        console.log("Error buscar_producto_por_cliente");
    });
    
}

function buscar_cliente(cliente_a_buscar)
{
    if(cliente_a_buscar==''){
        $("#botonbuscarCliente > span").removeClass("glyphicon-refresh-animate");
        $("#metas").hide().fadeIn("Fast");
        $("#resultado").html("");
        return;
    }

    $("#botonbuscarCliente > span").addClass('glyphicon-refresh-animate');
    
    url="cliente/buscar2";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            cliente_a_buscar:cliente_a_buscar
        },
    })
    .done(function(html) {
        $("#metas").html("").fadeOut("Fast");
        $("#botonbuscarCliente > span").removeClass("glyphicon-refresh-animate");
        $("#resultado").html(html).fadeIn("Fast");
    })
    .fail(function() {
        console.log("Error buscar_cliente");
    });
    
}

function vender(idproducto, calificacion, modo)
{
    url="usuario/vender";

    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'html',
        data: {
            id_pelicula:id_pelicula,
            calificacion:calificacion
        },
    })
    .done(function(html) {
        $("#para_calificacion_"+id_pelicula).html(html).hide().fadeIn("Slow");
        if(calificacion==-2)  //ocultar
        {
            $("#para_calificacion_"+id_pelicula).parent().parent().parent().carousel('next');
        }
    })
    .fail(function() {
        console.log("Error 556");
    });
}
