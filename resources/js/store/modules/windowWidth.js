const state = {
    windowWidth: window.innerWidth,
};

const getters = {
    getWindowWidth(state){
        return state.windowWidth;
    }
};

const actions = {
    fetchWindowWidth({commit, state}){
        commit('setWindowWidth');
    }
};


const mutations = {
    setWindowWidth(state){
        state.windowWidth = window.innerWidth;
    }
};


export default {
    state,
    getters,
    actions,
    mutations,
}
