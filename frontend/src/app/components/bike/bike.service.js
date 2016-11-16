function BikeService($resource) {
    return $resource('./assets/json/:name.json', {}, {
        query: {
            method: 'GET',
            isArray: false
        }
    });
}
bikeModule.factory('Bike',
    [
        '$resource',
        BikeService
    ]
);