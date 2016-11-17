function BikeController($scope, $routeParams, Bike){
   
    Bike.query({id: $routeParams.id}, function(data){
        $scope.bike = data.bike;
        $scope.manufacturer = $scope.bike.name.split(' ')[0].toLowerCase();
    });
}
bikeModule.controller('bikeController',
    [
        '$scope',
        '$routeParams',
        'Bike',
        BikeController
    ]
);