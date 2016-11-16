function ListBikesController($scope, $element, $attrs) {
    var ctrl = this;
}
listBikesModule.component('listBikes', {
    templateUrl: './app/shared/list-bikes/list-bikes.template.html',
    controller: ListBikesController,
    bindings: {
        bikes: '<'
    }
});