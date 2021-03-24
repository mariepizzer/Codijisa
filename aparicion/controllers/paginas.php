<?php

class Paginas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	

	public function ver($pagina)
	{
		if ( ! file_exists(APPPATH.'/views/paginas/'.$pagina.'.php'))
		{
			show_404();
		}
		$data['tipo_mensaje'] = $this->session->flashdata('tipo_mensaje');
		$data['mensaje'] = $this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('mensaje');
		$data['user_id'] = $this->session->userdata('user_id');

		$this->load->view('templates/header',$data);
		$this->load->view('paginas/'.$pagina);
		$this->load->view('templates/footer');
	}

	public function cargar($pagina)
	{
		if ( ! file_exists(APPPATH.'/views/paginas/'.$pagina.'.php'))
		{
			show_404();
		}
		$this->load->view('paginas/'.$pagina);
	}


	public function no_encontrado()
	{
		$this->load->view('auth/header');
		$this->load->view('paginas/no_encontrado');
		$this->load->view('auth/footer');
	}

}
