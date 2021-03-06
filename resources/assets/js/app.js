var app = angular.module('app',['ngRoute','angular-oauth2','app.controllers','app.services']);

angular.module('app.controllers',['ngMessages','angular-oauth2']);

angular.module('app.services',['ngResource']);

app.provider('appConfig', function(){
   var config = {
       baseUrl: 'http://localhost:8000'
   };
    return {
        config: config,
        $get: function(){
            return config;
        }
    }
});

app.config( [
    '$routeProvider','OAuthProvider','OAuthTokenProvider','appConfigProvider',
    function( $routeProvider,OAuthProvider,OAuthTokenProvider,appConfigProvider ){
    $routeProvider
        .when('/login',{
            templateUrl: 'build/views/login.html',
            controller: 'LoginController'})
        .when('/home', {
            templateUrl: 'build/views/home.html',
            controller: 'HomeController'})
        .when('/clients', {
            templateUrl: 'build/views/client/clientList.html',
            controller: 'ClientListController'})

        .when('/clients/new', {
            templateUrl: 'build/views/client/clientNew.html',
            controller: 'ClientNewController'})

        .when('/clients/:id/edit', {
            templateUrl: 'build/views/client/clientEdit.html',
            controller: 'ClientEditController'})

        .when('/clients/:id/remove', {
            templateUrl: 'build/views/client/clientRemove.html',
            controller: 'ClientRemoveController'});


        OAuthProvider.configure({
        baseUrl: appConfigProvider.config.baseUrl,
        clientId: 'codeproject',
        clientSecret: 'secret',
        grantPath: 'oauth/access_token'
    });

    OAuthTokenProvider.configure({
        name: 'token',
        options: {
            secure: false
        }
    });

}]);

app.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth) {
    $rootScope.$on('oauth:error', function(event, rejection) {
        // Ignore `invalid_grant` error - should be catched on `LoginController`.
        if ('invalid_grant' === rejection.data.error) {
            return;
        }

        // Refresh token when a `invalid_token` error occurs.
        if ('invalid_token' === rejection.data.error) {
            return OAuth.getRefreshToken();
        }

        // Redirect to `/login` with the `error_reason`.
        return $window.location.href = '/login?error_reason=' + rejection.data.error;
    });
}]);
