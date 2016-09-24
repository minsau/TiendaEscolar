<?php
session_start();
$path = '../static/';

function buscar($path,$consulta){
  require_once($path."baseDatos/conexion.php");
  $sql = $consulta;
  $res = mysqli_query($conexion, $sql) or die ("error al consultar "+mysqli_error($conexion));
  $data = [];

  while($reg = mysqli_fetch_assoc($res)){
    $data[] = $reg;
  }
  return $data;
}

function agregar($path,$consulta){
  require_once($path."baseDatos/conexion.php");
  $sql = $consulta;
  $res = mysqli_query($conexion, $sql) or die ("error al consultar "+mysqli_error($conexion));
  $data = [];
  if ($res){
    $data['hecho'] = 1;
    $data['mensaje'] = "Ha sido agregado exitosamente.";
  }else{
    $data['hecho'] = -1;
    $data['mensaje'] = "Ocurrio algun error al agregar.";
  }
  return $data;
}

function eliminar($path,$consulta){
  require_once($path."baseDatos/conexion.php");
  $sql = $consulta;
  $res = mysqli_query($conexion, $sql) or die ("error al consultar "+mysqli_error($conexion));
  $data = [];
  if ($res){
    $data['hecho'] = 1;
    $data['mensaje'] = "El empleado ha sido eliminado exitosamente.";
  }else{
    $data['hecho'] = -1;
    $data['mensaje'] = "Ocurrio algun error al eliminar el empleado.";
  }
  return $data;
}

function modificar($path,$consulta){
  require_once($path."baseDatos/conexion.php");
  $sql = $consulta;
  $res = mysqli_query($conexion, $sql) or die ("error al consultar "+mysqli_error($conexion));
  $data = [];
  if ($res){
    $data['hecho'] = 1;
    $data['mensaje'] = "Modificado con exito";
  }else{
    $data['hecho'] = -1;
    $data['mensaje'] = "Ocurrio algun error al modificar";
  }
  return $data;
}

function venta($path,$datos,$empleado,$cliente,$total){
  require_once($path."baseDatos/conexion.php");
  $sql = "INSERT INTO Venta VALUES (null,'$cliente','$empleado',now(),'$total')";
  //echo "$sql";
  $res = mysqli_query($conexion, $sql) or die ("error al consultar "+mysqli_error($conexion));
  $data = [];
  if ($res){
    $sqlVenta = "SELECT * FROM Venta order by id desc limit 1";
    //echo "$sqlVenta";
    $resG = mysqli_query($conexion, $sqlVenta) or die ("error al consultar "+mysqli_error($conexion));
    if($regV = mysqli_fetch_array($resG)){
      //echo "".count($datos);
      for($i = 0; $i < count($datos); $i++){
        $sqlP = "INSERT INTO Venta_Articulos VALUES ('".$regV['id']."','".$datos[$i]['id']."', '".$datos[$i]['cantidad']."')";
        //echo "$sqlP";
        $resP = mysqli_query($conexion, $sqlP) or die ("error al insertar "+mysqli_error($conexion));
        if(!$resP){
          echo "Hubo un error";
        }
      }
    }else{
      $data['hecho'] = -1;
      $data['mensaje'] = "Ocurrio algun error al modificar";
      return $data;
    }
  }else{
    $data['hecho'] = -1;
    $data['mensaje'] = "Ocurrio algun error al modificar";
    return $data;
  }

  //echo "Llego aqui";
  $data['hecho'] = 1;
  $data['mensaje'] = "Venta guardada";

  return $data;
}

if($_POST){
  $op = $_POST['op'];
}else{
  $data = json_decode(file_get_contents('php://input'), true);
  $op = $data['op'];
}

if($op == 1){
  $consulta = $data['consulta'];
  $resultado = buscar($path,$consulta);
  print json_encode($resultado);
}

if($op == 2){
  $consulta = $data['consulta'];
  $resultado = agregar($path,$consulta);
  print json_encode($resultado);
}

if($op == 3){
  $consulta = $data['consulta'];
  $resultado = eliminar($path,$consulta);
  print json_encode($resultado);
}

if($op == 4){
  $consulta = $data['consulta'];
  $resultado = modificar($path,$consulta);
  print json_encode($resultado);
}

if($op == 5){
  $empleado = $data['empleado'];
  $cliente = $data['cliente'];
  $datos = $data['productos'];
  $total = $data['total'];
  $resultado = venta($path,$datos,$empleado,$cliente,$total);
  print json_encode($resultado);
}

 ?>
