<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Receta extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->Usuario_model->inicializar($this->ion_auth->get_user_id());
	}

	function semana()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}

		$this->load->model('Receta_model');

		$data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
		$data['tipo_mensaje'] ="";
		
		$data['usuario'] = $this->ion_auth->user()->row();
		$data['categorias'] = $this->Receta_model->listar_categorias();
		$data['items_semana'] = $this->Receta_model->cargar_semana(); 

		$data['titulo']= 'Semana';
		$this->load->view('templates/header_receta', $data);
		$this->load->view('receta/semana');
		$this->load->view('templates/footer_receta');
	}

	function buscar_Plato_o_Ingrediente()
	{
		//validaciones
		$this->form_validation->set_rules('VALfrase', 'Texto a buscar', 'required');	
		if ($this->form_validation->run() == true)
		{
			$this->load->model('Receta_model');
			$data['datos'] = $this->Receta_model->buscar($this->input->post('VALfrase'));
			$this->load->view('receta/buscar',$data);
		}
		else echo 0;
	}

	function resetear_semana_y_lista()
	{
		$this->load->model('Receta_model');
		$this->Receta_model->resetear_semana_y_lista();
		echo 1;
	}


	function crear_plato()
	{
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('Categoria', 'Categoría', 'required');
		$this->form_validation->set_rules('Comentario', 'Comentario', '');

		$this->load->model('Receta_model');

		if ($this->form_validation->run() == true)
		{

			$data['Nombre'] = $this->input->post('Nombre');
			$data['Categoria'] = $this->input->post('Categoria');
			$data['Comentario'] = $this->input->post('Comentario');
			$idPlato = $this->Receta_model->crear_plato($data['Nombre'],$data['Categoria'],$data['Comentario']);
		
			redirect('semana/plato/'.$idPlato);
			
		}
		else
		{
			$data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
			
			$data['categorias'] = $this->Receta_model->listar_categorias();

			$data['titulo'] = 'Nuevo Plato';
			$this->load->view('templates/header_receta',$data);
			$this->load->view('receta/crear_plato');
			$this->load->view('templates/footer_receta');
		}
	}

	function detalles_plato($idPlato)
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}
		
		$this->load->model('Receta_model');
		$data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
		$data['idPlato'] = $idPlato;
		$data['categorias'] = $this->Receta_model->listar_categorias();
		$data['plato'] = $this->Receta_model->datos_plato($idPlato);
		$data['ingredientes'] = $this->Receta_model->ingredientes_por_plato($idPlato);
		
		$data['titulo'] = 'Plato';
		$this->load->view('templates/header_receta',$data);
		$this->load->view('receta/detalles_plato');
		$this->load->view('templates/footer_receta');
	}

	function retirar_ingrediente_plato()
	{
		//validaciones
		$this->form_validation->set_rules('idIngrediente', 'Ingrediente', 'required');
		$this->form_validation->set_rules('idPlato', 'Plato', 'required');	

		if ($this->form_validation->run() == true)
		{
			$this->load->model('Receta_model');
			$this->Receta_model->retirar_ingrediente_plato($this->input->post('idIngrediente'),$this->input->post('idPlato'));
			echo 1;
		}
		else echo 0;
	}

	function borrar_plato(){
		//validaciones
		$this->form_validation->set_rules('idPlato', 'Id Plato', 'required|numeric');
	
		if ($this->form_validation->run() == true)
		{
			$data['idPlato'] = $this->input->post('idPlato');

			$this->load->model('Receta_model');
			echo $this->Receta_model->borrar_plato($data['idPlato']);
		}
		else echo 0;
	}

	function actualizar_plato()
	{
		//validaciones
		$this->form_validation->set_rules('idPlato', 'Id Plato', 'required|numeric');
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('Categoria', 'Categoria', 'required');
		$this->form_validation->set_rules('Comentario', 'Comentario', '');
	
		if ($this->form_validation->run() == true)
		{
			$data['idPlato'] = $this->input->post('idPlato');			
			$data['Nombre'] = $this->input->post('Nombre');
			$data['Categoria'] = $this->input->post('Categoria');
			$data['Comentario'] = $this->input->post('Comentario');

			$this->load->model('Receta_model');
			echo $this->Receta_model->actualizar_plato($data['idPlato'], $data['Nombre'],$data['Categoria'],$data['Comentario']);
		}
		else echo 0;
	}

	function guardar_semana()
	{
		//validaciones
		$this->form_validation->set_rules('Dia', 'Día', 'required|numeric');
		$this->form_validation->set_rules('Turno', 'Turno', 'required|numeric');
		$this->form_validation->set_rules('Tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('Id', 'Id', 'required|numeric');
	
		if ($this->form_validation->run() == true)
		{
			$data['Dia'] = $this->input->post('Dia');
			$data['Turno'] = $this->input->post('Turno');
			$data['Tipo'] = $this->input->post('Tipo');
			$data['Id'] = $this->input->post('Id');

			$this->load->model('Receta_model');
			$semana_guardada = $this->Receta_model->guardar_semana($data['Dia'], $data['Turno'], $data['Tipo'], $data['Id']);
			
			echo $semana_guardada;
		}
		else echo 0;
	}

	function procesar_lista()
	{
		$this->load->model('Receta_model');
		$semana_guardada = $this->Receta_model->procesar_lista();
		
		echo $semana_guardada;
	
	}

	function cargar_Lista_Lista()
	{
		$this->load->model('Receta_model');
		$data['ingredientes'] = $this->Receta_model->cargar_lista();
		
		$this->load->view('receta/cargar_lista',$data);
	}


	function cargar_total_ingredientes()
	{
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}
		
		$this->load->model('Receta_model');
		$data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
		$data['categorias'] = $this->Receta_model->listar_categorias();
		$data['ingredientes'] = $this->Receta_model->cargar_total_ingredientes();
		
		$data['titulo'] = 'Ingredientes';
		$this->load->view('templates/header_receta',$data);
		$this->load->view('receta/cargar_total_ingredientes');
		$this->load->view('templates/footer_receta');
	}

	function agregar_ingrediente_plato()
	{
		//validaciones
		$this->form_validation->set_rules('idPlato', 'Id Plato', 'required|numeric');
		$this->form_validation->set_rules('idIngrediente', 'Id Ingrediente', 'required|numeric');
	
		if ($this->form_validation->run() == true)
		{
			$data['idPlato'] = $this->input->post('idPlato');			
			$data['idIngrediente'] = $this->input->post('idIngrediente');

			$this->load->model('Receta_model');
			echo $this->Receta_model->agregar_ingrediente_plato($data['idPlato'], $data['idIngrediente']);
		}
		else echo 0;
	}
	
	function crear_ingrediente()
	{
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('Categoria', 'Categoría', 'required');
		$this->form_validation->set_rules('Comentario', 'Comentario', '');

		$this->load->model('Receta_model');

		if ($this->form_validation->run() == true)
		{

			$data['Nombre'] = $this->input->post('Nombre');
			$data['Categoria'] = $this->input->post('Categoria');
			$data['Comentario'] = $this->input->post('Comentario');
			$idPlato = $this->Receta_model->crear_ingrediente($data['Nombre'],$data['Categoria'],$data['Comentario']);
		
			redirect('semana/ingredientes');
			
		}
		else
		{
			$data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
			
			$data['categorias'] = $this->Receta_model->listar_categorias();

			$data['titulo'] = 'Nuevo Ingrediente';
			$this->load->view('templates/header_receta',$data);
			$this->load->view('receta/crear_ingrediente');
			$this->load->view('templates/footer_receta');
		}
	}

	function crear_ingrediente_desde_plato()
	{
		//validaciones
		$this->form_validation->set_rules('Nombre_ingrediente', 'Nombre Ingrediente', 'required');
	
		if ($this->form_validation->run() == true)
		{
			$data['Nombre'] = $this->input->post('Nombre_ingrediente');

			$this->load->model('Receta_model');
			echo $this->Receta_model->crear_ingrediente_sin_categoria($data['Nombre']);
		}
		else echo 0;
	}


    function getIngredientesAutocomplete() 
	{
		$this->form_validation->set_rules('Frase_ingrediente', 'Ingrediente', 'required');
		$this->form_validation->set_rules('idPlato', 'Id Plato', 'required|numeric');

		if ($this->form_validation->run() == true)
		{

			$lista_ingredientes = array();
	        $texto_ingrediente = $this->input->post('Frase_ingrediente');
	        $idPlato = $this->input->post('idPlato');
	        $this->load->model('Receta_model');
	        $lista_ingredientes = $this->Receta_model->buscar_ingredientes($texto_ingrediente, $idPlato);

	        $this->output->set_header('Content-Type: application/json');
	        echo json_encode($lista_ingredientes);

		}
		else{
			echo "ERROR Frase_ingrediente  > ".$this->input->post('Frase_ingrediente');
		}

    }

    function getPlatosAutocomplete() 
	{
		$this->form_validation->set_rules('Nombre', 'Plato', 'required');

		if ($this->form_validation->run() == true)
		{

			$lista_platos = array();
	        $Frase_plato = $this->input->post('Nombre');
	        $this->load->model('Receta_model');
	        $lista_platos = $this->Receta_model->buscar_platos($Frase_plato);

	        $this->output->set_header('Content-Type: application/json');
	        echo json_encode($lista_platos);

		}
		else{
			echo "ERROR Frase_ingrediente  > ".$this->input->post('Frase_ingrediente');
		}

    }

    function cambiarEstadoIngrediente(){
    	$this->form_validation->set_rules('NuevoEstado', 'Nuevo Estado', 'required');
    	$this->form_validation->set_rules('idIngrediente', 'Id Ingrediente', 'required');
	
		if ($this->form_validation->run() == true)
		{
			$data['NuevoEstado'] = $this->input->post('NuevoEstado');
			$data['idIngrediente'] = $this->input->post('idIngrediente');

			$this->load->model('Receta_model');
			echo $this->Receta_model->cambiarEstadoIngrediente($data['idIngrediente'], $data['NuevoEstado']);
		}
		else echo 0;
    }


    function cambiarComentario(){
    	$this->form_validation->set_rules('nuevoComentario', 'Nuevo Comentario', 'required');
    	$this->form_validation->set_rules('idIngrediente', 'Id Ingrediente', 'required');
	
		if ($this->form_validation->run() == true)
		{
			$data['nuevoComentario'] = $this->input->post('nuevoComentario');
			$data['idIngrediente'] = $this->input->post('idIngrediente');

			$this->load->model('Receta_model');
			echo $this->Receta_model->cambiarComentario($data['idIngrediente'], $data['nuevoComentario']);
		}
		else echo 0;
    }

    function actualizar_ingrediente()
	{
		//validaciones
		$this->form_validation->set_rules('idIngrediente', 'Id Ingrediente', 'required|numeric');
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('Categoria', 'Categoria', 'required');
		$this->form_validation->set_rules('Comentario', 'Comentario', '');
	
		if ($this->form_validation->run() == true)
		{
			$data['idIngrediente'] = $this->input->post('idIngrediente');			
			$data['Nombre'] = $this->input->post('Nombre');
			$data['Categoria'] = $this->input->post('Categoria');
			$data['Comentario'] = $this->input->post('Comentario');

			$this->load->model('Receta_model');
			echo $this->Receta_model->actualizar_ingrediente($data['idIngrediente'], $data['Nombre'],$data['Categoria'],$data['Comentario']);
		}
		else echo 0;
	}

}
