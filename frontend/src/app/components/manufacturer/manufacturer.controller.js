function ManufacturerController($scope, $routeParams, Manufacturer){
    Manufacturer.query({name: $routeParams.name}, function(data){
        $scope.manufacturer = data;
    });
}
manufacturerModule.controller('manufacturerController',
    [
        '$scope',
        '$routeParams',
        'Manufacturer',
        ManufacturerController
    ]
);