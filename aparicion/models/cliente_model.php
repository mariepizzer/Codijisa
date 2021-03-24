<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
	* Name:  Cliente_model
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

class Cliente_model extends CI_Model
{
	public $id;
	public $nombre;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function inicializar($id,$nombre)
    {	
    	$this->id = $id;
		$this->nombre = $nombre;
		return $this;
    }

    public function registrar($idCLIENTE, $Nombre, $Zona,$Celular, $Direccion)
	{
		$query = $this->db->query("INSERT INTO CLIENTE VALUES({$idCLIENTE},'{$Nombre}','{$Zona}','{$Celular}',0,1,'{$Direccion}',1)");
	}

    public function datos($id)
    {
		$query = $this->db->query("SELECT * FROM CLIENTE WHERE idCLIENTE=".$id);
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$datos = array(
				'id' => $row->idCLIENTE, 
				'nombre' => $row->Nombre, 
				'zona' => $row->Zona, 
				'celular' => $row->Celular,
				'activo' => $row->Activo,
				'colgate' => $row->listaColgate,
				'direccion' => $row->Direccion,
				);

			return $datos; 			
		}
		return array();
    }

 	public function buscar($frase)
	{
		$resultado =  array();
		$query = $this->db->query("CALL BuscarCliente('{$frase}')");
			foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'id' => $row->idCLIENTE, 
				'nombre' => $row->Nombre, 
				'zona' => $row->Zona, 
				'activo' => $row->Activo,
				'colgate' => $row->listaColgate,
				'celular' => $row->Celular,

				);
			}
			return $resultado;
	}

	public function BuscarPorZona($zona)
	{
		$query = $this->db->query("SELECT idCLIENTE, Nombre, Zona, Activo, listaColgate, Celular FROM CLIENTE where Zona regexp '$zona'");
		if($query->num_rows() > 0)
		{

			foreach ($query->result() as $row)
			{
				$datos[] = array(
				'id' => $row->idCLIENTE, 
				'nombre' => $row->Nombre, 
				'zona' => $row->Zona, 
				'activo' => $row->Activo,
				'colgate' => $row->listaColgate,
				'celular' => $row->Celular,

				);
			}
			return $datos; 			
		}
		return array();
	}


	public function listar_metas_y_alcances($idCLIENTE, $idUsuario)
	{
		$resultado =  array();
		$query = $this->db->query("CALL listar_metas_y_alcances_por_cliente($idCLIENTE,$idUsuario)");

			foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'Mostrar' => $row->Mostrar,
				'idMETA' => $row->idMETA,
				'Marca' => $row->producto_marca_idMarca,
				'Nombre' => $row->nombre,
				'Coberturado' => $row->Coberturado,
				'Porcentaje' => $row->Porcentaje,
					);
			}
			return $resultado;
	}

	public function registrar_venta($idCLIENTE, $idPRODUCTO, $Volumen, $Marca, $Usuario)
	{
		$query = $this->db->query("CALL RegistrarVenta({$idCLIENTE},{$idPRODUCTO},{$Volumen},{$Usuario},'{$Marca}')");
		$resultado = $query->result();
		return $resultado;
	}

	public function listarVentas($idCLIENTE, $idUsuario){
		$query = $this->db->query("SELECT V.idVENTA, P.Nombre, P.marca_idMARCA AS Marca, V.fecha, V.Volumen,V.Monto
									FROM VENTA V
									JOIN CLIENTE C ON C.idCLIENTE = V.CLIENTE_idCLIENTE
									JOIN PRODUCTO P ON V.producto_idPRODUCTO = P.idPRODUCTO
									WHERE idCLIENTE={$idCLIENTE} AND V.Activo=1 AND users_id={$idUsuario} AND MONTH(V.fecha) = MONTH(CURDATE()) AND YEAR(V.fecha) = YEAR(CURDATE())");
		if($query->num_rows() > 0)
		{

			foreach ($query->result() as $row)
			{
				$datos[] = array(
				'id' => $row->idVENTA, 
				'producto' => $row->Nombre,
				'marca' => $row->Marca,
				'fecha' => $row->fecha, 
				'volumen' => $row->Volumen, 
				'Monto' => $row->Monto,

				);
			}
			return $datos; 			
		}
		return array();
	}

	public function anularVenta($idVENTA)
	{
		$query = $this->db->query("UPDATE VENTA SET Activo=0 WHERE idVENTA={$idVENTA}");
	}

	public function guardarCelular($idCLIENTE, $Celular)
	{
		$query = $this->db->query("UPDATE CLIENTE SET Celular='{$Celular}' WHERE idCLIENTE={$idCLIENTE}");
	}


}
