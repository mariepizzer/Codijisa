<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function ficha($id)
	{
		$this->load->model('Cliente_model');
		$data['cliente'] = $this->Cliente_model->datos($id);
		$data['ventas'] = $this->Cliente_model->listarVentas($id, $this->ion_auth->get_user_id());
		
		$this->load->view('templates/header',$data);
		$this->load->view('cliente/ficha');
		$this->load->view('templates/footer');
	}

	function registrar()
	{
		$this->form_validation->set_rules('idCliente', 'Código', 'required|numeric');
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('Zona' ,'Zona', 'required');
		$this->form_validation->set_rules('Celular' ,'Celular', 'required');
		$this->form_validation->set_rules('Direccion', 'Dirección', 'required');


		if ($this->form_validation->run() == true)
		{
			$this->load->model('Cliente_model');
			$data['idCliente'] = $this->input->post('idCliente');
			$data['Nombre'] = $this->input->post('Nombre');
			$data['Zona'] = $this->input->post('Zona');
			$data['Direccion'] = $this->input->post('Direccion');
			$data['Celular'] = $this->input->post('Celular');
			$data['ventas'] = array();
			$this->Cliente_model->registrar($data['idCliente'],$data['Nombre'],$data['Zona'],$data['Celular'],$data['Direccion']);
		
			redirect('cliente/'.$data['idCliente']);
			
		}
		else
		{
			$data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
			
			$data['titulo'] = 'Nuevo Cliente';
			$this->load->view('templates/header',$data);
			$this->load->view('cliente/registrar');
			$this->load->view('templates/footer');
		}
	}

	function buscar()
	{
		//validaciones
		$this->form_validation->set_rules('cliente_a_buscar', 'Texto a buscar', 'required');
		$this->load->model('Cliente_model');
		if ($this->form_validation->run() == true)
		{
			$frase = $this->input->post('cliente_a_buscar');
			$data['datos_clientes'] = $this->Cliente_model->buscar($frase);
			
			$data['titulo'] = "Resultado para ".$frase;
			$this->load->view('templates/header',$data);
			$this->load->view('cliente/lista');
			$this->load->view('templates/footer');
			
		}
	}

	function buscar2()
	{
		//validaciones
		$this->form_validation->set_rules('cliente_a_buscar', 'Texto a buscar', 'required');
		$this->load->model('Cliente_model');
		if ($this->form_validation->run() == true)
		{
			$frase = $this->input->post('cliente_a_buscar');
			$data['datos_clientes'] = $this->Cliente_model->buscar($frase);


			$data['titulo'] = "Resultado para ".$frase;
			$this->load->view('cliente/lista',$data);
			
			
		}
	}
	
	function anularVenta()
	{
		//validaciones
		$this->form_validation->set_rules('idVenta', 'ID Venta', 'required');
		
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Cliente_model');
			$idVenta = $this->input->post('idVenta');
			$this->Cliente_model->anularVenta($idVenta);
			echo 1;
		}
		else echo 0;
	}


	function guardar_celular(){
		$this->form_validation->set_rules('idCLIENTE', 'idCLIENTE', 'required');
		$this->form_validation->set_rules('Celular', 'Celular', '');
		
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Cliente_model');
			echo $this->Cliente_model->guardarCelular($this->input->post('idCLIENTE'),$this->input->post('Celular'));
			
		}
	}

	

	function BuscarPorZona()
	{
		//validaciones
		$this->form_validation->set_rules('Zona', 'Zona', 'required');
		$this->load->model('Cliente_model');
		if ($this->form_validation->run() == true)
		{
			$frase = $this->input->post('Zona');
			if($frase!=''){
				$data['datos_clientes'] = $this->Cliente_model->BuscarPorZona($frase);
				$data['titulo'] = "Resultado para zona: ".$frase;
				$this->load->view('cliente/lista',$data);
			}
			
			
		}
	}
}
