<?php
session_start();
define('INCLUDE_CHECK',1);
$problemas=0;
$devBug=0;
if ($devBug != 1){
	error_reporting(0);
} else{
		echo 'Contenido de POST: ';
		var_dump($_POST);
    echo '<br>Contenido de SESSION: ';
    var_dump($_SESSION);
		echo '</br></br>';
}

class Seguridad
{
    public $pagina;
    public $nombrePag;
    public $detailPag;
    public $ident;
    public $idNivel;
    public $nombreNivel;
    public $nombreUser;
    public $area;
    public $subArea;

    #-----------------------  SEGURIDAD  ------------------------------
    public function Acceso($pag)
    {
        //Validamos que existan las variables
        if(isset($_SESSION['ATZident']) AND isset($_SESSION['ATZidNivel']) ){
            //echo 'Existe la variable';
        }
        else{
            //echo 'No Existe la variable';
            header('location: ../index.php');
        }
        require('../include/connect.php');

        $this->ident=$_SESSION['ATZident'];
        $this->idNivel=$_SESSION['ATZidNivel'];
        $this->nombreNivel=$_SESSION['ATZnombreNivel'];
        $this->pagina=$pag;
        $this->nombreUser=$_SESSION['ATZnombreUser'];
        $idLevel=$_SESSION['ATZidNivel'];

        $sql="SELECT
                IF((SELECT
                      COUNT(nvl.id) AS CantAreas
                    FROM
                      segniveles nvl
                		INNER JOIN segdetnivel dnvl ON nvl.id = dnvl.idNivel
                		INNER JOIN segareas ars ON dnvl.idArea = ars.id AND ars.estatus = 1
                		INNER JOIN segsubareas sbars ON dnvl.idSubArea = sbars.id AND sbars.estatus = 1
                		LEFT JOIN segsubmenu sbmnu ON dnvl.idSubMenu = sbmnu.id AND sbmnu.estatus = 1
                		WHERE
                			nvl.id = '$idLevel' AND (sbars.link = '$pag' OR sbmnu.link = '$pag')
                    ) = 0,'OUT','IN') AS estatus,
                ar.id AS idArea, ar.error, sbar.id AS idsubArea, sbar.nombre AS title, sbmn.nombre AS titleSbmn, sbar.descripcion AS detail, sbmn.descripcion AS detailSbmn
            FROM
                segsubareas sbar
            INNER JOIN segareas ar ON sbar.idArea=ar.id
            LEFT JOIN segsubmenu sbmn ON sbar.id = sbmn.idSegSubarea
            WHERE sbar.link='$pag' OR sbmn.link = '$pag'";
        //----------------devBug------------------------------
        if ($GLOBALS['devBug'] == 1) {
          $res= mysqli_query($link,$sql) or die ("Error de consultar Autorización de Acceso: ".mysqli_error($link).'<br>SQL: '.$sql);
          echo 'Autorización de Acceso: '.$sql.'<br>';

					echo $sql;
					echo '<br>-->'.$detallePag;
        } else {
          $res= mysqli_query($link,$sql) or die (problemas(++$problemas));
        }
        //-------------Finaliza devBug------------------------------


        $var=mysqli_fetch_array($res);
        $estatus=$var['estatus'];
        $liga=$var['error'];
        $this->area=$var['idArea'];
        $this->subArea=$var['idsubArea'];
        $this->nombrePag=($var['titleSbmn'] == NULL || $var['titleSbmn'] == '') ? $var['title'] : $var['titleSbmn'] ;
				$this->detailPag=($var['detailSbmn'] == NULL || $var['detailSbmn'] == '') ? $var['detail'] : $var['detailSbmn'] ;

        if ($estatus == 'OUT') {
            //header('location: '.$liga);
            echo '===>> Estatus ='.$estatus;
        } else {
            //echo 'Estatus='.$estatus;
        }
    }

    #-----------------------  ACCESO A SECCION  ------------------------------
    public function Seccion($sec)
    {
        //Validamos que existan las variables
        if(isset($_SESSION['ATZident']) AND isset($_SESSION['ATZidNivel']) ){
            //echo 'Existe la variable';
        }
        else{
            //echo 'No Existe la variable';
            //header('location: ../index.php');
        }
        require('../include/connect.php');
        $idNivel=$this->idNivel;
        $area=$this->area;
        $subArea=$this->subArea;

        $sql="SELECT *
            FROM segdetnivel dtn
            INNER JOIN segsecciones scc ON dtn.idSeccion=scc.id AND scc.id='$sec'
            WHERE dtn.idNivel='$idNivel' AND dtn.idArea='$area' AND dtn.idSubArea='$subArea'";
        //echo 'Sql='.$sql;

        $res=mysqli_query($link,$sql) or die('Problemas al Consultar acceso 2:'.mysqli_error($link).'<br>'.$sql);
        $var=mysqli_num_rows($res);

        if ($var == 1) {
            return true;
        } else {
            return false;
        }
    }

