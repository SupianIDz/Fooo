// noinspection ES6UnusedImports

import map from './inc/map.js';
import alpine from 'alpinejs'
import Swal from "sweetalert2";
import { getMarker } from "../../utils/xhr/markers";
import { getTube } from "../../utils/xhr/tubes";

alpine.data('tube', () => ({
    lines: [],
    cables: [],
    cableLinesWithODCPorts: [],

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
            });
        });

        if (window.uuid) {
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
            });
        });

        if (window.uuid) {
            select.value = row.marker;
        }

        select.dispatchEvent(new Event('change'));
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
                                this.cableLinesWithODCPorts.push({
                                    ...line,
                                    odcs: [
                                        {
                                            port: 0,
                                            name: 'Output Port # 1',
                                            color: '#000000',
                                            weight: 20,
                                            opacity: 0.7,
                                            description: '',
                                            lines: [],
                                        }
                                    ],
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
                        })
                        .then(r => {

                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL',
                                text: 'Tube berhasil diupdate',
                                customClass: 'select-none uppercase text-slate-500',
                            })
                                .then(() => {
                                    // window.location.href = route('tubes.edit', r.data.data.uuid);
                                });
                        });
                }
            });
    },
    // END OF CREATE

    // TOGGLE SHOW
    toggle(row, index) {
        row.show = ! row.show;
    }
}));

alpine.start()
