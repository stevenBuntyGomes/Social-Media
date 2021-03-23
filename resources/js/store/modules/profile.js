const state = {
    user: null,
    userStatus: null,
    changeStatus: 0,
    nameStatus: 0,
    // posts: null,
    // postStatus: null,
    // friendButtonText: null,
    userFriends: [],
};

const getters = {
    user(state) {
        return state.user;
    },

    // posts(state){
    //     return state.posts;
    // },

    profileStatus(state){
        return{
            user: state.userStatus,
            post: state.postStatus,
        };
    },

    friendship:state => {
        return state.user.data.attributes.friendship;
    },

    friendButtonText: (state, getters, rootState) => { //rootState is the state of other store modules
        // return state.friendButtonText;
        if(rootState.User.user.data.user_id == state.user.data.user_id){
            return '';
        } else if(getters.friendship === null){
            return 'Add Friend';
        } else if(getters.friendship.data.attributes.confirmed_at == null
            && getters.friendship.data.attributes.friend_id != rootState.User.user.data.user_id){
            return 'Pending Friend Request';
        } else if(getters.friendship.data.attributes.confirmed_at != null) {
            return 'options';
        }

        return 'Accept';
    },

    //pass change status
    getChangeStatus(state){
        return state.changeStatus;
    },


    getNameStatus(state){
        return state.nameStatus;
    }, 


    getUserFriends(state){
        return state.userFriends;
    }
};

const actions = {
    fetchUser({commit, dispatch}, userId){
        // var self = this;
            commit('setUserStatus', 'loading');
            axios.get('/api/users/' + userId)
                .then(function (response){
                    commit('setUser', response.data);
                    commit('setUserStatus', 'success');
                    // self.loading = false;
                })
                .catch(function (error) {
                    // self.loading = false;
                    // console.log(error);
                    // console.log('erroron on user page');
                    commit('setUserStatus', 'error');
                });
    },




    sendFriendRequest({commit, getters}, friendId){
        if(getters.friendButtonText != 'Add Friend'){
            return;
        }
        axios.post('/api/friend-request', {'friend_id': friendId})
            .then(function (response) {
                commit('setUserFriendship', response.data);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },


    acceptFriendRequest({commit, state}, userId){
        // commit('setButtonText', 'loading');
        axios.post('/api/friend-request-response', {'user_id': userId, 'status': 1})
            .then(function (response) {
                commit('setUserFriendship', response.data);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },


    ignoreFriendRequest({commit, state}, userId){
        // commit('setButtonText', 'loading');
        axios.post('/api/friend-request-response/delete', {'user_id': userId})
            .then(function (response) {
                commit('setUserFriendship', null);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },

    // unfriend a person
    deleteFriendship({commit, state}, userId){
        axios.post('/api/friend-request-response/unfriend', {'user_id': userId})
            .then(function (response) {
                commit('setUserFriendship', null);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },

    // unfriend a person


    fetchUpdateUserName({commit, state}, updateUserName){
        axios.post('/api/auth-user/nameUpdate', {'updateUserName': updateUserName})
            .then(function (response) {
                // commit('setUserFriendship', null);
                commit('setNameStatus', response);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },

    //change User Password start
    fetchUpdatePassword({commit, state}, data){
        axios.post('/api/auth-user/passwordUpdate', {
            'oldPassword': data.oldPassword,
            'password': data.password,
            'confirmPassword': data.confirmPassword,
        })
            .then(function (response) {
                // commit('setUserFriendship', null);
                commit('passChangeStatus', response);
            })
            .catch(function (error){
                // commit('setButtonText', 'Add Friend');
            });
    },



    // get user friends in the friend list starts

    fetchUserFriends({commit, state}){
        axios.post('api/user/authFriends')
        .then(function (response){
            commit('setUserFriends', response.data);
        })
        .catch(function (error){
            // 
        })
    }

    // get user friends in the friend list ends
};

const mutations = {
    setUser(state, data){
        state.user = data;
    },


    // setPosts(state, posts){
    //     state.posts = posts;
    // },

    setUserFriendship(state, friendship){
        state.user.data.attributes.friendship = friendship;
    },

    setUserStatus(state, status){
        state.userStatus = status;
    },

    // setPostStatus(state, status){
    //     state.postStatus = status;
    // },

    passChangeStatus(state, data){
        state.changeStatus = data;
    },

    setNameStatus(state, data){
        state.nameStatus = data;
    },



    // get user friends starts

    setUserFriends(state, data){
        state.userFriends = data;
    }
    // get user friends ends
};

export default {
    state,
    getters,
    actions,
    mutations,
}
