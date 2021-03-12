import Vue from 'vue';
import Vuex from 'vuex';

import location from './modules/location';
import setting from './modules/setting';
import users from './modules/users';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules:{
        location,
        setting,
        users
    }
})

export default store;