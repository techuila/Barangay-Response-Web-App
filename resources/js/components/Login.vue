<template>
    <div id="login">
        <div class="form-container">
            <div class="con"></div>
            <div class="form-slider" :class="{ 'slide-left' : signUp, 'slide-right': !signUp }">
                <transition name="fade">
                    <SignUp v-if="signUp"></SignUp>
                    <SignIn v-else></SignIn>
                </transition>
            </div>
            <div class="info" :class="{ 'left-align' : !signUp, 'right-align' : signUp }">
                <center>
                    <h3 v-if="!signUp">Don't have an account?</h3>
                    <h3 v-else>Already have an account?</h3>
                    <button :class="{ 'orange-gradient' : !signUp, 'blue-gradient': signUp }" class="waves-effect waves-light btn-large z-depth-2" @click="signUp = ! signUp">
                        <span v-if="!signUp">Sign Up</span>
                        <span v-else>Sign In</span>
                    </button>
                </center>
            </div>
        </div>
    </div>
</template>

<script>
import SignIn from '../base/login/SignIn';
import SignUp from '../base/login/SignUp';

export default {
    components:{
        SignIn,
        SignUp
    },
    data: () => ({
        signUp: false
    })
}
</script>

<style scoped>
/* ======================================
				TRANSITIONS  
   ======================================*/
.slide-left {
	animation: slideLeft 0.5s both;
}

.slide-right {
	animation: slideRight 0.5s both;
}

.fade-enter-active{
    animation: showText 0.15s;
    animation-delay: 0.25s;
    opacity: 0;
}

.fade-leave-active{
    animation: hideText 0.15s;
}

@keyframes slideLeft{
	0%{
		right: 10px;
	}
	80%{
		right: 360px;
	}
	100%{
		right: 350px;
	}
}

@keyframes slideRight{
	0%{
		right: 350px;
	}
	80%{
		right: 0px;
	}
	100%{
		right: 10px;
	}
}

@keyframes showText{
	0%{
        opacity: 0;
        transform: translateY(20px);
	}
	100%{
        opacity: 1;
        transform: translateY(0);        
	}
}

@keyframes hideText{
	0%{
        opacity: 1;
        transform: translateY(0);        
	}
	100%{
        opacity: 0;
        transform: translateY(20px);        
	}
}


/* ======================================
				CLASSES
   ======================================*/
#login{
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	width: 100%;
	height: inherit;
	position: relative;
    /* background-color: #ecf0f1; */
    background: linear-gradient(45deg, #2193b0, #6dd5ed);
    overflow: hidden;
}

.form-container{
	box-shadow: 0px 2px 7px rgba(0,0,0,0.4);
	position: relative;
	height: 320px;
	width: 740px;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
}

.con{
    background-color: #ecf0f1;
    position: absolute;
    width: inherit;
    height: inherit;
    border-radius: 5px;
    opacity: 0.08;    
}

.wide{
	width: 100%;
}

#login-form input{
    /* border-color: #f0f0f0; */
    border-width: 1px;
    /* color: #fff; */
}

#login-form label{
    /* color: #f0f0f0; */
}

.form-slider{
	top: -50%;right: 10px;
	transform: translateY(24%);
    /* background: linear-gradient(45deg, #2193b0, #6dd5ed); */
    background-color: #e7e7e7;
	border-radius: 5px;
	position: absolute;
	padding: 20px;
	height: 430px;
	width: 380px;
	color: #ecf0f1 !important;
	box-shadow: -2px 2px 8px rgba(0,0,0,0.4);
	transition: all 0.5s ease-in-out;
	z-index: 10;
}

.info{
	position: absolute;
	padding: 20px;
	width: 350px;
}

.left-align{
	left: 0;
}

.right-align{
	right: 0;
}

.white{
	color:#ecf0f1 !important;
}

.signup, .signin{
	transition: all 0.5s forwards;
}

.show-text{
	animation: showText 0.5s forwards;
}
</style>
