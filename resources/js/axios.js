const axios = axios.create({
    baseURL: 'http://localhost:3000',
    timeout: 10000,
    params: {} // do not remove this, its added to add params later in the config
});

// axios.interceptors.request.use(function (config) {
//    alert('test');

//     return config;
// }, function (error) {
//     // Do something with request error
//     return Promise.reject(error)
// })

export default axios