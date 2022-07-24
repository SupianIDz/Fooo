import L from 'leaflet';
import { getTubes } from "./xhr/tubes";

export const drawCableTubes = async (map) => {

    const tubes = await getTubes({
        lines: true,
        cables: true,
    });

    const groupTube = [];
    const groupCablesGlobal = [];

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

        groupCablesGlobal.forEach(function (cable) {
            map.removeLayer(cable);
        });

        drawTubeWrapped();
    }

    // draw tubes
    function drawTubeWrapped() {
        let median = tubes.indexOf(
            tubes[Math.floor((tubes.length - 1) / 2)]
        );

        let idx = 1;
        let idy = 1;
        tubes.forEach((tube, index) => {

            const groupCables = [];

            let offset = 0;

            let weight = map.getZoom() - 5;

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
                    opacity: tube.opacity,
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

                    // draw cables
                    groupCables.forEach(cable => {
                        map.addLayer(cable);
                    });
                })
                .on('contextmenu', (e) => {
                    resetAllTubes();
                })
                .on('mouseover', (e) => {
                    geojson.setStyle({
                        opacity: 1,
                    });
                })
                .on('mouseout', (e) => {
                    geojson.setStyle({
                        opacity: tube.opacity,
                    });
                });

            groupTube.push(geojson.addTo(map));

            // CABLE
            let cdx = 1;
            let cdy = 1;
            let medianCable = tube.cables.indexOf(
                tube.cables[Math.floor((tube.cables.length - 1) / 2)]
            );

            tube.cables.forEach((cable, indexCable) => {

                let offsetCable = 0;
                let weightCable = cable.weight;

                if (indexCable < medianCable) {
                    offsetCable = weightCable * (cdx++)
                } else if (indexCable > medianCable) {
                    offsetCable = weightCable * -(cdy++)
                }

                if (indexCable === medianCable) {
                    offsetCable = 0;
                }

                let geoJSONCable = L.geoJSON(cable.lines_for_map, {
                    style: {
                        color: cable.color,
                        weight: weightCable,
                        opacity: cable.opacity,
                        offset: offsetCable,
                    }
                });

                geoJSONCable
                    .on('mouseover', (e) => {
                        geoJSONCable.setStyle({
                            opacity: 1,
                        });
                    })
                    .on('mouseout', (e) => {
                        geoJSONCable.setStyle({
                            opacity: cable.opacity,
                        });
                    });

                groupCables.push(geoJSONCable);
                groupCablesGlobal.push(geoJSONCable);
            });
        });
    }

    drawTubeWrapped();

    map.on('zoomend', resetAllTubes);

    return new Promise((resolve, reject) => {
        resolve();
    });
}
