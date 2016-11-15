function ManufacturersService($resource) {
    return $resource('./assets/json/manufacturers.json', {}, {
        query: {
            method: 'GET',
            isArray: true
        }
    });
}
manufacturersModule.factory('Manufacturers',
    [
        '$resource',
        ManufacturersService
    ]
);