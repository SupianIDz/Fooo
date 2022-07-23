import alpine from "alpinejs";
import Swal from "sweetalert2";

alpine.data('marker', () => ({
    detail: {
        name: 'Marker #1',
        address: '',
        lat: '',
        lng: '',
        type: '',
        port: 0,
        hasPort: false,
    },

    // WATCHER
    watcher: (value, detail) => {
        detail.hasPort = value !== 'POLE';
    },
    // END OF WATCHER

    // CREATE
    create() {
        Swal.fire({
            icon: 'question',
            title: 'APAKAH ANDA YAKIN ?',
            text: '',
            customClass: 'select-none uppercase text-sm text-slate-600',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YAKIN',
        })
            .then(r => {
                if (r.value) {
                    axios
                        .post(route('api.markers.store'), {
                            ...this.detail,
                        })
                        .then(r => {
                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL',
                                text: 'Marker berhasil dibuat',
                                customClass: 'select-none uppercase text-slate-500',
                            })
                                .then(r => {
                                    window.location.reload();
                                });
                        });
                }
            });
    },
    // END OF CREATE

    // INITIALIZE
    init() {
        //
    }
    // END OF INITIALIZE
}));

alpine.start()
