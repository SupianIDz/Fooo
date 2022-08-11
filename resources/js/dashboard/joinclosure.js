import { ttipCableJC } from "./ttip";

export const JoinClosure = (line) => {
    let jcs = [];
    line.lines_detail.forEach(lineDetail => {
        if (lineDetail.children.length > 0) {
            lineDetail.children.forEach(child => {
                jcs.push(child);
            });
        }
    });

    return jcs;
}

export const drawJoinClosure = (map, parent, offsetParent) => {
    let jcs = JoinClosure(parent);

    let group = [];
    jcs.forEach(joinClosure => {
        let geoJSONCable = L.geoJSON(joinClosure.lines_for_map, {
            style: {
                color: joinClosure.color,
                weight: joinClosure.weight,
                opacity: joinClosure.opacity,
                offset: offsetParent,
                lineCap: "square",
            }
        });

        ttipCableJC(joinClosure, parent).then(html => {
            geoJSONCable.bindTooltip(html);
        });

        group.push(geoJSONCable);

        let x = L.marker(joinClosure.lines_for_map.coordinates[joinClosure.lines_for_map.coordinates.length - 1].reverse(), {
            icon: L.icon({
                iconUrl: '/assets/img/odp.svg',
                className: '',
                iconSize: [20, 20],
                iconAnchor: [12, 15],
            }),
        });

        group.push(x);
    });

    if (group.length > 0) {
        const x = parent.lines_for_map.coordinates[parent.lines_for_map.coordinates.length - 1];
        let z = L.marker([x[1], x[0]], {
            icon: L.icon({
                iconUrl: '/assets/img/jc.svg',
                className: '',
                iconSize: [20, 20],
                iconAnchor: [12, 15],
            }),
        });

        group.push(z);
    }

    return group;
}
