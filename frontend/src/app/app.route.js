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
        .when('/research', {
            templateUrl: './app/components/research/research.template.html',
            controller: 'researchController'
        })
        .when('/comparator', {
            templateUrl: './app/components/comparator/comparator.template.html',
            controller: 'comparatorController'
        })
        .when('/news', {
            templateUrl: './app/components/news/news.template.html',
            controller: 'newsController'
        })
        .otherwise({
            redirectTo: '/news'
        });
}
bikeApp.config(
    [
        '$routeProvider',
        AppRouter
    ]
);