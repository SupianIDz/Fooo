// noinspection ES6UnusedImports

import map from './inc/map.js';
import alpine from 'alpinejs'
import Swal from "sweetalert2";
import { getMarker } from "../../utils/xhr/markers";

alpine.data('tube', () => ({
    lines: [],
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
    // ADD NEW ROW

    // REMOVE ROW
    remove(index) {
        this.lines.splice(index, 1);
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
                                .then(r => {
                                    window.location.href = route('tubes.index');
                                });
                        });
                }
            });
    },
    // END OF CREATE

    // INIT
    init() {
        for (let i = 0; i < 5; i++) {
            this.add();
        }
    },
    // END OF INIT
    watcher(row) {
        //
    },

    // TOGGLE SHOW
    toggle(row, index) {

        this.lines.forEach((line, idx) => {
            if (index !== idx) {
                line.show = false;
            }
        });

        row.show = ! row.show;
    }
}));

alpine.start()
