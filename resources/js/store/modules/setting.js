import Axios from "axios";

const setting = {
    state:{
        realtime: false
    },
    getters:{
        getRealtime:(state)=>{
            return state.realtime;
        }  
    },
    mutations:{
        SET_SETTINGS:(state, payload)=>{
            state.realtime = (payload == 1)?true:false;
        }
    },
    actions:{
        FETCH_SETTINGS:({commit}, payload)=>{
            axios.get('/api/settings').then(res =>{ 
                commit('SET_SETTINGS', res.data.realtime);
            }).catch(err=>{
                console.log(err);
            });
        },
        UPDATE_SETTINGS:({commit}, payload)=>{
            const formData = new URLSearchParams();
            formData.append('realtime', payload ? 1 : 0);
            axios.put(`/api/settings/1`, formData).then(res=>{
                commit('SET_SETTINGS', res.data.realtime);

                let on = (payload) ? 'On' : 'Off', icon = (payload) ? 'check_circle' : 'info_outline',color = (payload)? 'green':'yellow';
                M.Toast.dismissAll();
                M.toast({html: `<i class="material-icons ${color}-text">${icon}</i><span style="margin-left: 10px;">Realtime data: ${on}</span>`, displayLength: 1500 ,classes: 'rounded'});
            }).catch(err=>{
                M.Toast.dismissAll();
                M.toast({html: '<i class="material-icons red-text" style="transform: rotate(45deg);">add_circle</i><span style="margin-left: 10px;">Error!</span>', displayLength: 2000 ,classes: 'rounded'});
            });
        }
    }
}

export default setting;