// define application
var apiURL = "http://localhost:8080/ApiRest/ci/";
var app = angular.module("crudApp", ['ui.mask']);
app.controller("prodController", function($scope,$http){
    $scope.productos = [];
    $scope.tempProductoData = {};
    $scope.produSelected = {};
    $scope.config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}};


    var regexp = "[A-Z_a-z]";
    $scope.validarCuit = function(cuit){
        return regexp.test(cuit);
    };


    // DATOS //_____________________________
    $scope.getDatos = function(){
        $scope.getProvincias();
        $scope.getIvas();
        $scope.getCatGanancias();
        $scope.getRubros();
    };

    $scope.getRubros = function(){
        $http.get(apiURL+"rubro")
            .then(function(response){
                $scope.rubros = response.data.resp;
            })
    };
    $scope.getIvas = function(){
        $http.get(apiURL+"iva")
            .then(function(response){
                $scope.ivas = response.data.resp;
            })
    };


    //TRAE LISTADO DE PROVEEDORES
    $scope.getRecords = function(){
        $http.get(apiURL+"producto")
            .then(function(response){
                $scope.productos = response.data.resp;
            })
            .catch(function(response){
                //console.log(response);
            });
    };

    //____ ACCIONES ___ //
    $scope.saveProv = function(type,provForm){
        if(provForm.Razon_Social.$valid && provForm.Cuit.$valid && provForm.Email.$valid)
        {
            var proveedor = $.param({
                'proveedor':$scope.tempProvData,
                'type':type
            });
            $http.post(apiURL+"proveedor", proveedor, $scope.config)
                .then(function(response){
                    if(type == 'edit'){
                        $scope.provs[$scope.index].Id = $scope.tempProvData.Id;
                        $scope.provs[$scope.index].Razon_Social = $scope.tempProvData.Razon_Social;
                        $scope.provs[$scope.index].Cuit = $scope.tempProvData.Cuit;
                        $scope.provs[$scope.index].Domicilio = $scope.tempProvData.Domicilio;
                        $scope.provs[$scope.index].Localidad = $scope.tempProvData.Localidad;
                        $scope.provs[$scope.index].Email = $scope.tempProvData.Email;
                        $scope.provs[$scope.index].Codigo_Postal = $scope.tempProvData.Codigo_Postal;
                        $scope.provs[$scope.index].Telefono = $scope.tempProvData.Telefono;
                        $scope.provs[$scope.index].Celular = $scope.tempProvData.Celular;
                        $scope.provs[$scope.index].Fax = $scope.tempProvData.Fax;
                        $scope.provs[$scope.index].Pagina_Web = $scope.tempProvData.Pagina_Web;
                        $scope.provs[$scope.index].Observaciones = $scope.tempProvData.Observaciones;
                        $scope.provs[$scope.index].Id_Provincia = $scope.tempProvData.Id_Provincia;
                        $scope.provs[$scope.index].Id_Pais = $scope.tempProvData.Id_Pais;
                        $scope.provs[$scope.index].Barrio = $scope.tempProvData.Barrio;
                        $scope.provs[$scope.index].Id_Rubro = $scope.tempProvData.Id_Rubro;
                        $scope.provs[$scope.index].Nro_Ing_Brutos = $scope.tempProvData.Nro_Ing_Brutos;
                        $scope.provs[$scope.index].Agente_Retencion = $scope.tempProvData.Agente_Retencion;
                        $scope.provs[$scope.index].Id_Iva = $scope.tempProvData.Id_Iva;
                        $scope.provs[$scope.index].Id_Cat_Ing_Br = $scope.tempProvData.Id_Cat_Ing_Br;
                        $scope.provs[$scope.index].Id_Cat_Ganancia = $scope.tempProvData.Id_Cat_Ganancia;

                    }else{
                        $scope.provs.push({
                            Id:response.data.resp.Id,
                            Razon_Social:response.data.resp.Razon_Social,
                            Cuit:response.data.resp.Cuit,
                            Domicilio:response.data.resp.Domicilio,
                            Localidad:response.data.resp.Localidad,
                            Codigo_Postal:response.data.resp.Codigo_Postal,
                            Email:response.data.resp.Email,
                            Telefono:response.data.resp.Telefono,
                            Celular:response.data.resp.Celular,
                            Fax:response.data.resp.Fax,
                            Pagina_Web:response.data.resp.Pagina_Web,
                            Observaciones:response.data.resp.Observaciones,
                            Id_Provincia:response.data.resp.Id_Provincia,
                            Id_Pais:response.data.resp.Id_Pais,
                            Barrio:response.data.resp.Barrio,
                            Id_Rubro:response.data.resp.Id_Rubro,
                            Nro_Ing_Brutos:response.data.resp.Nro_Ing_Brutos,
                            Id_Iva:response.data.resp.Id_Iva,
                            Id_Cat_Ing_Br:response.data.resp.Id_Cat_Ing_Br,
                            Id_Cat_Ganancia:response.data.resp.Id_Cat_Ganancia,
                            Agente_Retencion:response.data.resp.Agente_Retencion

                        });

                    }

                    provForm.$setPristine();
                    $scope.tempProvData = {};
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

    $scope.addProv = function(provForm){
        $scope.saveProv('add',provForm);
    };

    $scope.updateProv = function(provForm){
        $scope.saveProv('edit',provForm);
    };
    $scope.editProv = function(prov){
        $scope.tempProvData = {
            Id:prov.Id,
            Razon_Social:prov.Razon_Social,
            Cuit:prov.Cuit,
            Email:prov.Email,
            Domicilio:prov.Domicilio,
            Codigo_Postal:prov.Codigo_Postal,
            Localidad:prov.Localidad,
            Telefono:prov.Telefono,
            Celular:prov.Celular,
            Fax:prov.Fax,
            Pagina_Web:prov.Pagina_Web,
            Observaciones:prov.Observaciones,
            Nro_Ing_Brutos:prov.Nro_Ing_Brutos,
            Barrio:prov.Barrio,
            Id_Provincia:prov.Id_Provincia,
            Id_Iva:prov.Id_Iva,
            Id_Cat_Ing_Br:prov.Id_Cat_Ing_Br,
            Id_Cat_Ganancia:prov.Id_Cat_Ganancia,
            Id_Rubro:prov.Id_Rubro,
            Agente_Retencion:prov.Agente_Retencion
        };
        //Capturo el indice del elemento que seleccione del array provs

        $scope.index = $scope.provs.indexOf(prov);
        formUp.slideDown();

        $scope.checkearProvi();
    };


    $scope.deleteProv = function(prov){
        $scope.provSelected = prov;

        $("#modalConfirma").modal('show');
    };

    //__________________JQUERY
    var formUp = $('.formData');

    var resetForm = $('#resetForm');
    var formulario = $scope.provForm;
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
    $scope.resetForm = function(provForm){
        $('input').val('').removeAttr('checked').removeAttr('selected');
        $('#barrio').removeAttr('disabled');
        formUp.slideUp();
        $scope.tempProvData = {};
        provForm.$setPristine();
        provForm.$setUntouched();
    };



    // ACCION CON JQUERY
    $("#acceptD").on('click',function(){
        var proveedor = $.param({
            'Id': $scope.provSelected.Id,
            'type':'delete'
        });

        $http.post(apiURL+"proveedor",proveedor,$scope.config)
            .then(function(response){

                $("#modalConfirma").modal('hide');

                //var index = $scope.provs.indexOf($scope.provSelected);
                //$scope.provs.splice(index,1); //Borra del array

                $scope.messageSuccess(response.data.resp);
                $scope.provSelected = {};
                $scope.getRecords();
            })
            .catch(function(response){
                $("#modalConfirma").modal('hide');
                $scope.messageError(response.data.resp);
                $scope.provSelected = {};

                $scope.getRecords();

            });
        formUp.slideUp();
    });


});