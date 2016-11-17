function ManufacturerController($scope, $routeParams, Manufacturer){
    Manufacturer.query({id: $routeParams.id}, function(data){        
        $scope.manufacturer = data.manufactures[0];         
        $scope.manufacturer.bikes = [];
        Manufacturer.queryBikes({id: $scope.manufacturer.id}, function(data){
            data.bikes.forEach(function(bike) {
                Manufacturer.queryCateg({id: bike.id}, function(data){
                    bike.category = data.bike.category_name;
                    $scope.manufacturer.bikes.push(bike);
                });
            }, this);            
        });
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