<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
	* Name:  Receta_model
	*
	* Version: 1.0
	*
	* Author:  Marie Pinto Gozzer
	* 		   soy@mariepizzer.com
	*	  	   @mariepizzer
	*
	* Created:  01.04.2020
	*
	* Description:  
	*
*/

class Receta_model extends CI_Model
{
	public $id;

	public function __construct()
	{
		parent::__construct();
	}

	public function inicializar($id)
    {	
    	$this->id = $id;
    	return $this;
    }


	public function buscar($frase)
	{
		$resultado =  array();
		$query = $this->db->query("CALL __Buscar_Plato_o_Ingrediente('{$frase}')");
			foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'Id' => $row->Id, 
				'Nombre' => $row->Nombre, 
				'Categoria' => $row->Categoria, 
				'Tipo' => $row->Tipo, 
				);
			}
			return $resultado;
	}

   	public function mostrar_semana()
    {
    	$resultado =  array();
		$query = $this->db->query("CALL Listar_metas_por_marca_y_coberturas (3,1);");
		
		foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'Mostrar' => $row->Mostrar,	
				'idMETA' => $row->Meta,
				'Tipo' => $row->Tipo,
				'Nombre' => $row->Nombre,
				'Objetivo' => $row->Objetivo,
				'Volumen' => $row->Volumen,
				'Incentivo' => $row->Incentivo,
				'Fecha_inicio' => $row->Fecha_inicio,
				'Fecha_fin' => $row->Fecha_fin,
				'Marca' => $row->MARCA,
				'Activo' => $row->activo,
				'Avance_Cobertura' => $row->Avance_Cobertura,
				'Avance_Volumen' => $row->Avance_Volumen,
				'PROYECCION_Volumen' => $row->PROYECCION_Volumen,
				'PROYECCION_Cobertura' => $row->PROYECCION_Cobertura,
				'Dias_restantes' => $row->Dias_restantes,
				);
			}
		return $resultado;
    }

    public function listar_categorias(){
    	$query = $this->db->query('SELECT * FROM RECETAS_CATEGORIA');

		foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'idCategoria' => $row->idCategoria,	
				'Tipo' => $row->Tipo,	
				);
			}

		$query->next_result(); 
		$query->free_result(); 
		return $resultado;
    }


    public function crear_plato($Nombre, $Categoria, $Comentario)
	{
		$query = $this->db->query("INSERT INTO RECETAS_PLATO VALUES(NULL,'{$Nombre}','{$Categoria}','{$Comentario}')");
		$query = $this->db->query('SELECT LAST_INSERT_ID() AS idPlato'); 

		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $row->idPlato;
		}
		return 0;
	}

	public function datos_plato($idPlato)
	{
		$resultado =  array();
		$query = $this->db->query("SELECT * from RECETAS_PLATO WHERE idPlato=".$idPlato);

			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$resultado = array(
				'idPlato' => $row->idPlato,
				'Nombre' => $row->Nombre,
				'Categoria' => $row->Categoria,
				'Comentario' => $row->Comentario,
				);

				return $resultado; 			
			}
			return array();
	}

	public function ingredientes_por_plato($idPlato)
    {
		$resultado =  array();
		$query = $this->db->query("CALL __Listar_ingredientes_por_plato({$idPlato}) ");
			foreach ($query->result() as $row)
			{
				$resultado[] = array(
					'idIngrediente' => $row->idIngrediente, 
					'Nombre' => $row->Nombre,
					);
			}
			return $resultado;
    }

    public function retirar_ingrediente_plato($idIngrediente,$idPlato)
	{
		$query = $this->db->query("DELETE FROM RECETAS_INGREDIENTE_PLATO WHERE idIngrediente={$idIngrediente} AND idPlato = {$idPlato}");
	}
	public function actualizar_plato($idPlato, $Nombre, $Categoria, $Comentario)
	{
		$query = $this->db->query("UPDATE RECETAS_PLATO SET Nombre='{$Nombre}', Categoria='{$Categoria}', Comentario='{$Comentario}' WHERE idPlato= {$idPlato}");
		return ($this->db->affected_rows() != 1) ? 0 : 1;
	}

	public function buscar_ingredientes($frase, $idPlato) {
		$resultado =  array();
		$query = $this->db->query("CALL __Buscar_Ingredientes('{$frase}', $idPlato)");
			foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'name' => $row->Nombre,
				'idIngrediente' => $row->idIngrediente, 
				);
			}
		return $resultado;	
    }
 	
 	public function buscar_platos($frase) {
		$resultado =  array();
		$query = $this->db->query("SELECT idPlato, Nombre from RECETAS_PLATO where Nombre regexp '{$frase}'");
			foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'name' => $row->Nombre,
				'idPlato' => $row->idPlato, 
				);
			}
		return $resultado;	
    }

    public function agregar_ingrediente_plato($idPlato, $idIngrediente)
	{
		$query = $this->db->query("INSERT INTO RECETAS_INGREDIENTE_PLATO VALUES({$idIngrediente},{$idPlato})");
		return 1;
	}

	public function crear_ingrediente_sin_categoria($Nombre)
	{
		$query = $this->db->query("INSERT IGNORE INTO RECETAS_INGREDIENTE VALUES(NULL,'{$Nombre}',NULL, '')");
		$query = $this->db->query('SELECT LAST_INSERT_ID() AS idIngrediente'); 

		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $row->idIngrediente;
		}
		return 0;
	}

	public function borrar_plato($idPlato)
	{
		$query = $this->db->query("DELETE FROM RECETAS_INGREDIENTE_PLATO WHERE idPlato= {$idPlato}");
		$query = $this->db->query("DELETE FROM RECETAS_PLATO WHERE idPlato= {$idPlato}");
		return ($this->db->affected_rows() != 1) ? 0 : 1;
	}

	public function crear_ingrediente($Nombre, $Categoria, $Comentario)
	{
		$query = $this->db->query("INSERT IGNORE INTO RECETAS_INGREDIENTE VALUES(NULL,'{$Nombre}','$Categoria', '$Comentario')");
		$query = $this->db->query('SELECT LAST_INSERT_ID() AS idIngrediente'); 

		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $row->idIngrediente;
		}
		return 0;
	}

	public function procesar_lista()
	{
		$resultado =  array();
		$query = $this->db->query("CALL __Procesar_Lista()");
			foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'idIngrediente' => $row->idIngrediente, 
				'Nombre' => $row->Nombre, 
				'Categoria' => $row->Categoria, 
				'Nro_platos' => $row->Nro_platos, 
				);
			}
			return $resultado;
	}

	public function guardar_semana($Dia, $Turno, $Tipo, $Id)
	{
		$query = $this->db->query("INSERT INTO RECETAS_SEMANA VALUES (NULL, {$Dia}, {$Turno}, {$Id}, '{$Tipo}')");
		return 1;
	}
	
	public function resetear_semana_y_lista()
	{
		$query = $this->db->query("DELETE FROM RECETAS_SEMANA");
		//$query = $this->db->query("DELETE FROM RECETAS_ITEM_LISTA");
		$query = $this->db->query("ALTER TABLE RECETAS_SEMANA AUTO_INCREMENT = 1");
		return 1;
	}	

	public function cargar_semana()
	{
		$resultado =  array();
		$query = $this->db->query("CALL __Cargar_Semana()");

			foreach ($query->result() as $row)
			{
				
				$resultado[] = array(
				'Auto' => $row->Auto,	
				'Dia' => $row->Dia,
				'Turno' => $row->Turno,
				'idItem' => $row->idItem,
				'Tipo' => $row->Tipo,
				'Nombre' => $row->Nombre,
				);
			}
			$query->next_result(); 
			$query->free_result(); 
		
			return $resultado; 			
	}

	public function cargar_lista()
	{
		$resultado =  array();
		$query = $this->db->query("SELECT * FROM RECETAS_ITEM_LISTA ORDER BY Categoria ASC");

			foreach ($query->result() as $row)
			{
				
				$resultado[] = array(
				'idIngrediente' => $row->idIngrediente,	
				'Nombre' => $row->Nombre,
				'Categoria' => $row->Categoria,
				'Nro_platos' => $row->Nro_platos,
				'Mostrar' => $row->Mostrar,
				'Comentario' => $row->Comentario,
				);
			}
			$query->next_result(); 
			$query->free_result(); 
		
			return $resultado; 			
	}

	public function cambiarEstadoIngrediente($idIngrediente, $NuevoEstado)
	{
		$query = $this->db->query("UPDATE  RECETAS_ITEM_LISTA SET Mostrar=".$NuevoEstado." WHERE idIngrediente=".$idIngrediente);
		return 1;
	}

	public function cambiarComentario($idIngrediente, $NuevoComentario)
	{
		$query = $this->db->query("UPDATE  RECETAS_ITEM_LISTA SET Comentario='$NuevoComentario' WHERE idIngrediente=$idIngrediente");
		return 1;
	}



	public function cargar_total_ingredientes()
	{
		$resultado =  array();
		$query = $this->db->query("SELECT * FROM RECETAS_INGREDIENTE ORDER BY Categoria, Nombre");

			foreach ($query->result() as $row)
			{
				
				$resultado[] = array(
				'idIngrediente' => $row->idIngrediente,	
				'Nombre' => $row->Nombre,
				'Categoria' => $row->Categoria,
				'Comentario' => $row->Comentario,
				);
			}
			$query->next_result(); 
			$query->free_result(); 
		
			return $resultado; 	

	}

	public function actualizar_ingrediente($idIngrediente, $Nombre, $Categoria, $Comentario)
	{
		$query = $this->db->query("UPDATE RECETAS_INGREDIENTE SET Nombre='{$Nombre}', Categoria='{$Categoria}', Comentario='{$Comentario}' WHERE idIngrediente= {$idIngrediente}");
		return ($this->db->affected_rows() != 1) ? 0 : 1;
	}


}