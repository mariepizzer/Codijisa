<h3>PRODUCTOS SIN MARCA</h3>
<table class="table table-responsive table-bordered table-striped" id="ventas_meta">
        <thead>
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Ventas</th>
                <th>Marca</th>
            </tr>
        </thead>
        <tbody>
             <?php 
                foreach ($productos as $producto) {
                    ?>
                    <tr>
                        <td><p><?php echo $producto['idProducto'];?></p></td>
                        <td><p><?php echo ucfirst($producto['Nombre']);?></p></td>
                        <td><p><?php echo $producto['Ventas'];?></p></td>
                        <td>
                            <form name="form_<?php echo $producto['idProducto'];?>">
                                <select class="Marca" name="Marca_<?php echo $producto['idProducto'];?>" id="Marca_<?php echo $producto['idProducto'];?>" >
                                <?php 
                                foreach ($Marcas as $marca) 
                                {
                                        ?>
                                        <option value="<?php echo $marca['idMARCA'];?>"><?php echo $marca['idMARCA'];?></option>
                                        <?php
                                }
                                ?>
                            </select>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
        </tbody>
    </table>

<script type="text/javascript">
    $(function()
        {
        $('.Marca').change(function()
            {
            idProducto = $(this).attr('id');
            console.log("PRODUCTO: " +idProducto);
            var idMARCA = $("#Marca_"+idProducto+" option:selected").val();
            console.log("Nueva marca: " + idMARCA + ".");

            /*
            url="colocar_marca";
            $.ajax({
                async:false,
                cache:false,
                url: VariablesPHP.base_url+url,
                type: 'POST',
                dataType: 'html',
                data: {
                    idProducto: idProducto,
                    idMARCA: idMARCA,
                },
            })
            .done(function(html) {
                console.log("Nueva marca para producto :"+ idProducto+">" + idMARCA + " ");
            })
            .fail(function() {
                console.log("Error fail colocar Marca ");
            });
            */
          });

        });
</script>