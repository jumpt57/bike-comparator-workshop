function ManufacturerController($scope, $routeParams, Manufacturer){
    Manufacturer.query({id: $routeParams.id}, function(data){        
        $scope.manufacturer = data.manufactures[0];         
        $scope.manufacturer.bikes = [];
        Manufacturer.queryBikes({id: $scope.manufacturer.id}, function(data){
            $scope.manufacturer.bikes = data.bikes;          
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