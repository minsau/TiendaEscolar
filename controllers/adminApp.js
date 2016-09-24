'use strict'

var angular_module = angular.module('adminApp',[]);

angular_module.controller('adminController',function($scope,$http){
  var cadena;
  $scope.venta = [];
  $scope.datosSesion = {};
  $scope.palabraEmpleado = "";
  $scope.datosEmp = [];
  $scope.datosCli = [];
  $scope.datosProd = [];
  $scope.resultado = {};
  $scope.editEmp ={};
  $scope.editCli ={};
  $scope.editProd ={};
  var idEmpMod;
  var idCliMod;
  var idProdMod;
  $scope.productose = [];
  $http.post('models/seguridad.php',{op: 2}).success(function(data){
    $scope.datosSesion = data;
    //console.log(data);
    if($scope.datosSesion.hecho == -1){
      alert($scope.datosSesion.mensaje);
      window.location.href = 'login.php';
    }else{
      //console.log("Se ha logueado correctamente");
    }
  });


  $scope.mostrarEmpleados = function(){
    $(".ocultable").hide();
    $("#resultadosEmpleados").show();
  }

  $scope.mostrarNuevaVenta_Cliente = function(){
    $scope.productose = [];
    $(".ocultable").hide();
    $("#nuevaVenta_Cliente").show();
  }

  $scope.mostrarNuevaVenta_Productos = function(id,nombre){
    $scope.venta.empleado = $scope.datosSesion.nombre
    $scope.venta.cliente = nombre;
    $scope.venta.clienteid = id;
    $("#nuevaVenta_Productos").show();
    $("#nuevaVenta_Cliente").fadeOut(500);
    $("#nuevaVenta_Productos").removeClass('col-md-offset-1');
    $("#estaVenta").show();
  }

  $scope.agregarProducto_Venta = function(id,nombre,precio){
    var encontro = 0;
    for(var x = 0; x < $scope.productose.length; x++){
      if($scope.productose[x].id == id){
        $scope.productose[x].cantidad = $scope.productose[x].cantidad + 1;
        encontro = 1;
        break;
      }
    }
    if(encontro == 0){
      $scope.productose.push({'id':id,'nombre':nombre,'precio':precio,'cantidad':1});
    }

  }

  $scope.vender = function(){
    var emp = $scope.datosSesion.id;
    var cli = $scope.venta.clienteid;
    if($scope.productose.length <= 0){
      console.log("No hay productos");
    }else{
      var tot = 0;
      for (var i = 0; i < $scope.productose.length; i++) {
        tot = tot + (parseFloat($scope.productose[i].precio) * $scope.productose[i].cantidad);
      }
      console.log(tot);
      $http.post('models/data.php',{op:5, productos: $scope.productose, empleado: emp, cliente:cli,total: tot }).success(function(res){
        $scope.resultado = res;
        $scope.productose = [];
      });
    }
  }

  $scope.buscarEmpleados = function(){
    var palabra = $scope.palabraEmpleado;
    cadena = "SELECT * FROM Empleado WHERE nombre LIKE '%"+palabra+"%' or correo LIKE '%"+palabra+"%' or direccion LIKE '%"+palabra+"%' or telefono LIKE '%"+palabra+"%' or estado LIKE '%"+palabra+"%'";
    //console.log(cadena);
    $http.post('models/data.php',{op:1,consulta: cadena}).success(function(res){
      $scope.empleados = res;
      //console.log(res);
    });
  }

  $scope.mostrarClientes = function(){
    $(".ocultable").hide();
    $("#resultadosClientes").show();
  }

  $scope.mostrarProductos = function(){
    $(".ocultable").hide();
    $("#resultadosProductos").show();
  }
  $scope.buscarClientes = function(){
    var palabra = $scope.palabraCliente;
    cadena = "SELECT * FROM Cliente WHERE nombre LIKE '%"+palabra+"%' or correo LIKE '%"+palabra+"%' or direccion LIKE '%"+palabra+"%' or telefono LIKE '%"+palabra+"%'";
    //console.log(cadena);
    $http.post('models/data.php',{op:1,consulta: cadena}).success(function(res){
      $scope.clientes = res;
      //console.log(res);
    });
  }

  $scope.buscarProducto = function(){
    var palabra = $scope.palabraProducto;
    cadena = "SELECT * FROM Articulo WHERE nombre LIKE '%"+palabra+"%'  or descripcion LIKE '%"+palabra+"%' or precio LIKE '%"+palabra+"%'";
    //console.log(cadena);
    $http.post('models/data.php',{op:1,consulta: cadena}).success(function(res){
      $scope.productos = res;
      //console.log(res);
    });
  }



  $scope.agregarEmpleado = function(){
    cadena = "INSERT INTO Empleado VALUES (null,'"+
              $scope.emp.nombre+"','"+
              $scope.emp.direccion+"','"+
              $scope.emp.email+"','"+
              $scope.emp.sexo+"','"+
              $scope.emp.telefono+"','"+
              $scope.emp.password+"',"+
              "now()"+",'"+
              "Activo"+"','"+
              "Administrador"+"')";
              //console.log(cadena);
    $http.post('models/data.php',{op:2,consulta: cadena}).success(function(res){
      $scope.resultado = res;
      //console.log(res);
    });
  }

  $scope.agregarCliente = function(){
    cadena = "INSERT INTO Cliente VALUES (null,'"+
              $scope.cli.nombre+"','"+
              $scope.cli.direccion+"','"+
              $scope.cli.email+"','"+
              $scope.cli.sexo+"','"+
              $scope.cli.telefono+"',"+
              "now())";
        //      console.log(cadena);
    $http.post('models/data.php',{op:2,consulta: cadena}).success(function(res){
      $scope.resultado = res;
      //console.log(res);
    });
  }

  $scope.agregarProducto = function(){
    cadena = "INSERT INTO Articulo VALUES (null,'"+
              $scope.prod.nombre+"','"+
              $scope.prod.descripcion+"','"+
              $scope.prod.precio+"','"+
              $scope.prod.cantidad+"')";
              console.log(cadena);
    $http.post('models/data.php',{op:2,consulta: cadena}).success(function(res){
      $scope.resultado = res;
      console.log(res);
    });
  }

  $scope.eliminarEmpleado = function(id,tr){
    cadena = "DELETE FROM Empleado WHERE id='"+id+"'";
    if(confirm("Esta seguro de eliminar este Empleado?")){
      $http.post('models/data.php',{op:3,consulta: cadena}).success(function(res){
        $scope.resultado = res;
        //console.log(res);
      });
    }
  }

  $scope.eliminarCliente = function(id,tr){
    cadena = "DELETE FROM Cliente WHERE id='"+id+"'";
    if(confirm("Esta seguro de eliminar este Cliente?")){
      $http.post('models/data.php',{op:3,consulta: cadena}).success(function(res){
        $scope.resultado = res;
        //console.log(res);
      });
    }

  }

  $scope.eliminarProducto = function(id,tr){
    cadena = "DELETE FROM Articulo WHERE id='"+id+"'";
    if(confirm("Esta seguro de eliminar este Articulo?")){
      $http.post('models/data.php',{op:3,consulta: cadena}).success(function(res){
        $scope.resultado = res;
        //console.log(res);
      });
    }

  }

  $scope.obtenerModificarEmpleado = function(id){
    idEmpMod = id;
    cadena = "SELECT * FROM Empleado WHERE id = '"+idEmpMod+"'";
    console.log(cadena);
    $http.post('models/data.php',{op:1,consulta: cadena}).success(function(res){
      $scope.datosEmp = res;
      $scope.editEmp.nombre = $scope.datosEmp[0].nombre;
      $scope.editEmp.email = $scope.datosEmp[0].correo;
      $scope.editEmp.sexo = $scope.datosEmp[0].sexo;
      $scope.editEmp.telefono = $scope.datosEmp[0].telefono;
      $scope.editEmp.password = $scope.datosEmp[0].password;
      $scope.editEmp.direccion = $scope.datosEmp[0].direccion;
      console.log(res);
    });
  }

  $scope.obtenerModificarCliente = function(id){
    idCliMod = id;
    cadena = "SELECT * FROM Cliente WHERE id = '"+idCliMod+"'";
    //console.log(cadena);
    $http.post('models/data.php',{op:1,consulta: cadena}).success(function(res){
      $scope.datosCli = res;
      $scope.editCli.nombre = $scope.datosCli[0].nombre;
      $scope.editCli.email = $scope.datosCli[0].correo;
      $scope.editCli.sexo = $scope.datosCli[0].sexo;
      $scope.editCli.telefono = $scope.datosCli[0].telefono;
      $scope.editCli.direccion = $scope.datosCli[0].direccion;
      //console.log(res);
    });
  }

  $scope.obtenerModificarProducto = function(id){
    idProdMod = id;
    cadena = "SELECT * FROM Articulo WHERE id = '"+idProdMod+"'";
    //console.log(cadena);
    $http.post('models/data.php',{op:1,consulta: cadena}).success(function(res){
      $scope.datosProd = res;
      $scope.editProd.nombre = $scope.datosProd[0].nombre;
      $scope.editProd.descripcion = $scope.datosProd[0].descripcion;
      $scope.editProd.precio = $scope.datosProd[0].precio;
      $scope.editProd.cantidad = $scope.datosProd[0].cantidad;
      //console.log(res);
    });
  }

  $scope.editarEmpleado = function(){
    if(!$scope.editEmp){
      $scope.resultado.mensaje = "No hay cambios que guardar";
    }else {
      if(!$scope.editEmp.nombre){
        $scope.editEmp.nombre = $scope.datosEmp[0].nombre;
      }

      if(!$scope.editEmp.direccion){
        $scope.editEmp.direccion = $scope.datosEmp[0].direccion;
      }

      if(!$scope.editEmp.email){
        $scope.editEmp.email = $scope.datosEmp[0].correo;
      }

      if(!$scope.editEmp.sexo){
        $scope.editEmp.sexo = $scope.datosEmp[0].sexo;
      }

      if(!$scope.editEmp.telefono){
        $scope.editEmp.telefono = $scope.datosEmp[0].telefono;
      }
      if(!$scope.editEmp.password){
        $scope.editEmp.password = $scope.datosEmp[0].password;
      }

      cadena = "UPDATE Empleado set nombre = '"+
                $scope.editEmp.nombre+"', direccion = '"+
                $scope.editEmp.direccion+"',correo = '"+
                $scope.editEmp.email+"',sexo = '"+
                $scope.editEmp.sexo+"',telefono = '"+
                $scope.editEmp.telefono+"',password = '"+
                $scope.editEmp.password+"' WHERE id = '"+idEmpMod+"' ";
                console.log(cadena);
      $http.post('models/data.php',{op:4,consulta: cadena}).success(function(res){
        $scope.resultado = res;
        console.log(res);
      });
    }



  }

  $scope.editarCliente = function(){
    if(!$scope.editCli){
      $scope.resultado.mensaje = "No hay cambios que guardar";
    }else {
      if(!$scope.editCli.nombre){
        $scope.editCli.nombre = $scope.datosCli[0].nombre;
      }

      if(!$scope.editCli.direccion){
        $scope.editCli.direccion = $scope.datosCli[0].direccion;
      }

      if(!$scope.editCli.email){
        $scope.editCli.email = $scope.datosCli[0].correo;
      }

      if(!$scope.editCli.sexo){
        $scope.editCli.sexo = $scope.datosCli[0].sexo;
      }

      if(!$scope.editCli.telefono){
        $scope.editCli.telefono = $scope.datosCli[0].telefono;
      }


      cadena = "UPDATE Cliente set nombre = '"+
                $scope.editCli.nombre+"', direccion = '"+
                $scope.editCli.direccion+"',correo = '"+
                $scope.editCli.email+"',sexo = '"+
                $scope.editCli.sexo+"',telefono = '"+
                $scope.editCli.telefono+"' WHERE id = '"+idCliMod+"' ";
                //console.log(cadena);
      $http.post('models/data.php',{op:4,consulta: cadena}).success(function(res){
        $scope.resultado = res;
        //console.log(res);
      });
    }
  }

  $scope.editarProducto = function(){
    if(!$scope.editProd){
      $scope.resultado.mensaje = "No hay cambios que guardar";
    }else {
      if(!$scope.editProd.nombre){
        $scope.editProd.nombre = $scope.datosProd[0].nombre;
      }

      if(!$scope.editProd.descripcion){
        $scope.editProd.descripcion = $scope.datosProd[0].descripcion;
      }

      if(!$scope.editProd.precio){
        $scope.editProd.precio = $scope.datosProd[0].precio;
      }

      if(!$scope.editProd.cantidad){
        $scope.editProd.cantidad = $scope.datosProd[0].cantidad;
      }

      cadena = "UPDATE Articulo set nombre = '"+
                $scope.editProd.nombre+"', descripcion = '"+
                $scope.editProd.descripcion+"',precio = '"+
                $scope.editProd.precio+"',cantidad = '"+
                $scope.editProd.cantidad+"' WHERE id = '"+idProdMod+"' ";
                //console.log(cadena);
      $http.post('models/data.php',{op:4,consulta: cadena}).success(function(res){
        $scope.resultado = res;
        //console.log(res);
      });
    }
  }

  $scope.cerrarSesion = function(){
    $http.post('models/seguridad.php',{op:3}).success(function(res){
      alert("Sesion cerrada");
      window.location.href = 'login.php';
    });
  };

  $scope.mostrarVentas = function() {
    $(".ocultable").hide();
    $("#verVentas").show();
    cadena = "SELECT * FROM Venta order by id desc";
    //console.log(cadena);
    $http.post('models/data.php',{op:1,consulta: cadena}).success(function(res){
      $scope.ventas = res;
      console.log(res);
    });
  }

});
