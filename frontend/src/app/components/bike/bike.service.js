function BikeService($resource) {
    return $resource('http://comparateur.anarkhief.fr/web/index.php/bike/:id', {}, {
        query: {
            method: 'GET',
            isArray: false
        },
        queryLBC2: {
            method: 'JSONP',
            url: 'https://mobile.leboncoin.fr/templates/api/list.json?q=:name',
            params: {
                'app_id': 'leboncoin_android',
                'key': 'd2c84cdd525dddd7cbcc0d0a86609982c2c59e22eb01ee4202245b7b187f49f1546e5f027d48b8d130d9aa918b29e991c029f732f4f8930fc56dbea67c5118ce'
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        },
        queryLBC: {
            method: 'GET',
            url: 'http://comparateur.anarkhief.fr/web/index.php/leboncoin?name=:name&year_min=:yearmin&year_max=:yearmax',
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