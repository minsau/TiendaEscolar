<?php
  session_start();
?>

<!DOCTYPE html>
<html ng-app="adminApp">
  <head>
    <meta charset="utf-8">
    <title>Mi tienda | Admin</title>
    <link rel="stylesheet" href="static/css/bootstrap.css" media="screen" title="no title">
    <link rel="stylesheet" href="static/css/estilo.css" media="screen" title="no title">
  </head>
  <body ng-controller="adminController">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="">Mi tienda</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
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
            <li ng-click="mostrarEmpleados()"><a href="">Empleados</a></li>
            <li ng-click="mostrarClientes()"><a href="">Clientes</a></li>
            <li ng-click="mostrarProductos()"><a href="">Articulos</a></li>
            <li ng-click="mostrarNuevaVenta_Cliente()"><a href="">Nueva venta</a></li>
            <li ng-click="mostrarVentas()"><a href="">Ver ventas</a></li>
          </ul>
        </div>

        <div class="col-md-8 col-md-offset-1 ocultable" id="resultadosEmpleados" style="display:none;">
          <div class="form-group">
            <div class="input-group">
              <input id="empleadoSearch" type="search" class="form-control" id="palabra" ng-change="buscarEmpleados()" ng-model="palabraEmpleado" placeholder="Buscar empleado">
              <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
            </div>
          </div>
          <button data-toggle="modal" data-target="#agregarEmpleado" type="button" class="btn btn-sm btn-default" name="button"><span class="glyphicon glyphicon-plus" style="color:green;"></span>Agregar empleado</button>
          <table class="table table-hover">
            <thead>
              <th>#</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th>Estado</th>
              <th>Tipo</th>
              <th></th>
              <th></th>
            </thead>
            <tr ng-repeat="empleado in empleados">
              <td>{{empleado.id}}</td>
              <td>{{empleado.nombre}}</td>
              <td>{{empleado.correo}}</td>
              <td>{{empleado.telefono}}</td>
              <td>{{empleado.estado}}</td>
              <td>{{empleado.tipo}}</td>
              <td><button data-toggle="modal" data-target="#editarEmpleado" type="button" ng-click="obtenerModificarEmpleado(empleado.id)" class="btn btn-sm btn-success" name="button"><span class="glyphicon glyphicon-pencil"></span></button></td>
              <td><button type="button" ng-click="eliminarEmpleado(empleado.id,this)" class="btn btn-sm btn-danger" name="button"><span class="glyphicon glyphicon-remove"></span></button></td>
            </tr>
          </table>
        </div>

        <div class="col-md-8 col-md-offset-1 ocultable" id="resultadosClientes" style="display:none;">
          <div class="form-group">
            <div class="input-group">
              <input id="clienteSearch" type="search" class="form-control" id="palabra" ng-change="buscarClientes()" ng-model="palabraCliente" placeholder="Buscar cliente">
              <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
            </div>
          </div>
          <button data-toggle="modal" data-target="#agregarCliente" type="button" class="btn btn-sm btn-default" name="button"><span class="glyphicon glyphicon-plus" style="color:green;"></span>Agregar cliente</button>
          <table class="table table-hover">
            <thead>
              <th>#</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th></th>
              <th></th>
            </thead>
            <tr ng-repeat="cliente in clientes">
              <td>{{cliente.id}}</td>
              <td>{{cliente.nombre}}</td>
              <td>{{cliente.correo}}</td>
              <td>{{cliente.telefono}}</td>
              <td><button data-toggle="modal" data-target="#editarCliente" type="button" ng-click="obtenerModificarCliente(cliente.id)" class="btn btn-sm btn-success" name="button"><span class="glyphicon glyphicon-pencil"></span></button></td>
              <td><button type="button" ng-click="eliminarCliente(cliente.id,this)" class="btn btn-sm btn-danger" name="button"><span class="glyphicon glyphicon-remove"></span></button></td>
            </tr>
          </table>
        </div>

        <div class="col-md-8 col-md-offset-1 ocultable" id="resultadosProductos" style="display:none;">
          <div class="form-group">
            <div class="input-group">
              <input id="productoSearch" type="search" class="form-control" id="palabra" ng-change="buscarProducto()" ng-model="palabraProducto" placeholder="Buscar productos">
              <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
            </div>
          </div>
          <button data-toggle="modal" data-target="#agregarProducto" type="button" class="btn btn-sm btn-default" name="button"><span class="glyphicon glyphicon-plus" style="color:green;"></span>Agregar producto</button>
          <table class="table table-hover">
            <thead>
              <th>#</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Precio</th>
              <th>Existencia</th>
              <th></th>
              <th></th>
            </thead>
            <tr ng-repeat="producto in productos">
              <td>{{producto.id}}</td>
              <td>{{producto.nombre}}</td>
              <td>{{producto.descripcion}}</td>
              <td>{{"$ "+producto.precio}}</td>
              <td>{{producto.cantidad}}</td>
              <td><button data-toggle="modal" data-target="#editarProducto" type="button" ng-click="obtenerModificarProducto(producto.id)" class="btn btn-sm btn-success" name="button"><span class="glyphicon glyphicon-pencil"></span></button></td>
              <td><button type="button" ng-click="eliminarProducto(producto.id,this)" class="btn btn-sm btn-danger" name="button"><span class="glyphicon glyphicon-remove"></span></button></td>
            </tr>
          </table>
        </div>

        <div class="col-md-4  ocultable" id="nuevaVenta_Cliente" style="display:none;">
          <div class="form-group">
            <div class="input-group">
              <input id="clienteSearch" type="search" class="form-control" id="palabra" ng-change="buscarClientes()" ng-model="palabraCliente" placeholder="Buscar cliente">
              <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
            </div>
          </div>
          <button data-toggle="modal" data-target="#agregarCliente" type="button" class="btn btn-sm btn-default" name="button"><span class="glyphicon glyphicon-plus" style="color:green;"></span>Agregar cliente</button>
          <table class="table table-hover">
            <thead>
              <th>#</th>
              <th>Nombre</th>
              <th>Telefono</th>
              <th></th>

            </thead>
            <tr ng-repeat="cliente in clientes">
              <td>{{cliente.id}}</td>
              <td>{{cliente.nombre}}</td>
              <td>{{cliente.telefono}}</td>
              <td><button type="button" ng-click="mostrarNuevaVenta_Productos(cliente.id,cliente.nombre)" class="btn btn-sm btn-default" name="button"><span class="glyphicon glyphicon-chevron-right"></span></button></td>

            </tr>
          </table>
        </div>

        <div class="col-md-4 col-md-offset-1 ocultable" id="nuevaVenta_Productos" style="display:none;">
          <div class="form-group">
            <div class="input-group">
              <input id="productoSearch" type="search" class="form-control" id="palabra" ng-change="buscarProducto()" ng-model="palabraProducto" placeholder="Buscar productos">
              <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
            </div>
          </div>
          <button data-toggle="modal" data-target="#agregarProducto" type="button" class="btn btn-sm btn-default" name="button"><span class="glyphicon glyphicon-plus" style="color:green;"></span>Agregar producto</button>
          <table class="table table-hover">
            <thead>
              <th>#</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Existencia</th>
              <th></th>
              <th></th>
            </thead>
            <tr ng-repeat="producto in productos">
              <td>{{producto.id}}</td>
              <td>{{producto.nombre}}</td>
              <td>{{"$ "+producto.precio}}</td>
              <td>{{producto.cantidad}}</td>
              <td><button type="button" ng-click="agregarProducto_Venta(producto.id,producto.nombre,producto.precio)" class="" name="button"><span class="glyphicon glyphicon-plus"></span></button></td>

            </tr>
          </table>
        </div>

        <div class="col-md-4 col-md-offset-1 ocultable" id="estaVenta" style="display:none;">
          <p class="text-default">Empleado: {{venta.empleado}}</p>
          <p class="text-default">Cliente: {{venta.cliente}}</p>
          <h3>Productos en esta venta</h3>
          <table class="table table-hover">
            <thead>
              <th>#</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Cantidad</th>
            </thead>
            <tr ng-repeat="prod in productose track by $index">
              <td>{{prod.id}}</td>
              <td>{{prod.nombre}}</td>
              <td>{{"$ "+prod.precio}}</td>
              <td>{{prod.cantidad}}</td>
            </tr>
          </table>
          <!--<h6 ng-repeat="prod in productose track by $index">{{prod.nombre+" "+prod.precio+" "+prod.cantidad}}</h6>-->
          <button class="btn btn-sm btn-success" ng-click="vender()" type="button" name="button">Vender</button>
      </div>

      <div class="col-md-6 col-md-offset-1 ocultable" id="verVentas" style="display:none;">
        <div class="panel panel-default" ng-repeat="venta in ventas">
          <div class="panel-heading">
            <p>Venta número {{venta.id}}</p>
          </div>
          <div class="panel-body">
            Fecha: {{venta.fecha}}<br>
            Empleado: {{venta.empleado}}<br>
            Cliente: {{venta.cliente}}<br>
            Total de esta venta: {{venta.total}}<br>
          </div>
        </div>
      </div>
    </div>





    <div id="agregarEmpleado" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar Empleado</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="">Nombre: </label>
                <input type="text" ng-model="emp.nombre"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

            <div class="form-group">
                <label for="">Correo: </label>
                <input type="email" ng-model="emp.email"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="form-group">
                <label for="">Telefono: </label>
                <input type="number" ng-model="emp.telefono"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="form-group">
                <label for="">Direccion: </label>
                <input type="text" ng-model="emp.direccion"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="form-group">
                <label for="">Sexo: </label>
                <input type="text" ng-model="emp.sexo"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="form-group">
                <label class="control-label">Password:</label>
                <input id="foto" type="password" class="form-control" placeholder="Ingresa un valor"  ng-model="emp.password">
              </div>
              <div class="">
                {{resultado.mensaje}}
              </div>
              <input type="button" value="Agregar" ng-click="agregarEmpleado()">
            </form>
          </div>
        </div>

      </div>
    </div>

    <div id="agregarCliente" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar cliente</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="">Nombre: </label>
                <input type="text" ng-model="cli.nombre"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

            <div class="form-group">
                <label for="">Correo: </label>
                <input type="email" ng-model="cli.email"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="form-group">
                <label for="">Telefono: </label>
                <input type="number" ng-model="cli.telefono"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="form-group">
                <label for="">Direccion: </label>
                <input type="text" ng-model="cli.direccion"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="form-group">
                <label for="">Sexo: </label>
                <input type="text" ng-model="cli.sexo"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="">
                {{resultado.mensaje}}
              </div>
              <input type="button" value="Agregar" ng-click="agregarCliente()">
            </form>
          </div>
        </div>

      </div>
    </div>

    <div id="agregarProducto" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar producto</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="">Nombre: </label>
                <input type="text" ng-model="prod.nombre"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="form-group">
                <label for="">Descripcion: </label>
                <input type="text" ng-model="prod.descripcion"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="form-group">
                <label for="">Precio: </label>
                <input type="number" step="0.001" ng-model="prod.precio"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>

              <div class="form-group">
                <label for="">Cantidad: </label>
                <input type="number"  ng-model="prod.cantidad"  class="form-control" placeholder="Ingresa un valor" value="">
              </div>
              <div class="">
                {{resultado.mensaje}}
              </div>
              <input type="button" value="Agregar" ng-click="agregarProducto()">
            </form>
          </div>
        </div>

      </div>
    </div>



    <div id="editarEmpleado" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar datos Empleado</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="">Nombre: </label>
                <input type="text" ng-model="editEmp.nombre"  class="form-control" placeholder="Ingresa un valor" ng-value="datosEmp[0].nombre">
              </div>

            <div class="form-group">
                <label for="">Correo: </label>
                <input type="email" ng-model="editEmp.email"  class="form-control" placeholder="Ingresa un valor" ng-value="datosEmp[0].correo">
              </div>

              <div class="form-group">
                <label for="">Telefono: </label>
                <input type="text" ng-model="editEmp.telefono"  class="form-control" placeholder="Ingresa un valor" ng-value="datosEmp[0].telefono">
              </div>

              <div class="form-group">
                <label for="">Direccion: </label>
                <input type="text" ng-model="editEmp.direccion"  class="form-control" placeholder="Ingresa un valor" ng-value="datosEmp[0].direccion">
              </div>

              <div class="form-group">
                <label for="">Sexo: </label>
                <input type="text" ng-model="editEmp.sexo"  class="form-control" placeholder="Ingresa un valor" ng-value="datosEmp[0].sexo">
              </div>

              <div class="form-group">
                <label class="control-label">Password:</label>
                <input id="foto" type="password" class="form-control" placeholder="Ingresa un valor"  ng-model="editEmp.password" ng-value="datosEmp[0].password">
              </div>
              <div class="">
                {{resultado.mensaje}}
              </div>
              <input type="button" class="btn btn-sm btn-default" value="Guardar cambios" ng-click="editarEmpleado()">
            </form>
          </div>
        </div>

      </div>
    </div>

    <div id="editarCliente" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar datos Empleado</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="">Nombre: </label>
                <input type="text" ng-model="editCli.nombre"  class="form-control" placeholder="Ingresa un valor" ng-value="datosCli[0].nombre">
              </div>

            <div class="form-group">
                <label for="">Correo: </label>
                <input type="email" ng-model="editCli.email"  class="form-control" placeholder="Ingresa un valor" ng-value="datosCli[0].correo">
              </div>

              <div class="form-group">
                <label for="">Telefono: </label>
                <input type="text" ng-model="editCli.telefono"  class="form-control" placeholder="Ingresa un valor" ng-value="datosCli[0].telefono">
              </div>

              <div class="form-group">
                <label for="">Direccion: </label>
                <input type="text" ng-model="editCli.direccion"  class="form-control" placeholder="Ingresa un valor" ng-value="datosCli[0].direccion">
              </div>

              <div class="form-group">
                <label for="">Sexo: </label>
                <input type="text" ng-model="editCli.sexo"  class="form-control" placeholder="Ingresa un valor" ng-value="datosCli[0].sexo">
              </div>

              <div class="">
                {{resultado.mensaje}}
              </div>
              <input type="button" class="btn btn-sm btn-default" value="Guardar cambios" ng-click="editarCliente()">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="editarProducto" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar datos Producto</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="">Nombre: </label>
                <input type="text" ng-model="editProd.nombre"  class="form-control" placeholder="Ingresa un valor" ng-value="datosProd[0].nombre">
              </div>

            <div class="form-group">
                <label for="">Descripcion: </label>
                <input type="text" ng-model="editProd.descripcion"  class="form-control" placeholder="Ingresa un valor" ng-value="datosProd[0].descripcion">
              </div>

              <div class="form-group">
                <label for="">Precio: </label>
                <input type="text" ng-model="editProd.precio"  class="form-control" placeholder="Ingresa un valor" ng-value="datosProd[0].precio">
              </div>

              <div class="form-group">
                <label for="">Cantidad: </label>
                <input type="t" step="0.01" ng-model="editProd.cantidad"  class="form-control" placeholder="Ingresa un valor" ng-value="datosProd[0].cantidad">
              </div>


              <div class="">
                {{resultado.mensaje}}
              </div>
              <input type="button" class="btn btn-sm btn-default" value="Guardar cambios" ng-click="editarProducto()">
            </form>
          </div>
        </div>
    </div>
  </div>





    <script src="static/js/jquery.js" charset="utf-8"></script>
    <script src="static/js/bootstrap.js" charset="utf-8"></script>
    <script src="static/js/angular.js" charset="utf-8"></script>
    <script src="controllers/adminApp.js" charset="utf-8"></script>
  </body>
</html>
