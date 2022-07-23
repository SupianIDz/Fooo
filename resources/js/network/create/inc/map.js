import map from '../../../map';
import { drawMarkers } from '../../../utils/map.marker';

export default map('map1', {
    zoom: 12,
    scrollWheelZoom: false,
})
    .then(map => {
        drawMarkers(map, {
            type: 'ODC'
        })
            .then(() => {
                //
            });
    });
