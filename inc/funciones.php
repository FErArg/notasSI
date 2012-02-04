<?php
/*
 * Funciones escritas por Fernando A. Rodriguez para el uso en SerInformaticos.es
 */

// Personalizaciones
$db="notasSI+";
$directorio="/var/www/owncloud/data/".$_SESSION['usuario']."/files";

// Menu
function menu01(){
	$array = array(
		'Ver notas' => 'ver.php',
		'Agregar Nota' => 'agregar.php',
		'Editar Nota' => 'editar.php',
		'Eliminar Nota' => 'eliminar.php',
		'Cargar' => 'cargar.php',
		'Salir' => "../check.php?logout");
	$i = '0';
	foreach ($array as $key => $value){
		$array2[$i] = "<a href=\"".$value."\">".$key."</a> ";
		$i++;
	}
	return $array2;
}
// MySQL Querys ------------------------------------------------------------

// Conecta con DB
function mysql00($servidor,$usuario,$clave,$db){
	$servidor="SERVIDOR";
	$usuario="USUARIO";
	$clave="CLAVE";
	$db="BASEDATOS";

	$enlace=mysql_connect($servidor,$usuario,$clave);
	if (!$enlace) {
		mysql_close($enlace);
		$a1="Error de Conexión";
	} else {
		$a1="Conectado Correctamente";
	}
	$db=mysql_select_db($db,$enlace);
	return $a1;
}

// Busca todos los elementos de una tabla y devuelve array
function mysql01($tabla){
	$query1="SELECT * FROM ".$tabla;
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	return $resultado;
}

// busca un elemento en una columna
function mysql02($dondeBuscar,$tabla,$enQueColumna,$queBuscar){
	$query1="SELECT $dondeBuscar FROM $tabla WHERE $enQueColumna='$queBuscar'";
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	return $resultado[0];
}

// recibe el query de MySQL
function mysql03($query1){
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	return $resultado;
}

// recibe peticion de tabla MySQL y devuelve array con formato de tabla HTML
function mysql04($tabla){
        $qColumnNames = mysql_query("SHOW COLUMNS FROM ".$tabla) or die("mysql error");
        $numColumns = mysql_num_rows($qColumnNames);
        $i = 0;
        while ( $i < $numColumns ){
                $colname = mysql_fetch_row($qColumnNames);
                $col[$i] = "<td>".$colname[0]."</td>";
                $i++;
        }
        $h = 0;
        $resultado[0] = "<tr>";
        while ( $h < $numColumns ){
                $resultado[0] = $resultado[0] . $col[$h];
                $h++;
        }
        $resultado[0] = $resultado[0]."</tr>";
        $query01="SELECT * FROM ".$tabla;
        $query02=mysql_query($query01);
        $numLines = mysql_num_rows($query02);

        $j=0;
        while( $rec = mysql_fetch_row($query02) ){
                for( $k = 0; $k != $numColumns ; $k++){
                        if ( $resultado[1 + $j] == "" ){
                                $resultado[1 + $j] = "<tr>";
                        }
                        if ( $rec[$k] == "" ){
                                $rec[$k] = "-";
                        }
                        $resultado[1 + $j] = $resultado[1 + $j]."<td>".$rec[$k]."</td>";
                }
                $resultado[1 + $j] = $resultado[1 + $j]."</tr>";
                $j++;
        }
        return $resultado;
}

// recibe peticion de tabla MySQL y devuelve array separado por ";"
function mysql05($tabla){
        $qColumnNames = mysql_query("SHOW COLUMNS FROM ".$tabla) or die("mysql error");
        $numColumns = mysql_num_rows($qColumnNames);
        $i = 0;
        while ( $i < $numColumns ){
                $colname = mysql_fetch_row($qColumnNames);
                $col[$i] = $colname[0].";";
                $i++;
        }
        $h = 0;
        while ( $h < $numColumns ){
                $resultado[0] = $resultado[0] . $col[$h];
                $h++;
        }
        $query01="SELECT * FROM ".$tabla;
        $query02=mysql_query($query01);
        $numLines = mysql_num_rows($query02);
        $j=0;
        while( $rec = mysql_fetch_row($query02) ){
                for( $k = 0; $k != $numColumns ; $k++){
                        if ( $rec[$k] == "" ){
                                $rec[$k] = "-";
                        }
                        $resultado[1 + $j] = $resultado[1 + $j]."".$rec[$k].";";
                }
                $j++;
        }
        return $resultado;
}


// busca todos los elementos de una columna de una tabla
function mysql06($campo,$tabla){
    $query1="SELECT ".$campo." FROM ".$tabla;
    $query2=mysql_query($query1);
    $i = 0;
    while( $rec = mysql_fetch_row($query2) ){
            $array[$i] = $rec[0];
            $i++;
    }
    return $array;
}

// Busca todos los elementos de una tabla y devuelve array multidimencional
// para despues separar los elementos con un foreach
function mysql07($tabla){
	$query01="SELECT * FROM ".$tabla;
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

// Como ver los datos
//	foreach( $array as $value){
//		foreach( $value as $value){
//			echo $value."<br />";
//		}
//	}
}

// Busca todos los elementos de los campos asignados de una tabla y
// devuelve array multidimencional para despues separar los elementos
// con un foreach
function mysql08($campos, $tabla){
	$query01="SELECT ".$campos." FROM ".$tabla;
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

// Como ver los datos
//	foreach( $resultado as $value){
//		foreach( $value as $value){
//			echo $value."<br />";
//		}
//	}
}

