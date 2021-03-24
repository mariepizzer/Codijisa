DROP PROCEDURE Listar_metas_por_marca_y_coberturas_general;
DELIMITER //
CREATE PROCEDURE Listar_metas_por_marca_y_coberturas_general( IN VALidUsuario int(11))
   BEGIN
    
	CREATE TEMPORARY TABLE IF NOT EXISTS T1 AS
	(	SELECT
			d.producto_marca_idMARCA AS Marca, d.meta_idMETA AS Meta, d.Pedido_minimo,
			ifnull(SUM(V.volumen),0) >= d.Pedido_minimo  AS Coberturado
			
		FROM detalle_meta d
		JOIN Venta V 
			ON d.producto_idPRODUCTO = V.producto_idPRODUCTO 
		WHERE V.Activo=1 AND MONTH(V.fecha) = MONTH(CURRENT_DATE()) AND V.users_id=VALidUsuario
		GROUP BY Meta, V.CLIENTE_idCLIENTE
		ORDER BY Meta
		);

	SELECT 
		M.idMETA as Meta, M.Nombre, #T1.Avance_Detalle,
		ifnull(SUM(T1.Coberturado),0) >= M.Cobertura AS Coberturado,
        ROUND(IFNULL(SUM(T1.Coberturado),0)*100/ M.Cobertura, 0) AS Porcentaje
	FROM T1
	RIGHT JOIN META M ON M.idMETA=T1.Meta
    WHERE M.activo=1  AND M.Cobertura>0
	GROUP BY M.idMETA
	ORDER BY M.idMETA ASC;
    DROP TEMPORARY TABLE T1;
   END //
DELIMITER ;
select * from detalle_meta where meta_idMETA=13;
CALL Listar_metas_por_marca_y_coberturas_general(3);

select count(*),v.* from venta v
inner join cliente c on c.idCLIENTE=v.CLIENTE_idCliente
where c.listaColgate=1#producto_idPRODUCTO in(54000,54001)
;

