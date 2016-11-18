function ManufacturersController($scope, Manufacturers) {

    Manufacturers.query(function(data) {
        $scope.manufacturers = data.manufactures;
    });
}
manufacturersModule.controller('manufacturersController',
    [
        '$scope',
        'Manufacturers',
        ManufacturersController
    ]
);