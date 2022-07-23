export const getMarkers = (params = {}) => {
    return axios.get(route('api.markers.index') + '?' + new URLSearchParams(params))
        .then(response => response.data)
        .then(response => response.data);
};

export const getMarker = (id) => {
    return axios.get(route('api.markers.show', {id}))
        .then(response => response.data)
        .then(response => response.data);
};
