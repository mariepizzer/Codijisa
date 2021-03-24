<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
                $this->load->view('usuario/subir_sincro', array('error' => ' ' ));
        }

        public function do_upload()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'txt|sql';
                $config['max_size']             = 1000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                if($_FILES != NULL){
                        $new_name = date("Y-m-d")."_".$_FILES["sincro"]['name'];
                        $config['file_name'] = $new_name;        
                }
                

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('sincro'))
                {
                        $data['mensaje'] = $this->upload->display_errors();
                        $data['tipo_mensaje'] ="";
                
                        $data['titulo']= 'Subir Sincro';
                        $this->load->view('templates/header', $data);
                        $this->load->view('usuario/subir_sincro');
                        $this->load->view('templates/footer');
                }
                else
                {

                        $data = array('upload_data' => $this->upload->data());
                        $data['titulo']= 'Subir Sincro';
                        $data['mensaje'] = "Sincro subido correctamente.";
                        $data['tipo_mensaje'] ="exito";

                        $this->load->model('Usuario_model');
                        $data['mensaje'] = $data['mensaje'] . $this->Usuario_model->subir_sincro('/home/iconwixp/public_html/codijisa/uploads/', $data['upload_data']['file_name']);


                        $this->load->view('templates/header', $data);
                        $this->load->view('usuario/subir_sincro');
                        $this->load->view('templates/footer');
                }
        }
}
?>
