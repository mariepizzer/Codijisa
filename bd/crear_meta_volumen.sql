insert into detalle_meta (producto_idPRODUCTO, producto_marca_idMARCA, meta_idMETA, Pedido_minimo)  
(select idPRODUCTO, marca_idMARCA, 25,1 from producto where idPRODUCTO in ());

select * from producto where  nombre regexp 'Nosotras';
select * from producto where idPRODUCTO in ();

select * from detalle_meta where meta_idmeta=23;