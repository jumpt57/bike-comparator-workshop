function BikeService($resource) {
    return $resource('http://comparateur.anarkhief.fr/web/index.php/bike/:id', {}, {
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