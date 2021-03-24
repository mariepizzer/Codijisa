<?php
if (sizeof($ingredientes)>0)
{   
    ?>
    <div class="col-xs-12" id="mamita">
        <h3 style="text-align:center;">Ingredientes</h3>
    <?php 

    $bandera = 1;
    while ($ingrediente_actual = current($ingredientes) )
    {
        $siguiente = next($ingredientes);

        if($bandera ==1 ){
            $bandera = 0;
                ?>
                <div class='clearfix'></div>
                <div class="categoria">
                    <button class="btn btn-default " type="button" id="boton<?php echo $ingrediente_actual['Categoria']; ?>" >
                        <?php if($ingrediente_actual['Categoria']=='') echo "Sin Categoría"; else echo $ingrediente_actual['Categoria']; ?>
                    </button>
                </div>
                <div class='clearfix'></div>
                <?php 
        }
        ?>

        <div class="row">
            <div class="col-xs-6">
                <div class="input-group">
                    <input id="Nombre_<?php echo $ingrediente_actual['idIngrediente'];?>" type="text" class="form-control " placeholder="<?php echo $ingrediente_actual['Nombre'];?>" value="<?php echo $ingrediente_actual['Nombre'];?>" >
                    <span class="input-group-addon">
                        <select style="width: 20px;" class="" name="Categoria_<?php echo $ingrediente_actual['idIngrediente'];?>" id="Categoria_<?php echo $ingrediente_actual['idIngrediente'];?>" >
                            <?php 
                            foreach ($categorias as $categoria) 
                            {
                                if($categoria['Tipo']=='I')
                                    { 
                                    ?>
                                    <option value="<?php echo $categoria['idCategoria'];?>" <?php if($ingrediente_actual['Categoria']==$categoria['idCategoria']) echo "selected"; ?> ><?php echo $categoria['idCategoria'];?></option>
                                    <?php
                                    } 
                            }
                            ?>
                        </select>
                    </span>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="input-group">
                    <input aria-describedby="basic-addon1" type="text" class="form-control comentario" name="Comentario_<?php echo $ingrediente_actual['idIngrediente'];?>" id="Comentario_<?php echo $ingrediente_actual['idIngrediente'];?>" value="<?php echo $ingrediente_actual['Comentario'];?>">
                    <span class="input-group-btn">
                        <button id="boton_actualizar_<?php echo $ingrediente_actual['idIngrediente'];?>" class="btn btn-default boton_actualizar" type="button" onclick="actualizar_ingrediente(<?php echo $ingrediente_actual['idIngrediente']; ?>);" >
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        </button>   
                    </span>
                </div>
            </div><!-- /.col-lg-6 -->
        </div>
        <?php
        if (false !== $siguiente &&  $siguiente['Categoria'] != $ingrediente_actual['Categoria'])
        {
            ?>
            <div class='clearfix' style="padding-bottom: 20px;"></div>
            <div class="categoria">
                <button class="btn btn-default " type="button" id="boton<?php echo $siguiente['Categoria']; ?>" >
                    <?php echo $siguiente['Categoria'];?>
                </button>
            </div>
            <div class='clearfix'></div>
            <?php
        }
    }
    ?>
    </div>
    <?php  }   else  { }  ?>

<script type="text/javascript">
    
</script>