// busca todos los elementos de la/las columnas que se pasen de una tabla
function mysql09($campos,$tabla){
	$query1="SELECT $campos FROM $tabla";
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	return $resultado;
}

// busca el/los campos que se le pasa al query y lo convierte en tabla
// con seleccionable segun el primer campo que s ele pasa
function mysql10($campos, $tabla){
	$query01="SELECT ".$campos." FROM ".$tabla;
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}

	// elimina espacios y convierte en array los diferentes campos que
	// se pasaron
	$campos = str_replace(" ", "", $campos);
	$arr_campos = explode(",", $campos);
	$nro_campos = count($arr_campos);
	$h = 0;
	$l = 1;
	$rtdo[$h++] = "<table border=\"1\">";
	foreach( $resultado as $value){
			unset($fila);
			unset($filaHidden);
			$filaHidden ='';
			// crea la tabla con los datos pedidos a la DB
			$fila = "<tr><td>";
			for( $i = 0; $i < $nro_campos; $i++){
				$campo = $arr_campos[$i];
				$fila = $fila . $value[$campo]."</td>\n<td>";
			}
			// utiliza el primer valor que se paso en el campo "campos"
			// para usarlo como valor identificativo y despues hacer
			// la búsqueda en la DB y crea la ultima columna con el selector
			$fila = $fila ./* $filaHidden.*/"<input id=\"".$tabla."\" name=\"".$tabla."\" class=\"".$tabla."\" type=\"radio\" value=\"".$value[$arr_campos[0]]."\"></td>\n</tr>\n";
			$rtdo[$h++] = $fila;
			$h++;
			$l++;
	}
	$h++;
	$j = '1';
	foreach( $arr_campos as $value){
		$rtdo[$h] = "<input type=\"hidden\" name=\"campos[".$j."]\" value=\"".$value."\" />\n";
		$h++;
		$j++;
	}
	$rtdo[$h++] = "<input type=\"hidden\" name=\"campos[".$j."]\" value=\"".$tabla."\" />\n";
	$rtdo[$h++] =  "</table>";
return $rtdo;
// Como ver datos
// foreach($rtdo as $value){
// 	echo $value;
//}
}

// busca el/los campos que se le pasa al query y lo convierte en tabla
// con seleccionable segun el primer campo que s ele pasa
function mysql11($campos, $tabla){
	$query01="SELECT ".$campos." FROM ".$tabla;
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}

	// elimina espacios y convierte en array los diferentes campos que
	// se pasaron
	$campos = str_replace(" ", "", $campos);
	$arr_campos = explode(",", $campos);
	$nro_campos = count($arr_campos);
	$h = 0;
	$l = 1;
	$rtdo[$h++] = "<table border=\"1\">";
	foreach( $resultado as $value){
			unset($fila);
			unset($filaHidden);
			$filaHidden ='';
			// crea la tabla con los datos pedidos a la DB
			$fila = "<tr><td>";
			for( $i = 0; $i < $nro_campos; $i++){
				$campo = $arr_campos[$i];
				$fila = $fila . $value[$campo]."</td>\n<td>";
			}
			// utiliza el primer valor que se paso en el campo "campos"
			// para usarlo como valor identificativo y despues hacer
			// la búsqueda en la DB y crea la ultima columna con el selector
			$fila = $fila ."
			<form method=\"POST\" action=\"ver2.php\">
			<input id=\"".$tabla."\" name=\"".$tabla."\" class=\"".$tabla."\" type=\"hidden\" value=\"".$value[$arr_campos[0]]."\">
			<p align=left><input name=\"send\" type=\"submit\" value=\"Ver\"></p>
			</form>
			</td>\n</tr>\n";
			$rtdo[$h++] = $fila;
			$h++;
			$l++;
	}
	$h++;
	$j = '1';
	foreach( $arr_campos as $value){
		$rtdo[$h] = "<input type=\"hidden\" name=\"campos[".$j."]\" value=\"".$value."\" />\n";
		$h++;
		$j++;
	}
	$rtdo[$h++] = "<input type=\"hidden\" name=\"campos[".$j."]\" value=\"".$tabla."\" />\n";
	$rtdo[$h++] =  "</table>";
return $rtdo;
// Como ver datos
// foreach($rtdo as $value){
// 	echo $value;
//}
}
// HTML --------------------------------------------------------------------

// crea enlace
function enlace01($web,$texto){
	echo "<a href=\"$web\">$texto</a>";
	return;
}

// recibe array de 2 valores y devuelve tabla completa
function tabla01($array01){
	$i = '0';
	$array02[$i++] = "<table border=\"1\">";
	foreach( $array01 as $key => $value){
		$array02[$i++] = "<tr><td>".$key."</td><td>".$value."</td></tr>\n";
	}
	$array02[$i++] = "</table>";
	return $array02;
}

// recibe array de 2 valores y devuelve tabla completa con una columna extra
// para editar el contenido
function tabla02($array01){
	$i = '0';
	$array02[$i++] = "<table border=\"1\">";
	foreach( $array01 as $key => $value){
		if ( $key == 'id' or $key == 'ID' or $key == 'Id'){
			$array02[$i++] = "<tr><td>".$key."</td><td>".$value."</td><td> - </td></tr>\n";
		} else{
			$array02[$i++] = "<tr><td>".$key."</td><td>".$value."</td><td>".$value."</td></tr>\n";
		}
	}
	$array02[$i++] = "</table>";
	return $array02;
}

// imprime GPL3 en formato HTML oculto
function gpl3(){
	$var= <<<INICIO
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

INICIO;
 return $var;
}

function php05($min,$max){
	$random = rand($min,$max);
	return $random;
}
?>
