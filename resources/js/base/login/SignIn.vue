<template>
    <form name="signin-form" id="signin-form" @submit.prevent="login">
        <h2 class="blue-text">Sign In</h2>
        <div class="input-field">
            <i class="material-icons prefix blue-text text-lighten-2">account_circle</i>
            <input v-model="emailText" @keydown="keydown()" :class="{ 'input-error': email }" class="validate" id="email" type="email" name="email" required>
            <label for="email" class="blue-text text-lighten-2">Email</label>
            <span class="helper-text red-text">
                <span v-if="email">{{errorMsg}}</span>
            </span>
        </div>

        <div class="input-field">
            <i class="material-icons prefix blue-text text-lighten-2">lock_outline</i>
            <input v-model="passwordText" class="validate" id="password" type="password" name="password" required>
            <label for="password" class="blue-text text-lighten-2">Password</label>
        </div>

        <label for="remember">
            <input type="checkbox" name="remember" id="remember" ref="rem">
            <span>Remember Me</span>
        </label>
        <br><br>
        <button type="submit" class="waves-effect waves-light btn wide blue-gradient circular" style="margin-bottom: 5px;">
            Login
        </button><br>
        <a class="grey-text text-darken-4" href="password/reset">
            Forgot Your Password?
        </a>
    </form>
</template>

<script>
export default {
    data: ()=>({
        errorMsg: '',
        email: false,
        emailText: '',
        passwordText: ''
    }),
    mounted(){
        console.log(localStorage.getItem(`email`));
        if(localStorage.getItem('email') != null && localStorage.getItem('email').trim() != ''){
            console.log('true')
            console.log(localStorage.getItem('email'))
            this.emailText = localStorage.getItem('email');
            this.passwordText = localStorage.getItem('password');
            $('#email').val(localStorage.getItem('email'));
            $('#password').val(localStorage.getItem('password'));
            $('#remember').prop('checked', true);
            M.updateTextFields();
        }else{
            console.log('false')
            this.emailText = '';
            this.passwordText = '';
            $('#remember').prop('checked', false);
        }

    },
    methods:{
        login(){
            console.log(window.axios.defaults.headers.common);
            const formData = new FormData(document.forms.namedItem('signin-form'));
            formData.set('remember',this.$refs.rem.checked);
            // const formData = $('form').serialize();

            console.log($('#signin-form').serialize());

            axios.post(`login`,formData).then(res => {
                console.log(res);
                /* Add to local Session user auth */
                localStorage.setItem('email', res.data.email);
                localStorage.setItem('name', res.data.name);
                console.log(localStorage.getItem('email'));
                console.log(localStorage.getItem('name'));

                /* REMEMBER ME~ */
                console.log(this.$refs.rem.checked);
                if(this.$refs.rem.checked == true){
                    localStorage.setItem('email', this.emailText);
                    localStorage.setItem('password', this.passwordText);
                    console.log(localStorage.getItem('password'));
                }else{
                    if(localStorage.getItem('email') != null){
                        localStorage.setItem('email', '');  
                        localStorage.setItem('password', '');
                    }
                }
                
                this.showError(0,'');
            })
            .catch(error =>{
                M.updateTextFields();
                if(typeof error.response.data.errors.email[0] !== 'undefined')
                    this.showError(1,error.response.data.errors.email[0]);
            });
        },
        showError(n,msg){
            this.email = false;
            if(n == 1)
                this.email = true;
            else
                this.$router.push('/home');
            this.errorMsg = msg;
        },
        keydown(){
            if(this.errorMsg != '') this.email = false;
        }
    }
}
</script>

<style>

</style>
