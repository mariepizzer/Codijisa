<?php
    function asset_url()
    {
       return base_url().'assets/';
    }

    function application_url()
    {
       return base_url().'aparicion/';
    }

    function pre_mensaje($tipo='')
    {
    	if($tipo=='exito')
    	{
    		return "<div class='alert alert-success alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button><strong>¡Ok!</strong> ";
    	}
    	if($tipo=='advertencia')
    	{
    		return "<div class='alert alert-warning alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button><strong>¡Advertencia!</strong> ";
    	}

    	return "<div class='alert alert-danger alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button><strong>¡Error!</strong> ";
    }

    function post_mensaje()
    {
       return "</div>";
    }

    function eliminar_tildes($val)
    {
        $val = iconv('UTF-8','ASCII//TRANSLIT',$val); 
        $val =  str_replace("'","",$val);
        $val =  str_replace("`","",$val);
        $val =  str_replace("~","",$val);
        $val =  str_replace("^","",$val);
        $val =  str_replace('"',"",$val);
        return $val;
    }

    function imprimir_mensaje($mensaje,$tipo_mensaje)
    {
    	if(substr( $mensaje, 0, 4 ) === "<div"){  //el estilo ya está configurado
    		echo $mensaje;
        }
        else
        {
        	echo pre_mensaje($tipo_mensaje).$mensaje.post_mensaje();	
        }
    }
