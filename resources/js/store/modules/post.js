const state = {
    posts: null,
    newsPostStatus: null,
    postMessage: '',
};

const getters = {
    posts(state) {
        return state.posts;
    },

    postMessage(state){
        return state.postMessage;
    },

    newsPostStatus(state){
        return {
            newsPostStatus: state.newsPostStatus,
        }
    }
};

const actions = {
    fetchNewsPosts({commit, state}){
        commit('setPostStatus', 'loading');
        axios.get('/api/get_posts')
            .then(function (response) {
                // self.posts = response.data
                commit('setNewsPosts', response.data);
                commit('setPostStatus', 'success');
            })
            .catch(function (error) {
                commit('setPostStatus', 'failure or error');
            })
    },

    // fetching user posts for user profile

    fetchUserPosts({commit, state}, userId){
        commit('setPostStatus', 'loading');
        axios.get('/api/users/' + userId + '/posts')
                    .then(function (response) {
                        // self.posts = response.data
                        commit('setNewsPosts', response.data);
                        commit('setPostStatus', 'success');
                    })
                    .catch(function (error) {
                        commit('setPostStatus', 'failure or error');
                    });
    },

    // fetching user posts for user profile


    fetchPostMessage({commit, state}, postMessage){
        commit('updateMessage', postMessage);
    },


    postMessage({commit, state}){
        axios.post('/api/posts', {body: state.postMessage})
            .then(function (response) {
                // self.posts = response.data
                commit('pushPost', response.data);
                commit('updateMessage', '');
            })
            .catch(function (error) {
                commit('setPostStatus', 'error');
            })
    },

    // updatePostMessage only message not image
    updatePostMessage({commit, state}, data){
        axios.post('/api/posts/edit', {
            'body': data.body,
            'post_id': data.post_id,
        })
            .then(function (response) {
                // self.posts = response.data
                commit('updatePost', {
                    response: response.data,
                    postKey: data.postKey,
                });
                commit('updateMessage', '');
            })
            .catch(function (error) {
                commit('setPostStatus', 'error');
            })
    },

    // setting up like for user post

    likePost({commit, state}, data){
        axios.post('/api/posts/' + data.postId + '/like')
            .then(function (response) {
                commit('pushLikes', {likes: response.data, postKey: data.postKey});
            })
            .catch(function (error) {
                // commit('setPostStatus', 'error');
            })
    },
    // setting up like for user post

    // setting up comment for user post
    commentPost({commit, state}, data){
        axios.post('/api/posts/' + data.postId + '/comment', {body: data.body})
            .then(function (response) {
                commit('pushComments', {comments: response.data, postKey: data.postKey});
            })
            .catch(function (error) {
                // commit('setPostStatus', 'error');
            })
    },
    // setting up comment for user post

    // delete post starts
    deleteSinglePosts({commit, state}, data){
        axios.post('/api/posts/destroy', {
           'post_id': data.post_id,
           'postKey': data.postKey,
        })
            .then(function (response){
                commit('removePost', {
                    response: resonse.data,
                    postKey: data.postKey
                });
            })
            .catch(function(error){
            
            });
    }

    // delete post ends

};

const mutations = {
    setNewsPosts(state, posts){
        state.posts = posts;
    },

    setPostStatus(state, status){
        state.newsPostStatus = status;
    },


    updateMessage(state, postMessage){
        state.postMessage = postMessage;
    },

    pushPost(state, post){
        state.posts.data.unshift(post);
    },

    // wortking with likes of posts
    pushLikes(state, data){
        state.posts.data[data.postKey].data.attributes.likes = data.likes;
    },

    // wortking with likes of posts

    // wortking with comments of posts
    pushComments(state, data){
        state.posts.data[data.postKey].data.attributes.comments = data.comments;
    },

    // wortking with comments of posts

    // update post starts
    updatePost(state, data){
        state.posts.data[data.postKey].data.attributes.body = data.response.data.attributes.body;
        state.posts.data[data.postKey].data.attributes.image = data.response.data.attributes.image;
    },
    // update post ends

    // delete post permanently starts
    removePost(state, data){
        state.posts.data.splice(data.postKey, 1);
    }
    // delete post permanently ends



};

export default {
    state,
    getters,
    actions,
    mutations,
}
