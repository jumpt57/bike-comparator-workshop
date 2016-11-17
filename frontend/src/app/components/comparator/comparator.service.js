function ComparatorService($resource) {
    return $resource('./assets/json/manufacturers.json', {}, {
        query: {
            method: 'GET',
            isArray: true
        }
    });
}
comparatorModule.factory('Comparator',
    [
        '$resource',
        ComparatorService
    ]
);