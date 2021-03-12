<template>
    <div class="modal" :id="type">
        <div class="modal-content">
            <h4><slot name="modal-title"></slot></h4>
            <slot name="modal-content"></slot>
        </div>
        <div class="modal-footer">
            <slot name="modal-footer"></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        type: String
    }
}
</script>

<style scoped>
.modal{
    border-radius: 5px;
}
.modal-footer{
    margin-top: -55px !important;
} 
.modal-content{
    overflow: hidden;
    height: 100% !important;
} 
</style>
