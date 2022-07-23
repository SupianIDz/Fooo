import map from '../../../map';
import { drawMarkers } from '../../../utils/map.marker';
import { drawCableTubes } from "../../../utils/map.tubes";

export default map('map1', {
    zoom: 12,
    scrollWheelZoom: false,
})
    .then(map => {
        drawMarkers(map).then(() => {
            //
        });
    });

map('map2', {
    zoom: 12,
    scrollWheelZoom: false,
})
    .then(map => {
        drawMarkers(map).then(() => {
            //
        });

        drawCableTubes(map).then(() => {
            //
        });
    });
