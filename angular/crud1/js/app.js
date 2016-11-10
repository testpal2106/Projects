var app = angular.module('crud1', ['ngRoute']);
app.config(['$routeProvider', function($routeProvider){
	$routeProvider.
	when('/addUser', {
		templateUrl: 'addUser.html',
		controller: 'addUserController'		
	}).
	when('/viewUsers', {	
		templateUrl: 'viewUser.html',
		controller: 'viewUserController'	
	}).
	otherwise('/addUser', {
		templateUrl: 'addUser.html',
		controller: 'addUserController'		
	})
	
}]);

app.controller('AddStudentController', function($scope) {
	$scope.message = "This page will be used to display add student form";
});

app.controller('viewUsersController', function($scope, $http) {
	$http.get("http://localhost/angular/crud1/api/get_users.php")
	.then(function (response) {
		console.log(response);
		$scope.users = response.data.records;
	});
});
