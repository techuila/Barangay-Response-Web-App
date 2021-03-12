import Axios from "axios";

const users = {
    state:{
        users:[]
    },
    getters:{
        getUsers:(state)=>{
            return state.users;
        }
    },
    mutations:{
        SET_USERS:(state, payload)=>{
            state.users  = payload;
        },
        ADD_USER:(state, payload)=>{
            state.users.push(payload);
        },
        UPDATE_USER:(state, payload)=>{
            const index = state.users.findIndex(e=> e.id == payload.id);
            state.users = state.users.map(e=>{
                if(e.id == index)
                    e = payload;
                return e;
            })
        },  
        DELETE_USER:(state, payload)=>{
            const index = state.user.findIndex(e=> e.id == payload.id);
            state.users.splice(index, 1);
        }
    },
    actions:{
        ADD_USER:({commit}, payload)=>{
            axios.post('/api/user', payload).then(res=>{
                M.Toast.dismissAll();
                M.toast({html: '<i class="material-icons green-text">check_circle</i><span style="margin-left: 10px;">Done!</span>', displayLength: 2000 ,classes: 'rounded'});

                commit('ADD_USER', res.data);
            }).catch(err=>{
                M.Toast.dismissAll();
                M.toast({html: '<i class="material-icons red-text" style="transform: rotate(45deg);">add_circle</i><span style="margin-left: 10px;">Error!</span>', displayLength: 2000 ,classes: 'rounded'});
                console.log(err);
            });
        },
        DELETE_USER:({commit}, payload)=>{
            axios.delete(`/api/user/${payload.id}`, payload).then(res=>{
                M.Toast.dismissAll();
                M.toast({html: '<i class="material-icons green-text">check_circle</i><span style="margin-left: 10px;">Done!</span>', displayLength: 2000 ,classes: 'rounded'});

                commit('DELETE_USER', res.data);
            }).catch(err=>{
                M.Toast.dismissAll();
                M.toast({html: '<i class="material-icons red-text" style="transform: rotate(45deg);">add_circle</i><span style="margin-left: 10px;">Error!</span>', displayLength: 2000 ,classes: 'rounded'});
                console.log(err);
            });
        },
        UPDATE_USER:({commit}, payload)=>{
            axios.put('/api/user', payload).then(res=>{
                M.Toast.dismissAll();
                M.toast({html: '<i class="material-icons green-text">check_circle</i><span style="margin-left: 10px;">Done!</span>', displayLength: 2000 ,classes: 'rounded'});

                commit('UPDATE_USER', res.data);
            }).catch(err=>{
                M.Toast.dismissAll();
                M.toast({html: '<i class="material-icons red-text" style="transform: rotate(45deg);">add_circle</i><span style="margin-left: 10px;">Error!</span>', displayLength: 2000 ,classes: 'rounded'});
                console.log(err);
            });
        },
        FETCH_USERS:({commit}, payload)=>{
            axios.get('/api/users').then(res=>{
                commit('SET_USERS', res.data);
            }).catch(err=>{
                M.Toast.dismissAll();
                M.toast({html: '<i class="material-icons red-text" style="transform: rotate(45deg);">add_circle</i><span style="margin-left: 10px;">Error!</span>', displayLength: 2000 ,classes: 'rounded'});
                console.log(err);
            });
        }
    }
}

export default users;