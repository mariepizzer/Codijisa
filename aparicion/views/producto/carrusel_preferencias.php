<?php
if(sizeof($fichas)>0){
    ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> <?php echo $titulo; ?>
        </div>
        <div class="panel-body">
            <div id="carrusel_preferencias" class="carousel slide col-xs-12" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php 
                    foreach ($fichas as $ficha) {
                        echo $ficha;
                    }
                    ?>
                </div>
                <!-- Controles -->
                <a class="left carousel-control" href="#carrusel_preferencias" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="right carousel-control" href="#carrusel_preferencias" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $("#carrusel_preferencias > div > div").first().addClass('active');
    </script>
    <?php 
}
else
{
    echo "oh oh...";
    ?>
    <?php
}
?>