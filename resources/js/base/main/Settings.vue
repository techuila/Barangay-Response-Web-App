<template>
    <div id="settings">
        <!-- <ul class="tabs tabs-fixed-width tab-demo z-depth-2">
            <li class="tab"><router-link :to="{name:'Users'}">Users</router-link></li>
            <li class="tab"><router-link :to="{name:'Sim'}">Sim</router-link></li>
        </ul> -->
        <div id="test1" class="col s12 content-tab"><router-view></router-view></div>
    </div>
</template>

<script>
export default {
    mounted(){
        $('.tabs').tabs();
    }
}
</script>

<style scoped>
#settings{
    padding-top: 10px;
}
.content-tab{
    padding-top: 20px;
}
</style>
