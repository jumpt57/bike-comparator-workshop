function BikeController($scope, $routeParams, Bike){
    var nameManu = $routeParams.name.split(' ')[0].toLowerCase();
    Bike.query({name: nameManu}, function(data){
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