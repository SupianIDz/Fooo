// noinspection ES6UnusedImports

import map, { mapModal } from './inc/map.js';
import alpine from 'alpinejs'
import Swal from "sweetalert2";
import { getMarker } from "../../utils/xhr/markers";
import { getTube } from "../../utils/xhr/tubes";

alpine.data('tube', () => ({
    lines: [],
    cables: [],
    cableLinesWithODCPorts: [],
    odcLinesWithJCPorts: [],

    detail: {
        name: 'Tube #1',
        color: '#000000',
        weight: 20,
        opacity: 1,
        description: '',
    },

    initSelect(row, index) {
        const select = document.getElementById('select' + index);

        select.addEventListener('change', (e) => {
            row.marker = e.target.value;
            getMarker(e.target.value).then(response => {
                row.address = response.address;
                row.coordinates = response.location.coordinates.reverse();
            })
                .catch(error => {
                    console.log('INIT SELECT');
                });
        });

        if (window.uuid && row.marker !== 0) {
            select.value = row.marker;
        }

        select.dispatchEvent(new Event('change'));
    },

    initSelectCore(row, indexCable, indexCableLine) {
        const select = document.getElementById('selectCore' + indexCable + '_' + indexCableLine);

        select.addEventListener('change', (e) => {
            row.marker = e.target.value;
            getMarker(e.target.value).then(response => {
                row.address = response.address;
                row.coordinates = response.location.coordinates.reverse();
            })

                .catch(error => {
                    console.log('INIT SELECT CORE');
                });
        });

        if (window.uuid && row.marker !== 0) {
            select.value = row.marker;
        }

        select.dispatchEvent(new Event('change'));
    },

    initSelectODC(row, indexODC, indexCableODC) {
        const select = document.getElementById('selectODCMarker' + indexODC + '_' + indexCableODC);

        select.addEventListener('change', (e) => {
            row.marker = e.target.value;
            getMarker(e.target.value).then(response => {
                row.address = response.address;
                row.coordinates = response.location.coordinates.reverse();
            })
                .catch(error => {
                    console.log('INIT SELECT ODC');
                });
        });

        if (window.uuid && row.marker !== 0) {
            select.value = row.marker;
        }

        select.dispatchEvent(new Event('change'));
    },

    initSelectJC(row, indexJC, indexCableJC) {
        const select = document.getElementById('selectJCMarker' + indexJC + '_' + indexCableJC);

        select.addEventListener('change', (e) => {
            row.marker = e.target.value;
            getMarker(e.target.value).then(response => {
                row.address = response.address;
                row.coordinates = response.location.coordinates.reverse();
            })
                .catch(error => {
                    console.log('INIT SELECT ODC');
                });
        });

        if (window.uuid && row.marker !== 0) {
            select.value = row.marker;
        }

        select.dispatchEvent(new Event('change'));
    },

    initPort(row, indexODCLine, indexODC) {
        const select = document.getElementById('selectPort' + indexODCLine + '_' + indexODC);

        select.value = row.port;
    },

    // ADD NEW ROW
    add() {
        this.lines.push({
            name: 'Jalur #' + (this.lines.length + 1),
            show: this.lines.length === 0,
            coordinates: [null, null],
            address: '',
            manual: false,
            marker: 0,
        });
    },

    addCable() {
        this.cables.push({
            name: 'Kabel #' + (this.cables.length + 1),
            color: '#000000',
            weight: 20,
            opacity: 0.7,
            description: '',
            lines: [],
        });
    },

    addCableLine(cable) {
        cable.lines.push({
            name: 'Jalur #' + (cable.lines.length + 1),
            show: cable.lines.length === 0,
            coordinates: [null, null],
            address: '',
            manual: false,
            marker: 0,
        });
    },

    addOutputPortODC(cable) {
        cable.odcs.push({
            port: 0,
            name: 'Output Port #' + (cable.odcs.length + 1),
            color: '#000000',
            weight: 20,
            opacity: 0.7,
            description: '',
            lines: [],
        });
    },

    addCableToODC(odc) {
        odc.lines.push({
            name: 'Jalur #' + (odc.lines.length + 1),
            show: odc.lines.length === 0,
            coordinates: [null, null],
            address: '',
            manual: false,
            marker: 0,
        });
    },

    addOutputPortJC(jc) {
        jc.jcs.push({
            port: 0,
            name: 'Output Port #' + (jc.jcs.length + 1),
            color: '#000000',
            weight: 20,
            opacity: 0.7,
            description: '',
            lines: [],
        });
    },

    addCableToJC(odp) {
        odp.lines.push({
            name: 'Jalur #' + (odp.lines.length + 1),
            show: odp.lines.length === 0,
            coordinates: [null, null],
            address: '',
            manual: false,
            marker: 0,
        });
    },
    // ADD NEW ROW

    // REMOVE ROW
    remove(index) {
        this.lines.splice(index, 1);
    },
    removeCable(index) {
        this.cables.splice(index, 1);
    },
    removeCableLine(cable, index) {
        cable.lines.splice(index, 1);
    },
    removeOutputPortODC(cable, index) {
        cable.odcs.splice(index, 1);
    },
    removeODCLine(odc, index) {
        console.log(odc, index);
        odc.lines.splice(index, 1);
    },
    // REMOVE ROW

    // CREATE
    create() {
        Swal.fire({
            icon: 'question',
            title: 'APAKAH ANDA YAKIN ?',
            text: 'Anda akan dialihkan ke halaman daftar tube setelah proses ini selesai.',
            customClass: 'select-none uppercase text-sm text-slate-600',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YAKIN',
        })
            .then(r => {
                if (r.value) {
                    axios
                        .post(route('api.tubes.store'), {
                            lines: this.lines,
                            detail: this.detail,
                        })
                        .then(r => {

                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL',
                                text: 'Tube berhasil dibuat',
                                customClass: 'select-none uppercase text-slate-500',
                            })
                                .then(() => {
                                    window.location.href = route('tubes.edit', r.data.data.uuid);
                                });
                        });
                }
            });
    },
    // END OF CREATE

    // INIT
    init() {

        if (window.uuid) {
            getTube(window.uuid, {
                raw_lines: true
            })
                .then(data => {
                    // TUBE DETAIL
                    this.detail = {
                        name: data.name,
                        color: data.color,
                        weight: data.weight,
                        opacity: data.opacity,
                        description: data.description,
                    }

                    // TUBE LINES
                    data.raw_lines.forEach((line, index) => {
                        this.lines.push({
                            name: line.name,
                            show: index === 0,
                            coordinates: [line.lat, line.lng],
                            address: line.address,
                            manual: line.attached === null,
                            marker: line.attached_on,
                        });
                    });

                    // CABLES
                    data.cables.forEach((cable, index) => {
                        let lines = [];

                        cable.lines.forEach((line, index) => {
                            lines.push({
                                uuid: line.uuid,
                                name: line.name,
                                show: false,
                                coordinates: [line.lat, line.lng],
                                address: line.address,
                                manual: line.attached_on === null,
                                marker: line.attached_on,
                            });

                            if (line.attached.ports.length > 0) {

                                let odcs = [];

                                line.children.forEach((child, index) => {
                                    let childODCLines = [];
                                    child.lines_detail.forEach((foo, index) => {
                                        childODCLines.push({
                                            port: foo.port_id,
                                            uuid: foo.uuid,
                                            name: foo.name,
                                            show: false,
                                            coordinates: [foo.lat, foo.lng],
                                            address: foo.address,
                                            manual: foo.attached_on === null,
                                            marker: foo.attached_on,
                                        });

                                        // JC
                                        if (foo.attached.ports.length > 0) {
                                            let jcs = [];

                                            console.log(foo);
                                            foo.children.forEach((child, index) => {

                                                let childJCLines = [];

                                                child.lines_detail.forEach((jcLine, index) => {
                                                    childJCLines.push({
                                                        port: jcLine.port_id,
                                                        uuid: jcLine.uuid,
                                                        name: jcLine.name,
                                                        show: false,
                                                        coordinates: [jcLine.lat, jcLine.lng],
                                                        address: jcLine.address,
                                                        manual: jcLine.attached_on === null,
                                                        marker: jcLine.attached_on,
                                                    });
                                                })

                                                jcs.push({
                                                    ...child,
                                                    port: child.port_id,
                                                    lines: childJCLines,
                                                });
                                            });

                                            this.odcLinesWithJCPorts.push({
                                                ...foo,
                                                jcs: jcs,
                                            });
                                        }
                                        //END OF JC
                                    });

                                    odcs.push({
                                        ...child,
                                        lines: childODCLines,
                                        show: false,
                                    });
                                });

                                this.cableLinesWithODCPorts.push({
                                    ...line,
                                    odcs: odcs,
                                });
                            }
                        });

                        this.cables.push({
                            uuid: cable.uuid,
                            name: cable.name,
                            color: cable.color,
                            weight: cable.weight,
                            opacity: cable.opacity,
                            description: cable.description,
                            lines: lines,
                        });

                    });
                });
        }
    },
    // END OF INIT
    watcher(row) {
        //
    },

    // CREATE
    update() {
        Swal.fire({
            icon: 'question',
            title: 'APAKAH ANDA YAKIN ?',
            text: 'Anda akan dialihkan ke halaman daftar tube setelah proses ini selesai.',
            customClass: 'select-none uppercase text-sm text-slate-600',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YAKIN',
        })
            .then(r => {
                if (r.value) {
                    axios
                        .patch(route('api.tubes.update', window.uuid), {
                            lines: this.lines,
                            detail: this.detail,
                            cables: this.cables,
                            cableAttachedToODC: this.cableLinesWithODCPorts,
                            odcCableAttachToJC: this.odcLinesWithJCPorts,
                        })
                        .then(r => {

                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL',
                                text: 'Tube berhasil diupdate',
                                customClass: 'select-none uppercase text-slate-500',
                            })
                                .then(() => {
                                    window.location.href = route('tubes.edit', r.data.data.uuid);
                                });
                        });
                }
            });
    },
    // END OF CREATE

    // TOGGLE SHOW
    toggle(row, index) {
        row.show = ! row.show;
    },

    initLatLng(row) {
        const modalWrapper = () => {
            mapModal().then(map => {
                let modal = new Modal(document.getElementById('modalMap'), {
                    onShow: () => {
                        document.getElementById('map1').classList.add('hidden');
                        setTimeout(function () {
                            map.invalidateSize();
                        }, 100);
                    },
                    onHide: () => {
                        document.getElementById('map1').classList.remove('hidden');
                    }
                });

                modal.show();

                map.on('contextmenu', e => {
                    row.coordinates = [e.latlng.lat, e.latlng.lng];

                    modal.hide();

                    map.off();
                    map.remove();
                });
            });
        }

        this.$refs.lat.addEventListener('focus', () => {
            modalWrapper();
        });

        this.$refs.lng.addEventListener('focus', () => {
            modalWrapper();
        });
    }
}));

alpine.start()
