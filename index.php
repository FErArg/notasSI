<?php
include('inc/framework.php');
include('inc/header.php');
?>
<h2>notaSI+</h2>
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
<table style="text-align: center; width: 100%; heigh: 100%;">
	<tr style="vertical-align: middle; text-align: center;">
		<td>
	<div class="login-block">
			<form action="check.php" method="post">
				<table>
				<tr>
					<td>Usuario</td>
					<td><input type="text" name="usuario" size=10 /></td>
				</tr>
				<tr>
					<td>Clave</td>
					<td><input type="password" name="clave" size=10 /></td>
				</tr>
				<tr>
					<td><input type="hidden" name="login" /></td>
					<td></td>
				</tr>
				<tr>
					<td><p class="submit-wrap"><input type="reset"></p></td>
					<td><p class="submit-wrap"><input name="send" type="submit" value="Entrar"></p></td>
				</tr>
				</table>
			</form>
 </div>
	</td>
 </tr>
 </table>
<?php
include('inc/footer.php');
?>
