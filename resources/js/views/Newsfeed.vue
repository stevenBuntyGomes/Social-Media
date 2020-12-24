<template>
    <div class = "flex flex-col items-center py-4">
        <Newpost>
            </Newpost>
            <p v-if = "newsPostStatus.newsPostStatus == 'loading'">Loading posts....</p>
            <Post v-else v-for = "(post, postKey) in posts.data" :key = "postKey" :post="post"></Post>
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
    }
}


</script>
<style scoped>

</style>
