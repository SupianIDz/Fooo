import map from '../map';
import { drawMarkers } from '../utils/map.marker';
import { drawCableTubes } from "../utils/map.tubes";

map('map').then(map => {
    drawMarkers(map, {
        type: 'POLE'
    }).then(() => {
        //
    });

    drawCableTubes(map).then(() => {
        //
    });
});
