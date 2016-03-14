angular.module('app.controllers')
    .controller('ClientNewController', ['$scope', '$location','Client', function($scope,$location, Client){
        $scope.clients = new Client();

        $scope.save = function(){
            if( $scope.form.$valid){
                $scope.clients.$save().then( function(){
                    $location.path('/clients');
                });
            };
        }
    }]);