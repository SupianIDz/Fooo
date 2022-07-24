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

export const drawJoinClosure = (map, parent) => {
    let jcs = JoinClosure(parent);

    let group = [];
    jcs.forEach(joinClosure => {
        let geoJSONCable = L.geoJSON(joinClosure.lines_for_map, {
            style: {
                color: joinClosure.color,
                weight: joinClosure.weight,
                opacity: joinClosure.opacity,
                offset: 0,
            }
        });

        geoJSONCable.bindTooltip(joinClosure.name);

        // geoJSONCable.addTo(map);

        group.push(geoJSONCable);
    });

    return group;
}
