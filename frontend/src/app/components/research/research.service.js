function ResearchService($resource) {
    return $resource('./assets/json/manufacturers.json', {}, {
        query: {
            method: 'GET',
            isArray: true
        }
    });
}
researchModule.factory('Research',
    [
        '$resource',
        ResearchService
    ]
);