<?php if(isset($_SESSION["admin"])){?>
<div style="min-height:500px;">
<ul id="menu" class="menu">
	<li class="menu_principal" onclick="window.location.href='admin_categoria.php'">&raquo; Categorias Nivel 1</li>
	<li class="menu_principal" onclick="window.location.href='admin_menu.php'">&raquo; Categorias Nivel 2</li>
    <li class="menu_principal" onclick="window.location.href='admin_submenu.php'">&raquo; Categorias Nivel 3</li>
    <li class="menu_principal" onclick="window.location.href='admin_submenu2.php'">&raquo; Categorias Nivel 4</li>
    <li class="menu_principal" onclick="window.location.href='admin_tiendas.php'">&raquo; Tiendas Repuestos</li>
    <li class="menu_principal" onclick="window.location.href='admin_clientes.php'">&raquo; Clientes Premium</li>
    <li class="menu_principal" onclick="window.location.href='admin_paquete.php'">&raquo; Paquetes / Tarifas</li>
    <li class="menu_principal" onclick="window.location.href='admin_estado.php'">&raquo; Estados</li>
    <li class="menu_principal" onclick="window.location.href='admin_ciudad.php'">&raquo; Ciudades</li>
    <li class="menu_principal" onclick="window.location.href='admin_banco.php'">&raquo; Bancos</li>
    <li class="menu_principal" onclick="window.location.href='admin_pago.php'">&raquo; Medios de Pago</li>
    <li class="menu_principal" onclick="window.location.href='admin_envio.php'">&raquo; Medios de Envio</li>
    <li class="menu_principal" onclick="window.location.href='admin_noticias.php'">&raquo; Noticia Home</li>
    <li class="menu_principal" onclick="window.location.href='admin_salutacion.php'">&raquo; Salutacion</li>
    <li class="menu_principal" onclick="window.location.href='/publicidad/'" title="vendorepuestos / publicidad">&raquo; Banners</li>
    <!--<li class="menu_principal" onclick="window.location.href='admin_usuarios_registrados.php'">&raquo; Usuarios Registrados</li>-->
  </ul>
</div>
<? }?>
<script type="text/javascript">
	$$('#menu li').each(function(valor){
		valor.onmouseover=function(){
			valor.className='menu_principal_over';
		};
		
		valor.onmouseout=function(){
			valor.className='menu_principal';
		};
	});
</script>