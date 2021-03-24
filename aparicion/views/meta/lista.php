<div class="form-group col-sm-3 col-sm-offset-3 col-xs-6">
        <a class="btn btn-info btn-block" href="meta/registrar"><span class="glyphicon glyphicon-plus"></span> Nueva Meta</a>
    </div>   
<?php
if (sizeof($datos_metas)>0)
{   
    ?>
    <div class="form-group col-sm-3 col-xs-6">
        <button type="button" title="Graba Premios Alcanzados" class="btn btn-info btn-block" onclick="cerrar_mes()">
             Cerrar Mes <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
        </button>
    </div>
    <div class="clearfix"></div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <script type="text/javascript">
                    var Premios_Alcanzados = [];
                    var contador = -1;
                </script>
                <table class="table table-responsive table-hover table-striped" id="resultado_metas">
                    <thead>
                        <tr class="info">
                            <!-- <th>Meta</th> -->
                            <th>Meta</th>
                            <th>Incentivo / Obtenido</th>
                            <!-- <th></th> -->
                            <th>Proyección</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        $total_incentivos = 0;
                        $total_incentivos_alcanzados = 0;
                        foreach ($datos_metas as $meta) {
                            if($meta['Tipo']=='COBERTURA'){
                                $porcentaje= $meta['Avance_Cobertura']*100/$meta['Objetivo'];
                                $incentivo_para_esta_meta = $meta['Incentivo']*$meta['Objetivo'];
                                $total_incentivos = $total_incentivos + $incentivo_para_esta_meta;

                                if($porcentaje>=100) {
                                    $logrado = 1;
                                    $total_incentivos_alcanzados = $total_incentivos_alcanzados+ ($meta['Incentivo']*$meta['Avance_Cobertura']); 
                                }else{
                                    $logrado = 0;
                                }
                                
                                ?>
                                <script type="text/javascript">
                                    contador = contador+1;
                                    Premios_Alcanzados[contador] =[<?php echo $meta['idMETA'];?>,"<?php echo $meta['Fecha_fin'];?>", <?php echo ($meta['Incentivo']*$meta['Avance_Cobertura']);?>, <?php echo $meta['Avance_Cobertura'];?>,<?php echo $logrado;?>];
                                </script>
                                
                                <tr class="<?php if($meta['Activo']) echo "activo"; else echo "no_activo";?>">
                                    <!-- <td><?php echo $meta['idMETA'];?></td> -->
                                    <td>
                                        <div style="">
                                            <div class="meter orange nostripes">
                                                
                                                <a href="<?php echo base_url().'meta/detalles/'.$meta['idMETA'];?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> <?php echo $meta['Marca'];?> <?php echo $meta['Nombre'];?> - <span style="color:blue;font-weight:bold;"><?php echo floor($porcentaje);?>%</span></a> 
                                                <span style="<?php if($porcentaje>=100) echo 'background-color:red;color:white;'; else if($porcentaje<100 && $porcentaje>=80) echo 'background-color:orange;color:white;'; else echo 'color:blue;'?> width: <?php echo $porcentaje?>%"><?php echo $meta['Avance_Cobertura'];?><strong>/</strong><?php echo $meta['Objetivo'];?></span>
                                            </div>
                                        </div>

                                    </td>
                                    <td><strong><p>S/.<?php echo $meta['Incentivo']*$meta['Objetivo'];?></strong> / <strong><?php if($porcentaje>=100) echo "S/ ".($meta['Incentivo']*$meta['Avance_Cobertura']); else echo "S/ 0";?></p></strong></td>
                                    <!-- <td></td> -->
                                    <td><?php if($meta['PROYECCION_Cobertura']>0) echo $meta['PROYECCION_Cobertura'].' puntos por '.$meta['Dias_restantes'] . ' días'; else echo "&#10084;";?></td>
                                </tr>
                                <?php
                            }

                            if($meta['Tipo']=='VOLUMEN')
                                {
                                $porcentaje= $meta['Avance_Volumen']*100/($meta['Volumen']);
                                $incentivo_para_esta_meta = $meta['Incentivo'];
                                $total_incentivos = $total_incentivos + $incentivo_para_esta_meta;
                                if($porcentaje>=100) { 
                                    $logrado = 1;
                                    $total_incentivos_alcanzados = $total_incentivos_alcanzados+ $meta['Incentivo']; 
                                }else{
                                    $logrado = 0;
                                }
                                ?>
                                <script type="text/javascript">
                                    contador = contador+1;
                                    Premios_Alcanzados[contador] =[<?php echo $meta['idMETA'];?>,"<?php echo $meta['Fecha_fin'];?>", <?php echo $meta['Incentivo'];?>, <?php echo $meta['Avance_Volumen'];?>,<?php echo $logrado;?>];
                                    
                                </script>
                                
                                <tr class="<?php if($meta['Activo']) echo "activo"; else echo "no_activo";?>">
                                    <!-- <td><?php echo $meta['idMETA'];?></td> -->
                                    <td>
                                        <div style="">
                                            <div class="meter orange nostripes">
                                                <a href="<?php echo base_url().'meta/detalles/'.$meta['idMETA'];?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> <?php echo $meta['Marca'];?> <?php echo $meta['Nombre'];?> - <span style="color:blue;font-weight:bold;"><?php echo floor($porcentaje);?>%</span></a> 
                                                <span style="<?php if($porcentaje>=100) echo 'background-color:red;color:white;'; else if($porcentaje<100 && $porcentaje>=80) echo 'background-color:orange;color:white;'; else echo 'color:blue;'?> width: <?php echo $porcentaje?>%" >S/.<?php echo round($meta['Avance_Volumen'],1);?><strong>/</strong><?php echo ($meta['Volumen']);?></span>
                                            </div>
                                        </div>

                                    </td>
                                    <td><strong>S/. <?php echo $meta['Incentivo'];?></strong> / <strong><?php if($porcentaje>=100) echo "S/. ".$meta['Incentivo']; else echo "S/. 0";?></strong></td>
                                    <!-- <td></td> -->
                                    <td><?php if($meta['PROYECCION_Volumen']>0) echo 'S/. '.$meta['PROYECCION_Volumen'].' por '.$meta['Dias_restantes'] . ' días'; else echo "&#10084;";?> </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    <tr>
                        <!-- <td></td> -->
                        <td></td>
                        <td><strong>S/. <?php echo $total_incentivos;?></strong> / <br/><strong>S/. <?php echo $total_incentivos_alcanzados;?></strong></td>
                        <!-- <td></td> -->
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
}
else
{
    imprimir_mensaje("No se encontró metas con ese criterio.",'advertencia');
}
?>

<script type="text/javascript">

    $(function() {
      $(".meter > span").each(function() {
        var relativePercentage = ($(this).width()/$(this).parent('div').width())*100;
        if(relativePercentage>100){
          relativePercentage=100;
        }
          
        $(this)
            .data("origWidth", $(this).width())
            .width(0)
            .animate({
                width: relativePercentage + '%'
            }, 800);
      });
    });

    
    function cerrar_mes(){

        for(var i=0;i<Premios_Alcanzados.length;i++){
            idMETA=Premios_Alcanzados[i][0];
            Mes=Premios_Alcanzados[i][1];
            Efectivo=Premios_Alcanzados[i][2];
            Alcanzado=Premios_Alcanzados[i][3];
            Logrado=Premios_Alcanzados[i][4];
            console.log(i+" > "+Premios_Alcanzados[i]);
            url="meta/cerrar_mes";
            $.ajax({
                url: VariablesPHP.base_url+url,
                type: 'POST',
                dataType: 'html',
                data: {
                    idMETA:idMETA,
                    Mes:Mes,
                    Efectivo:Efectivo,
                    Alcanzado:Alcanzado,
                    Logrado:Logrado,
                },
            })
            .done(function(html) {
                console.log(html);
            })
            .fail(function() {
                console.log("Error cerrar_mes META: "+i+" > "+Premios_Alcanzados[i]);
            }); 
               
        }
        
    }
</script>

<style>
    .meter {
        position: relative;
        margin:5px 0 5px 4px;
        background: #dcd4d4;
        padding: 8px;
        -webkit-box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
        -moz-box-shadow   : inset 0 -1px 1px rgba(255,255,255,0.3);
        box-shadow        : inset 0 -1px 1px rgba(255,255,255,0.3);
        font-size: 110%;
    }
    .meter > span {
        display: block;        
        background-color: #29ee5d;
        position: relative;
        overflow: visible;
    }
    .meter > span:after, .animate > span > span {
        content: "";
        position: absolute;
        top: 0; left: 0; bottom: 0; right: 0;
        z-index: 1;
        -webkit-background-size: 50px 50px;
        -moz-background-size: 50px 50px;
        background-size: 50px 50px;
        overflow: hidden;
    }

    .animate > span:after {
        display: none;
    }

    @-webkit-keyframes move {
        0% {
           background-position: 0 0;
        }
        100% {
           background-position: 50px 50px;
        }
    }

    @-moz-keyframes move {
        0% {
           background-position: 0 0;
        }
        100% {
           background-position: 50px 50px;
        }
    }
</style>