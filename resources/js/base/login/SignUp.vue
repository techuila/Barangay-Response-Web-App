<template>
    <form name="signup-form" id="signup-form" @submit.prevent="register"> 
        <div class="row">
            <div class="col s12">
                <h2 class="red-text text-darken-1">Sign Up</h2>
                <div class="col s12">
                    <div class="input-field">
                        <input v-model="name" class="validate" id="name" type="text" name="name" required>
                        <label for="name" class="blue-text text-lighten-2">Name</label>
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <input :class="{ 'input-error': errorMsg[0] != '' }" @keydown="keydown(0)" v-model="email" class="validate" id="email" type="email" name="email" required>
                        <label for="email" class="blue-text text-lighten-2">Email</label>
                        <span class="helper-text red-text" v-if="errorMsg[0] != ''">{{errorMsg[0]}}</span>
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <input :class="{ 'input-error': errorMsg[1] != '' }" @keydown="keydown(1)" v-model="password" class="validate" id="password" type="password" name="password" required>
                        <label for="password" class="blue-text text-lighten-2">Password</label>
                        <span class="helper-text red-text" v-if="errorMsg[1] != ''">{{errorMsg[1]}}</span>
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <input :class="{ 'input-error': errorMsg[2] != '' }" @keydown="keydown(2)" v-model="c_password" class="validate" id="password-confirm" type="password" name="password_confirmation" required>
                        <label for="password-confirm" class="blue-text text-lighten-2">Confirm Password</label>
                        <span class="helper-text red-text" v-if="errorMsg[2] != ''">{{errorMsg[2]}}</span>
                    </div>
                </div>
                <div class="col s12" style="margin-top: 15px;">
                    <button type="submit" class="waves-effect waves-light btn wide orange-gradient circular" style="margin-bottom: 5px;">
                        Register
                    </button><br>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data: () => ({
        name: '',
        email: '',
        password: '',
        c_password: '',
        errorMsg:{
            0 : '',
            1 : '',
            2 : ''
        }
    }),
    methods:{
        register(){
            this.errorMsg[0] = '';
            this.errorMsg[1] = '';
            this.errorMsg[2] = '';
            const formData = new FormData(document.forms.namedItem('signup-form'));
            axios.post('register', formData).then(res=>{
                this.$router.push('/home');
            }).catch(error=>{
                if(typeof error.response.data.errors.email !== 'undefined')
                    this.errorMsg[0] = error.response.data.errors.email[0];

                if(typeof error.response.data.errors.password[1] !== 'undefined'){
                    this.errorMsg[1] = error.response.data.errors.password[0];
                    this.errorMsg[2] = error.response.data.errors.password[1];
                }else
                    this.errorMsg[2] = error.response.data.errors.password[0];
                
            });
        },
        keydown(id){
            if(this.errorMsg[id] != '') this.errorMsg[id] = '';
        }
    }
}
</script>

<style scoped>
.input-field{
    position: relative;
}
.helper-text{
    position: absolute;
    bottom: -15px;
}
</style>
