function ManufacturersService($resource) {
    return $resource('http://comparateur.anarkhief.fr/web/index.php/manufacturers', {}, {
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
manufacturersModule.factory('Manufacturers',
    [
        '$resource',
        ManufacturersService
    ]
);