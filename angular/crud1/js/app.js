
var mainApp = angular.module("mainApp", ['ngRoute']);

mainApp.factory("services", ['$http', function($http) {
	var serviceBase = 'http://localhost/gitProjects/angular/crud1/api/action.php'
    var obj = {};
    obj.getStudents = function(student_id){
		if(student_id != '' && student_id != null && typeof student_id != 'undefined')
        return $http.post(serviceBase + '?action=get_students', {id:student_id});
    }

    obj.insertStudent = function (student) {
		return $http.post(serviceBase + '?action=add_student', student).then(function (results) {
			return results;
		});
	};
    obj.updateStudent = function (student) {
		return $http.post(serviceBase + '?action=update_student', student).then(function (results) {
			return results;
		});
	};
    obj.deleteStudent = function (id) {
		return $http.post(serviceBase + '?action=delete_student', {id:id}).then(function (results) {
			return results;
		});
	};

	

    return obj;   
}]);

	mainApp.config(['$routeProvider', function($routeProvider) {
		$routeProvider.
		when('/addStudent', {
		   templateUrl: 'addStudent.htm',
		   controller: 'AddStudentController'
		}).
		when('/viewStudents', {
		   templateUrl: 'viewStudents.htm',
		   controller: 'ViewStudentsController'
		}).
		when('/editStudent/:studentID', {
			title: 'Edit Customers',
			templateUrl: 'editStudent.htm',
			controller: 'EditStudentController',
			resolve: {
				student: function(services, $route){
					var studentID = $route.current.params.studentID;
					return services.getStudents(studentID);
				}
			}
		}).
		when('/deleteStudent/:studentID', {
			title: 'Delete Customers',
			templateUrl: 'viewStudents.htm',
		    controller: 'ViewStudentsController',
			resolve: {
				student: function(services, $route){
					var studentID = $route.current.params.studentID;
					return services.deleteStudent(studentID);
				}
			}
		}).
		otherwise({
		   redirectTo: '/'
		});
	}]);
	
	
	mainApp.controller('AddStudentController', function($scope, services) {
		$scope.addStudent=function(form){	
			$scope.submitted = true;
		
			// If form is invalid, return and let AngularJS show validation errors.
			if (form.$invalid) {
				return;
			}
			var student = {
				'firstname':$scope.firstname,
				'lastname':$scope.lastname,
				'email':$scope.email,
				'password':$scope.password,
				'confirm_password':$scope.confirm_password,
			}
			services.insertStudent(student).then(function (response) {
				console.log(response);
				$scope.messages = response.msg;
				if (response.status == 'success') {
					$scope.submitted = false;
					$scope.firstname = null;
					$scope.lastname = null;
					$scope.email = null;
					$scope.password = null;
				}
			});
		}
	});
		
	 
	mainApp.controller('ViewStudentsController', function($scope,services) {
	    services.getStudents('0').then(function (response) {
			$scope.students = response.data.records;
		});
	});
	
	mainApp.controller('EditStudentController', function($scope, services,  $routeParams,$location, student) {
		var studentID = ($routeParams.studentID) ? parseInt($routeParams.studentID) : 0;
		var original = student.data;
		original._id = studentID;
		$scope.student = angular.copy(original.records[0]);
		$scope.student._id = studentID;
		
		$scope.deleteCustomer = function(student) {
			$location.path('/');
			if(confirm("Are you sure to delete student : "+$scope.student._id)==true)
			services.deleteCustomer(student._id);
		};
		$scope.editStudent=function(formid, user){	
			$scope.submitted = true;
		
			// If form is invalid, return and let AngularJS show validation errors.
			if (formid.$invalid) {
				return;
			}
			var student = {
				'student_id':$scope.student._id,
				'firstname':user.firstname,
				'lastname':user.lastname,
				'email':user.email,
				'password':user.password,
				'confirm_password':user.confirm_password,
			}
			services.updateStudent(student).then(function (response) {
				console.log(response);
				$scope.messages = response.msg;
				if (response.status == 'success') {
					$scope.submitted = false;
					$scope.firstname = null;
					$scope.lastname = null;
					$scope.email = null;
					$scope.password = null;
				}
			});
		}
		
	});
