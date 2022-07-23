import { getMarkers } from './xhr/markers';

export const drawMarkers = (map, params = {}) => {

    getMarkers(params).then((markers) => {
        for (let row of markers) {

            const svgIcon = L.icon({
                iconUrl: '/assets/img/' + row.icon,
                className: '',
                iconSize: [50, 40],
                iconAnchor: [12, 40],
            });

            let marker = L.marker(row.location.coordinates, {
                icon: svgIcon,
            });

            marker.addTo(map);
        }
    });

    return new Promise((resolve, reject) => {
        resolve();
    });
}
