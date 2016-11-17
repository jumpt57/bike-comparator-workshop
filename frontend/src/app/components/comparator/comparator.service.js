function ComparatorService($resource) {
    return $resource('http://comparateur.anarkhief.fr/web/index.php/manufacturers', {}, {
        queryAll: {
            method: 'GET',
            isArray: false
        }, 
        queryOneById: {
            method: 'GET',
            isArray: false,
            url: 'http://comparateur.anarkhief.fr/web/index.php/manufacturer/:id'
        },
        queryBikes: {
            method: 'GET',
            isArray: false,
            url: 'http://comparateur.anarkhief.fr/web/index.php/manufacturer/:id/bike?year=:year'
        },
        queryBikeById: {
            method: 'GET',
            isArray: false,
            url: 'http://comparateur.anarkhief.fr/web/index.php/bike/:id'
        }
        
    });
}
comparatorModule.factory('Comparator',
    [
        '$resource',
        ComparatorService
    ]
);