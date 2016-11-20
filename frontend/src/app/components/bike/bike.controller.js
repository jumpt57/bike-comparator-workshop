function BikeController($scope, $routeParams, Bike){
   
    Bike.query({id: $routeParams.id}, function(data){
        $scope.bike = data.bike;
        $scope.bike.ads = [];
        $scope.manufacturer = $scope.bike.name.split(' ')[0].toLowerCase();
        $scope.bikeName = $scope.bike.name.substring(0, $scope.bike.name.length - 4);
        /**Name without year */
        Bike.queryLBC({name: $scope.bikeName, yearmin: $scope.bike.year, yearmax: $scope.bike.year}, function(data){
            data.ads.forEach(function(ad) {
                $scope.bike.ads.push({city: ad.city, zip: ad.zipcode, url: ad.url, price: ad.price});
            }, this);      
        });    
        /**Name with year */
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