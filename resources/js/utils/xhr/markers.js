export const getMarkers = () => {
    return axios.get(route('markers.index'))
        .then(response => response.data)
        .then(response => response.data);
};
