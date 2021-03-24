                </div>
        </div>
    </div>
    <div id="modal"></div>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    
    <script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <script src="<?php echo asset_url();?>js/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo asset_url();?>js/scripts_receta.js"></script>

    <script type="text/javascript">

        <?php 
        if (isset($codigo_jquery))
            {
                echo $codigo_jquery;
            }        
        ?>
    </script>
</body>
</html>
