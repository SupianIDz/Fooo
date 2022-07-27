import { getMarkers } from './xhr/markers';
import { markerToolTip } from "../dashboard/marker";

export const drawMarkers = (map, params = {}) => {
    return getMarkers(params).then((markers) => {

        const markersZ = [];
        for (let row of markers) {

            let svgIcon = L.icon({
                iconUrl: '/assets/img/' + row.icon,
                className: '',
                iconSize: [50, 40],
                iconAnchor: [12, 40],
            });

            let marker = L.marker(row.location.coordinates, {
                icon: svgIcon,
            });

            markersZ.push(marker.bindPopup(markerToolTip(row)))
        }

        return markersZ;
    });
}
