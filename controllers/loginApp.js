'use strict'

var angular_model = angular.module('loginApp', [ ]);

angular_model.controller('loginController',function($scope,$http){
	$scope.mensajes = "";
	$scope.login = "";
	$scope.loguear = function(){
		var user = $scope.usuario.correo;
		var pass = $scope.usuario.pass;
			$scope.mensajes = "";
			console.log(user + " " +pass);
			$http.post('models/seguridad.php',{op:1,correo: user,clave:pass}).success(function(res){
				$scope.login = res;
				console.log(res);
				if($scope.login.hecho == 1){
					window.location.href = 'index.php'
				}

			});
		}
});
