const state = {
    userSearch: [],
    postSearch: [],
};

const getters = {
    getUserSearch(state){
        return state.userSearch;
    }
};


const actions = {
    fetchUserSearch({commit, state}, data){
        axios.post('/api/search/userSearch', {
            'keywords': data.keywords,
        })
            .then(function (response) {
                // commit('setUserFriendship', null);
                commit('setUserSearch', response.data);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    }
};


const mutations = {
    setUserSearch(state, data){
        state.userSearch = data;
    }
};


export default {
    state,
    getters,
    actions,
    mutations,
}
