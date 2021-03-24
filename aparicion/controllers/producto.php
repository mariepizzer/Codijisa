<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function ficha($id)
	{
		$this->load->model('Producto_model');
		$data['datos'] = $this->Producto_model->datos($id);
		
		$this->load->view('templates/header',$data);
		$this->load->view('producto/ficha');
		$this->load->view('templates/footer');
	}

	function recomendaciones()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}
		else
		{
			$this->load->model('Recomendacion_model');

			$num_recomendaciones = 5;
			$arreglo_recomendaciones = $this->Recomendacion_model->recomendaciones_sin_calificar($this->ion_auth->get_user_id(),$num_recomendaciones);
			
			if(sizeof($arreglo_recomendaciones)>0)
			{
				$vistas_fichas = array();
				foreach ($arreglo_recomendaciones as $recomendacion) {
					$vistas_fichas[] = $this->producto_lib->mini_ficha($recomendacion,'recomendacion',1);
				}

				$data['fichas']= $vistas_fichas;
				$data['titulo']= 'Seleccionadas para ti';
				$this->load->view('producto/carrusel_recomendaciones',$data);
			}
			else
			{
				echo "<div style=' display: table;margin: 0 auto;'><a href='#' onclick='calcular_recomendaciones_background(this);' class='btn btn-lg btn-warning text-center'>¡Calcular recomendaciones!</a></div>";
			}
		}
	}

	function buscar()
	{
		//validaciones
		$this->form_validation->set_rules('producto_a_buscar', 'Texto a buscar', 'required|alpha_numeric');
		$this->load->model('Producto_model');
		if ($this->form_validation->run() == true)
		{
			$frase = $this->input->post('producto_a_buscar');
			$data['datos_productos'] = $this->Producto_model->buscar($frase);
			if(sizeof($data['datos_productos'])>0)
			{
				$data['titulo'] = "Resultado para ".$this->input->post('producto_a_buscar');
				$this->load->view('templates/header',$data);
				$this->load->view('producto/lista');
				$this->load->view('templates/footer');	
			}
			else
			{
				
				$this->Usuario_model->inicializar($this->ion_auth->get_user_id());

				$data['mensaje'] = "No se encontró productos con la frase <u><strong>".strtoupper($frase)."</strong></u>.";
				$data['tipo_mensaje'] ="advertencia";
				$data['usuario'] = $this->ion_auth->user()->row();
				
				$data['titulo']= 'Mi Perfil';
				$this->load->view('templates/header',$data);
				$this->load->view('usuario/mi_perfil');
				$this->load->view('templates/footer');
			}
			
		}

	}

	function listar_por_marca(){
		$this->form_validation->set_rules('idMETA', 'Meta', 'required|numeric');
		$this->form_validation->set_rules('Marca', 'Marca', 'required');		
		
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Producto_model');
			$arreglo_productos = $this->Producto_model->listar_por_marca($this->input->post('idMETA'),$this->input->post('Marca'));
			if(sizeof($arreglo_productos)>0)
			{
				$select = "<select id='idPRODUCTO_a_agregar' name='idPRODUCTO_a_agregar'  class='form-control'>";

				foreach ($arreglo_productos as $producto) {
					$select = $select . "<option value=".$producto['idPRODUCTO'].">".$producto['idPRODUCTO']."-".$producto['Nombre']."</option>";
				}
				$select = $select . "</select>";
				
				echo $select;
			}
			else
			{
				echo "<div style=' display: table;margin: 0 auto;'>Todos los productos de la marca {$this->input->post('Marca')} ya están agregados a esta Meta.</div>";
			}
		}
	}

	function agregar_producto_meta(){
		$this->form_validation->set_rules('idMETA', 'Meta', 'required|numeric');
		$this->form_validation->set_rules('idPRODUCTO', 'Producto', 'required|numeric');
		$this->form_validation->set_rules('Pedido_minimo', 'Pedido Mínimo', 'required|numeric');
		$this->form_validation->set_rules('Marca', 'Marca', 'required');
		
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Producto_model');
			echo $this->Producto_model->agregar_producto_meta($this->input->post('idMETA'),$this->input->post('idPRODUCTO'),$this->input->post('Pedido_minimo'),$this->input->post('Marca'));
			
		}
	}

	function agregar_todos_producto_meta(){
		$this->form_validation->set_rules('idMETA', 'Meta', 'required|numeric');
		$this->form_validation->set_rules('MARCA', 'MARCA', 'required');
		
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Producto_model');
			echo $this->Producto_model->agregar_todos_producto_meta($this->input->post('idMETA'),$this->input->post('MARCA'));
			
		}
	}
}
