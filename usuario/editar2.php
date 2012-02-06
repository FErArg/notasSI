<?php
/*
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


<div class="cabecera">
</div><!-- CAB -->

<div class="medio">

<?php
extract($_POST);
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
$fechaHoy = date('Y-m-d h:i:s');

$query = "SELECT fecha, titulo, texto, enlace, tag FROM notas WHERE id = '$id'";
$array00 = mysql03($query);

/*
print_r($array00);
echo "<br />";
*/

$array01 = array(
	'ID' => $id,
	'Fecha' => $array00[0],
	'Titulo' => $array00[1],
	'Nota' => $array00[2],
	'Enlace' => $array00[3],
	'Tag' => $array00[4]);


echo "<br />";
echo "<form action=\"editar3.php\" method=\"POST\">\n";
echo "<input type=\"hidden\" name=\"tabla\" value=\"notas\" />\n";
echo "<input type=\"hidden\" name=\"id\" value=\"".$array01['ID']."\" />\n";

echo "<table id=\"one-column-emphasis\" >
    <colgroup>
    	<col class=\"oce-first\" />
    </colgroup>
    <tbody>";
	echo "<tr>";
		echo "<td>";
			echo "ID";
		echo "</td>\n";
		echo "<td>";
			echo $array01['ID'];
		echo "</td>\n";
	echo "<tr>";
		echo "<td>";
			echo "Fecha";
		echo "</td>\n";
		echo "<td>";
			echo $array01['Fecha'];
		echo "</td>\n";
	echo "</tr>\n";
	echo "<tr>";
		echo "<td>";
			echo "T&iacute;tulo";
		echo "</td>\n";
		echo "<td>";
			echo "<input type=\"text\" class=\"text\" name=\"titulo2\" size=\"50\" maxlength=\"50\" value=\"".$array01['Titulo']."\" />";
		echo "</td>\n";
	echo "</tr>\n";
	echo "<tr>";
		echo "<td>";
			echo "Nota";
		echo "</td>\n";
		echo "<td>";
			echo "<textarea cols=\"50\" rows=\"3\" name=\"texto2\">".$array01['Nota']."</textarea>";
		echo "</td>\n";
	echo "</tr>\n";
	echo "<tr>";
		echo "<td>";
			echo "Enlace";
		echo "</td>\n";
		echo "<td>";
			echo "<textarea cols=\"50\" rows=\"3\" name=\"enlace2\">".$array01['Enlace']."</textarea>";
		echo "</td>\n";
	echo "</tr>\n";

	echo "<tr>";
		echo "<td>";
			echo "Tag";
		echo "</td>\n";
		echo "<td>";
			echo $array01['Tag']." ";
			echo "<select class=\"tag\" id=\"tag\" name=\"tag2\">";
			echo "<option value=\"\" selected=\"selected\"></option>";
			// busca tags y las convierte en seleccionables
			$array = mysql06('tag','tags');
			foreach ( $array as $value ) {
				echo "<option value=\"".$value."\" >".$value."</option>";
			}
			echo "</select>";
		echo "</td>\n";
	echo "</tr>\n";
echo "</tbody>\n</table>\n";
echo "<button type=\"button\"><a href=\"index.php\">Volver</a></button>";
echo "<input id=\"saveForm\" class=\"button_text\" type=\"submit\" name=\"submit\" value=\"Enviar\" />";
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
