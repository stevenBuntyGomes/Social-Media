const state = {
    authNotification: [],
};

const getters = {
    getAuthNotification(state){
        return state.authNotification;
    }
};

const actions = {
    AuthNotification({state, commit}, data){
        axios.post('/api/mybook/getNotifications')
            .then(function (response) {
                // console.log(response.data);
                // commit('setChatContacts', response.data);
                commit('setNotifications', response.data);
            })
            .catch(function (error) {

            });
    },


    fetchDeleteNotification({state, commit}, data){
        axios.post('/api/book/deleteNotification', {
            'notification_id': data.notification_id,
        })
            .then(function (response) {
                // console.log(response.data);
                // commit('setChatContacts', response.data);
                // commit('removeNotification', {
                //     notifyKey: data.key,
                // });
            })
            .catch(function (error) {

            });
    }
};

const mutations = {
    setNotifications(state, data){
        state.authNotification = data;
    },

    removeNotification(state, data){
        state.authNotification.data.splice(data.notifyKey, 1);
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
}
