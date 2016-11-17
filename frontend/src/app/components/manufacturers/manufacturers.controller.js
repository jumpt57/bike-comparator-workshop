function ManufacturersController($scope, Manufacturers) {

    Manufacturers.query(function(data) {        
        $scope.manufacturers = data.manufactures;
        $scope.manufacturers.forEach(function(manufacturer) {
            Manufacturers.queryBikes({id: manufacturer.id}, function(data){
                manufacturer.nbBikes = data.bikes.length;
            });
        }, this);        
    });
}
manufacturersModule.controller('manufacturersController',
    [
        '$scope',
        'Manufacturers',
        ManufacturersController
    ]
);