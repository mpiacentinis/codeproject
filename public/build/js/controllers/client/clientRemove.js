angular.module('app.controllers')
    .controller('ClientRemoveController',
    ['$scope', '$location','$routeParams','Client',
        function($scope,$location,$routeParams,Client){
            $scope.clients = Client.get({id: $routeParams.id});

            $scope.remove = function() {

                console.log($scope.clients.data.client_id);

/*                $scope.clients.$delete( ).then( function(){
                    $location.path('/clients');
                })*/
            }
        }]);
