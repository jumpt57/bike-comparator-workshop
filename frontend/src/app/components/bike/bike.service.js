function BikeService($resource) {
    return $resource('./assets/json/:name.json', {}, {
        query: {
            method: 'GET',
            isArray: false
        },
        queryLBC: {
            method: 'POST',
            isArray: false,
            //url: 'https://mobile.leboncoin.fr/templates/api/list.json?limit=0&ca=:region_s&w=1&f=a&o=1&q=:query&sp=0&pivot=0,0,0&c=:categorie&cce=:cylindremax&pe=:prixmax&me=kmmax&ps=prixmin&re=anneemax&rs=:anneemin&ccs=cynlindremin&ms=:kmmin&zipcode=:codepost&city=:ville',
            url: 'http://mobile.leboncoin.fr/templates/api/list.json?limit=0&ca=2_s&w=1&f=a&o=1&q=&sp=0&pivot=0,0,0&c=3&cce=1000&pe=17&me=200000&ps=2&re=2015&rs=1964&ccs=50&ms=5000&zipcode=24340&city=Mareuil',
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded'   ,
                'Access-Control-Allow-Origin': '*'           
            }
        }
    });
}
bikeModule.factory('Bike',
    [
        '$resource',
        BikeService
    ]
);