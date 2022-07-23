import L from 'leaflet';
import { getTubes } from "./xhr/tubes";

export const drawCableTubes = (map) => {

    const groupTube = [];

    // hiding all tubes
    function hideTubes() {
        groupTube.forEach(function (tube) {
            tube.setStyle({
                weight: 0,
                opacity: 0,
            });
        });
    }

    // this function to avoid duplicate tubes
    function resetAllTubes() {
        groupTube.forEach(function (tube) {
            map.removeLayer(tube);
        });

        drawTubeWrapped();
    }

    // draw tubes
    function drawTubeWrapped() {
        getTubes({lines: true}).then((tubes) => {

            let median = tubes.indexOf(
                tubes[Math.floor((tubes.length - 1) / 2)]
            );

            let idx = 1;
            let idy = 1;
            tubes.forEach((tube, index) => {

                let offset = 0;

                let weight = map.getZoom();

                if (index < median) {
                    offset = weight * (idx++)
                } else if (index > median) {
                    offset = weight * -(idy++)
                }

                if (index === median) {
                    offset = 0;
                }

                let geojson = L.geoJSON(tube.lines, {
                    style: {
                        color: tube.color,
                        weight: weight,
                        opacity: 1,
                        offset: offset,
                    }
                });

                geojson
                    .on('click', (e) => {
                        hideTubes();

                        geojson.setStyle({
                            weight: tube.weight,
                            opacity: tube.opacity,
                        });

                        // move offset to 0
                        geojson.eachLayer(function (layer) {
                            layer.setOffset(0);
                        });
                    })
                    .on('contextmenu', (e) => {
                        resetAllTubes();
                    });

                groupTube.push(geojson.addTo(map));
            });
        });
    }

    drawTubeWrapped();

    map.on('zoomend', resetAllTubes);

    return new Promise((resolve, reject) => {
        resolve();
    });
}
