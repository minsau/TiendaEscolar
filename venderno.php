<?php
  session_start();
?>

<!DOCTYPE html>
<html ng-app="venderApp">
  <head>
    <meta charset="utf-8">
    <title>Mi tienda | Admin</title>
    <link rel="stylesheet" href="static/css/bootstrap.css" media="screen" title="no title">
  </head>
  <body ng-controller="venderController">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="">Mi tienda</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Inicio</a></li>
          <li class="active" ><a href="">Vender</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><span class="glyphicon glyphicon-user"></span> {{datosSesion.nombre+"    "}}    </a>
            <ul class="dropdown-menu">
              <li  ng-click="cerrarSesion()" name="button"><a>Cerrar Sesion</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li ng-click="mostrarEmpleados()"><a href="">Nueva venta</a></li>
            <li ng-click="mostrarClientes()"><a href="">Ver ventas</a></li>
          </ul>
        </div>

        <div class="col-md-4 col-md-offset-1">
          <div class="form-group">
            <div class="input-group">
              <input id="clienteSearch" type="search" class="form-control" id="palabra" ng-change="buscarClientes()" ng-model="palabraCliente" placeholder="Buscar cliente">
              <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="static/js/jquery.js" charset="utf-8"></script>
    <script src="static/js/bootstrap.js" charset="utf-8"></script>
    <script src="static/js/angular.js" charset="utf-8"></script>
    <script src="controllers/venderApp.js" charset="utf-8"></script>
  </body>
</html>
