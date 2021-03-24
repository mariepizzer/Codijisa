DROP PROCEDURE RegistrarVenta;
DELIMITER //
CREATE PROCEDURE RegistrarVenta(VALidCLIENTE int(11), VALidPRODUCTO int(11), VALVolumen decimal(10,1), VALidUsuario int(11), VALMarca varchar(45) )
   BEGIN
    DECLARE precioS DECIMAL (10,2) DEFAULT 0;
    SELECT Precio*VALVolumen INTO precioS FROM Producto WHERE idPRODUCTO=VALidPRODUCTO;

    INSERT INTO venta (fecha, Volumen, Monto, Cobertura, users_id, CLIENTE_idCLIENTE, producto_idPRODUCTO, producto_marca_idMARCA, Activo) 
    VALUEs (CURDATE(), VALVolumen,precioS, 1,VALiDUsuario,VALidCLIENTE,VALidPRODUCTO, VALMarca,1);
    
    SELECT idMETA, SUM(V.volumen) as NuevoVolumen,SUM(V.volumen) >= DM.Pedido_minimo as Coberturado
	FROM producto P 
		JOIN Detalle_meta DM 
			ON P.idPRODUCTO = DM.producto_idPRODUCTO AND  P.marca_idMARCA = DM.producto_marca_idMARCA
		JOIN Meta M 
			ON DM.meta_idMETA = M.idMETA AND M.Cobertura >0
		JOIN Venta V 
			ON P.idProducto = V.producto_idPRODUCTO AND MONTH(V.fecha) = MONTH(CURRENT_DATE()) AND V.users_id = VALidUsuario
	WHERE M.activo=1 
		AND V.Activo=1 
		AND MONTH(M.mes) = MONTH(CURRENT_DATE()) 
		AND V.CLIENTE_idCLIENTE=VALidCLIENTE
		AND idPRODUCTO=VALidPRODUCTO
	GROUP BY (M.idMETA)
	ORDER BY (Coberturado) DESC;
    
   END //
DELIMITER ;
 
CALL RegistrarVenta(1,34378,2,3,'RECKITT');
