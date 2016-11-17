function RecordCardBikeController($scope, $element, $attrs) {
    var ctrl = this;
}
recordCardBikeModule.component('recordCardBike', {
    templateUrl: './app/shared/record-card-bike/record-card-bike.template.html',
    controller: RecordCardBikeController,
    bindings: {
        bike: '<'
    }
});