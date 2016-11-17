function ManufacturersService($resource) {
    return $resource('http://comparateur.anarkhief.fr/web/index.php/manufacturers', {}, {
        query: {
            method: 'GET',
            isArray: false
        }
    });
}
manufacturersModule.factory('Manufacturers',
    [
        '$resource',
        ManufacturersService
    ]
);