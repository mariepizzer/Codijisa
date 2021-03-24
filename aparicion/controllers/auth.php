<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->helper('language');
	}

	function login()
	{
		$this->data['title'] = "Iniciar Sesión";

		//validaciones
		$this->form_validation->set_rules('identity', 'Usuario / Email', 'required|trim');
		$this->form_validation->set_rules('contrasena', 'Contraseña', 'required|trim');

		if ($this->form_validation->run() == true)
		{
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('contrasena'), $remember))
			{
				redirect('/');
			}
			else
			{
				$this->session->set_flashdata('mensaje', $this->ion_auth->errors());
				redirect('iniciar_sesion');
			}
		}
		else
		{
			$this->data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');

			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$this->data['etiqueta_identidad'] = $this->lang->line('forgot_password_username_identity_label');
			}
			else
			{
				$this->data['etiqueta_identidad'] = $this->lang->line('forgot_password_email_identity_label');
			}

			$this->data['titulo']  = "Iniciar Sesión";
			$this->load->view('auth/header',$this->data);
			$this->load->view('auth/iniciar_sesion');
			$this->load->view('auth/footer');
		}
	}

	function logout()
	{
		$logout = $this->ion_auth->logout();

		$this->session->set_flashdata('mensaje', $this->ion_auth->messages());
		redirect('iniciar_sesion');
	}

	function change_password()
	{
		$this->form_validation->set_rules('antigua_contrasena', "Antigua contraseña", 'required|trim');
		$this->form_validation->set_rules('nueva_contrasena', "Nueva contraseña", 'required|trim|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confirma_contrasena]');
		$this->form_validation->set_rules('confirma_contrasena', "Confirmación de contraseña", 'required|trim');

		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			$this->data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');

			$this->data['user_id'] = $user->id;

			$this->data['titulo']  = "Cambia tu contraseña";
			$this->load->view('templates/header',$this->data);
			$this->load->view('auth/cambiar_contrasena');
			$this->load->view('templates/footer');
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('antigua_contrasena'), $this->input->post('nueva_contrasena'));

			if ($change)
			{
				$this->session->set_flashdata('mensaje', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('mensaje', $this->ion_auth->errors());
				redirect('cambiar_contrasena');
			}
		}
	}

	function forgot_password()
	{
		$this->form_validation->set_rules('email', "Email", 'required|trim');
		if ($this->form_validation->run() == false)
		{
			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$this->data['etiqueta_identidad'] = $this->lang->line('forgot_password_username_identity_label');
			}
			else
			{
				$this->data['etiqueta_identidad'] = $this->lang->line('forgot_password_email_identity_label');
			}

			$this->data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
			
			$this->data['titulo']  = "Olvidáste tu contraseña :/";
			$this->load->view('auth/header',$this->data);
			$this->load->view('auth/olvido_contrasena');
			$this->load->view('auth/footer');
		}
		else
		{
			// get identity from username or email
			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
			}
			else
			{
				$identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
			}

        	if(empty($identity)) {
        		$this->ion_auth->set_message('forgot_password_email_not_found');
                $this->session->set_flashdata('mensaje', $this->ion_auth->messages());
        		redirect("olvide_contrasena");
    		}

			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				//if there were no errors
				$this->session->set_flashdata('mensaje', $this->ion_auth->messages());
				redirect("iniciar_sesion"); 
			}
			else
			{
				$this->session->set_flashdata('mensaje', $this->ion_auth->errors());
				redirect("olvide_contrasena");
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}
		
		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			$this->form_validation->set_rules('nueva_contrasena', "Nueva contraseña", 'required|trim|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confirma_contrasena]');
			$this->form_validation->set_rules('confirma_contrasena', "Confirmar contraseña", 'required|trim');

			if ($this->form_validation->run() == false)
			{

				$this->data['mensaje'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('mensaje');
				$this->data['user_id'] = $user->id;
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				$this->data['titulo']  = "Resetea tu contraseña";
				$this->load->view('auth/header',$this->data);
				$this->load->view('auth/resetear_contrasena');
				$this->load->view('auth/footer');
				
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);
					show_error($this->lang->line('error_csrf'));
				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('nueva_contrasena'));

					if ($change)
					{
						//if the password was successfully changed
						$this->session->set_flashdata('mensaje', $this->ion_auth->messages());
						$this->logout();
					}
					else
					{
						$this->session->set_flashdata('mensaje', $this->ion_auth->errors());
						redirect('resetear_contrasena/' . $code);
					}
				}
			}
		}
		else
		{
			$this->session->set_flashdata('mensaje', $this->ion_auth->errors());
			redirect("olvide_contrasena", 'refresh');
		}
	}

	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('mensaje', $this->ion_auth->messages());
			redirect("panel");
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('mensaje', $this->ion_auth->errors());
			redirect("olvide_contrasena");
		}
	}

	function deactivate($id = NULL)
	{

		$id = (int) $id;

		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->load->view('auth/desactivar_usuario', $this->data);
		}
		else
		{
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('mensaje', $this->ion_auth->messages());
				$this->ion_auth->deactivate($id);
			}
			redirect('mi_perfil');
		}
	}

	function create_user()
	{
		$tables = $this->config->item('tables','ion_auth');
		
		//validate form input
		$this->form_validation->set_rules('nombres', "Nombres", 'required|xss_clean');
		$this->form_validation->set_rules('apellidos', "Apellidos", 'required|xss_clean');
		$this->form_validation->set_rules('email', "Email", 'required|valid_email|is_unique['.$tables['users'].'.email]');
		$this->form_validation->set_rules('telefono', "Teléfono", 'xss_clean|numeric');
		$this->form_validation->set_rules('contrasena', "Contraseña", 'required|trim|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confirma_contrasena]');
		$this->form_validation->set_rules('confirma_contrasena', "Confirmación de Contraseña", 'required|trim');


		if ($this->form_validation->run() == true)
		{
			$username = strtolower(eliminar_tildes($this->input->post('nombres'))) . ' ' . eliminar_tildes(strtolower($this->input->post('apellidos')));
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('contrasena');

			$grupos_seleccionados = array('2');

			$additional_data = array(
				'first_name' => $this->input->post('nombres'),   //first_name es el nombre de la columna en bdx
				'last_name'  => $this->input->post('apellidos'),
				'phone'      => $this->input->post('telefono')
			);
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data,$grupos_seleccionados))
		{
			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('mensaje', $this->ion_auth->messages());
			redirect("mi_perfil");
		}
		else
		{
			$groups=$this->ion_auth->groups()->result_array();
			
			$this->data['groups'] = $groups;
			
			$this->data['mensaje'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('mensaje')));
			
			$this->data['titulo']  = "Crear cuenta";
			$this->load->view('auth/header', $this->data);
			$this->load->view('auth/crear_usuario');
			$this->load->view('auth/footer');
			
		}
	}

	function edit_user($id)
	{
		$this->data['title'] = "Edita tu perfil";
		if (!$this->ion_auth->logged_in())
		{
			redirect('iniciar_sesion');
		}

		if ( !$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id) )
		{
			$this->session->set_flashdata('mensaje', "No tiene permisos para acceder a la página solicitada.");
			redirect('mi_perfil');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
		$this->form_validation->set_rules('nombres', 'Nombres', 'required|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|xss_clean');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'required|xss_clean|numeric');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			$data = array(
				'first_name' => $this->input->post('nombres'),
				'last_name'  => $this->input->post('apellidos'),
				'email'      => $this->input->post('email'),
				'phone'      => $this->input->post('telefono')
			);

			//update the password if it was posted
			if ($this->input->post('contrasena'))
			{
				$this->form_validation->set_rules('contrasena',"Contraseña", 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confirma_contrasena]');
				$this->form_validation->set_rules('confirma_contrasena', "Confirma Contraseña", 'required');

				$data['password'] = $this->input->post('contrasena');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$this->ion_auth->update($user->id, $data);
				$this->session->set_flashdata('tipo_mensaje', "exito");
				$this->session->set_flashdata('mensaje', "Cambios guardados.");
				redirect('mi_perfil');
			}
		}

		//display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		$this->data['mensaje'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : ($this->session->flashdata('mensaje') ? pre_mensaje().$this->session->flashdata('mensaje').post_mensaje() : '')));

		//pass the user to the view
		$this->data['user'] = $user;

		$this->data['titulo']  = "Editar tu perfil";
		$this->load->view('templates/header', $this->data);
		$this->load->view('auth/editar_usuario');
		$this->load->view('templates/footer');
	}

	function create_group()
	{

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('mensaje', "No tiene permisos para acceder a la página solicitada.");
			redirect('iniciar_sesion');
		}

		//validate form input
		$this->form_validation->set_rules('nombre_grupo', "Nombre", 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('descripcion_grupo', "Descripción", 'xss_clean|required');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('nombre_grupo'), $this->input->post('descripcion_grupo'));
			if($new_group_id)
			{
				$this->session->set_flashdata('mensaje', $this->ion_auth->messages());
				redirect("panel");
			}
		}
		else
		{
			$this->data['mensaje'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('mensaje')));
			
			$this->data['titulo']  = "Crear Nuevo Rol";
			$this->load->view('templates/header', $this->data);
			$this->load->view('auth/crear_rol');
			$this->load->view('templates/footer');
		}
	}

	function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('mi_perfil');
		}

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('iniciar_sesion');
		}

		$group = $this->ion_auth->group($id)->row();

		//validate form input
		$this->form_validation->set_rules('nombre_grupo',"Nombre", 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('descripcion_grupo', "Descripción", 'required|xss_clean');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['nombre_grupo'], $_POST['descripcion_grupo']);

				if($group_update)
				{
					$this->session->set_flashdata('mensaje', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('mensaje', $this->ion_auth->errors());
				}
				redirect("panel");
			}
		}

		$this->data['mensaje'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('mensaje')));

		//pass the user to the view
		$this->data['group'] = $group;

		$this->data['titulo']  = "Editar Rol";
		$this->load->view('templates/header', $this->data);
		$this->load->view('auth/editar_rol');
		$this->load->view('templates/footer');
	}

	function remove_group($group_id = NULL)
	{

		$group_id = (int) $group_id;

		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', 'ID de Rol', 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['group'] = $this->ion_auth->group($group_id)->row();

			$this->load->view('auth/eliminar_rol', $this->data);
		}
		else
		{
			if ($this->_valid_csrf_nonce() === FALSE || $group_id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
			{
				$this->ion_auth->delete_group($group_id);
				$this->ion_auth->messages();
			}
			redirect('mi_perfil');
		}
	}

	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _render_page($view, $data=null, $render=false)
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $render);

		if (!$render) return $view_html;
	}

}
