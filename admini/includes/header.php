<?
	$cerrar="";
	if(isset($_GET["cerrar"])) $cerrar=$_GET["cerrar"];
	if($cerrar==1)
	{   
		   session_unset(); session_destroy(); 
		   echo"<script language=javascript>window.location=\"index.php\";</script>";
	}	   
?>
<title>.::VendoRepuestos - Administrador CMS::.</title>
<div class="header">
	<div class="logo"><a href="/admini"><img src="imagenes/logo.jpg" width="230" height="120" border="0" /></a></div>
  <div class="site_name"></div>
    <?php if(isset($_SESSION["admin"])){?>
    <div class="session"><strong>Bienvenido</strong>, <?php echo $_SESSION['nombre_admin']; ?>. Desea <a href="index.php?cerrar=1">Salir del Sistema</a>?</div>
    <?php }?>
</div>