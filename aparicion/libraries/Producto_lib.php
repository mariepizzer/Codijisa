<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
	* Name:  Producto
	*
	* Version: 1.0
	*
	* Author:  Marie Pinto Gozzer
	* 		   soy@mariepizzer.com
	*	  	   @mariepizzer
	*
	* Created:  14.06.2017
	*
	* Description:  
	*
*/

class Producto_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('Producto_model');
  		$this->CI->load->library('session');
		
	}
	
	public function mini_ficha($id, $modo, $muestra_sinopsis)  /*$modo se refiere a voto o recomendacion*/
	{
		$data['ficha'] = $this->CI->Producto_model->datos_resumidos($id);
		$data['modo'] = $modo;
		$data['muestra_sinopsis'] = $muestra_sinopsis;
		return $this->CI->load->view('producto/mini_ficha',$data, TRUE);
	}


	}
}
