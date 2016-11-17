function ManufacturerService($resource) {
    return $resource('http://comparateur.anarkhief.fr/web/index.php/manufacturer/:id', {}, {
        query: {
            method: 'GET',
            isArray: false
        },
        queryBikes: {
            method: 'GET',
            isArray: false,
            url: 'http://comparateur.anarkhief.fr/web/index.php/manufacturer/:id/bike'
        }
    });
}
manufacturerModule.factory('Manufacturer',
    [
        '$resource',
        ManufacturerService
    ]
);