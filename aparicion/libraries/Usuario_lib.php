<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
	* Name:  Usuario
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

class Usuario_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('Usuario_model');
  		//$this->CI->load->library('session');
		
	}
	
	public function listar_marcas()
	{
		$data = $this->CI->Usuario_model->listar_marcas();
		return $data;
	}

}
