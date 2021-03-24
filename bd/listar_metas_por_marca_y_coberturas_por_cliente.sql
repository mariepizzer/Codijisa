DROP PROCEDURE Listar_metas_por_marca_y_coberturas_por_cliente;
DELIMITER //

CREATE PROCEDURE Listar_metas_por_marca_y_coberturas_por_cliente (IN VALidCLIENTE int(11), IN VALidUSUARIO int(11))
   BEGIN
      
	SELECT 
		m.idMETA, 
		m.nombre, 
        d.producto_marca_idMarca, 
        IFNULL(SUM(V.volumen), 0) >= d.Pedido_minimo  AS Coberturado
	FROM meta m
	INNER JOIN detalle_meta d ON m.idMeta=d.meta_idMETA
	INNER JOIN Producto P 
			ON P.idPRODUCTO = d.producto_idPRODUCTO AND  P.marca_idMARCA = d.producto_marca_idMARCA
	LEFT JOIN Venta V 
		ON P.idProducto = V.producto_idPRODUCTO 
        AND V.Activo=1 
        AND MONTH(V.fecha) = MONTH(CURRENT_DATE()) 
        AND V.CLIENTE_idCLIENTE=VALidCLIENTE 
        AND V.users_id=VALidUSUARIO
	WHERE m.activo=1  AND m.Cobertura>0 
		AND MONTH(m.mes) = MONTH(CURRENT_DATE())
	GROUP BY m.idMETA;
   END //
DELIMITER ;
call Listar_metas_por_marca_y_coberturas_por_cliente(500488,3);