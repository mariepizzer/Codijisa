<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
	* Name:  Usuario_model
	*
	* Version: 1.0
	*
	* Author:  Marie Pinto Gozzer
	* 		   soy@mariepizzer.com
	*	  	   @mariepizzer
	*
	* Created:  06.01.2015
	*
	* Description:  
	*
*/

class Usuario_model extends CI_Model
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

   	public function listarMetas($idUsuario, $Order_por_Prioridad)
    {
    	$resultado =  array();
		$query = $this->db->query("CALL Listar_metas_por_marca_y_coberturas ({$idUsuario},{$Order_por_Prioridad});");
		//PARA MES VENCIDO DESCOMENTAR INTERCAMBIAR ==>
		//$query = $this->db->query("CALL Listar_metas_por_marca_y_coberturas ({$idUsuario},{$Order_por_Prioridad});");
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


    public function registrar_meta($Nombre_Meta, $Cobertura, $Incentivo, $Fecha_inicio, $Fecha_fin, $Marca, $Volumen, $Tipo, $Mostrar)
	{
		$query = $this->db->query("INSERT INTO META (`Nombre`,`Cobertura`,`Incentivo`,`Fecha_inicio`,`Fecha_fin`,`Activo`,`Marca`,`Volumen`,`Tipo`,`Mostrar`)VALUES('{$Nombre_Meta}',{$Cobertura},{$Incentivo},'{$Fecha_inicio}','{$Fecha_fin}',1,'{$Marca}',{$Volumen},'{$Tipo}',1);");
		$query = $this->db->query("SELECT LAST_INSERT_ID() AS idMETA");

		if($query->num_rows() > 0)
		{
			$row = $query->row();
			return $row->idMETA;
		}
		return 0;
	}

    public function datos_meta($idMETA)
	{
		$resultado =  array();
		$query = $this->db->query("SELECT Prioridad, Mostrar, Tipo, Nombre, Cobertura, Volumen, Incentivo, Fecha_inicio, Fecha_fin, Activo, Marca from META WHERE idMETA=".$idMETA);

			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$resultado = array(
				'Prioridad' => $row->Prioridad,
				'Mostrar' => $row->Mostrar,
				'Tipo' => $row->Tipo,
				'Nombre_Meta' => $row->Nombre,
				'Cobertura' => $row->Cobertura,
				'Volumen' => $row->Volumen,
				'Incentivo' => $row->Incentivo,
				'Fecha_inicio' => $row->Fecha_inicio,
				'Fecha_fin' => $row->Fecha_fin,
				'Activo' => $row->Activo,
				'Marca' => $row->Marca,
					);

				return $resultado; 			
			}
			return array();
	}

	public function datos_detalles_meta($idMETA)
	{
		$resultado =  array();
		$query = $this->db->query("CALL Datos_detalles_meta ({$idMETA});");

			foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'idPRODUCTO' => $row->idPRODUCTO,
				'Nombre' => $row->Nombre,
				'Pedido_minimo' => $row->Pedido_minimo,
				);
			}
		
		return $resultado;
	}


	public function listar_ventas_por_meta($idMETA)
	{
		$resultado =  array();
		$query = $this->db->query("CALL Listar_ventas_por_meta ({$idMETA});");

			foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'PED_PK' => $row->PED_PK,
				'Fecha' => $row->Fecha,
				'Volumen' => $row->Volumen,
				'Monto' => $row->Monto,
				'idCliente' => $row->idCliente,
				'Nombre' => $row->Nombre,
				);
			}
		
		return $resultado;
	}

    public function listar_marcas()
    {
		$query = $this->db->query("SELECT idMARCA FROM MARCA");
		foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'idMARCA' => $row->idMARCA,
				);
			}
		return $resultado;
    }

	public function registro_premios($idUsuario,$Mes,$Marca)
	{
		$resultado =  array();

		if($Mes!='' && $Marca!='')
		{
			$query = $this->db->query("SELECT M.Nombre,M.Tipo, M.Cobertura,M.Volumen,PA.*
									FROM PREMIOS_ALCANZADOS PA 
									JOIN META M ON PA.idMETA=M.idMETA 
									WHERE MONTH(PA.Mes)=MONTH('$Mes') AND  M.MARCA='$Marca' AND PA.idUSUARIO=$idUsuario  AND PA.Cumplido=1");
		}else{
			if($Marca!='')
			{
				$query = $this->db->query("SELECT M.Nombre,M.Tipo, M.Cobertura,M.Volumen,PA.*
										FROM PREMIOS_ALCANZADOS PA 
										JOIN META M ON PA.idMETA=M.idMETA 
										WHERE M.MARCA='$Marca' AND PA.idUSUARIO=$idUsuario  AND PA.Cumplido=1");			
			}

			if($Mes!='')
			{
				$query = $this->db->query("SELECT M.Nombre,M.Tipo, M.Cobertura,M.Volumen,PA.*
										FROM PREMIOS_ALCANZADOS PA 
										JOIN META M ON PA.idMETA=M.idMETA 
										WHERE MONTH(PA.Mes)=MONTH('$Mes') AND PA.idUSUARIO=$idUsuario  AND PA.Cumplido=1");
			}
			if($Mes=='' && $Marca=='')
			{
				return $resultado;	
			}
		}


		foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'idMETA' => $row->idMETA,
				'Nombre_Meta' => $row->Nombre,
				'Tipo' => $row->Tipo,
				'Volumen' => $row->Volumen,
				'Cobertura' => $row->Cobertura,
				'Efectivo' => $row->Efectivo,
				'Alcanzado' => $row->Alcanzado,
				'Pagado' => $row->Pagado,
				'Mes' => $row->Mes,
				);
			}
		return $resultado;
    }

    public function retirar_detalle_meta($idPRODUCTO,$idMETA)
	{
		$query = $this->db->query("DELETE FROM DETALLE_META WHERE producto_idPRODUCTO={$idPRODUCTO} AND meta_idMETA = {$idMETA}");
	}

    public function retirar_meta($idMETA)
	{
		$query = $this->db->query("DELETE FROM DETALLE_META WHERE meta_idMETA = {$idMETA}");
		$query = $this->db->query("DELETE FROM META WHERE idMETA = {$idMETA}");
		return 1;
	}

    public function actualizar_meta($idMETA, $Nombre, $Cobertura, $Volumen, $Incentivo, $Fecha_inicio, $Fecha_fin, $Mostrar, $Prioridad)
	{
		$query = $this->db->query("UPDATE META SET Nombre='{$Nombre}', Incentivo={$Incentivo}, Cobertura={$Cobertura}, Volumen={$Volumen}, Mostrar={$Mostrar}, Fecha_inicio='{$Fecha_inicio}', Fecha_fin='{$Fecha_fin}', Mostrar={$Mostrar}, Prioridad={$Prioridad} WHERE idMETA= {$idMETA}");
		return ($this->db->affected_rows() != 1) ? 0 : 1;
	}

    public function cerrar_mes($idUsuario,$idMETA, $Mes, $Efectivo, $Alcanzado, $Logrado)
	{
		$query = $this->db->query("CALL Guardar_Premios_Alcanzados( $idMETA,$idUsuario, '{$Mes}', $Efectivo, $Alcanzado, $Logrado)");
		return ($this->db->affected_rows() != 1) ? 0 : 1;
	}

    public function pagar_premio($idMETA, $Mes, $idUsuario)
	{
		$query = $this->db->query("UPDATE PREMIOS_ALCANZADOS SET Pagado=1 WHERE idMETA= {$idMETA} AND idUSUARIO={$idUsuario} AND MONTH(Mes)=MONTH('$Mes')");
		return ($this->db->affected_rows() != 1) ? 0 : 1;
	}

	public function cuota_general($idUsuario)
    {
    	$resultado =  array();
		$query = $this->db->query("CALL Cuotas_Marcas ({$idUsuario});");
		foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'Marca' => $row->Marca,	
				'Cuota' => $row->Cuota,
				'CuotaDiaria' => $row->CuotaDiaria,
				'Venta_Hoy' => $row->Venta_Hoy,
				'Acumulado' => $row->Acumulado,
				'AvanceReal' => $row->AvanceReal,
				'AvanceIdeal' => $row->AvanceIdeal,
				);
			}
		return $resultado;
    }

	public function subir_sincro($script_path, $file_name)
	{
		
		$file= $script_path. $file_name;
		$archivo = '';
		if (file_exists($file))
	    {
	        $lines = file($file);
	        $statement = '';
	        foreach ($lines as $line)
	        {
	            $statement .= $line;
	            if (substr(trim($line), -1) === ';')
	            {
	                $this->db->simple_query($statement);
	            	$archivo .=$statement;
	                $statement = '';
	            }
	        }
	        $query = $this->db->query("CALL Importar_Ventas_Dia('')");
    		return ($this->db->affected_rows() == 0) ? 0 : 1;
	    }
	}

	public function importar_clientes($idUsuario)
    {
    	$resultado =  array();

		$query = $this->db->query("CALL Importar_Clientes();");
		$query = $this->db->query("CALL Mostrar_Ventas_Sin_Cliente(); ");

		foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'Fecha' => $row->Fecha,
				'Ventas' => $row->Ventas,
				);
			}
		return $resultado;
    }
	public function importar_productos($idUsuario)
    {
    	$resultado =  array();

		$query = $this->db->query("CALL Importar_Productos();");
		$query = $this->db->query("CALL Mostrar_Productos_Sin_Marca(); ");

		foreach ($query->result() as $row)
			{
				$resultado[] = array(
				'idProducto' => $row->idPRODUCTO,
				'Nombre' => $row->Nombre,
				'Ventas' => $row->Ventas,
				);
			}
		return $resultado;
    }

 	   
}