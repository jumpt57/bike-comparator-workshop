function BikeController($scope, $routeParams, Bike){
    $scope.message = 'test';
    $scope.manufacturer = $routeParams.name.split(' ')[0].toLowerCase();
    Bike.query({name: $scope.manufacturer}, function(data){
        data.bikes.forEach(function(bike) {
            if(bike.name == $routeParams.name){
                $scope.bike = bike;
            }
        }, this);
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