    #-----------------------  MENU DE USUARIO  ------------------------------
    public function generaMenuUsuario()
    {
				require('../include/connect.php');

        $level=$this->idNivel;
        $area =$this->area;
        $sql="SELECT
                DISTINCT(dtnvl.idArea) AS identArea, ars.*
            FROM segdetnivel dtnvl
            INNER JOIN segareas ars ON dtnvl.idArea = ars.id
            WHERE
            dtnvl.idNivel='$level'
            ORDER BY ars.orden ASC";
        //----------------devBug------------------------------
        if ($GLOBALS['devBug'] == 1) {
        $res= mysqli_query($link,$sql) or die ("Error de consultar Menu de Usuario: ".mysqli_error($link).'<br>SQL: '.$sql);
        echo 'Menu de Usuario: '.$sql.'<br>';
        } else {
        $res= mysqli_query($link,$sql) or die (problemas(++$problemas));
        }
        //-------------Finaliza devBug------------------------------

        echo '<li class="dropdown-header">Secciones</li>';
        while ($dat=mysqli_fetch_array($res)){
            $estatus = ($dat['id'] == $area) ? 'class="active"' : '' ;
						$atras = '../';
            echo '<li '.$estatus.'><a href="'.$atras.$dat['link'].'"><i class="'.$dat['icono'].'"></i> '.$dat['nombre'].'</a></li>';
        }
        echo '<li class="divider"></li>
				<li><a href="../logout.php"><i class="fa fa-fw fa-power-off text-danger"></i> Cerrar Sesi&oacute;n</a></li>';
    }

    #-----------------------  MENU LATERAL  ------------------------------
    public function generaMenuLateral()
    {
        require('../include/connect.php');

        $pagina =$this->pagina;
        $level=$this->idNivel;
        $area =$this->area;
        $sql="SELECT dtnvl.idSubArea, dtnvl.idSubMenu, sbmn.nombre AS sbmn, sbmn.descripcion AS sbmnDesc, sbmn.link AS sbmnLink,
								sbars.nombre AS menu, sbars.descripcion AS menuDesc, sbars.icono AS menuIco, sbars.link AS menuLink
              FROM
                  segdetnivel dtnvl
              INNER JOIN segsubareas sbars ON dtnvl.idSubArea = sbars.id AND sbars.estatus = 1
							LEFT JOIN segsubmenu sbmn ON dtnvl.idSubMenu = sbmn.id AND sbmn.estatus = 1
              WHERE
                  dtnvl.idNivel = '$level' AND dtnvl.idArea='$area'
              ORDER BY sbars.orden, sbmn.orden ASC";
							//echo $sql.'<br><br>';
        //----------------devBug------------------------------
        if ($GLOBALS['devBug'] == 1) {
        $res= mysqli_query($link,$sql) or die ("Error de consultar Menu Lateral: ".mysqli_error($link).'<br>SQL: '.$sql);
        echo 'Menu de Usuario: '.$sql.'<br>';
        } else {
        $res= mysqli_query($link,$sql) or die (problemas(++$problemas));
        }
        //-------------Finaliza devBug------------------------------

				$idMenu=0;
				$subOpen=0;
        while ($dat=mysqli_fetch_array($res)){
					if($idMenu == $dat['idSubArea']){
						$estatus = ($dat['sbmnLink'] == $pagina) ? 'class="active"' : '' ;
						echo '<li><a '.$estatus.' data-toggle="tooltip" data-placement="top" data-original-title="'.$dat['sbmnDesc'].'" href="'.$dat['sbmnLink'].'" ><span class="title">'.$dat['sbmn'].'</span></a></li>';
					}else{
						if ($subOpen == 1) {
							echo'
								</ul><!--end /submenu -->
							</li><!--end /menu-li -->';
							$subOpen = 0;
						}
						if (isset($dat['idSubMenu'])) {
							$estatus = ($dat['sbmnLink'] == $pagina) ? 'class="active"' : '' ;
							echo '
							<li class="gui-folder">
								<a data-toggle="tooltip" data-placement="top" data-original-title="'.$dat['menuDesc'].'">
									<div class="gui-icon"><i class="'.$dat['menuIco'].'"></i></div>
									<span class="title">'.$dat['menu'].'</span>
								</a>
								<!--start submenu -->
								<ul>
									<li><a '.$estatus.' data-toggle="tooltip" data-placement="top" data-original-title="'.$dat['sbmnDesc'].'" href="'.$dat['sbmnLink'].'" >
										<span class="title">'.$dat['sbmn'].'</span></a></li>';
							$idMenu = $dat['idSubArea'];
							$subOpen = 1;
						} else {
							$estatus = ($dat['menuLink'] == $pagina) ? 'class="active"' : '' ;
							echo '
		          <li>
		              <a href="'.$dat['menuLink'].'" '.$estatus.' data-toggle="tooltip" data-placement="top" data-original-title="'.$dat['menuDesc'].'">
		                  <div class="gui-icon"><i class="'.$dat['menuIco'].'"></i></div>
		                  <span class="title">'.$dat['menu'].'</span>
		              </a>
		          </li>';
							$idMenu = $dat['idSubArea'];
						}
					}
        }
				if ($subOpen == 1) {
					echo'
						</ul><!--end /submenu -->
					</li><!--end /menu-li -->';
					$subOpen = 0;
				}
    }
}

function problemas($problemas){
	if ($problemas!=0) {
		echo 'Corre Función';
		$_SESSION['ATZacceso']='Lo sentimos, este sitio web está experimentando problemas Tecnicos...<br> Por favor notifica al Administrador.';
		header('location: ../index.php');
	  exit(0);
	}
}
?>
