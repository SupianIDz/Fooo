export const getMarkers = () => {
    return axios.get(route('api.markers.index'))
        .then(response => response.data)
        .then(response => response.data);
};
