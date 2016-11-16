function AppRouter($routeProvider) {
    $routeProvider
        .when('/manufacturers', {
            templateUrl: './app/components/manufacturers/manufacturers.template.html',
            controller: 'manufacturersController'
        })
        .when('/manufacturer/:name', {
            templateUrl: './app/components/manufacturer/manufacturer.template.html',
            controller: 'manufacturerController'
        })
        .when('/bike/:name', {
            templateUrl: './app/components/bike/bike.template.html',
            controller: 'bikeController'
        })
        .otherwise({
            redirectTo: '/manufacturers'
        });
}
bikeApp.config(
    [
        '$routeProvider',
        AppRouter
    ]
);