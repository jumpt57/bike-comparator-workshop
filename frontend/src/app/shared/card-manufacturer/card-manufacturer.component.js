function CardManufacturerModule($scope, $element, $attrs) {
    var ctrl = this;
}
cardmanufacturerModule.component('cardManufacturer', {
    templateUrl: './app/shared/card-manufacturer/card-manufacturer.template.html',
    controller: CardManufacturerModule,
    bindings: {
        manufacturer: '<'
    }
});