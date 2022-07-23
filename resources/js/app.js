import 'flowbite';
import 'leaflet-polylineoffset';
import _ from 'lodash';
import axios from 'axios';
import route from 'ziggy-js';
import { Ziggy } from './ziggy';

window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.route = (name, params = {}) => {
    return route(name, params, params, Ziggy);
}
