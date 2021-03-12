const location = {
    state:{
        data:{
            links:{
                first: '',
                last: '1=0',
                next: '',
                prev: ''
            },
            meta:{
                current_page: 1
            }
        }
    },
    getters:{
        locations:(state)=>{
            return state.data;
        },
        getLocationLen:(state)=>{
            return state.data.links.last.split("=");
        }
    },
    mutations:{
        SET_LOCATIONS:(state, payload)=>{
            state.data = payload;
        },
        ADD_LOCATION:(state,payload)=>{
            state.data.data.push(payload);
        },
        DELETE_LOCATION:(state,payload)=>{
            const index = state.data.data.findIndex(location => location.id == payload.id);
            state.data.data.splice(index, 1);
        },
        UPDATE_LOCATION:(state,payload)=>{
            const index = state.data.data.findIndex(location => location.id == payload.id);
            state.data.data = state.data.data.map(e => {
                if(e.id == payload.id){
                    e = payload;
                } 
                return e
            });
        }
    },
    actions:{
        FETCH_LOCATIONS:({commit})=>{
            axios.get('/api/locations').then(res=>{
                commit('SET_LOCATIONS', res.data);
            }).catch(err=>{
                console.log(err);
            });
        },
        FETCH_LOCATION_PAGE:({commit}, payload)=>{
            axios.get(`/api/locations?page=${payload}`).then(res=>{
                commit('SET_LOCATIONS', res.data);
            });
        }
    }
};

export default location;