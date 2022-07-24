export const getTubes = (queries = {}) => {

    return axios.get(route('api.tubes.index') + '?' + new URLSearchParams(queries))
        .then(response => response.data)
        .then(response => response.data);
};

export const getTube = (uuid, queries = {}) => {
    return axios.get(route('api.tubes.show', uuid) + '?' + new URLSearchParams(queries))
        .then(response => response.data)
        .then(response => response.data);
}
