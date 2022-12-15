<?php
define('INCLUDE_CHECK',1);
require_once('include/connect.php');
session_start();
$problemas=0;
$devBug=0;
if ($devBug != 1){
	error_reporting(0);
} else{
		echo 'Contenido de POST:</br>';
		print_r($_POST);
		echo '</br></br>';
}

if(isset($_POST['usuario']) and isset($_POST['pass']) and $_POST['usuario']!="" and $_POST['pass']!="")
{
	$usuario = $_POST['usuario'];
	$passwd  = md5($_POST['pass']);
	$sql="SELECT * FROM segusuarios WHERE usuario='$usuario' AND pass='$passwd'";
	//----------------devBug------------------------------
	if ($devBug==1) {
		$res= mysqli_query($link,$sql) or die ("Error de consulta existeUsuario: ".mysqli_error($link).'<br>SQL: '.$sql);
		echo $sql.'<br>';
	} else {
		$res= mysqli_query($link,$sql) or die (problemas(++$problemas));
	}
	//-------------Finaliza devBug------------------------------

	$numRes=mysqli_num_rows($res);

	if($numRes== 1)
		{
			$var=mysqli_fetch_array($res);
			if($var['estatus']!=1)
			{
				$_SESSION['ATZacceso']='Usuario deshabilitado.';
				header('location: index.php');
				}
			else{
				$nivel = $var['idNivel'];
				$sql="SELECT
								lvl.nombre AS nameNivel, ars.link AS envLink
							FROM
								segniveles lvl
							INNER JOIN segdetnivel dtlvl ON lvl.id = dtlvl.idNivel
							INNER JOIN segareas ars ON dtlvl.idArea = ars.id AND ars.estatus = '1'
							WHERE lvl.id = '$nivel' AND lvl.estatus = '1'
							ORDER BY ars.orden DESC
							LIMIT 1";

							#echo '<br>nivel:'.$nivel.'<br>';
				//----------------devBug------------------------------
				if ($devBug==1) {
					$res1= mysqli_query($link,$sql) or die ("Error de consulta Nivel de Usuario: ".mysqli_error($link).'<br>SQL: '.$sql);
					echo $sql.'<br>';
				} else {
					$res1= mysqli_query($link,$sql) or die (problemas(++$problemas));
				}
				//-------------Finaliza devBug------------------------------

				$cantPermisos = mysqli_num_rows($res1);
#				echo '<br>$cantPermisos: '.$cantPermisos.'<br>';
				if($cantPermisos < 1)
				{
					$_SESSION['ATZacceso']='Su usuario no tiene Permisos Asignados.';
					header('location: index.php');
					}
				else{
					$dat = mysqli_fetch_array($res1);

					$_SESSION['ATZident'] = $var['id'];
					$_SESSION['ATZidNivel'] = $var['idNivel'];
					$_SESSION['ATZnombreNivel'] = $dat['nameNivel'];
					$_SESSION['ATZnombreUser'] = $var['nombre'].' '.$var['apellidos'];
					$link = $dat['envLink'];
					mysqli_free_result($res);

					//----------------devBug------------------------------
					if ($devBug==1) {
						echo '<br>Ya paso todo OK. <br> Link: '.$link.'<br>';
						print_r($_SESSION);
					} else {
					header('location: '.$link);
					}
					//-------------Finaliza devBug------------------------------

					}
				}
		}
	else
		{
		$_SESSION['ATZacceso']='El usuario o el password que ingreso son incorrectos por favor intente de nuevo.';
		header('location: index.php');

		}
}
else{
	$_SESSION['ATZacceso']='Debes llenar todos los campos.';
	header('location: index.php');
	}

function problemas($problemas){
	if ($problemas!=0) {
		$_SESSION['ATZacceso']='Lo sentimos, este sitio web está experimentando problemas..<br> Por favor notifica al Administrador.';
		header('location: index.php');
	  exit(0);
	}
}
?>
