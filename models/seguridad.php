<?php
session_start();
$path = '../static/';
function login($path,$correo,$pass){
  date_default_timezone_set('America/Mexico_City');
  require_once($path."baseDatos/conexion.php");
  $sql = "SELECT * FROM Empleado WHERE correo = '$correo' and password = '$pass'";
  $res = mysqli_query($conexion, $sql) or die ("error al consultar "+mysqli_connect_error());
  $data = [];
  if(mysqli_num_rows($res)==1){
    if($reg = mysqli_fetch_array($res)){
      $data['hecho'] = 1;
      $data['mensaje'] = 'Se ha logueado correctamente';
      $_SESSION['id'] = $reg['id'];
      $_SESSION['user'] = $correo;
    }
  }else{
    $data['hecho'] = -1;
    $data['mensaje'] = 'No se encontro la combinación usuario/contraseña';
  }

  return $data;
}

function obtenerSesion($path){
  require_once($path."baseDatos/conexion.php");
  $data = [];
  if(!$_SESSION){
    $data['hecho'] = -1;
    $data['mensaje'] = 'Usted no esta logueado,sera redireccionado';
  }else{
    $data['hecho'] = 1;
    $data['mensaje'] = 'Bienvenido';
    $data['id'] = $_SESSION['id'];
    $data['user'] = $_SESSION['user'];
    $sql = "SELECT * FROM Empleado WHERE id = '".$data['id']."'";
    $res = mysqli_query($conexion, $sql) or die ("error al consultar "+mysqli_error($conexion));
    if($reg = mysqli_fetch_array($res)){
      $data['nombre'] = $reg['nombre'];
    }
  }
  return $data;
}

function destruir(){
  $data['mensaje'] = "Sesion destruida";
  session_destroy();
  return $data;
}

if($_POST){
  $op = $_POST['op'];
}else{
  $data = json_decode(file_get_contents('php://input'), true);
  $op = $data['op'];
}

if($op == 1){
  $correo = $data['correo'];
  $clave = $data['clave'];
  $resultado = login($path,$correo,$clave);
  print json_encode($resultado);
}

if($op == 2){

  $resultado = obtenerSesion($path);
  print  json_encode($resultado);
}

if($op == 3){
  $resultado = destruir();
  print  json_encode($resultado);
}


 ?>
