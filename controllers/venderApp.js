'use strict'

var angular_module = angular.module('venderApp',[]);
angular_module.controller('venderController',function($scope,$http){
  $scope.datosSesion = {};
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


  $scope.cerrarSesion = function(){
    $http.post('models/seguridad.php',{op:3}).success(function(res){
      alert("Sesion cerrada");
      window.location.href = 'login.php';
    });
  };
});
