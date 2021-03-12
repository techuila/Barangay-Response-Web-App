$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-Requested-With' : 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};  

window.Vue = require('vue');
import App from './Index';
import store from './store/store'
import router from './routes/routes';

Vue.config.productionTip = false;

const app = new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app');
