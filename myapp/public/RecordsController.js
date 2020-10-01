var app = angular.module('app', []);

app.baseUrl = 'http://localhost:8080/';

app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('//');
    $interpolateProvider.endSymbol('//');
});

app.controller('RecordsController', ['$scope', '$http', function($scope, $http) {

    $scope.submit = function () {
        $http.post(app.baseUrl + 'add')
            .then(function(response) {
                $scope.records.push(response.data); // todo
            });
    }

    $http.get(app.baseUrl + 'list')
        .then(function(response) {
            $scope.records = response.data;
        });
}]);

