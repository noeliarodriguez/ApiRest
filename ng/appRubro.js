// define application
var apiURL = "http://localhost:8080/ApiRest/ci/";
var app = angular.module("crudRubro", ['ui.mask']);
app.controller("rubroController", function($scope,$http){
    $scope.rubros = [];
    $scope.tempRubroData = {};
    $scope.rubroSelected = {};
    $scope.config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}};
    $scope.estados = "";

    //TRAE LISTADO DE PROVEEDORES
    $scope.getRecords = function(){
        $http.get(apiURL+"rubro")
            .then(function(response){
                $scope.rubros = response.data.resp;
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
    $scope.saveRubro = function(type,rubroForm){
        if(rubroForm.DescRubro.$valid)
        {
            var rubro = $.param({
                'rubro':$scope.tempRubroData,
                'type':type
            });
            $http.post(apiURL+"rubro", rubro, $scope.config)
                .then(function(response){
                    if(type == 'edit'){
                        $scope.rubros[$scope.index].Id = $scope.tempRubroData.Id;
                        $scope.rubros[$scope.index].Descripcion = $scope.tempRubroData.Descripcion;
                        $scope.rubros[$scope.index].Estado = $scope.tempRubroData.Estado;

                    }else{
                        $scope.rubros.push({
                            Id:response.data.resp.Id,
                            Descripcion:response.data.resp.Descripcion,
                            Estado:response.data.resp.Estado
                        });

                    }
                    rubroForm.$setPristine();
                    $scope.tempRubroData = {};
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

    $scope.addRubro = function(rubroForm){
        $scope.saveRubro('add',rubroForm);
    };

    $scope.updateRubro = function(rubroForm){
        $scope.saveRubro('edit',rubroForm);
    };
    $scope.editProv = function(rubro){
        $scope.tempRubroData = {
            Id:rubro.Id,
            Descripcion:rubro.Descripcion,
            Id_Estado:rubro.Id_Estado
        };

        $scope.index = $scope.rubros.indexOf(rubro);
        formUp.slideDown();
    };


    $scope.deleteProv = function(rubro){
        $scope.rubroSelected = rubro;

        $("#modalConfirma").modal('show');
    };

    //__________________JQUERY
    var formUp = $('.formData');

    var resetForm = $('#resetForm');
    var formulario = $scope.rubroForm;
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
    $scope.resetForm = function(rubroForm){
        $('input').val('').removeAttr('checked').removeAttr('selected');
        $('select').selected = 2;
        formUp.slideUp();
        $scope.tempRubroData = {};
        rubroForm.$setPristine();
        rubroForm.$setUntouched();
    };


});