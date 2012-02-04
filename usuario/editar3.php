<?php
session_start();
include('../inc/framework.php');
include('../inc/header.php');

if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){
mysql00();
$array01 = menu01();
foreach ( $array01 as $value){
	echo $value;
}
?>
<!--
	/**************************************************************************************************
	#     Copyright (c) 2008, 2009, 2010, 2011, 2012 Fernando A. Rodriguez para SerInformaticos.es    #
	#                                                                                                 #
	#     Este programa es software libre: usted puede redistribuirlo y / o modificarlo               #
	#     bajo los t&eacute;rminos de la GNU General Public License publicada por la                  #
	#     la Free Software Foundation, bien de la versi&oacute;n 3 de la Licencia, o de               #
	#     la GPL2, o cualquier versi&oacute;n posterior.                                              #
	#                                                                                                 #
	#     Este programa se distribuye con la esperanza de que sea &uacute;til,                        #
	#     pero SIN NINGUNA GARANTÍA, incluso sin la garant&iacute;a impl&iacute;cita de               #
	#     COMERCIABILIDAD o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. V&eacute;ase el                   #
	#     GNU General Public License para m&aacute;s detalles.                                        #
	#                                                                                                 #
	#     Usted deber&iacute;a haber recibido una copia de la Licencia P&uacute;blica General de GNU  #
	#     junto con este programa. Si no, visite <http://www.gnu.org/licenses/>.                      #
	#                                                                                                 #
	#     Puede descargar la version completa de la GPL3 en este enlace:                              #
	#     	< http://www.serinformaticos.es/index.php?file=kop804.php >                               #
	#                                                                                                 #
	#     Para mas información puede contactarnos :                                                   #
	#                                                                                                 #
	#       Teléfono  (+34) 961 19 60 62                                                              #
	#                                                                                                 #
	#       Email:    info@serinformaticos.es                                                         #
	#                                                                                                 #
	#       MSn:      info@serinformaticos.es                                                         #
	#                                                                                                 #
	#       Twitter:  @SerInformaticos                                                                #
	#                                                                                                 #
	#       Web:      www.SerInformaticos.es                                                          #
	#                                                                                                 #
	**************************************************************************************************/
-->
<div class="cabecera">
</div><!-- CAB -->

<div class="medio">

<?php
// print "<br />\n";
extract($_POST);

echo "<pre>";
print_r($_POST);
echo "</pre>";

$titulo2 = filter_var($_POST['titulo2'], FILTER_SANITIZE_STRING);
$texto2 = filter_var($_POST['texto2'], FILTER_SANITIZE_STRING);
$enlace2 = filter_var($_POST['enlace2'], FILTER_SANITIZE_STRING);

if ( $titulo2 == '' OR $titulo2 == ' '){
	unset($titulo2);
}
if ( $tag2 == ''){
	unset($tag2);
}
if ( $texto2 == '' OR $texto2 == ' '){
	unset($texto2);
}
if ( $enlace2 == '' OR $enlace2 == ' '){
	unset($enlace2);
}

if (isset($titulo2)){
	mysql_query("update $tabla set titulo='$titulo2' where id='$id'");
}
if (isset($tag2)){
	mysql_query("update $tabla set tag='$tag2' where id='$id'");
}
if (isset($texto2)){
	mysql_query("update $tabla set texto='$texto2' where id='$id'");
}
if (isset($enlace2)){
	mysql_query("update $tabla set enlace='$enlace2' where id='$id'");
}

if ( $titulo2 == '' OR $titulo2 == ' '){
	unset($titulo2);
}
if ( $tag2 == ''){
	unset($tag2);
}
if ( $texto2 == '' OR $texto2 == ' '){
	unset($texto2);
}
if ( $enlace2 == '' OR $enlace2 == ' '){
	unset($enlace2);
}

// redireccionar de nuevo a index
echo mysql_error();
// echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
?>
</div><!-- Medio -->

<div class="pie">
</div><!-- pie -->


<?php
// Control de la sesion ----------------------------------------------------------------------
} else{
		print"<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		print"<br />\n<a href=\"../index.php\" class=\"botonR\">Volver</a><br /><br />\n";
}
// Control de la sesion ----------------------------------------------------------------------
include('../inc/footer.php');
?>
