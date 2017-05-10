var app = angular.module('app',['ngRoute','ui.bootstrap']);

app.config(function($routeProvider){
	$routeProvider.when("/",{
		templateUrl:"home.html",
		controller:"homeController"
	})
	.otherwise({redirectTo:"/"});
});

app.controller("homeController",function($scope){
	
});