var bikeApp = angular.module('bikeApp',
    [
        'ngRoute',
        'ngResource',

        'manufacturersModule',       
        'manufacturerModule',
        'bikeModule',
        'researchModule',
        'comparatorModule',
        'newsModule',

        'listBikesModule',       
        'listManufacturersModule',

        'cardbikeModule',
        'cardmanufacturerModule',

        'recordCardBikeModule',
        'recordCardManufacturerModule'      
        
    ]
);