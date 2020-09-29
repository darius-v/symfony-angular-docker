var app = angular.module('app', []);

app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('//');
    $interpolateProvider.endSymbol('//');
});

app.controller('RecordsController', ['$scope', function($scope) {

    $scope.records = {0 : 'a'};
    console.log('r');

}]);

