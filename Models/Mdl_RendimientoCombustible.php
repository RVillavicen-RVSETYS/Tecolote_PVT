<?php
class Rendimiento
{
    private $link;
    private $debug;
    private $idUserReg;


    public function __construct($debug, $idUserReg)
    {  
        $this->link = conectar::conexion();
        $this->debug = $debug;
        $this->idUserReg = $idUserReg;

    }

    public function __destruct(){
        $this->link->close();
    }


   
    private function cargasPeriodicasXVehiculo($idVehiculo, $fecha, $fechaReg, $idCarga){
        $debug = $this->debug;
        $link = $this->link;
        $ArrayDatos=array();
        $sql="CALL LimitesDeFullCombustibles('$idVehiculo','$fecha','$idCarga',@fechaLimiteA, @fechaLimiteB, @idLimiteA, @idLimiteB, @conteoRegistro);
        SELECT @fechaLimiteA, @fechaLimiteB, @idLimiteA, @idLimiteB,@conteoRegistro ;";
          if ($debug == 1) {
           $ejection=$link->multi_query($sql);
            echo 'SQL: '.$sql;
            if (! $ejection) {
                return($link->error);
            }
            $canInsert=$link->affected_rows;
        } else {
             $ejection =$link->multi_query($sql);
            if (! $ejection) {
                return('Problemas al consultar Tabla de Cargas de Combustible Para Rendimiento, notifica a tu Administrador');
            }
            $canInsert=$link->affected_rows;
        }
        do {
            /* almacenar primer juego de resultados */
            if ($result = $link->store_result()) {
                while ($row = $result->fetch_array(MYSQLI_BOTH)) {
                    $fechaLimiteB=$row['@fechaLimiteB'];
                    $SinFull='0';
                    if($row['@fechaLimiteB']==''){
                        $SinFull='1';
                        $fechaLimiteB=$fechaReg;

                    }
                   $fechaLimiteA=$row['@fechaLimiteA'];
                   $idLimiteA=$row['@idLimiteA'];
                   $idLimiteB=$row['@idLimiteB']==''?$idCarga:$row['@idLimiteB'];
                   $cuentaRegistro=$row['@conteoRegistro']==''?'0':$row['@conteoRegistro'];
                }
                $result->free();
            }
           
        } while ($link->next_result());

        $filtradoNoIncluyente=($idLimiteA==$idLimiteB OR $SinFull=='1' OR $cuentaRegistro<=2)?'1=1':"c.id!='$idLimiteA'";
        $sql="SELECT c.id AS idCargComb, av.idVehiculo, c.cant, c.fechaReg, c.kilometraje FROM cargacombustible c 
        INNER JOIN viajes v ON v.id=c.idViaje
        INNER JOIN asignavehiculos av ON av.id=v.idAsignaVehiculo
        WHERE av.idVehiculo='$idVehiculo'
        AND 	c.fechaReg>='$fechaLimiteA'
        AND   c.fechaReg<='$fechaLimiteB'
        
        ORDER BY c.fechaReg;
        ";
        #AND $filtradoNoIncluyente
        if ($debug == 1) {
          $resultXquery =$link->query($sql);
          echo 'SQL: '.$sql;
          if (!$resultXquery) {
              return($link->error);
          }
          $canInsert=$link->affected_rows;
      } else {
          $resultXquery =$link->query($sql);
          if (!$resultXquery) {
              return('Problemas al consultar Tabla de Cargas de Combustible Para Rendimiento, notifica a tu Administrador');
          }
          $canInsert=$link->affected_rows;
      }

        $count = 0;
        while ($row = $resultXquery->fetch_array(MYSQLI_BOTH)) {
            $ArrayDatos[$count] = $row;
            $count++;
        }
        return $ArrayDatos;
    }

    public function rendimientoXVehiculo($idVehiculo, $fecha,$fechaReg, $idCarga){
        $debug = $this->debug;
        $link = $this->link;
        $DataCargas=$this->cargasPeriodicasXVehiculo($idVehiculo, $fecha,$fechaReg, $idCarga);
       # print_r($DataCargas);
        if(is_array( $DataCargas)){
            $indexInit=0;
            $indexFin=count($DataCargas)-1;
            if(count($DataCargas)>1){
                $TotalKm=$DataCargas[$indexFin]['kilometraje']-$DataCargas[$indexInit]['kilometraje'];
            }else  if(count($DataCargas)==1){
                $TotalKm=$DataCargas[0]['kilometraje'];
            }
           
            $SumaCarga=0;
            for ($i=0; $i < count($DataCargas) ; $i++) { 
                $SumaCarga=$SumaCarga+$DataCargas[$i]['cant'];
              
            }
            $rendimientoAprox= $TotalKm/($SumaCarga-$DataCargas[$i-1]['cant']);
            return $rendimientoAprox;

        }else{
            return  $DataCargas;
        }
       

    }

    public function calculoKilometraje($idCarga, $idVehiculo){
        $debug = $this->debug;
        $link = $this->link;
        $ArrayDatos=array();
        $sql="SELECT c.* FROM cargacombustible c
        INNER JOIN viajes v ON v.id=c.idViaje
        INNER JOIN asignavehiculos av ON av.id=v.idAsignaVehiculo
        WHERE c.id<='$idCarga' AND av.idVehiculo='$idVehiculo'
        ORDER BY c.fechaReg DESC
        LIMIT 2;
        ";
        #AND $filtradoNoIncluyente
        if ($debug == 1) {
          $resultXquery =$link->query($sql);
          echo 'SQL: '.$sql;
          if (!$resultXquery) {
              return($link->error);
          }
          $canInsert=$link->affected_rows;
      } else {
          $resultXquery =$link->query($sql);
          if (!$resultXquery) {
              return('Problemas al consultar Tabla de Cargas de Combustible Para Rendimiento, notifica a tu Administrador');
          }
          $canInsert=$link->affected_rows;
      }

        $count = 1;
        $kilometrajeInit=0;
        $kilometrajeFin=0;

        while ($row = $resultXquery->fetch_array(MYSQLI_BOTH)) {
            if($count=='1'){
                $kilometrajeFin=$row['kilometraje'];
            }
            if($count=='2'){
                $kilometrajeInit=$row['kilometraje'];

            }
            $count++;
        }
        return $kilometrajeFin-$kilometrajeInit;
    }
}
