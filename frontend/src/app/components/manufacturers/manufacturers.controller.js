function ManufacturersController($scope, Manufacturers) {

    Manufacturers.query(function(data) {
        $scope.manufacturers = data;
    });
}
manufacturersModule.controller('manufacturersController',
    [
        '$scope',
        'Manufacturers',
        ManufacturersController
    ]
);