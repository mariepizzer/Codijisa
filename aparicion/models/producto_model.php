<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
	* Name:  Producto_model
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

class Producto_model extends CI_Model
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

    public function datos($id)
    {
		$query = $this->db->query("SELECT idPRODUCTO, Nombre, marca_idMARCA, Activo, Imagen, Precio, UnidadDefecto, UndXEmpaque FROM PRODUCTO WHERE idPRODUCTO=".$id);
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$datos = array(
				'id' => $row->idPRODUCTO, 
				'nombre' => $row->Nombre, 
				'marca' => $row->marca_idMARCA, 
				'activo' => $row->Activo,
				'imagen' => $row->Imagen,
				'Precio' => $row->Precio,
				'UnidadDefecto' => $row->UnidadDefecto,
				'UndXEmpaque' => $row->UndXEmpaque,
				);

			return $datos; 			
		}
		return array();
    }

    public function datos_resumidos($id)
    {
		$query = $this->db->query("SELECT idPRODUCTO, Nombre, marca_idMARCA, Imagen  FROM PRODUCTO WHERE idPRODUCTO=".$id);
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$datos = array(
				'id' => $row->idPRODUCTO, 
				'nombre' => $row->Nombre, 
				'imagen' => $row->Imagen, 
				'marca' => $row->marca_idMARCA,
				);

			return $datos; 			
		}
		return array();
    }

    public function buscar($frase)
    {
		$resultado =  array();
		$query = $this->db->query("SELECT idPRODUCTO, Nombre, marca_idMARCA, Imagen FROM PRODUCTO where UCASE(Nombre) regexp UCASE('{$frase}')");
			foreach ($query->result() as $row)
			{
				$resultado[] = array(
					'id' => $row->idPRODUCTO, 
					'nombre' => $row->Nombre, 
					'imagen' => $row->Imagen,
					'marca' => $row->marca_idMARCA,
					);
			}
			return $resultado;
    }

    public function listar_por_marca($idMETA, $Marca)
    {
		$resultado =  array();
		$query = $this->db->query("CALL Listar_productos_marca_meta({$idMETA},'{$Marca}') ");
			foreach ($query->result() as $row)
			{
				$resultado[] = array(
					'idPRODUCTO' => $row->idPRODUCTO, 
					'Nombre' => $row->Nombre,
					);
			}
			return $resultado;
    }

    public function agregar_producto_meta($idMETA, $idPRODUCTO,$Pedido_minimo,$Marca)
    {
    	$query = $this->db->query("INSERT INTO DETALLE_META VALUES({$idPRODUCTO},'{$Marca}',{$idMETA},{$Pedido_minimo})");
    	return ($this->db->affected_rows() != 1) ? 0 : 1;
	}

    public function agregar_todos_producto_meta($idMETA, $MARCA)
    {
    	$query = $this->db->query("CALL Insertar_Productos_Meta_Marca({$idMETA},'{$MARCA}')");
    	return ($this->db->affected_rows() == 0) ? 0 : 1;
	}

}
