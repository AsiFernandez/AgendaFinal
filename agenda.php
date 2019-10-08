<!doctype html>
<html>
	<head>
		<title>
			DWES02 - Agenda
		</title>
	</head>
	<body>

		<style type="text/css">
			
			th{
				border: 1px solid;
				width: 300px;
			}

		</style>

		<?php
			//Funciones extra que he utilizado para gestionar la agenda
			function stringtoarray ($string_agenda,&$array_agenda) {
				//Convierte la agenda de datos (string) en un array asociativo
				$a=explode (";",$string_agenda);
				for($i=0; $i<count($a); $i++) {
					$array_agenda[$a[$i]]=$a[$i+1];
					$i++;
				}
				return true;
			}
			function arraytostring ($array_agenda) {
				//Convierte el array asociativo en una cadena de caracteres cada elemento separado por ;
				foreach($array_agenda as $key_nombre => $value)
				{
				  $string_agenda.=$key_nombre.";".$value.";";
				}
				//Quitamos el ultimo ';''
				$string_agenda=substr($string_agenda, 0, -1);
				return $string_agenda;
			}
		?>
		<?php
		//Creamos un array para almacenar los datos de la agenda
		$array_agenda=array( );
		if (isset ($_POST['submit'])) {
			//Rellenamos el array con los datos recibidos en el campo oculto 'agenda' del formulario
			stringtoarray ($_POST['agenda'],$array_agenda);
			
			// REALIZAR COMPROBACIONES NECESARIAS


			if(!isset($_POST['nombre'])  || $_POST['nombre'] === ""){		//comprobacion del input 'nombre' y si esta vacio muestra un mensaje
				echo "No has introducido un nombre";
			}else{
				if (array_key_exists(strtolower($_POST['nombre']), $array_agenda) && isset($_POST['email'])){  //si el nombre introducido esta en el array (convertido en minuscula) lo borramos con unset 
						unset($array_agenda[strtolower($_POST['nombre'])]);
						echo "Contacto con el nombre ".$_POST['nombre'] . " eliminado";
				}else{
					$array_agenda[strtolower($_POST['nombre'])]= $_POST['email']; //si el nombre no esta en el array lo agregamos al array asociativo
					echo "Hemos añadido un nuevo contacto";
				}
			}

		}
		?>

		<form action="" method="post">
			<!-- Campo oculto para ir almacenando los elementos de la agenda-->
			<input name="agenda" type="hidden" value="<?php echo  arraytostring ($array_agenda) ?>"/><br>
			Nombre:<br>
			<input type="text" name="nombre"><br><br>
			Email:<br>
			<input type="text" name="email"><br><br> 
			<button type="submit" name="submit" >Añadir contacto</button>
		</form>

		<h2>AGENDA</h2>
		<table>
		  <tr>
		    <th>Nombre</th>
		    <th>Email</th>
		  </tr>
		  	<?php

		  	// recorremos el array y mostramos los contactos
		  	foreach($array_agenda as $nombre=>$email){
				echo  "<tr><th>" . $nombre . "</th><th>  " . $email . "</th></tr>" ;
			}

			?>
		</table>

	</body>
</html>