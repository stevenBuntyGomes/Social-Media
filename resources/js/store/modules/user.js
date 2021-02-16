const state = {
    user: null,
    userStatus: null,
    settingsToggle: false,
};

const getters = {
    authUser(state) {
        return state.user;
    },

    toggleSettings(state){
        return state.settingsToggle;
    }
};

const actions = {
    fetchAuthUser({commit, state}){
        // var self = this;
        axios.get('/api/auth-user')
            .then(function (response){
                // self.user = response.data;
                commit('setAuthUser', response.data);
            })
            .catch(function (error){
                console.log('unable to fetch auth user')
            })
    },

    // fetching settings toggle data
    fetchSettings({commit, state}, data){
        commit('setAuthSettings', data);
    },


    AuthLogOut(){
        axios.post('/logout')
            .then(function (response){
                // self.user = response.data;
                window.location.reload();
            })
            .catch(function (error){
                // console.log('unable to fetch auth user')
            })
    }
};

const mutations = {
    setAuthUser(state, data){
        state.user = data;
    },

    setAuthSettings(state, data){
        state.settingsToggle = data;
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
}
