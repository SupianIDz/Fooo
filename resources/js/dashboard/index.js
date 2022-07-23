import map from '../map';
import { drawMarkers } from '../utils/map.marker';

map('map').then(map => {
    drawMarkers(map).then(() => {
        //
    });
});
