function ComparatorController($scope, Comparator) {
    $scope.bikes = [];
    Comparator.queryAll(function (data) {
        $scope.manufacturers = data.manufactures;
    });
    $scope.onManufacturerChange = function (id) {
        Comparator.queryOneById({ id: id }, function (data) {
            $scope.manuYears = JSON.parse(data.manufactures[0].years);
        });
        
    };
    $scope.onManuYearChange = function (id, year) {
        Comparator.queryBikes({ id: id, year: year }, function (data) {
            $scope.manuBikes = data.bikes;
        });
    };
    $scope.onClickAddBike = function (id) {
        Comparator.queryBikeById({ id: id }, function (data) {
            $scope.bikes.push(data.bike);
            $scope.marqueSelect = null;
            $scope.modeleSelect = null;
            $scope.anneeSelect = null;
            $scope.manuYears = [];
            $scope.manuBikes = [];
        });
    };

}
comparatorModule.controller('comparatorController',
    [
        '$scope',
        'Comparator',
        ComparatorController
    ]
    );