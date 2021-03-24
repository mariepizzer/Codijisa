DROP PROCEDURE BuscarCliente;
DELIMITER //
CREATE PROCEDURE BuscarCliente(VALfrase varchar(100) )
   BEGIN
	IF VALfrase REGEXP '^-?[0-9]+$' THEN
		SELECT idCLIENTE, Nombre, Zona, Activo, listaColgate FROM Cliente where idCLIENTE REGEXP (VALfrase);
	ELSE 
		SELECT idCLIENTE, Nombre, Zona, Activo, listaColgate FROM Cliente where UCASE(Nombre) REGEXP UCASE(VALfrase);
	END IF;
   END //
DELIMITER ;

CALL BuscarCliente('50048');