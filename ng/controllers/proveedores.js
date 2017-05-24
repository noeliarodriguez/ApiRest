app.controller('proveedorController',function($scope,$http,API_URL){
	$http.get(API_URL + 'proveedor')
		.then(function(response){
			$scope.proveedores = response;
			console.log($scope.proveedores);
		});

	$scope.toggle = function(formState,id){
		$scope.formState = formState;
		switch(formState){
			case 'add':
				$scope.formTitle = "Agregar Nuevo Proveedor";
				break;
			case 'edit':
				$scope.formTitle = "Editar Proveedor";
				$scope.id = id;
				$http.get(API_URL + 'proveedor/'+ id)
					.then(function(response){
						console.log(response);
						$scope.proveedor = response;
					});
					break;
			default:
				break;
		}
		console.log(id);
		//Aca iria lo de modal show
	}


	$scope.save = function(formState, id) {
        var url = API_URL + "proveedor";
        
        if (formState === 'edit'){
            url += "/" + id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.proveedor),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            console.log(response);
            location.reload();
        }).catch(function(response) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }

    $scope.confirmDelete = function(id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: API_URL + 'proveedor/' + id
            })
                    .then(function(data) {
                        console.log(data);
                        location.reload();
                    })
                    .catch(function(data) {
                        console.log(data);
                        alert('Unable to delete');
                    });
        } else {
            return false;
        }
    }
});