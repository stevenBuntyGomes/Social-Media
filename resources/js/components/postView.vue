<template>
    <div class = "flex flex-col items-center py-4">
        <Post :post="post"></Post>
    </div>
</template>
<script>
import Post from '../components/Post.vue'

export default {

    data: () => {
        return {
            post: [],
        }
    },


    components: {
        Post,
    },


    created(){
        this.post = this.$route.params.thisPost;
    },
}
</script>
<style scoped>

</style>
