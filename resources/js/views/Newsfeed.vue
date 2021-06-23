<template>
    <div class = "flex flex-col items-center py-4">
        <Newpost>
            </Newpost>
            <div v-if = "newsPostStatus.newsPostStatus === 'loading'">Loading posts....</div>
            <div v-else-if = "newsPostStatus.newsPostStatus == 'success' && posts.length < 1">No posts found....!</div>
            <Post v-else v-for = "(post, postKey) in posts.data" :key = "postKey" :post="post" @post_key = "removePost"></Post>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'

// const axios = require('axios').default;
import Newpost from '../components/Newpost.vue'
import Post from '../components/Post.vue'

export default {
    name: 'Newsfeed',

    components: {
        Newpost,
        Post,
    },

    // data: () => {
    //     return {
    //         posts: null,
    //         loading: true,
    //     }
    // },

    mounted(){
        this.$store.dispatch('fetchNewsPosts');
    },


    computed: {
        ...mapGetters({
            posts: 'posts',
            newsPostStatus: 'newsPostStatus',
        })
    },


    methods: {
        removePost(postKey){
            this.posts.data.splice(postKey, 1);
        }
    }
}


</script>
<style scoped>

</style>
