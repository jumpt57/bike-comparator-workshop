function BikeController($scope, $routeParams, Bike){
    $scope.manufacturer = $routeParams.name.split(' ')[0].toLowerCase();
    Bike.query({name: $scope.manufacturer}, function(data){
        data.bikes.forEach(function(bike) {
            if(bike.name == $routeParams.name){
               
                $scope.bike = bike;
               
                /*Bike.queryLBC(
                    {
                        region: 2,
                        query: 'CB1000R ABS',
                        c: 3,
                        ps: 1000,
                        pe: 10000,
                        ms: 5000,
                        me: 50000,
                        rs: 2000,
                        re: 2016,
                        ccs: 600,
                        cce: 1200,
                        city: 'Bordeaux',
                        zipcode: 33000
                    }, 
                    function(dataLBC){
                        console.log(JSON.stringify(dataLBC));
                    }
                );*/
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