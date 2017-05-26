var provinciasService = angular.module('provinciasService', [])
provinciasService.factory('ProvinciasData', ['$http', function ($http) {
    var apiURL = "http://localhost:8080/ApiRest/ci/";
    var ProvinciasData = {};

    ProvinciasData.getProvincias = function () {
        return $http.get(apiURL+'provincia');
    };

    return ProvinciasData;

}]);