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
print "<br />\n";
$campos = 'id, titulo, fecha, tag';
$tabla1 = 'notas';
$columna1 = 'usuario';
$queBuscar1 = $usuarioId;
$columna2 = 'eliminado';
$queBuscar2 = '0';
$colOrden = 'id';
$orden = 'DESC';
$resultado = mysql25($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $colOrden, $orden);


echo "<table id=\"box-table-a\" summary=\"Listado de Enlaces\">\n";
echo "<thead>
    	<tr>
        	<th scope=\"col\"> ID </th><th scope=\"col\"> Enlace </a></th><th scope=\"col\"> Fecha </th></tr></thead><tbody>\n";
foreach($resultado as $value){
		echo "<tr>\n";
		echo "<td>".$value['id']."</td><td>\n";

		echo "<table border=\"0\" width=\"100%\">\n";
		echo "<tr>\n";

		// echo "<tr>\n<td colspan=\"3\">\n<a href=\"".$value['enlace']."\">".$value['titulo']."</a></td>\n</tr>\n";
		echo "<td width=\"100%\"><a href=\"".$value['enlace']."\">".$value['titulo']."</a></td>\n";


		// Ver
		$ver = <<<_VER
		<td>\n
		<form method="POST" action="ver2.php">
			<input name="id" type="hidden" value="$value[id]">
			<input name="send" type="submit" value="Ver">
		</form>
		</td>\n
_VER;
		echo $ver;

		// editar
		$editar = <<<_EDITAR
		<td>\n
		<form method="POST" action="editar2.php">
			<input name="id" type="hidden" value="$value[id]">
			<input name="send" type="submit" value="Editar">
		</form>
		</td>\n
_EDITAR;
		echo $editar;

		// eliminar
		$eliminar = <<<_ELIMINAR
		<td>\n
		<form method="POST" action="eliminar3.php">
			<input name="id" type="hidden" value="$value[id]">
			<input name="tabla" type="hidden" value="notas">
			<input name="send" type="submit" value="Eliminar">
		</form>
		</td>\n
_ELIMINAR;
		echo $eliminar;

		echo "</tr>\n</table>\n";
		echo "</td>\n<td>".$value['fecha']."</td>\n";
		echo "</tr>\n";
}
echo "</tbody></table>\n";

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
