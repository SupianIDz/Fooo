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
                weight: joinClosure.weight * 3,
                opacity: joinClosure.opacity,
                offset: offsetParent,
            }
        });

        geoJSONCable.bindTooltip(joinClosure.name);

        // geoJSONCable.addTo(map);

        group.push(geoJSONCable);
    });

    return group;
}