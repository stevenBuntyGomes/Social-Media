const state = {
    about: null,
};

const getters = {
    getAbout(state){
        return state.about;
    }
};


const actions = {
    fetchAuthAbout({commit, state}, data){
        axios.post('/api/auth/about', {
            'user_id': data.user_id,
            })
            .then(function (response) {
                // commit('setUserFriendship', response.data);
                commit('setAbout', response.data);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },


    updateUserAbout({commit, state}, data){
        axios.post('/api/auth/about/edit', {
            'user_id': data.user_id,
            'study_place': data.study_place,
            'work_place': data.work_place,
            'business': data.business,
            'Location': data.Location,
            'contact': data.contact,
            })
            .then(function (response) {
                // commit('setUserFriendship', response.data);
                commit('setUpdateAbout', response.data);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    }
};


const mutations = {
    setAbout(state, data){
        state.about = data;
    },

    setUpdateAbout(state, data){
        state.about = data; 
    }
};


export default {
    state,
    getters,
    actions,
    mutations,
}