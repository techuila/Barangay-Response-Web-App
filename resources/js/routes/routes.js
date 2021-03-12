window.Vue = require('vue');
import Router from 'vue-router';
import Home from '../components/Home';
import Login from '../components/Login';
import Settings from '../base/main/Settings';
import Dashboard from '../base/main/Dashboard';
import Users from '../base/main/settings/Users';
import Sim from '../base/main/settings/Sim';

// window.Vue.use(Router);
Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/',
            // name: 'Home',
            component: Home,
            children:[
                {
                    path: '/',
                    name: 'Dashboard',
                    component: Dashboard
                },
                {
                    path: 'settings',
                    name: 'Settings',
                    component: Users,
                    children:[
                        {
                            path: 'users',
                            name: 'Users',
                            component: Users
                        },
                        {
                            path: 'sim',
                            name: 'Sim',
                            component: Sim,
                        }
                    ]
                }
            ]
        },
        {
            path: '/home',
            redirect:{ path: '/' }
        }
    ]
});