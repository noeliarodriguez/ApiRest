// define application
var apiURL = "http://localhost:8080/ApiRest/ci/";
var app = angular.module("crudRubro", ['ui.mask']);
app.controller("rubroController", function($scope,$http){
    $scope.marcas = [];
    $scope.tempMarcaData = {};
    $scope.marcaSelected = {};
    $scope.config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}};
    $scope.estados = "";

    //TRAE LISTADO DE PROVEEDORES
    $scope.getRecords = function(){
        $http.get(apiURL+"marca")
            .then(function(response){
                $scope.marcas = response.data.resp;
                $scope.getEstados();
            })
            .catch(function(response){
                console.log(response);
            });
    };

    $scope.getEstados = function(){
        $http.get(apiURL+"estado")
            .then(function(response){
                $scope.estados = response.data.resp;
            })
            .catch(function(response){
                console.log(response);
            });
    };

    //____ ACCIONES ___ //
    $scope.saveMarca = function(type,MarcaForm){
        if(rubroForm.DescMarca.$valid)
        {
            var marca = $.param({
                'marca':$scope.tempMarcaData,
                'type':type
            });
            $http.post(apiURL+"rubro", rubro, $scope.config)
                .then(function(response){
                    if(type == 'edit'){
                        $scope.marcas[$scope.index].Id = $scope.tempMarcaData.Id;
                        $scope.marcas[$scope.index].Nombre = $scope.tempMarcaData.Nombre;
                        $scope.marcas[$scope.index].Id_Estado = $scope.tempMarcaData.Id_Estado;

                    }else{
                        $scope.marcas.push({
                            Id:response.data.resp.Id,
                            Nombre:response.data.resp.Nombre,
                            Id_Estado:response.data.resp.Id_Estado
                        });

                    }
                    MarcaForm.$setPristine();
                    $scope.tempMarcaData = {};
                    formUp.slideUp();
                    if(response.data.status == "OK")
                        $scope.messageSuccess(response.data.resp);
                    else
                    {
                        $scope.messageError(response.data.resp);
                        console.log(response.data);
                    }
                    $scope.getRecords();
                })
                .catch(function(response){
                    $scope.messageError(response);
                    $scope.getRecords();
                });
        }
    };

    $scope.addMarca = function(MarcaForm){
        $scope.saveMarca('add',MarcaForm);
    };

    $scope.updateRubro = function(MarcaForm){
        $scope.saveMarca('edit',MarcaForm);
    };
    $scope.editProv = function(marca){
        $scope.tempRubroData = {
            Id:marca.Id,
            Descripcion:marca.Nombre,
            Id_Estado:marca.Id_Estado
        };

        $scope.index = $scope.marcas.indexOf(rubro);
        formUp.slideDown();
    };


    $scope.deleteProv = function(marca){
        $scope.marcaSelected = marca;

        $("#modalConfirma").modal('show');
    };

    //__________________JQUERY
    var formUp = $('.formData');

    var resetForm = $('#resetForm');
    var formulario = $scope.MarcaForm;
    $scope.messageSuccess = function(msg){
        var alertSuccess = $('.alert-success');
        $('.alert-success > p').html(msg);
        alertSuccess.show();
        alertSuccess.delay(5000).slideUp(function(){
            $('.alert-success > p').html('');
        });
    };

    $scope.messageError = function(msg){
        var alertDanger = $('.alert-danger');
        $('.alert-danger > p').html(msg);
        alertDanger.show();
        alertDanger.delay(5000).slideUp(function(){
            $('.alert-danger > p').html('');
        });
    };

    $scope.slideToggle = function(){
        formUp.slideToggle();
    };
    $scope.resetForm = function(MarcaForm){
        $('input').val('').removeAttr('checked').removeAttr('selected');
        $('select').selected = 2;
        formUp.slideUp();
        $scope.tempMarcaData = {};
        MarcaForm.$setPristine();
        MarcaForm.$setUntouched();
    };


});