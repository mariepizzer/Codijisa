<?php
class MY_Form_validation extends CI_Form_validation{

    public function __construct($config = array()){
        parent::__construct($config);
    }
    public function alfa_espacio_alfa($texto) 
	{   
		$texto_normalizado = iconv('UTF-8','ASCII//TRANSLIT',$texto);
		$caracteres_permitidos="a-zA-Z~\'";
		$regexp = "/^[".$caracteres_permitidos."]+([ ]{1,1}[".$caracteres_permitidos."]+)*$/";
		if(preg_match($regexp, $texto_normalizado))
			return TRUE;
		else 
			return FALSE;
	}

	public function formato_fecha($texto)
	{   
		$regexp = '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](18|19|20|21|22)[0-9]{2}$/';
		if(preg_match($regexp, $texto))
			return TRUE;
		else
			return FALSE;
	}
    
}