
var app = angular.module('registerApp', []);
app.directive('pwCheck', [function () {
    return {
      require: 'ngModel',
      link: function (scope, elem, attrs, ctrl) {
        var pw1 = '#' + attrs.pwCheck;      
        elem.add(pw1).on('keyup', function () {
          scope.$apply(function () {
            var v = elem.val()===$(pw1).val();
            ctrl.$setValidity('pwmatch', v);
          });
        });
      }
    }
  }]);

var INTEGER_REGEXP = /^\-?\d+$/;
app.directive('integer', function() {
  return {
    require: 'ngModel',
    link: function(scope, elm, attrs, ctrl) {
      ctrl.$validators.integer = function(modelValue, viewValue) {
        if (ctrl.$isEmpty(modelValue)) {
          // consider empty models to be valid
          return true;
        }

        if (INTEGER_REGEXP.test(viewValue)) {
          // it is valid
          return true;
        }

        // it is invalid
        return false;
      };
    }
  };
});

app.controller('registerCtrl', function($scope, $http, $log)  {	

	var get_countries = function() {				
		$http({
			method : 'POST',
			url : 'get_countries.php'		
		}).then(
			function success(response) {
				$scope.countries = response.data.records;
			},
			function error(response) {
				$scope.countries = response.statusText;
			}	
		); 
	}
	
	$scope.get_states = function(code){
		$http({
			method : 'POST',
			params: {country_code:code},
			url : 'get_states.php/'		
		}).then(
			function success(response) {
				$scope.states = response.data.records;
			},
			function error(response){
				$scope.states = response.statusText;
			}	
		); 
		
	}
	
	$scope.submitForm = function(reg_form) {
	
		// Trigger validation flag.
		$scope.submitted = true;
		
		// If form is invalid, return and let AngularJS show validation errors.
		if (reg_form.$invalid) {
			return;
		}
		
		var qualification = '';
		for(var i in $scope.selection ){			
			qualification += $scope.selection[i];	
			if( i != $scope.selection.length-1 ){
				qualification += ',';
			}
		}		
		
		var formData = {
			username: $scope.username,
			firstname: $scope.firstname,
			lastname: $scope.lastname,
			email: $scope.email,
			password: $scope.password,
			gender: $scope.gender,
			education: qualification,
			phone_number: $scope.phone_number,
			address: $scope.address,
			country: $scope.country,
			state: $scope.state,
			zipcode: $scope.zipcode
		};
	
		$http({
			method : 'POST',
			params:{formData:formData},
			url : 'create_account.php'		
		
		}).then(
			function success(response) {
				console.log(response);
				if (response.data == 'success') {
					
					$scope.submitted = false;
					$scope.messages = 'You have successfully registered yourself. Please login now';

					$scope.username = null;
					$scope.firstname = null;
					$scope.lastname = null;
					$scope.email = null;
					$scope.password = null;
					$scope.gender = null;
					$scope.education = null;
					$scope.phone_number = null;
					$scope.address = null;
					$scope.country = null;
					$scope.state = null;
					$scope.zipcode = null;
				} else {
					$scope.messages = 'Oops, we received your request, but there was an error processing it.';
					$log.error(response);
				}
			},
			function error(response) {
				console.log(response);				
				$scope.messages = 'There was a network error. Try again later.';
				$log.error(response);
			}	
		); 
		
    }
	
	get_countries();		
	
    $scope.choices = [{"id":1, "value":"primary", "label":"10th std."},
						{"id":2, "value":"secondary","label":"12th std."},
						{"id":3, "value":"graduation","label":"Graduation"},
						{"id":3, "value":"post-graduation","label":"Post Graduation"}];
	
	$scope.choicesCount = 0;
	$scope.countCheck = function(choices){
		if(choices.checked){
			$scope.choicesCount--;//opposite
		}else{
			$scope.choicesCount++;			
		}
	};
	
		
	$scope.selection=[];
	// toggle selection for a given employee by name
	$scope.toggleSelection = function toggleSelection(qual) {
	var idx = $scope.selection.indexOf(qual);

	// is currently selected
	if (idx > -1) {
	  $scope.selection.splice(idx, 1);
	}

	// is newly selected
	else {
	  $scope.selection.push(qual);
	}
  };
	
});


