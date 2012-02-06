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

$today = date("y-m-d");
$random = php05('0','1000');
$myFile = $directorio."/ShareURL.html";
$myFile2 = $directorio."/URL_Cargados/ShareURL.".$today."-".$random.".html";

$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);

// print $theData;

$theData = str_replace('<html>', '', $theData);
$theData = str_replace('<head>', '', $theData);
$theData = str_replace('</head>', '', $theData);
$theData = str_replace('</html>', '', $theData);
$theData = str_replace('<meta http-equiv="Content-Type" content="text/html ; charset=utf-8">', '', $theData);
$theData = str_replace('<body>', '', $theData);
$theData = str_replace('</body>', '', $theData);
$theData = str_replace('<br><br>', '<br>', $theData);
$theData = str_replace('á', '&aacute;', $theData);
$theData = str_replace('é', '&eacute;', $theData);
$theData = str_replace('í', '&iacute;', $theData);
$theData = str_replace('ó', '&oacute;', $theData);
$theData = str_replace('ú', '&uacute;', $theData);
$theData = str_replace('–', '-', $theData);

$theData = trim($theData);

$theData2 = explode("<br>", $theData);

$h = '0';
foreach( $theData2 as $key => $value ){
  if( isset($value) AND $value != '' AND $value != ' '){
    // unset($theData2[$key]);
	$value = trim($value);
	$value = rtrim($value);
	$value = strip_tags($value);
	$theData2[$h] = $value;
	$h++;
  }
}


$totalAray = count($theData2);
$totalAray = $totalAray / 3;

// echo "<br>\n";
// echo "<br>\n";
$i = '0';
$j = '1';
$k = '2';
$theData3 = array();
for( $ii = '0' ; $ii < $totalAray ; $ii++ ){
	$theData3[$ii]['titulo'] = $theData2[$i];

	$j = $i + 1;
	$theData3[$ii]['fecha'] = $theData2[$j];

	$k = $j + 1;
	$theData3[$ii]['enlace'] = $theData2[$k];
/*
	echo "titulo: ".$theData3[$ii]['titulo']."<br>\n";
	echo "fecha: ".$theData3[$ii]['fecha']."<br>\n";
	echo "link: ".$theData3[$ii]['enlace']."<br>\n";
	echo "<br>\n";
*/
	$i = $k + 1;
}

foreach( $theData3 as $value ){
	if( $value['titulo'] != '' ){
		// comprueba que no exista el enlace en el servidor
/*
		echo $value['titulo']."<br />\n";
		echo $value['fecha']."<br />\n";
		echo $value['enlace']."<br />\n";
*/

		$campos = 'id';
		$tabla = 'notas';
		$columna1 = 'titulo';
		$queBuscar1 = $value['titulo'];
		$resultado1 = mysql02($campos,$tabla,$columna1,$queBuscar1);
//		echo $resultado1."<br /> \n";


		$campos = 'id';
		$tabla = 'notas';
		$columna1 = 'enlace';
		$queBuscar1 = $value['enlace'];
		$resultado3 = mysql02($campos,$tabla,$columna1,$queBuscar1);
//		echo $resultado3."<br /> \n";

		if( empty($resultado1) OR empty($resultado3) ){
			// echo $resultado1 ." - ". $resultado3 ."<br />\n";
			mysql_query("insert into notas (usuario, titulo, fecha, texto, enlace, tag, eliminado)
				values ('$usuarioId','$value[titulo]','$value[fecha]','Sin Contenido','$value[enlace]','ownCloud','0')");
		}

	}
}

rename($myFile, $myFile2);
/*
echo "<pre>";
print_r($theData3);
echo "</pre>";
*/

echo "<meta http-equiv='refresh' content='0;URL=ver.php'>";
?>

<?php
// Control de la sesion ----------------------------------------------------------------------
} else{
		print"<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		print"<br />\n<a href=\"../index.php\" class=\"botonR\">Volver</a><br /><br />\n";
}
// Control de la sesion ----------------------------------------------------------------------
include('../inc/footer.php');
?>
