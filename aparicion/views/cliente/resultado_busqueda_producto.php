<?php
    if (sizeof($productos)>0)
    {
        foreach ($productos as $producto) {
        ?>
            <div id="producto_<?php echo $producto['idProducto'];?>" class="item col-xs-12 item_resultado <?php if ($producto['ConMeta']==0) echo 'item_sin_meta'; else if ($producto['Coberturado']==1) echo 'coberturado'; else echo 'por_coberturar';?>">
                <div class="col-sm-8 col-xs-7">
                    <p style="font-size:12px;"  class="codigo"><?php echo $producto['Nombre'];?></p>
                    <strong>Avance</strong>:<span id="AvanceVolumen_<?php echo $producto['idProducto'];?>"> <?php echo $producto['Volumen'];?> <?php echo $producto['UnidadDefecto'];?> </span>
                </div>
                <div class="col-sm-4 col-xs-5" id="controles_<?php echo $producto['idProducto'];?>">
                    <div class="input-group">
                        <input id="volumen_a_vender_<?php echo $producto['idProducto'];?>" name="volumen_a_vender_<?php echo $producto['idProducto'];?>" type="number"  step="0.5" class="form-control control_mediano" value="<?php echo $producto['Pedido_minimo'];?>" >
                        <span class="input-group-btn">
                            <button class="btn btn-default control_mediano" type="submit" type="button" id="boton_vender_ajax_<?php echo $producto['idProducto'];?>" onclick="venderProducto(<?php echo $idCliente;?>,<?php echo $producto['idProducto'];?>, document.getElementById('volumen_a_vender_<?php echo $producto['idProducto'];?>').value,'<?php echo $producto['Marca'];?>' )"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                        </span>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
<div class="clearfix"></div>
<?php
    }

?>
<script type="text/javascript">

function venderProducto(idCLIENTE, idPRODUCTO, Volumen, Marca)
{
    if(Volumen<=0 || Volumen==''){
        alert("El Volumen debe ser mayor que cero.");
        return;
    }
    $("#metas").hide().fadeOut("Fast");

    url="registrar_venta";
    $.ajax({
        url: VariablesPHP.base_url+url,
        type: 'POST',
        dataType: 'json',
        data: {
            id_cliente:idCLIENTE,
            id_producto:idPRODUCTO,
            volumen:Volumen,
            marca:Marca
        },
    })
    .done(function(json) {
        var idMETA, Coberturado, NuevoVolumen;

        for (index = 0; index < json.length; ++index) {
            idMETA = json[index]['idMETA'];
            Coberturado = json[index]['Coberturado'];
            NuevoVolumen = json[index]['NuevoVolumen'];

            clase = "rojo";
            switch(Coberturado){
                case '1': clase = "coberturado";
                    break;
                case '0': clase = "puedes_mas";
                    break;
                default: clase = "error";
                    break;
            }
            $("#producto_"+idPRODUCTO).removeClass();
            $("#producto_"+idPRODUCTO).hide().fadeIn("Fast").addClass("item col-xs-12 item_resultado "+clase);
            $("#meta"+idMETA).removeClass();
            $("#meta_"+idMETA).addClass("col-sm-2 meta " + clase).hide().fadeIn("Fast");
            $("#AvanceVolumen_"+idPRODUCTO).html(NuevoVolumen);   
        }    
    })
    .fail(function() {
        console.log("Error venderProducto" );

    }); 
}

</script>