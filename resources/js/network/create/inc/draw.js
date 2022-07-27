let groupAll = [];
let tempOffset = [];
export default function refreshMap(map, tubeDetail, tubeLines, cables, cableLinesWithODCPorts, odcLinesWithJCPorts) {
    let lineOfTube = [];

    tempOffset = [];

    if (groupAll.length > 0) {
        groupAll.forEach(function (layer) {
            map.removeLayer(layer);
        });
    }

    tubeLines.forEach(line => {
        lineOfTube.push([
            line.coordinates[1],
            line.coordinates[0],
        ]);

    });

    const polyline = L.polyline(lineOfTube, {
        color: tubeDetail.color,
        weight: tubeDetail.weight,
        opacity: tubeDetail.opacity,
    });

    groupAll.push(polyline.addTo(map));

    //

    let idx = 1;
    let idy = 1;

    let median = cables.indexOf(
        cables[Math.floor((cables.length - 1) / 2)]
    );

    cables.forEach((cable, index) => {
        let coordinatesCable = [];

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

        cable.lines.forEach(line => {
            if (line.uuid) {
                tempOffset[line.uuid] = offset;
            }

            coordinatesCable.push([
                line.coordinates[1],
                line.coordinates[0],
            ]);
        });

        coordinatesCable = coordinatesCable.filter(function (coordinate) {
            return (coordinate[0] !== undefined && coordinate[1] !== undefined) || (coordinate[0] === null && coordinate[1] === null);
        });

        const polylineCable = L.polyline(coordinatesCable, {
            color: cable.color,
            weight: cable.weight,
            opacity: cable.opacity,
            offset: offset,
        });

        groupAll.push(polylineCable.addTo(map));
    });

    //
    cableLinesWithODCPorts.forEach(cable => {

        let svgIcon = L.icon({
            iconUrl: '/assets/img/odc.svg',
            className: '',
            iconSize: [20, 20],
            iconAnchor: [12, 15],
        });

        let marker = L.marker([cable.lng, cable.lat], {
            icon: svgIcon,
        });

        marker.addTo(map);

        let indexODCX = 1;
        let indexODCY = 1;
        let medianODC = cable.odcs.indexOf(
            cable.odcs[Math.floor((cable.odcs.length - 1) / 2)]
        );

        cable.odcs.forEach((odc, index) => {
            let coordinatesODC = [];

            coordinatesODC.push([
                cable.lng,
                cable.lat,
            ]);

            odc.lines.forEach(line => {
                coordinatesODC.push([
                    line.coordinates[1],
                    line.coordinates[0],
                ]);
            });

            let offsetODc = 0;
            let weightODc = odc.weight;

            if (index < medianODC) {
                offsetODc = weight * (indexODCX++)
            } else if (index > medianODC) {
                offsetODc = weight * -(indexODCY++)
            }

            if (index === medianODC) {
                offsetODc = 0;
            }

            const polylineODC = L.polyline(coordinatesODC, {
                color: odc.color,
                weight: odc.weight,
                opacity: odc.opacity,
                offset: tempOffset[cable.uuid],
            });

            groupAll.push(polylineODC.addTo(map));
        });
    });

    //
    odcLinesWithJCPorts.forEach(odc => {
        let svgIcon = L.icon({
            iconUrl: '/assets/img/jc.svg',
            className: '',
            iconSize: [20, 20],
            iconAnchor: [12, 15],
        });

        let marker = L.marker([odc.lng, odc.lat], {
            icon: svgIcon,
        });

        marker.addTo(map);

        let indexODPX = 1;
        let indexODPY = 1;
        let medianODP = odc.jcs.indexOf(
            odc.jcs[Math.floor((odc.jcs.length - 1) / 2)]
        );

        odc.jcs.forEach((jc, index) => {
            let coordinatesODP = [];

            coordinatesODP.push([
                odc.lng,
                odc.lat,
            ]);

            jc.lines.forEach(line => {
                coordinatesODP.push([
                    line.coordinates[1],
                    line.coordinates[0],
                ]);
            });

            let offsetODc = 0;
            let weightODC = jc.weight;

            if (index < medianODP) {
                offsetODc = weight * (indexODPX++)
            } else if (index > medianODP) {
                offsetODc = weight * -(indexODPY++)
            }

            if (index === medianODP) {
                offsetODc = 0;
            }

            const polylineJC = L.polyline(coordinatesODP, {
                color: jc.color,
                weight: weightODC,
                opacity: jc.opacity,
                offset: tempOffset[odc.uuid],
            });

            groupAll.push(polylineJC.addTo(map));
        });
    });
};
