<template>
    <div id="app">
        <router-view :key="this.$route.path"></router-view>
    </div>
</template>

<script>
export default {

}
</script>

<style>
html,body{
    width: 100%;
    height: 100%;
    scroll-behavior: smooth;
}
.magic{
    display: none;
}
.nav-wrapper{
    transition: all 0.3s ease-out;
    background-color: #2c3e50 !important;
    padding-left: 300px;
}
#app{
    width: 100%;
    height: 100%;
}
.tiny{
    font-size: 1rem !important;
}
.small{
    font-size: 2rem !important;
}
.medium{
    font-size: 4rem !important;
}
.large{
    font-size: 6rem !important;
}
.pointer{
    cursor: pointer;
}
.secondary-bg{
    background-color: #E91E63;
}
.secondary-color{
    color: #E91E63;
}
.primary-bg{
    background-color: #2196F3;
}
.primary-color{
    color: #2196F3;
}
.wide{
    width: 100%;
}
.blue-gradient{
	background: linear-gradient(135deg, #2193b0, #6dd5ed);
}
.orange-gradient{
    background: linear-gradient(135deg, #FF416C, #FF4B2B);
}
.btn, .btn-large{
    outline: 0 !important;
}
.circular{
    border-radius: 100px;
}
.input-error{
    border-width: 2px !important;
    border-color: red !important;
}
.datepicker-modal{
    height: 396px !important;
}
#home{
    overflow-x: hidden;
}
#slide-out, #content{
    transition: all 0.3s ease-out;
}
#content {
    padding-left: 300px;
}
header{
    height: 70px;
}
main{
    padding: 0 2%;
}
@media only screen and (max-width : 992px) {
    #content {
    padding-left: 0;
    }
}
</style>
