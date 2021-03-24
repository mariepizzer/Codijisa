<script>
// PARA DRAG AND DROP DE LOS PLATOS
    function allowDrop(ev) {
      ev.preventDefault();
    }

    function drag(ev) {
        ev.target.classList.add("dragging");
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      ev.target.appendChild(document.getElementById(data));
      document.getElementById(data).classList.remove("dragging", "col-xs-6","col-sm-3");
    }
</script>


<div class="container-fluid">
    <div class="row">
        <!-- categorías -->
        <div class="col-sm-6" id="categorias">
            <?php

                if (sizeof($categorias)>0)
                {
                    foreach ($categorias as $categoria) { 

                        if($categoria['Tipo']=='P'){
                             ?>  
                            <div class="categoria">
                                <button class="btn btn-default boton_categoria_plato" type="button" id="boton<?php echo $categoria['idCategoria']; ?>" onclick="buscar_plato_ingrediente('<?php echo $categoria['idCategoria']; ?>', 'boton');">
                                    <?php echo $categoria['idCategoria'];?>
                                </button>
                            </div>
                            <?php 
                        }
                        if($categoria['Tipo']=='I'){
                             ?>  
                            <div class="categoria">
                                <button class="btn btn-default boton_categoria_ingrediente" type="button" id="boton<?php echo $categoria['idCategoria']; ?>" onclick="buscar_plato_ingrediente('<?php echo $categoria['idCategoria']; ?>', 'boton');">
                                    <?php echo $categoria['idCategoria'];?>
                                </button>
                            </div>
                            <?php 
                        }
                    }
                }
            ?>
        </div>

        <div class="col-sm-6">
            <div class="panel-heading input-group">
                <input id="frase_a_buscar" name="frase_a_buscar" autofocus type="text" class="form-control control_grande" placeholder="Buscar plato o ingrediente...">
                    <span class="input-group-btn">
                        <button class="btn btn-default control_grande" type="submit" type="button" id="botonBuscar" onclick="buscar_plato_ingrediente($('#frase_a_buscar').val(),'');">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                    </span>
                    <span class="input-group-btn">
                        <button class="btn btn-default control_grande" type="submit" type="button" id="botonLimpiarBuscador" onclick="limpiarBuscador();">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </span>
                    <span class="input-group-btn">
                        <button class="btn btn-default control_grande" type="submit" type="button" id="botonBorrarListaSemana" onclick="borrar_ListaSemana();">
                            <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                        </button>
                    </span>
                    <span class="input-group-btn">
                        <button class="btn btn-default control_grande" type="submit" type="button" id="botonProcesarLista" onclick="guardarsemana_y_procesarLista();" style="background-color: #e2ffef;">
                            <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
                        </button>
                    </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table id="semana" class="table">
                <thead>
                    <tr class="active">
                        
                        <th>Lun</th>
                        <th>Mar</th>
                        <th>Miér</th>
                        <th>Jue</th>
                        <th>Vier</th>
                        <th>Sáb</th>
                        <th>Dom</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (sizeof($items_semana)==0)
                {
                    ?>
                    
                    <tr id="desayuno" class="success">
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                    <tr id="almuerzo" class="danger">
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                    <tr id="cena" class="warning">
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                        <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    </tr>
                    
                    <?php
                }
                if (sizeof($items_semana)>0){

                    $Dia = 1;
                    $Contador = 0;
                    $Turno = 1;

                    $cantidad_items = count($items_semana);

                    while ( $Dia <= 7 AND $Turno <=3) {

                        if($Dia==1 AND $Turno==1){
                            echo '<tr id="desayuno" class="success">';
                        }
                        if($Dia==1 AND $Turno==2){
                            echo '<tr id="almuerzo" class="danger">';
                        }
                        if($Dia==1 AND $Turno==3){
                            echo '<tr id="cena" class="warning">';
                        }

                        echo "<td  ondrop='drop(event)' ondragover='allowDrop(event)'>";
                        
                        if($Contador <= $cantidad_items){

                            while( isset($items_semana[$Contador]['Dia']) && $items_semana[$Contador]['Dia'] ==$Dia && $items_semana[$Contador]['Turno'] ==$Turno )
                            {
                                ?>          
                                <div draggable="true" ondragstart="drag(event)" id="<?php echo $items_semana[$Contador]['Tipo'].'_'.$items_semana[$Contador]['idItem'];?>" class="plato_o_ingrediente resultado_<?php echo $items_semana[$Contador]['Tipo'];?>">
                                    <span class="Nombre"><?php echo $items_semana[$Contador]['Nombre'];?> </span><span class="borrar"><a href="<?php echo base_url();?>semana/plato/<?php echo $items_semana[$Contador]['idItem'];?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></span><span class="borrar"><a href="#" onclick="retirar_plato_o_ingrediente('<?php echo $items_semana[$Contador]['Tipo'].'_'.$items_semana[$Contador]['idItem'];?>');">x</a></span>
                                    <p class="Tipo" style="display:none;"><?php echo $items_semana[$Contador]['Tipo'];?></p>
                                    <p class="Id" style="display:none;"><?php echo $items_semana[$Contador]['idItem'];?></p>
                                </div>

                                <?php
                                $Contador++;
                            }
                        }                            
                                
                        $Dia++;

                        if($Dia==8) {
                            echo "</tr>";
                            $Turno++;
                            $Dia=1;
                        }

                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<div class="row">
    <div id="resultado"  style="padding:20px 5px;"></div>
</div>
<div class="clearfix"></div>



<div id="listalista"  style="padding:20px 5px;">

<?php 

    if (sizeof($items_semana)>0)
    {
        ?>
        <script type="text/javascript">
            $('document').ready(function(){
                mostrar_Lista_Procesada();
            });
        </script>
        <?php
    }

?>

</div>
<div class="clearfix"></div>


<script type="text/javascript">

    $("#frase_a_buscar").keyup(function(event){
        if(event.keyCode == 13){
            $("#botonBuscar").click();
        }
    });

</script>


