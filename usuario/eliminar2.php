<?php
session_start();
include('../inc/funciones.php');
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

/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

$fechaHoy = date('Y-m-d h:i:s');
$query = "SELECT texto, ".$campos[2].", ".$campos[3].",".$campos[4]." FROM ".$campos[5]." WHERE ".$campos[1]." = ".$notas;
$array00 = mysql03($query);


$array01 = array(
	'ID' => $notas,
	'Fecha' => $array00[2],
	'Titulo' => $array00[1],
	'Tag' => $array00[3],
	'Nota' => $array00[0]);

echo "<br />";
echo "<form action=\"eliminar3.php\" method=\"POST\">\n";
echo "<input type=\"hidden\" name=\"tabla\" value=\"".$campos[5]."\" />\n";
echo "<input type=\"hidden\" name=\"id\" value=\"".$array01['ID']."\" />\n";
$array02 = tabla01($array01);
foreach ( $array02 as $value){
	echo $value;
}


echo "<input id=\"saveForm\" class=\"button_text\" type=\"submit\" name=\"submit\" value=\"Eliminar\" />";
echo "</form>";
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
