const state = {
    user: null,
    userStatus: null,
};

const getters = {
    authUser(state) {
        return state.user;
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
    }
};

const mutations = {
    setAuthUser(state, data){
        state.user = data;
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
}
