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

<form method="POST" action="agregar2.php" accept-charset="utf-8">
 <table>
	 <tr>
	   <h3>T&iacute;tulo</h3>
	</tr>
	<tr>
		<input type="text" class="text" name="titulo" size="30" maxlength="30" />
		<select class="tag" id="tag" name="tag">
			<option value="" selected="selected"></option>
		<?php
        // busca tags y las convierte en seleccionables
		$array = mysql06('tag','tags');
		foreach ( $array as $value ) {
			echo "<option value=\"".$value."\" >".$value."</option>";
		}
		?>
		</select>
	</tr>
	<tr>
	   <h3>Nota</h3>
	</tr>
	<tr>
	<textarea cols="30" rows="3" name="texto"></textarea><br />
	</tr>
	<tr>
	   <h3>Enlace</h3>
	</tr>
	<tr>
	<input type="text" class="text" name="enlace" size="30" maxlength="60" />
	</tr>
	<tr>
	<br />
	<br />
	  <input id="saveForm" class="button_text" type="submit" name="submit" value="Enviar" />
	</tr>
	</table>
</form>
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
