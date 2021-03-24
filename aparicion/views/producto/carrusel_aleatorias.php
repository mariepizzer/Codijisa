<?php
if(sizeof($fichas)>0)
{
    ?>
    <div class="col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-tags text-left" aria-hidden="true"></span>&nbsp; <?php echo $titulo; ?>
                <a href="#" class="invertido" onclick="entrenar_mas()"><span class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></span></a>
            </div>
            <div class="panel-body">
                <div id="carrusel_aleatorias" class="carousel slide col-xs-12" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php 
                        foreach ($fichas as $ficha) {
                            echo $ficha;
                        }
                        ?>
                    </div>
                    <!-- Controles -->
                    <a class="left carousel-control" href="#carrusel_aleatorias" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="right carousel-control" href="#carrusel_aleatorias" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div style=" display: table;margin: 0 auto;" id="boton_recomendar">
        <a href="#" class="btn btn-lg btn-warning text-center" onclick="calcular_recomendaciones_background(this);">¡Calcular recomendaciones!</a>
    </div>

    <script type="text/javascript">
        $("#carrusel_aleatorias > div > div").first().addClass('active');
    </script>
    <?php
}
?>