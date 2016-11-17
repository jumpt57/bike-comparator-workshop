function BikeController($scope, $routeParams, Bike){
   
    Bike.query({id: $routeParams.id}, function(data){
        $scope.bike = data.bike;
        $scope.manufacturer = $scope.bike.name.split(' ')[0].toLowerCase();
        /*Bike.queryLBC({name: $scope.bike.name}, function(data){
            console.log(JSON.parse(data));           
        });*/
    
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