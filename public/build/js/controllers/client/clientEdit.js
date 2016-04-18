angular.module('app.controllers')
    .controller('ClientEditController',
    ['$scope', '$location','$routeParams','Client',
        function($scope,$location,$routeParams,Client){
        $scope.clients = Client.get({id: $routeParams.id});

            $scope.update = function() {
            if ($scope.form.$valid) {
                Client.update({id: $scope.clients.data.client_id }, $scope.clients.data, function () {
                    $location.path('/clients')
                });
            }
        }
    }]);
