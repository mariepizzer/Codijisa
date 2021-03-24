<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->Usuario_model->inicializar($this->ion_auth->get_user_id());
	}

	function mi_perfil()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}


		$data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
		$data['tipo_mensaje'] ="";
		
		$data['usuario'] = $this->ion_auth->user()->row();
		$data['metas'] = $this->Usuario_model->listarMetas($data['usuario']->id,1);

		$data['titulo']= 'Mi Perfil';
		$this->load->view('templates/header', $data);
		$this->load->view('usuario/mi_perfil');
		$this->load->view('templates/footer');
	}

	function vender($id) 
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}

		$this->load->model('Cliente_model');

		$data['usuario'] = $this->ion_auth->user()->row();
		$data['datos_cliente'] = $this->Cliente_model->datos($id);
		$data['metas'] = $this->Cliente_model->listar_metas_y_alcances($id,$data['usuario']->id);
				
		$data['titulo']= 'Vender';
		$this->load->view('templates/header', $data);
		$this->load->view('usuario/vender');
		$this->load->view('templates/footer');
	}

	function registrar_venta() 
	{
		
		$this->form_validation->set_rules('id_producto', 'Id Producto', 'required|alpha_numeric');
		$this->form_validation->set_rules('id_cliente', 'Id Cliente', 'required|numeric');
		$this->form_validation->set_rules('volumen', 'Volumen', 'required|float');
		$this->form_validation->set_rules('marca', 'Marca', 'required|alpha_numeric');
		$usuario = $this->ion_auth->user()->row()->id;
		
		$this->load->model('Cliente_model');

		if ($this->form_validation->run() == true)
		{
			$data = $this->Cliente_model->registrar_venta($this->input->post('id_cliente'),$this->input->post('id_producto'),$this->input->post('volumen'),$this->input->post('marca'), $usuario);
			print_r(json_encode($data));
		}	
	}

	function registrar_meta()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}

		$this->form_validation->set_rules('Nombre_Meta', 'Nombre de Meta', 'required');
		$this->form_validation->set_rules('Cobertura', 'Cobertura', 'required|numeric');
		$this->form_validation->set_rules('Incentivo', 'Incentivo', 'required|numeric');
		$this->form_validation->set_rules('Fecha_inicio', 'Inicio', 'required');
		$this->form_validation->set_rules('Fecha_fin', 'Fin', 'required');
		$this->form_validation->set_rules('Marca', 'Marca', 'required');
		$this->form_validation->set_rules('Volumen', 'Volumen', 'required');
		$this->form_validation->set_rules('Tipo', 'Tipo de Meta', 'required');
		$this->form_validation->set_rules('Mostrar', 'Mostrar', '');
	
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Usuario_model');
			$data['Nombre_Meta'] = $this->input->post('Nombre_Meta');
			$data['Cobertura'] = $this->input->post('Cobertura');
			$data['Incentivo'] = $this->input->post('Incentivo');
			$data['Fecha_inicio'] = $this->input->post('Fecha_inicio');
			$data['Fecha_fin'] = $this->input->post('Fecha_fin');
			$data['Marca'] = $this->input->post('Marca');
			$data['Volumen'] = $this->input->post('Volumen');
			$data['Tipo'] = $this->input->post('Tipo');
			$data['Mostrar'] = $this->input->post('Mostrar');

			if($data['Mostrar']==''){
				$data['Mostrar']=1;
			}
			
			$meta = $this->Usuario_model->registrar_meta($data['Nombre_Meta'],$data['Cobertura'],$data['Incentivo'],$data['Fecha_inicio'],$data['Fecha_fin'],$data['Marca'],$data['Volumen'],$data['Tipo'],$data['Mostrar']);
		
			redirect('meta/detalles/'.$meta);
		}
		else
		{
			$data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
			$data['Marcas']=  $this->usuario_lib->listar_marcas();
			$data['titulo'] = 'Nueva Meta';
			$this->load->view('templates/header',$data);
			$this->load->view('meta/registrar');
			$this->load->view('templates/footer');
		}
	}


	function detalles_meta($idMETA)
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}
		
		$data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
		$data['idMETA'] = $idMETA;
		$data['meta'] = $this->Usuario_model->datos_meta($idMETA);
		$data['detalles'] = $this->Usuario_model->datos_detalles_meta($idMETA);

		
		$data['titulo'] = 'Detalles de Meta ';
		$this->load->view('templates/header',$data);
		$this->load->view('meta/registrar_detalles');
		$this->load->view('templates/footer');
	}

	function ventas_por_meta()
	{
		//validaciones
		$this->form_validation->set_rules('idMETA', 'Meta', 'required');	
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Usuario_model');
			$data['ventas'] = $this->Usuario_model->listar_ventas_por_meta($this->input->post('idMETA'));
			
			$this->load->view('meta/ventas',$data);
		}
		else echo 0;
	}

	function actualizar_meta()
	{
		//validaciones
		$this->form_validation->set_rules('idMETA', 'ID Meta', 'required|numeric');
		$this->form_validation->set_rules('Nombre_Meta', 'Nombre de Meta', 'required');
		$this->form_validation->set_rules('Cobertura', 'Cobertura', 'required|numeric');
		$this->form_validation->set_rules('Incentivo', 'Incentivo', 'required|numeric');
		$this->form_validation->set_rules('Fecha_inicio', 'Inicio', 'required');
		$this->form_validation->set_rules('Fecha_fin', 'Fin', 'required');
		$this->form_validation->set_rules('Volumen', 'Volumen', 'required');
		$this->form_validation->set_rules('Mostrar', 'Mostrar', 'required');
		$this->form_validation->set_rules('Prioridad', 'Prioridad', 'required');
	
		if ($this->form_validation->run() == true)
		{
			$data['idMETA'] = $this->input->post('idMETA');			
			$data['Nombre_Meta'] = $this->input->post('Nombre_Meta');
			$data['Cobertura'] = $this->input->post('Cobertura');
			$data['Incentivo'] = $this->input->post('Incentivo');
			$data['Fecha_inicio'] = $this->input->post('Fecha_inicio');
			$data['Fecha_fin'] = $this->input->post('Fecha_fin');
			$data['Volumen'] = $this->input->post('Volumen');
			$data['Mostrar'] = $this->input->post('Mostrar');
			$data['Prioridad'] = $this->input->post('Prioridad');

			$this->load->model('Usuario_model');
			$this->Usuario_model->actualizar_meta($data['idMETA'], $data['Nombre_Meta'],$data['Cobertura'],$data['Volumen'],$data['Incentivo'],$data['Fecha_inicio'],$data['Fecha_fin'],$data['Mostrar'],$data['Prioridad']);
			echo 1;
		}
		else echo 0;
	}

	function cerrar_mes()
	{
		//validaciones
		$this->form_validation->set_rules('idMETA', 'ID Meta', 'required|numeric');
		$this->form_validation->set_rules('Mes', 'Mes', 'required');
		$this->form_validation->set_rules('Efectivo', 'Efectivo', 'required');
		$this->form_validation->set_rules('Alcanzado', 'Alcanzado', 'required');
		$this->form_validation->set_rules('Logrado', 'Logrado', 'required');
	
		if ($this->form_validation->run() == true)
		{
			$data['idMETA'] = $this->input->post('idMETA');			
			$data['Mes'] = $this->input->post('Mes');
			$data['Efectivo'] = $this->input->post('Efectivo');
			$data['Alcanzado'] = $this->input->post('Alcanzado');
			$data['Logrado'] = $this->input->post('Logrado');

			$this->load->model('Usuario_model');
			$this->Usuario_model->cerrar_mes($this->ion_auth->user()->row()->id,$data['idMETA'], $data['Mes'],$data['Efectivo'],$data['Alcanzado'],$data['Logrado']);
			echo 1;
		}
		else echo 0;
	}

	function retirar_detalle_meta()
	{
		//validaciones
		$this->form_validation->set_rules('idPRODUCTO', 'Producto', 'required');
		$this->form_validation->set_rules('idMETA', 'Meta', 'required');	
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Usuario_model');
			$this->Usuario_model->retirar_detalle_meta($this->input->post('idPRODUCTO'),$this->input->post('idMETA'));
			echo 1;
		}
		else echo 0;
	}

	function retirar_meta()
	{
		//validaciones
		$this->form_validation->set_rules('idMETA', 'Meta', 'required');	
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Usuario_model');
			echo $this->Usuario_model->retirar_meta($this->input->post('idMETA'));
		}
		else echo 0;
	}

	function listar_metas()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}

		$this->load->model('Usuario_model');
		$data['idUsuario'] = $this->ion_auth->user()->row()->id;
		$data['datos_metas'] = $this->Usuario_model->listarMetas($data['idUsuario'],0);
		
		$this->load->view('templates/header',$data);
		$this->load->view('meta/lista');
		$this->load->view('templates/footer');
	}


	function importar_clientes()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}

		$this->load->model('Usuario_model');
		$data['idUsuario'] = $this->ion_auth->user()->row()->id;
		
		$data['ventas'] = $this->Usuario_model->importar_clientes($data['idUsuario']);
		$this->load->view('usuario/ventas_vacias',$data);		
	}


	function importar_productos()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}

		$this->load->model('Usuario_model');
		$data['idUsuario'] = $this->ion_auth->user()->row()->id;
		$data['Marcas']=  $this->usuario_lib->listar_marcas();
		$data['productos'] = $this->Usuario_model->importar_productos($data['idUsuario']);
		$this->load->view('usuario/productos_sin_marca',$data);		
	}


	function registro_premios()
	{

		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}

		$this->form_validation->set_rules('Marca', 'Marca', '');
		$this->form_validation->set_rules('Mes', 'Mes', '');

		$data['premios'] = [];
		$data['Marcas']=  $this->usuario_lib->listar_marcas();

		if ($this->form_validation->run() == true){

			$data['Mes'] = $this->input->post('Mes');
			$data['Marca'] = $this->input->post('Marca');
			$data['idUsuario'] = $this->ion_auth->user()->row()->id;

			$this->load->model('Usuario_model');
			$data['premios'] = $this->Usuario_model->registro_premios($data['idUsuario'],$data['Mes'],$data['Marca']);
		}

		$this->load->view('templates/header',$data);
		$this->load->view('meta/registro_premios');
		$this->load->view('templates/footer');	
	}

	
	function pagar_premio()
	{
		//validaciones
		$this->form_validation->set_rules('idMETA', 'ID META', 'required');
		$this->form_validation->set_rules('Mes', 'Mes', 'required');
		$this->form_validation->set_rules('idUsuario', 'ID Usuario', 'required');
		
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Usuario_model');
			$idMETA = $this->input->post('idMETA');
			$Mes = $this->input->post('Mes');
			$idUsuario = $this->input->post('idUsuario');

			echo $this->Usuario_model->pagar_premio($idMETA, $Mes,$idUsuario);
			
		}
		else echo 0;
	}

	
	function subir_sincro()
	{
		//validaciones
		$this->form_validation->set_rules('Archivo', 'Archivo', 'required');
		
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Usuario_model');
			$Archivo = $this->input->post('Archivo');
			$idUsuario = $this->ion_auth->user()->row()->id;

			echo $this->Usuario_model->subir_sincro($Archivo,$idUsuario);
			
		}
		else echo 0;
	}

	function cuota_general()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}


		$data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
		$data['tipo_mensaje'] ="";
		
		$data['usuario'] = $this->ion_auth->user()->row();
		$data['marcas'] = $this->Usuario_model->cuota_general($data['usuario']->id);

		$data['titulo']= 'Cuota General y Por Marca';
		$this->load->view('templates/header', $data);
		$this->load->view('usuario/cuota_general');
		$this->load->view('templates/footer');
	}

}
