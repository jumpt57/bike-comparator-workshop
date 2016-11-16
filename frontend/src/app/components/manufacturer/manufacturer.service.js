function ManufacturerService($resource) {
    return $resource('./assets/json/:name.json', {}, {
        query: {
            method: 'GET',
            isArray: false
        }
    });
}
manufacturerModule.factory('Manufacturer',
    [
        '$resource',
        ManufacturerService
    ]
);