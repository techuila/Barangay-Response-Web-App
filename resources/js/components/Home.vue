<template>
    <div id="home">
        <ul id="slide-out" class="sidenav sidenav-fixed" :class="{ 'hide-sidebar' : hideSidebar }" style="z-index: 10;">
            <li><router-link :to="{name:'Dashboard'}">Home</router-link></li>
            <li><router-link to="/settings/users">Settings</router-link></li>
            <li style="position: absolute !important; bottom:60px;z-index:9999 !important;">
                <div class="switch" style="padding-left: 30px;">
                    <b>Realtime Data</b>
                    <label>
                        <input type="checkbox" @click="toggleRealtime" v-model="realdata" :value="realtime" refs="realdata">
                        <span class="lever"></span>
                    </label>
                </div>
            </li>
        </ul>
        <div id="content" :class="{ 'expand-main' : hideSidebar }">
            <header>
                <Navbar @toggleSidebar="toggleSidebar"></Navbar>
            </header>
            <main>
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script>
import Navbar from '../base/Navbar';
import Modal from '../base/Modal';
import Dashboard from '../base/main/Dashboard';

export default {
    components:{
        Navbar,
        Modal,
        Dashboard
    },
    data: ()=>({
        hideSidebar: false,
        realdata: false
    }),
    created(){
        this.$store.dispatch('FETCH_SETTINGS');
    },
    mounted(){
        $('.modal').modal();
    },
    methods:{
        toggleSidebar(val){
            this.hideSidebar = val;
        },
        toggleRealtime(){
            this.$store.dispatch('UPDATE_SETTINGS', !this.realtime);
        }
    },
    computed:{
        realtime(){
            this.realdata = this.$store.getters.getRealtime
            return this.realdata;
        }
    }
}
</script>

<style scoped>
.hide-sidebar{
    transform: translateX(-300px);
}
.expand-main{
    padding-left: 0 !important;
}
</style>
