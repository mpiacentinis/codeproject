angular.module('app.controllers')
    .controller('ClientEditController',
    ['$scope', '$location','$routeParams','Client',
        function($scope,$location,$routeParams,Client){
        $scope.clients = Client.get({id: $routeParams.id}); //pegando client

            $scope.save = function() {
            if ($scope.form.$valid) {
                Client.update({id: $scope.clients.id}, $scope.clients, function () {
                    $location.path('/clients')
                });
            }
        }
    }]);
