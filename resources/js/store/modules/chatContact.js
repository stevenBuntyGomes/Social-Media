const state = {
    contacts: [],
    messages: [],
    notification: false,
};


const getters = {
    chatContacts(state){
        return state.contacts;
    },

    getNotification(state){
        return state.notification;
    }
};


const actions = {
    fetchContacts({commit, state}){
        axios.get('/api/contacts')
            .then(function (response) {
                // console.log(response.data);
                commit('setChatContacts', response.data);
                // commit('setNewsPosts', response.data);
            })
            .catch(function (error) {

            });
    },


    notify({commit, state}, data){
        commit('setNotification', data);
    }
};


const mutations = {
    setChatContacts(state, data){
        state.contacts = data;
    },

    setNotification(state, data){
        state.notification = data;
    }
};


export default {
    state,
    getters,
    actions,
    mutations,
}
