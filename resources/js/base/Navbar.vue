<template>
    <nav>
        <div class="nav-wrapper" :class="{ 'toggleSidebar' : hideSidebar }">
            <a class="waves-effect waves-dark btn-flat left" style="height: 100%;" @click="toggleSidebar"><i class="material-icons small">menu</i></a>
            <form style="display: inline-block">
                <div class="input-field">
                    <input type="search" id="search" required style="padding-right: 45px;">
                    <label for="search" class="label-icon"><i class="material-icons">search</i></label>
                    <i class="material-icons" style="margin-right: -45px;">close</i>
                </div>
            </form>
            <ul class="right">
                <li>
                </li>
                <li>
                    <form action="/logout" method="GET" id="logout">   
                        Hi, {{ name }}<a class="waves-effect waves-light btn-flat" onclick="$('#logout').submit();"><i class="material-icons">exit_to_app</i></a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    data: ()=> ({
        name: localStorage.getItem('name'),
        hideSidebar: false
    }),
    mounted(){
        console.log(`Navbar component mounted!`);
        setTimeout(() => {
            console.log(localStorage.getItem('name'));
        }, 2000);
    },
    methods:{
        toggleSidebar(){
            this.hideSidebar = !this.hideSidebar;
            this.$emit('toggleSidebar', this.hideSidebar);
        }
    }
}
</script>

<style scoped>
nav{
    position: fixed;
    top:0;right:0;
    z-index: 9;
}
.toggleSidebar{
    padding-left: 0 !important;
}
</style>
