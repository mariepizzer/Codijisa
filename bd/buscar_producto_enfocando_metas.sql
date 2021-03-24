DROP PROCEDURE Buscar_Producto_Enfocando_Metas;
DELIMITER //
CREATE PROCEDURE Buscar_Producto_Enfocando_Metas ( IN VALidCLIENTE int(11), VALfrase varchar(100), VALidUsuario int(11) )
   BEGIN
      
	CREATE TEMPORARY TABLE IF NOT EXISTS T1 AS
    (SELECT M.idMETA, P.idPRODUCTO, P.Nombre, 0 AS Volumen, DM.Pedido_minimo,P.marca_idMARCA as Marca, P.UnidadDefecto
			FROM Producto P 
				JOIN detalle_meta DM 
					ON P.idPRODUCTO = DM.producto_idPRODUCTO AND  P.marca_idMARCA = DM.producto_marca_idMARCA
				JOIN meta M 
					ON DM.meta_idMETA = M.idMETA AND M.Cobertura!=0
			WHERE M.activo=1 
				AND MONTH(M.mes) = MONTH(CURRENT_DATE()) 
				AND (UCASE(P.marca_idMARCA) regexp UCASE(VALfrase) OR UCASE(P.Nombre) regexp UCASE(VALfrase) OR UCASE(P.idPRODUCTO) regexp UCASE(VALfrase))
			GROUP BY (P.idPRODUCTO)
	);
    
    CREATE TEMPORARY TABLE IF NOT EXISTS T2 AS
    (
    SELECT P.idPRODUCTO, P.Nombre, SUM(V.Volumen) AS Volumen
        FROM Venta V
			INNER JOIN Producto P
            ON V.producto_idPRODUCTO = P.idPRODUCTO 
		WHERE 
			V.CLIENTE_idCLIENTE=VALidCLIENTE 
            AND V.users_id = VALidUsuario
            AND V.Activo = 1
            AND (UCASE(P.marca_idMARCA) regexp UCASE(VALfrase) OR UCASE(P.Nombre ) regexp UCASE(VALfrase) OR UCASE(P.idPRODUCTO) regexp UCASE(VALfrase))
		GROUP BY (P.idPRODUCTO)
        );
	SELECT T1.idPRODUCTO, T1.Nombre, T1.Pedido_minimo, IFNULL(T2.Volumen, 0) as Volumen, T1.Marca, T1.UnidadDefecto
	FROM T1 
    LEFT JOIN T2 ON T2.idPRODUCTO = T1.idPRODUCTO
    ORDER BY T1.Nombre;
    
   DROP TEMPORARY TABLE T1, T2;
   END //
DELIMITER ;

#no sé por qué no busca el resto de productos de sancela
#select * from detalle_meta where producto_idPRODUCTO in (17861);
select * from venta where producto_idPRODUCTO in (17861);
call Buscar_Producto_Enfocando_Metas(1,'noso',3);
