import L from 'leaflet';
import { getTubes } from "./xhr/tubes";
import { drawJoinClosure } from "../dashboard/joinclosure";
import { ttipCable, ttipCableODC,ttipTube } from "../dashboard/ttip";

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
                    lineCap: "square",
                }
            });

            ttipTube(tube).then(html => {

                geojson.bindTooltip(html);

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
                        lineCap: "square",
                    }
                });

                let cableToolTip = null;
                ttipCable(cable, tube).then(toolTip => {
                    cableToolTip = geoJSONCable.bindTooltip(toolTip);
                });

                // CHILD CABLE ODC
                let childs = cable.lines.filter(line => {
                    return line.children.length > 0;
                });

                // CHILD CABLE ODC
                let groupCableChild = [];
                let joinClosureGroup = [];
                if (childs.length > 0) {

                    childs.forEach((child) => {
                        let x = L.marker([child.lng, child.lat], {
                            icon: L.icon({
                                iconUrl: '/assets/img/odc.svg',
                                className: '',
                                iconSize: [20, 20],
                                iconAnchor: [12, 15],
                            }),
                        });

                        groupCableChild.push(x);

                        let chdx = 1;
                        let chdy = 1;
                        let medianChildCable = child.children.indexOf(
                            child.children[Math.floor((child.children.length - 1) / 2)]
                        );

                        child.children.forEach((childCable) => {

                            let offsetCable = 0;
                            let weightCable = childCable.weight;

                            if (indexCable < medianCable) {
                                offsetCable = weightCable * (chdx++)
                            } else if (indexCable > medianCable) {
                                offsetCable = weightCable * -(chdy++)
                            }

                            if (indexCable === medianCable) {
                                offsetCable = 0;
                            }

                            // JC
                            let joinClosureLine = drawJoinClosure(map, childCable, offsetCable);

                            joinClosureLine.forEach(joinClosure => {
                                joinClosureGroup.push(joinClosure);
                            });
                            // END OF JC

                            let geoJSONCableChild = L.geoJSON(childCable.lines_for_map, {
                                style: {
                                    color: childCable.color,
                                    weight: weightCable,
                                    opacity: childCable.opacity,
                                    offset: offsetCable,
                                    lineCap: "square",
                                }
                            });

                            let cableChildToolTip = null;
                            ttipCableODC(childCable, cable, tube).then(toolTip => {
                                cableChildToolTip = geoJSONCableChild.bindTooltip(toolTip);
                            });

                            let tempJCx = [];
                            joinClosureGroup.forEach(joinClosure => {
                                tempJCx.push(joinClosure);
                            });

                            geoJSONCableChild
                                .on('click', (e) => {
                                    cableChildToolTip.openTooltip(e.latlng);
                                })
                                .on('mouseover', (e) => {
                                    joinClosureGroup.forEach(joinClosure => {
                                        try {
                                            joinClosure.setStyle({
                                                opacity: 1,
                                            });
                                        } catch (e) {

                                        }
                                    });
                                })
                                .on('mouseout', (e) => {
                                    joinClosureGroup.forEach((joinClosure, index) => {
                                        try {
                                            joinClosure.setStyle({
                                                opacity: tempJCx[index].options.opacity,
                                            });
                                        } catch (e) {

                                        }
                                    });
                                });

                            groupCableChild.push(geoJSONCableChild);
                        });

                    });
                }

                let group = L.layerGroup([geoJSONCable, ...groupCableChild, ...joinClosureGroup]);

                groupCables.push(group);
                groupCablesGlobal.push(group);
                // END OF CHILD CABLE ODC

                // TEMP
                let temps = [];
                groupCableChild.forEach(child => {
                    temps.push(child);
                });

                let tempJC = [];
                joinClosureGroup.forEach(joinClosure => {
                    tempJC.push(joinClosure);
                });
                // END OF TEMP

                geoJSONCable
                    .on('mouseover', (e) => {
                        geoJSONCable.setStyle({
                            opacity: 1,
                        });

                        groupCableChild.forEach(child => {
                            try {
                                child.setStyle({
                                    opacity: 1,
                                });
                            } catch (e) {

                            }
                        });

                        joinClosureGroup.forEach(joinClosure => {
                            try {
                                joinClosure.setStyle({
                                    opacity: 1,
                                });
                            } catch (e) {

                            }
                        });
                    })
                    .on('mouseout', (e) => {
                        geoJSONCable.setStyle({
                            opacity: cable.opacity,
                        });

                        groupCableChild.forEach((child, index) => {
                            try {
                                child.setStyle({
                                    opacity: temps[index].options.style.opacity,
                                });
                            } catch (e) {
                            }
                        });

                        joinClosureGroup.forEach((joinClosure, index) => {
                            try {
                                joinClosure.setStyle({
                                    opacity: tempJC[index].options.style.opacity,
                                });
                            } catch (e) {
                            }
                        });
                    })
                    .on('click', (e) => {
                        cableToolTip.openTooltip(e.latlng);
                    });
            });
        });
    }

    drawTubeWrapped();

    map.on('zoomend', resetAllTubes);

    return new Promise((resolve, reject) => {
        resolve();
    });
}
