import L from 'leaflet';
import outer from './utils/map.outer';
import 'leaflet.fullscreen';

export default (element) => {
    let defaultTile = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    let tastersTile = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png');

    const map = L.map(element, {
        layers: [tastersTile],
        center: [
            -1.62061025,
            103.6031150,
        ],
        zoom: 13,
        fullscreenControl: true,
        fullscreenControlOptions: {
            position: 'topleft'
        }
    });

    L.control.layers({
        'DEFAULT': defaultTile,
        'RASTERS': tastersTile
    })
        .addTo(map);

    axios.get('/jambi.json')
        .then(response => {

            const polygon = L.geoJSON(response.data.geometry, {
                style: {
                    "color": "#000",
                    "weight": 1,
                    "opacity": 0.65,
                    "fillOpacity": 0,
                }
            })
                .addTo(map);

            // Add Masks Outer JAMBI
            const latLongs = [];
            const coordinates = response.data.geometry.coordinates[0][0];

            for (let i = 0; i < coordinates.length; i++) {
                latLongs.push(new L.LatLng(coordinates[i][1], coordinates[i][0]));
            }

            outer(latLongs).addTo(map).bringToFront();
        });

    return new Promise((resolve, reject) => {
        resolve(map);
    });
}
