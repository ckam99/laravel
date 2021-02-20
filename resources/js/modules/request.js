
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';
if(localStorage.getItem('token')){
    window.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('token');
}
