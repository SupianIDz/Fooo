import map from '../../../map';
import { drawMarkers } from '../../../utils/map.marker';

export function mapModal() {
    return map('mapModal', {
        zoom: 12,
        scrollWheelZoom: false,
    });
}

export default map('map1', {
    zoom: 12,
    scrollWheelZoom: false,
})
    .then(map => {
        drawMarkers(map, {
            type: 'ODC'
        });

        return map;
    });
