import map from '../map';
import { drawMarkers } from '../utils/map.marker';
import { drawCableTubes } from "../utils/map.tubes";

map('map').then(async map => {

    let poles = await drawMarkers(map, {
        type: 'POLE'
    });

    let odcs = await drawMarkers(map, {
        type: 'ODC'
    });

    let odps = await drawMarkers(map, {
        type: 'ODP'
    });

    let jcs = await drawMarkers(map, {
        type: 'JC'
    });

    L.Control.Button = L.Control.extend({
        options: {
            position: 'topleft'
        },
        onAdd: function (map) {
            let container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
            const button1 = L.DomUtil.create('a', 'leaflet-control-button p-1', container);
            const button2 = L.DomUtil.create('a', 'leaflet-control-button p-1', container);
            const button3 = L.DomUtil.create('a', 'leaflet-control-button p-1', container);
            const button4 = L.DomUtil.create('a', 'leaflet-control-button p-1', container);

            button1.innerHTML = '<img src="/assets/img/pole.svg" alt="">';
            button2.innerHTML = '<img src="/assets/img/odc.svg" alt="">';
            button3.innerHTML = '<img src="/assets/img/odp.svg" alt="">';
            button4.innerHTML = '<img src="/assets/img/jc.svg" alt="">';

            L.DomEvent.disableClickPropagation(button1);
            L.DomEvent.disableClickPropagation(button2);
            L.DomEvent.disableClickPropagation(button3);
            L.DomEvent.disableClickPropagation(button4);

            L.DomEvent.on(button1, 'click', function () {
                if (localStorage.getItem('pole') === 'true') {
                    poles.forEach(pole => pole.removeFrom(map));
                    localStorage.setItem('pole', 'false');
                } else {
                    poles.forEach(pole => pole.addTo(map));
                    localStorage.setItem('pole', 'true');
                }
            });

            L.DomEvent.on(button2, 'click', function () {
                if (localStorage.getItem('odc') === 'true') {
                    odcs.forEach(pole => pole.removeFrom(map));
                    localStorage.setItem('odc', 'false');
                } else {
                    odcs.forEach(pole => pole.addTo(map));
                    localStorage.setItem('odc', 'true');
                }
            });

            L.DomEvent.on(button3, 'click', function () {
                if (localStorage.getItem('odp') === 'true') {
                    odps.forEach(pole => pole.removeFrom(map));
                    localStorage.setItem('odp', 'false');
                } else {
                    odps.forEach(pole => pole.addTo(map));
                    localStorage.setItem('odp', 'true');
                }
            });

            L.DomEvent.on(button4, 'click', function () {
                if (localStorage.getItem('jc') === 'true') {
                    jcs.forEach(pole => pole.removeFrom(map));
                    localStorage.setItem('jc', 'false');
                } else {
                    jcs.forEach(pole => pole.addTo(map));
                    localStorage.setItem('jc', 'true');
                }
            });

            container.title = "Title";

            return container;
        },
        onRemove: function (map) {
        },
    });

    const control = new L.Control.Button().addTo(map);

    drawCableTubes(map).then(() => {
        //
    });
});
