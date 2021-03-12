<template>
    <div id="users">
        <Modal type="m-users" style="height: 150px !important; width: 350px !important;">
            <template slot="modal-title">Add User</template>
            <template slot="modal-content"><p>Are you sure you want to add this user?</p></template>
            <template slot="modal-footer">
                <a class="modal-close waves-effect waves-red btn-flat red-text">CANCEL</a>
                <a class="modal-close waves-effect waves-green btn-flat green-text" onclick="$('#magic').click()">SAVE</a>
            </template>
        </Modal>
        <div class="row">
            <div class="col s12" style="margin-top: 20px;">
                <h2>Users</h2>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <form @submit.prevent="addUser" name="form-user">
                    <div class="col s3">
                        <div class="input-field">
                            <input type="text" id="name" name="name" required>
                            <label for="name">Name</label>
                        </div>
                    </div>
                    <div class="col s3">
                        <div class="input-field">
                            <input type="text" id="address" name="address" required>
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <div class="col s2">
                        <div class="input-field">
                            <input type="text" class="datepicker" id="birthdate" name="birthdate" required>
                            <label for="birthdate">Birthdate</label>
                        </div>
                    </div>
                    <div class="col s2">
                        <div class="input-field">
                            <input type="tel" id="sim_number" name="sim_number" required>
                            <label for="sim_number">Sim Number</label>
                        </div>
                    </div>
                    <div class="col s2">
                        <button type="submit" id="magic" class="magic"></button>
                        <a id="saveUser" href="#m-users" class="modal-trigger waves-effect waves-light btn blue wide white-text">Save</a>
                    </div>
                </form>
            </div>
        </div>
        <table class="highlight responsive-table striped centered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Birthdate</th>
                    <th>Sim Number</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.address}}</td>
                    <td>{{user.birthdate}}</td>
                    <td>{{user.sim_number}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import Modal from '../../Modal';

export default {
    components:{
        Modal
    },
    created(){
        this.$store.dispatch('FETCH_USERS');
    },
    mounted(){
        $('.datepicker').datepicker();
        $('#birthdate').focusin(()=>{
            $('#birthdate').click();
        }); 
    },
    methods:{
        addUser(){
            const formData = new FormData(document.forms.namedItem('form-user'));
            this.$store.dispatch('ADD_USER', formData);
        }
    },
    computed:{
        users(){
            return this.$store.getters.getUsers;
        }
    }
}
</script>

<style scoped>
#saveUser{
    margin-top: 22px;
}
</style>
