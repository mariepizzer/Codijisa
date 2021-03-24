<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*-------------------------------------- R   E   C   E   T   A   S-------------------------------------*/
$route['semana'] = 'receta/semana';
$route['semana/buscar_ingredientes'] = 'receta/getIngredientesAutocomplete';
$route['semana/buscar_platos'] = 'receta/getPlatosAutocomplete';
$route['semana/resetear_semana_y_lista'] = 'receta/resetear_semana_y_lista';
$route['semana/guardar_item_semana'] = 'receta/guardar_semana';
$route['semana/cambiarEstadoIngrediente'] = 'receta/cambiarEstadoIngrediente';
$route['semana/cambiarComentario'] = 'receta/cambiarComentario';
$route['semana/cargar_Lista_Lista'] = 'receta/cargar_Lista_Lista';
$route['semana/ingredientes'] = 'receta/cargar_total_ingredientes';
$route['semana/ingrediente/editar'] = 'receta/actualizar_ingrediente';
$route['semana/procesar_lista'] = 'receta/procesar_lista';
$route['semana/crear_ingrediente_desde_plato'] = 'receta/crear_ingrediente_desde_plato';
$route['semana/crear_ingrediente'] = 'receta/crear_ingrediente';
$route['semana/buscar'] = 'receta/buscar_Plato_o_Ingrediente';
$route['semana/borrar_plato'] = 'receta/borrar_plato';
$route['semana/plato/agregar_ingrediente'] = 'receta/agregar_ingrediente_plato';
$route['semana/plato/editar'] = 'receta/actualizar_plato';
$route['semana/plato/nuevo'] = 'receta/crear_plato';
$route['semana/plato/retirar_ingrediente'] = 'receta/retirar_ingrediente_plato';
$route['semana/plato/(:any)'] = 'receta/detalles_plato/$1';

/*-------------------------------------- M   E    T    A   -------------------------------------*/

$route['meta/ventas_por_meta'] = 'usuario/ventas_por_meta';
$route['meta'] = 'usuario/listar_metas';
$route['meta/actualizar'] = 'usuario/actualizar_meta';
$route['meta/registrar'] = 'usuario/registrar_meta';
$route['meta/detalles/(:any)'] = 'usuario/detalles_meta/$1';
$route['meta/detalles/retirar'] = 'usuario/retirar_detalle_meta';
$route['meta/retirar'] = 'usuario/retirar_meta';
$route['meta/cerrar_mes'] = 'usuario/cerrar_mes';
$route['meta/registro_premios'] = 'usuario/registro_premios';
$route['meta/pagar_premio'] = 'usuario/pagar_premio';

/*--------------------------------------C  L  I  E  N  T  E -------------------------------------*/
$route['cliente/guardar_celular'] = 'cliente/guardar_celular';
$route['cliente/registrar'] = 'cliente/registrar';
$route['cliente/(:any)'] = 'cliente/ficha/$1';
$route['cliente/buscar'] = 'cliente/buscar';
$route['cliente/BuscarPorZona'] = 'cliente/BuscarPorZona';
$route['cliente/buscar2'] = 'cliente/buscar2';
$route['devolver'] = 'cliente/anularVenta';


/*--------------------------------------P  R  O  D  U  C  T  O-------------------------------------*/

$route['producto/(:any)'] = 'producto/ficha/$1';
$route['producto/listar_por_marca'] = 'producto/listar_por_marca';
$route['producto/buscar'] = 'producto/buscar';
$route['producto/agregar_producto_meta'] = 'producto/agregar_producto_meta';
$route['producto/agregar_todos_producto_meta'] = 'producto/agregar_todos_producto_meta';

/*--------------------------------------   U S U A R I O   -------------------------------------*/
$route['importar_clientes'] = 'usuario/importar_clientes';
$route['importar_productos'] = 'usuario/importar_productos';
$route['subir_sincro'] = 'upload/do_upload';
$route['panel'] = 'usuario/panel';
$route['usuario/(:any)'] = 'usuario/ver/$1';
$route['devolver/(:any)'] = 'usuario/anular_venta';
$route['vender/(:any)'] = 'usuario/vender/$1';
$route['registrar_venta'] = 'usuario/registrar_venta';
$route['cuotas'] = 'usuario/cuota_general';
/*--------------------------------------A U T E N T I C A C I Ó N-------------------------------------*/

$route['editar_usuario/(:any)'] = 'auth/edit_user/$1';
$route['crear_usuario'] = 'auth/create_user';
$route['resetear_contrasena/(:any)'] = 'auth/reset_password/$1';
$route['olvide_contrasena'] = 'auth/forgot_password';
$route['cambiar_contrasena'] = 'auth/change_password';
$route['cerrar_sesion'] = 'auth/logout';
$route['iniciar_sesion'] = 'auth/login';
$route['mi_perfil'] = 'usuario/mi_perfil';

/*---------------------------------------PREDETERMINADO-------------------------------------*/

$route['cargar/(:any)'] = "paginas/cargar/$1";
$route['ver/(:any)'] = "paginas/ver/$1";
$route['default_controller'] = "usuario/mi_perfil";
$route['404_override'] = 'paginas/no_encontrado';

/* End of file routes.php */
/* Location: ./application/config/routes.php */