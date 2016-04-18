angular.module('app.services')
    .factory('Client',
    ['$resource', 'appConfig',
        function ($resource, appConfig) {
            return $resource(appConfig.baseUrl + '/clients/:id', {id: '@id'},
                {
                    query:  { isArray: false},
                    update: { method: 'PUT'}
                }
            );
        }]);