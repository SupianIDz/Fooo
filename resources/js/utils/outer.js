import L from 'leaflet';

L.Mask = L.Polygon.extend({
    options: {
        stroke: false,
        color: '#333',
        fillOpacity: 0.8,
        clickable: false,

        outerBounds: new L.LatLngBounds([-90, -360], [90, 360])
    },

    initialize: function (latLngs, options) {
        let outerBoundsLatLngs = [
            this.options.outerBounds.getSouthWest(),
            this.options.outerBounds.getNorthWest(),
            this.options.outerBounds.getNorthEast(),
            this.options.outerBounds.getSouthEast()
        ];

        L.Polygon.prototype.initialize.call(this, [outerBoundsLatLngs, latLngs], options);
    },
});

export default function (latLongs, options) {
    return new L.Mask(latLongs, options);
};
