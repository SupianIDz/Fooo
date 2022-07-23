// noinspection ES6UnusedImports

import map from './inc/map.js';
import alpine from 'alpinejs'

alpine.data('tube', () => ({
    lines: [],
    detail: {
        name: 'Tube #1',
        color: '#000000',
        weight: 20,
        opacity: 1,
        description: '',
    },

    // CREATE
    create() {
        axios
            .post(route('api.tubes.store'), {
                // @formatter:off
                lines  : this.lines,
                detail : this.detail,
                // @formatter:on
            })
            .then(r => {

            });
    },
    // END OF CREATE

    // INIT
    init() {

    }
    // END OF INIT
}));

alpine.start()
